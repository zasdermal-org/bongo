<?php

namespace Module\Access\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Module\Access\Models\Role;
use Module\Access\Models\User;
use Module\Access\Models\Employee;
use Module\Access\Models\Designation;

use Module\Market\Models\Area;
use Module\Market\Models\Zone;
use Module\Market\Models\Region;
use Module\Market\Models\Division;
use Module\Market\Models\Territory;
use Module\Sales\Models\OrderInvoice;


class UserController extends Controller
{
    public function users(Request $request): View
    {
        $this->authorize('read', User::class);

        $data['breadcrumbs'] = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'User Management', 'url' => null],
            ['title' => 'Users', 'url' => null],
        ];

        $query = User::query();
        $data['roles'] = Role::all();
        $data['areas'] = Area::all();
        $data['zones'] = Zone::all();
        $data['regions'] = Region::all();
        $data['divisions'] = Division::all();
        $data['territories'] = Territory::all();
        $data['designations'] = Designation::all();

        if ($request->filled('is_active')) {
            $is_active = $request->is_active;
            $query->where('is_active', $is_active);
        }

        if ($request->filled('username')) {
            $username = $request->username;
            $query->where('username', $username);
        }

        $data['users'] = $query->orderBy('id', 'desc')->paginate(20);

        return view('Access::users.list', $data);
    }

    public function store(Request $request): JsonResponse
    {
        $this->authorize('create', User::class);

        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'username' => 'required|unique:users|max:255',
            'name' => 'required|string|max:255',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'role_id'=> $data['role_id'],
            'username' => $data['username'],
            'name' => Str::title($data['name']),
            'password' => Hash::make($data['password']),
        ]);
        
        Employee::create([
            'user_id' => $user->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User added successfully',
        ]);
    }

    public function user($id)
    {
        $this->authorize('update', User::class);

        $user = User::with(
            'employee',
            'employee.zone'
        )->findOrFail($id);

        return response()->json([
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', User::class);

        $user = User::findOrFail($id);

        $data = $request->validate([
             // User table fields
            'role_id' => 'sometimes|required|exists:roles,id',
            'name' => 'sometimes|required|string|max:255',
            'is_active' => 'nullable|in:Active,Inactive',
            // Employee table fields
            'designation_id' => 'nullable|exists:designations,id',
            'zone_id' => 'nullable|exists:zones,id|unique:employees,zone_id,' . optional($user->employee)->id,
            'division_id' => 'nullable|exists:divisions,id|unique:employees,division_id,' . optional($user->employee)->id,
            'region_id' => 'nullable|exists:regions,id|unique:employees,region_id,' . optional($user->employee)->id,
            'area_id' => 'nullable|exists:areas,id|unique:employees,area_id,' . optional($user->employee)->id,
            'territory_id' => 'nullable|exists:territories,id|unique:employees,territory_id,' . optional($user->employee)->id,
            'contact' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'joining_date' => 'nullable|date',
        ], [
            'zone_id.unique' => 'The zone is already assigned to another employee.',
        ]);

        $user->update([
            'role_id'=> $data['role_id'] ?? $user->role_id,
            'name' => isset($data['name']) ? Str::title($data['name']) : $user->name,
            'is_active' => $data['is_active'] ?? $user->is_active
        ]);

        $updateEmployee = [
            'designation_id'=> $data['designation_id'] ?? $user->employee->designation_id,
            'division_id'=> $data['division_id'] ?? $user->employee->division_id,
            'region_id'=> $data['region_id'] ?? $user->employee->region_id,
            'area_id'=> $data['area_id'] ?? $user->employee->area_id,
            'territory_id'=> $data['territory_id'] ?? $user->employee->territory_id,
            'contact' => $data['contact'] ?? $user->employee->contact,
            'address' => $data['address'] ?? $user->employee->address,
            'joining_date' => $data['joining_date'] ?? $user->employee->joining_date,
        ];

        if (array_key_exists('zone_id', $data)) {
            $updateEmployee['zone_id'] = $data['zone_id'];
        }

        $user->employee->update($updateEmployee);

        if (array_key_exists('zone_id', $data)) {
            if (isset($data['zone_id'])) {
                $zone_by_user = Zone::where('user_id', $user->id)->first();
                if ($zone_by_user) {
                    $zone_by_user->update([
                        'user_id' => null
                    ]);
                }
                
                $zone = Zone::where('id', $data['zone_id'])->first();
                $zone->update([
                    'user_id' => $user->id
                ]);
            } else {
                $zone = Zone::where('user_id', $user->id)->first();
                if ($zone) {
                    $zone->update([
                        'user_id' => null
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $this->authorize('delete', User::class);

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ]);
    }

    // api
    public function dashboard_summary(Request $request)
    {
        try {
            $user_id = $request->user_id;
            $employee = Employee::with('designation')->where('user_id', $user_id)->first();

            $slugs = ['chief-executive-officer', 'divisional-sales-manager', 'software-engineer'];
            $isAdmin = in_array(optional($employee->designation)->slug, $slugs);

            $date = now();
            // $year = $date->year;
            // $month_name = $date->format('F');




            $query = OrderInvoice::query();

            // if ($request->filled('region_id') && $request->region_id != 0) {

            //     $region_id = $request->region_id;

            //     $territoryIds = Territory::whereHas('area.region', function ($query) use ($region_id) {
            //         $query->where('id', $region_id);
            //     })->pluck('id');

            //     $query->whereIn('territory_id', $territoryIds);
            // }

            if (!$isAdmin) {

                if ($request->filled('region_id') && $request->region_id != 0) {

                    $region_id = $request->region_id;

                    $territoryIds = Territory::whereHas('area.region', function ($query) use ($region_id) {
                        $query->where('id', $region_id);
                    })->pluck('id');

                    $query->whereIn('territory_id', $territoryIds);
                }
            }

            // Area Filter
            if ($request->filled('area_id') && $request->area_id != 0) {

                $area_id = $request->area_id;

                $territoryIds = Territory::whereHas('area', function ($query) use ($area_id) {
                    $query->where('id', $area_id);
                })->pluck('id');

                $query->whereIn('territory_id', $territoryIds);
            }

            // Territory Filter
            if ($request->filled('territory_id') && $request->territory_id != 0) {

                $query->where('territory_id', $request->territory_id);
            }

            $invoiceQuery = clone $query;


            $invoices = $invoiceQuery->whereNotIn('status', ['Requested', 'Cancel'])
                ->whereMonth('invoice_date', $date->month)
                ->whereYear('invoice_date', $date->year)
                ->get();

            $total_due = (clone $query)
                ->whereNotIn('status', ['Requested', 'Cancel'])
                // ->whereMonth('invoice_date', $date->month)
                // ->whereYear('invoice_date', $date->year)
                ->get();


            /*
            |--------------------------------------------------------------------------
            | Summary Calculation
            |--------------------------------------------------------------------------
            */
            $creditInvoices = $invoices->where('payment_type', 'Credit');
            $cashInvoices   = $invoices->where('payment_type', 'Cash');

            $sales = [
                'credit_invoice_count'   => $creditInvoices->count(),
                'cash_invoice_count'     => $cashInvoices->count(),
                'credit_invoice_value'   => round($creditInvoices->sum('total_amount'), 2),
                'cash_invoice_value'     => round($cashInvoices->sum('total_amount'), 2),
                'total_collection'       => round($invoices->sum('paid'), 2),
                'total_due'              => round($invoices->sum('due'), 2),
                'all_due'                => round($total_due->sum('due'), 2),
            ];


            return response()->json([
                'status' => 'SUCCESS',
                'data' => $sales,
                'message' => 'Summary retrieved successfully.'
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error retrieving summary: ' . $e->getMessage());

            return response()->json([
                'status' => 'Error',
                'message' => 'Failed to retrieve summary.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace Module\Access\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Laravel\Sanctum\PersonalAccessToken;
use Module\Access\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login_form(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); // Redirect to the desired page
        }

        return view('Access::login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $validator = Validator::make($credentials, [
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if (!Auth::attempt($credentials)) {
            $errors = [];
            if (!$user = User::where('username', $credentials['username'])->first()) {
                $errors['username'] = 'Invalid username';
            } else {
                if (!Hash::check($credentials['password'], $user->password)) {
                    $errors['password'] = 'Invalid password';
                }
            }

            return redirect()->back()->withErrors($errors)->withInput($request->except('password'));
        }

        return redirect()->intended(route('dashboard'));
    }

    public function dashboard(): View
    {
        $data['title'] = 'Dashboard';
        $data['breadcrumbs'] = [
            ['title' => 'Dashboard', 'url' => null]
        ];

        // $data['modules'] = Module::all();

        return view('Access::dashboard', $data);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    // api
    // public function signin(Request $request)
    // {
    //     $credentials = $request->only('username', 'password');

    //     // Validation rules
    //     $rules = [
    //         'username' => 'required',
    //         'password' => 'required|min:6',
    //     ];

    //     // Validate the input data
    //     $validator = Validator::make($credentials, $rules);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'ERROR',
    //             'message' => $validator->errors()
    //         ], 422);
    //     }

    //     $user = User::where('username', $credentials['username'])->first();

    //     if (!$user || !Hash::check($credentials['password'], $user->password)) {
    //         return response()->json([
    //             'status' => 'ERROR',
    //             'message' => 'Invalid username or password'
    //         ], 401);
    //     }

    //     $token = $user->createToken('api-token')->plainTextToken;

    //     return response()->json([
    //         'status' => 'SUCCESS',
    //         'data' => [
    //             'user_id' => $user->id,
    //             'role_id' => $user->role->id,
    //             'region_id' => $user->employee->region?->id,
    //             'area_id' => $user->employee->area?->id,
    //             'territory_id' => $user->employee->territory?->id,
    //             'username' => $user->username,
    //             'name' => $user->name,
    //             'designation_name' => $user->employee->designation?->name,
    //             'contact' => $user->employee->contact,
    //             'address' => $user->employee->address,
    //             'joining_date' => $user->employee->joining_date,
    //             'token' => $token
    //         ],
    //         'message' => 'User successfully login.'
    //     ], 200);
    // }

    // public function signin(Request $request)
    // {
    //     $credentials = $request->only('username', 'password');

    //     // Validation rules
    //     $rules = [
    //         'username' => 'required',
    //         'password' => 'required|min:6',
    //     ];

    //     // Validate the input data
    //     $validator = Validator::make($credentials, $rules);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'ERROR',
    //             'message' => $validator->errors()
    //         ], 422);
    //     }

    //     // Use mysql_test connection
    //     $user = User::on('mysql_test')
    //         ->where('username', $credentials['username'])
    //         ->first();

    //     if (!$user || !Hash::check($credentials['password'], $user->password)) {
    //         return response()->json([
    //             'status' => 'ERROR',
    //             'message' => 'Invalid username or password'
    //         ], 401);
    //     }

    //     // Create token from mysql_test connection user
    //     $token = $user->createToken('api-token')->plainTextToken;

    //     return response()->json([
    //         'status' => 'SUCCESS',
    //         'data' => [
    //             'user_id' => $user->id,
    //             'role_id' => $user->role?->id,
    //             'region_id' => $user->employee?->region?->id,
    //             'area_id' => $user->employee?->area?->id,
    //             'territory_id' => $user->employee?->territory?->id,
    //             'username' => $user->username,
    //             'name' => $user->name,
    //             'designation_name' => $user->employee?->designation?->name,
    //             'contact' => $user->employee?->contact,
    //             'address' => $user->employee?->address,
    //             'joining_date' => $user->employee?->joining_date,
    //             'token' => $token
    //         ],
    //         'message' => 'User successfully login.'
    //     ], 200);
    // }

    public function signin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Validation rules
        $rules = [
            'username' => 'required',
            'password' => 'required|min:6',
        ];

        // Validate the input data
        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $validator->errors()
            ], 422);
        }

        $user = User::where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Invalid username or password'
            ], 401);
        }

        // $token = $user->createToken('api-token')->plainTextToken;

        /*
        |--------------------------------------------------------------------------
        | Create token in main DB
        |--------------------------------------------------------------------------
        */
        $tokenResult = $user->createToken('api-token');

        $plainTextToken = $tokenResult->plainTextToken;

        $mainToken = $tokenResult->accessToken;

        /*
        |--------------------------------------------------------------------------
        | Insert same token into mysql_test DB
        |--------------------------------------------------------------------------
        */
        DB::connection('mysql_test')
            ->table('personal_access_tokens')
            ->insert([
                'id' => $mainToken->id,
                'tokenable_type' => $mainToken->tokenable_type,
                'tokenable_id' => $mainToken->tokenable_id,
                'name' => $mainToken->name,
                'token' => $mainToken->token,
                'abilities' => $mainToken->abilities,
                'last_used_at' => $mainToken->last_used_at,
                'expires_at' => $mainToken->expires_at,
                'created_at' => $mainToken->created_at,
                'updated_at' => $mainToken->updated_at,
            ]);

        return response()->json([
            'status' => 'SUCCESS',
            'data' => [
                'user_id' => $user->id,
                'role_id' => $user->role->id,
                'region_id' => $user->employee->region?->id,
                'area_id' => $user->employee->area?->id,
                'territory_id' => $user->employee->territory?->id,
                'username' => $user->username,
                'name' => $user->name,
                'designation_name' => $user->employee->designation?->name,
                'contact' => $user->employee->contact,
                'address' => $user->employee->address,
                'joining_date' => $user->employee->joining_date,
                'token' => $plainTextToken
            ],
            'message' => 'User successfully login.'
        ], 200);
    }
}

@extends('Access::layouts.app')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    @include('Access::layouts.breadcrumb')
    <!--end::Toolbar-->

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header mt-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <form class="d-flex align-items-center position-relative my-1" action="{{ route('report.collections') }}" method="GET">
                            <div class="w-110 mw-120px me-2">
                                <select name="sale_point_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Sales Point">
                                    <option></option>
                                    @foreach ($sale_points as $sale_point)
                                        <option value="{{ $sale_point->id }}" {{ request('sale_point_id') == $sale_point->id ? 'selected' : '' }}>
                                            {{ $sale_point->name }} — ({{ $sale_point->code_number }})
                                        </option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- <div class="w-110 mw-120px me-2">
                                <select name="type" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Type">
                                    <option></option>
                                    <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="seed" {{ request('type') == 'seed' ? 'selected' : '' }}>Seed</option>
                                    <option value="agrochemicals" {{ request('type') == 'agrochemicals' ? 'selected' : '' }}>Agrochemicals</option>
                                </select>
                            </div> --}}

                            <!-- Region -->
                            <div class="w-110 mw-120px me-2">
                                <select onchange="loadAreas(this.value)" name="region_id" id="region_id" class="form-select form-select-solid" data-control="select2">
                                    <option value="">All Regions</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? 'selected' : '' }}>
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Area -->
                            <div class="w-110 mw-120px me-2">
                                <select onchange="loadTerritories(this.value)" name="area_id" id="area_id" class="form-select form-select-solid" data-control="select2">
                                    <option value="">All Areas</option>
                                    @if(request('region_id'))
                                        @foreach ($areas->where('region_id', request('region_id')) as $area)
                                            <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                                                {{ $area->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Territory -->
                            <div class="w-110 mw-120px me-2">
                                <select name="territory_id" id="territory_id" class="form-select form-select-solid" data-control="select2">
                                    <option value="">All Territories</option>
                                    @if(request('area_id'))
                                        @foreach ($territories->where('area_id', request('area_id')) as $territory)
                                            <option value="{{ $territory->id }}" {{ request('territory_id') == $territory->id ? 'selected' : '' }}>
                                                {{ $territory->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="w-110 mw-120px me-2">
                                <input name="from_date" type="date" value="{{ request('from_date') ?? \Carbon\Carbon::now()->toDateString() }}" class="form-control form-control-solid" />
                            </div>

                            <div class="w-110 mw-120px me-2">
                                <input name="to_date" type="date" value="{{ request('to_date') ?? \Carbon\Carbon::now()->toDateString() }}" class="form-control form-control-solid" />
                            </div>

                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Export dropdown-->
                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor" />
                                    <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor" />
                                    <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            Export Report
                        </button>

                        <!--begin::Menu-->
                        <div id="kt_ecommerce_report_views_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="{{ request()->fullUrlWithQuery(['export'=>'excel']) }}" class="menu-link px-3">Export as Excel</a>
                            </div>

                            <div class="menu-item px-3">
                                <a href="{{ request()->fullUrlWithQuery(['export'=>'pdf']) }}" class="menu-link px-3">Export as PDF</a>
                            </div>
                        </div>
                        <!--end::Menu-->
                        <!--end::Export dropdown-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-700 fw-bolder fs-7 gs-0">
                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Count => {{ $collcetion_count }}</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Total Adjustment Value => {{ number_format($total_adjustment_value, 2) }} Tk</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Total Collect => {{ number_format($total_value, 2) }} Tk</div>
                                </th>

                                {{-- <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Return => {{ number_format($return_value, 2) }} Tk</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Payable => {{ number_format($payable_value, 2) }} Tk</div>
                                </th> --}}
                            </tr>
                            <!--end::Table row-->
                        </thead>
                    </table>

                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-10px">S.N</th>
                                {{-- <th class="min-w-80px">Invoice No</th> --}}
                                <th class="min-w-80px">Collceted By</th>
                                <th class="min-w-80px">Sales Point Name</th>
                                {{-- <th class="min-w-50px">Type</th> --}}
                                {{-- <th class="min-w-80px">Order Date</th> --}}
                                <th class="min-w-80px">Collcetion Date</th>
                                <th class="min-w-50px">Payment Type</th>
                                {{-- <th class="min-w-60px text-end">Invoice Value</th> --}}
                                {{-- <th class="min-w-60px text-end">Discount</th> --}}
                                {{-- <th class="min-w-60px text-end">Return</th> --}}
                                <th class="min-w-60px text-end">Commission</th>
                                <th class="min-w-60px text-end">Collection</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody class="text-black-600">
                            @foreach ($collections as $key => $collection)
                                <tr class="hover-row">
                                    <td>{{ $collections->firstItem() + $key }}</td>

                                    {{-- <td class="pe-0">
                                        <a href="{{ route('order_management.order_invoice', $order_invoice->id) }}" class="text-gray-700 text-hover-primary fs-5 fw-bolder">
                                        <a href="{{ route('order.invoice', $order_invoice->id) }}">{{ $order_invoice->invoice_number }}</a>
                                    </td> --}}

                                    <td>{{ $collection->user->name }}</td>

                                    <td>{{ $collection->salePoint->name }} ({{ $collection->salePoint->code_number }})</td>

                                    {{-- <td>{{ ucwords($order_invoice->type) }}</td> --}}

                                    {{-- <td class="pe-0">{{ $order_invoice->created_at->setTimezone('Asia/Dhaka')->format('d M, Y') }}</td> --}}

                                    <td class="pe-0">{{ $collection->created_at->setTimezone('Asia/Dhaka')->format('d M, Y') }}</td>

                                    <td>{{ $collection->payment_type }}</td>

                                    {{-- <td>
                                        @if ($order_invoice->payment_type === 'Cash')
                                            {{ $order_invoice->payment_type }} ({{ $order_invoice->discount }} %)
                                        @else
                                            {{ $order_invoice->payment_type }}
                                        @endif
                                    </td> --}}

                                    {{-- <td class="text-end">{{ number_format($order_invoice->total_amount, 2) }} Tk</td> --}}

                                    {{-- <td class="text-end">
                                        @if ($order_invoice->discount)
                                            {{ number_format($order_invoice->discount_value, 2) }} Tk
                                        @else
                                            —
                                        @endif
                                    </td> --}}

                                    {{-- <td class="text-end">
                                        @if ($order_invoice->return_amount)
                                            {{ number_format($order_invoice->return_amount, 2) }} Tk
                                        @else
                                            —
                                        @endif
                                    </td> --}}

                                    <td class="text-end">{{ number_format($collection->adjustment_amt, 2) }} Tk</td>

                                    <td class="text-end">{{ number_format($collection->total_collect, 2) }} Tk</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->

                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">Total:</div>
                                </td>
                                <td class="fw-bold text-end">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($total_adjustment_value, 2) }} Tk</div>
                                </td>
                                {{-- <td class="fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($discount_value, 2) }} Tk</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($return_value, 2) }} Tk</div>
                                </td> --}}
                                <td class="fw-bold text-end">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($total_value, 2) }} Tk</div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <!--end::Table-->

                    <div class="pagination-container mt-10">
                        <nav>
                            {{ $collections->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </nav>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>  
@endsection

<script>
    function loadAreas(regionId) {
        let areaSelect = document.getElementById('area_id');
        let territorySelect = document.getElementById('territory_id');

        // Reset areas and territories
        areaSelect.innerHTML = '<option value="">All Areas</option>';
        territorySelect.innerHTML = '<option value="">All Territories</option>';

        if (!regionId) return; // Nothing selected

        fetch('/report/get-areas/' + regionId)
            .then(response => response.json())
            .then(data => {
                data.forEach(area => {
                    let option = document.createElement('option');
                    option.value = area.id;
                    option.text = area.name;
                    areaSelect.add(option);
                });

                // Trigger Select2 refresh
                $('#area_id').val('').trigger('change.select2');
            })
            .catch(err => console.error('Error fetching areas:', err));
    }

    function loadTerritories(areaId) {
        let territorySelect = document.getElementById('territory_id');
        territorySelect.innerHTML = '<option value="">All Territories</option>';

        if (!areaId) return;

        fetch('/report/get-territories/' + areaId)
            .then(response => response.json())
            .then(data => {
                data.forEach(territory => {
                    let option = document.createElement('option');
                    option.value = territory.id;
                    option.text = territory.name;
                    territorySelect.add(option);
                });

                // Trigger Select2 refresh
                $('#territory_id').val('').trigger('change.select2');
            })
            .catch(err => console.error('Error fetching territories:', err));
    }
</script>




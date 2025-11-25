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
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header mt-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <form class="d-flex align-items-center position-relative my-1" action="{{ route('report.order_summary') }}" method="GET">
                                <div class="w-110 mw-120px me-2">
                                    <input name="from_date" type="date" value="{{ request('from_date') ?? \Carbon\Carbon::now()->toDateString() }}" class="form-control form-control-solid" />
                                </div>

                                <div class="w-110 mw-120px me-2">
                                    <input name="to_date" type="date" value="{{ request('to_date') ?? \Carbon\Carbon::now()->toDateString() }}" class="form-control form-control-solid" />
                                </div>

                                @if (auth()->user()->role->slug === 'admin')
                                    <div class="w-110 mw-120px me-2">
                                        <select name="type" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Type">
                                            <option></option> {{-- placeholder --}}
                                            <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All</option>
                                            <option value="seed" {{ request('type') == 'seed' ? 'selected' : '' }}>Seed</option>
                                            <option value="agrochemicals" {{ request('type') == 'agrochemicals' ? 'selected' : '' }}>Agrochemicals</option>
                                        </select>
                                    </div>
                                @endif
        
                                <button type="submit" class="btn btn-light-primary me-10">Search</button>
                            </form>
                        </div>
                        <!--begin::Card title-->

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
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ request()->fullUrlWithQuery(['export'=>'excel']) }}" class="menu-link px-3">Export as Excel</a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ request()->fullUrlWithQuery(['export'=>'csv']) }}" class="menu-link px-3">Export as CSV</a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ request()->fullUrlWithQuery(['export'=>'pdf']) }}" class="menu-link px-3">Export as PDF</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Export dropdown-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-10px">S.N</th>
                                    <th class="min-w-80px">SKU</th>
                                    <th class="min-w-120px">Product Name</th>
                                    <th class="min-w-60px">Required Quantity</th>
                                    <th class="min-w-60px text-center">Available Quantity</th>
                                    <th class="min-w-60px text-end">Remaining Quantity</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-black-600">
                                <!--begin::Table row-->
                                @foreach ($orders as $key => $order)
                                    <tr class="hover-row">
                                        <!--begin::S.N=-->
                                        <td>{{ $key + 1 }}</td>
                                        <!--end::S.N=-->

                                        <td>{{ $order->sku }}</td>

                                        <td>{{ $order->product_name }}</td>

                                        <td>
                                            <div class="badge badge-light-info">{{ $order->total_quantity }}</div>
                                        </td>

                                        <td class="text-center">
                                            <div class="badge badge-light-info">{{ $order->available_stock }}</div>
                                        </td>

                                        <td class="text-end">
                                            <div class="badge badge-light-info">{{ $order->available_stock - $order->total_quantity }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!--end::Table row-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
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


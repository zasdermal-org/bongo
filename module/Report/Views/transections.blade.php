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
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-2 gap-2 gap-md-5 mt-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1 me-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->

                                <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                            </div>
                            <!--end::Search-->

                            <form class="d-flex align-items-center position-relative my-1" action="{{ route('report.transections') }}" method="GET">
                                <!--begin::Status-->
                                <div class="w-200 mw-250px me-2">
                                    <!--begin::Select2-->
                                    <select name="status" class="form-select form-select-solid" data-placeholder="Search Trans Type" data-control="select2">
                                        <option></option>
                                        <option value="Warehouse Purchase" {{ request('status') == 'Warehouse Purchase' ? 'selected' : '' }}>Warehouse Purchase</option>
                                        <option value="Warehouse to Depot" {{ request('status') == 'Warehouse to Depot' ? 'selected' : '' }}>Warehouse to Depot</option>
                                        <option value="Depot to Warehouse" {{ request('status') == 'Depot to Warehouse' ? 'selected' : '' }}>Depot to Warehouse</option>
                                        <option value="Depot to Depot" {{ request('status') == 'Depot to Depot' ? 'selected' : '' }}>Depot to Depot</option>
                                        <option value="Depot to Sales Point" {{ request('status') == 'Depot to Sales Point' ? 'selected' : '' }}>Depot to Sales Point</option>
                                        <option value="Sales Point to Depot" {{ request('status') == 'Sales Point to Depot' ? 'selected' : '' }}>Sales Point to Depot</option>
                                        <option value="Stock Out / Stock In" {{ request('status') == 'Stock Out / Stock In' ? 'selected' : '' }}>Stock Out / Stock In</option>
                                        <option value="Stock Out" {{ request('status') == 'Stock Out' ? 'selected' : '' }}>Stock Out</option>
                                        <option value="Stock In" {{ request('status') == 'Stock In' ? 'selected' : '' }}>Stock In</option>
                                        <option value="Return" {{ request('status') == 'Return' ? 'selected' : '' }}>Return</option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                                <!--end::Status-->

                                <input name="from_date" type="date" value="{{ request('from_date') }}" class="form-control form-control-solid w-100 mw-250px me-2" />
                                <input name="to_date" type="date" value="{{ request('to_date') }}" class="form-control form-control-solid w-100 mw-250px me-2" />

                                <button type="submit" class="btn btn-light-primary">Search</button>
                            </form>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-700 fw-bolder fs-7 gs-0">
                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info">Total => {{ $total }}</div>
                                    </th>
                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info">Trans Qty => {{ $trans_qty }}</div>
                                    </th>
                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info">Stock In => {{ $stock_in }}</div>
                                    </th>
                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info">Stock Out => {{ $stock_out }}</div>
                                    </th>
                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info">Return => {{ $return }}</div>
                                    </th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                        </table>

                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_report_views_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">S.N</th>
                                    <th class="min-w-200px">Product</th>
                                    <th class="min-w-60px">SKU</th>
                                    <th class="min-w-100px">Invoice Number</th>
                                    {{-- <th class="min-w-100px">Tran Type</th> --}}
                                    <th class="min-w-150px">Status</th>
                                    <th class="min-w-100px">Tran Date</th>
                                    <th class="min-w-50px">Pre Stock</th>
                                    <th class="min-w-50px text-center">Tran Quant ±</th>
                                    <th class="min-w-50px text-end">Curr Stock</th>
                                    {{-- <th class="min-w-50px text-end">National Stock</th> --}}
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            <tbody class="text-black-200">
                                <!--begin::Table row-->
                                @foreach ($transections as $key => $transection)
                                    <tr>
                                        <!--begin::S.N=-->
                                        {{-- <td>{{ $key + 1 }}</td> --}}
                                        <td>{{ $transection->id }}</td>
                                        <!--end::S.N=-->

                                        <!--begin::Product=-->
                                        <td>{{ $transection->stock->product->title }}</td>
                                        <!--end::Product=-->

                                        <!--begin::SKU=-->
                                        <td class="pe-0">{{ $transection->sku }}</td>
                                        <!--end::SKU=-->

                                        <!--begin::Invoice Number=-->
                                        <td class="pe-0">
                                            @if ($transection->orderInvoice)
                                                {{ $transection->orderInvoice->invoice_number }}
                                            @endif
                                        </td>
                                        <!--end::Invoice Number=-->

                                        <!--begin::Tran Type=-->
                                        {{-- <td class="pe-0">
                                            @if ($transection->tran_type === 'Warehouse Purchase')
                                                <div class="badge badge-light-success">
                                                    Warehouse Purchase
                                                </div>
                                            @endif

                                            @if ($transection->tran_type === 'Warehouse to Depot')
                                                <div class="badge badge-light-success">
                                                    Warehouse to {{ $transection->depot->name }}
                                                </div>
                                            @endif

                                            @if ($transection->tran_type === 'Depot to Warehouse')
                                                <div class="badge badge-light-success">
                                                    {{ $transection->stock_out_depot_name }} to Warehouse
                                                </div>
                                            @endif

                                            @if ($transection->tran_type === 'Depot to Depot')
                                                <div class="badge badge-light-success">
                                                    {{ $transection->stock_out_depot_name }} to {{ $transection->depot->name }}
                                                </div>
                                            @endif

                                            @if ($transection->tran_type === 'Depot to Sales Point')
                                                <div class="badge badge-light-success">
                                                    {{ $transection->stock_out_depot_name }} to Sales Point
                                                </div>
                                            @endif

                                            @if ($transection->tran_type === 'Sales Point to Depot')
                                                <div class="badge badge-light-success">
                                                    Sales Point to {{ $transection->depot->name }}
                                                </div>
                                            @endif

                                            @if ($transection->tran_type === 'Sample')
                                                <div class="badge badge-light-success">
                                                    Sample Deduction from {{ $transection->stock_out_depot_name }}
                                                </div>
                                            @endif
                                        </td> --}}
                                        <!--end::Tran Type=-->

                                        <!--begin::Status=-->
                                        <td class="pe-0">{{ $transection->status }}</td>
                                        <!--end::Status=-->

                                        <!--begin::Tran Date=-->
                                        <td class="pe-0">{{ $transection->created_at->format('d M, Y') }}</td>
                                        <!--end::Tran Date=-->

                                        <!--begin::Pre Stock=-->
                                        <td class="pe-0">{{ $transection->pre_stock }}</td>
                                        <!--end::Pre Stock=-->

                                        <!--begin::Tran Quant=-->
                                        <td class="pe-0 text-center">{{ $transection->tran_quant }}</td>
                                        <!--end::Tran Quant=-->

                                        <!--begin::Curr Stock=-->
                                        <td class="pe-0 text-end">
                                            <div class="badge badge-light-success">
                                                {{ $transection->curr_stock }}
                                            </div>
                                        </td>
                                        <!--end::Curr Stock=-->
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
                <!--end::Products-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
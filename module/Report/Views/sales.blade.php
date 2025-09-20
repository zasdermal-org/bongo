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
                        <form class="d-flex align-items-center position-relative my-1" action="{{ route('report.sales') }}" method="GET">
                            <!--begin::Search-->
                            <div class="w-110 mw-120px me-2">
                                <select name="code_number" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Sales Point">
                                    <option></option>
                                    @foreach ($sale_points as $sale_point)
                                        <option value="{{ $sale_point->code_number }}" {{ request('code_number') == $sale_point->code_number ? 'selected' : '' }}>
                                            {{ $sale_point->name }} — ({{ $sale_point->code_number }})
                                        </option>
                                    @endforeach
                                </select>                                
                            </div>
                            <!--end::Search-->

                            <!--begin::Depot-->
                            <div class="w-110 mw-120px me-2">
                                <!--begin::Select2-->
                                <select name="territory_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Territory" data-kt-ecommerce-product-filter="status">
                                    <option></option>
                                    @foreach ($territories as $territory)
                                        <option value="{{ $territory->id }}" {{ request('territory_id') == $territory->id ? 'selected' : '' }}>{{ $territory->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->
                            </div>
                            <!--end::Depot-->

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
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-700 fw-bolder fs-7 gs-0">
                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Invoice => {{ $invoice }}</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Order => {{ number_format($invoice_value, 2) }} Tk</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Discount => {{ number_format($discount_value, 2) }} Tk</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Return => {{ number_format($return_value, 2) }} Tk</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Payable => {{ number_format($payable_value, 2) }} Tk</div>
                                </th>
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
                                <th class="min-w-80px">Invoice No</th>
                                <th class="min-w-80px">Order By</th>
                                <th class="min-w-80px">Sales Point Name</th>
                                <th class="min-w-50px">Type</th>
                                <th class="min-w-80px">Order Date</th>
                                <th class="min-w-80px">Invoice Date</th>
                                <th class="min-w-50px">Payment Type</th>
                                <th class="min-w-60px text-end">Invoice Value</th>
                                <th class="min-w-60px text-end">Discount</th>
                                <th class="min-w-60px text-end">Return</th>
                                <th class="min-w-60px text-end">Payable</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody class="text-black-600">
                            @foreach ($order_invoices as $key => $order_invoice)
                                <tr class="hover-row">
                                    <td>{{ $order_invoices->firstItem() + $key }}</td>

                                    <td class="pe-0">
                                        {{-- <a href="{{ route('order_management.order_invoice', $order_invoice->id) }}" class="text-gray-700 text-hover-primary fs-5 fw-bolder"> --}}
                                        {{-- <a href="{{ route('order_management.order_invoice', $order_invoice->id) }}"> --}}
                                        <a href="javascript:void(0)">
                                            {{ $order_invoice->invoice_number }}
                                        </a>
                                    </td>

                                    <td>{{ $order_invoice->user->name }}</td>

                                    <td>{{ $order_invoice->salePoint->name }}</td>

                                    <td>{{ ucwords($order_invoice->type) }}</td>

                                    <td class="pe-0">{{ $order_invoice->created_at->setTimezone('Asia/Dhaka')->format('d M, Y') }}</td>

                                    <td class="pe-0">{{ $order_invoice->updated_at->setTimezone('Asia/Dhaka')->format('d M, Y') }}</td>

                                    <td>
                                        @if ($order_invoice->payment_type === 'Cash')
                                            {{ $order_invoice->payment_type }} ({{ $order_invoice->discount }} %)
                                        @else
                                            {{ $order_invoice->payment_type }}
                                        @endif
                                    </td>

                                    <td class="text-end">{{ number_format($order_invoice->total_amount, 2) }} Tk</td>

                                    <td class="text-end">
                                        @if ($order_invoice->discount)
                                            {{ number_format($order_invoice->discount_value, 2) }} Tk
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        @if ($order_invoice->return_amount)
                                            {{ number_format($order_invoice->return_amount, 2) }} Tk
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td class="text-end">{{ number_format($order_invoice->total_amount - $order_invoice->discount_value, 2) }} Tk</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->

                        <tfoot>
                            <tr>
                                <td colspan="8" class="text-end fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">Total:</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($invoice_value, 2) }} Tk</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($discount_value, 2) }} Tk</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($return_value, 2) }} Tk</div>
                                </td>
                                <td class="fw-bold text-end">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($payable_value, 2) }} Tk</div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <!--end::Table-->

                    <div class="pagination-container mt-10">
                        <nav>
                            {{ $order_invoices->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
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
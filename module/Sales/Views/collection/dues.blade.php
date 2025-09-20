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
                        <form class="d-flex align-items-center position-relative my-1" action="{{ route('collection.dues') }}" method="GET">
                            <div class="w-110 mw-120px me-2">
                                <select name="sale_point_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Sale Point">
                                    <option></option>
                                    @foreach ($salePoints as $salePoint)
                                        <option value="{{ $salePoint->id }}" {{ request('sale_point_id') == $salePoint->id ? 'selected' : '' }}>
                                            {{ $salePoint->name }} / ({{ $salePoint->code_number }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-110 mw-120px me-2">
                                <select name="payment_type" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Payment Type">
                                    <option></option> {{-- placeholder --}}
                                    <option value="all" {{ request('payment_type') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="Credit" {{ request('payment_type') == 'Credit' ? 'selected' : '' }}>Credit</option>
                                    <option value="Cash" {{ request('payment_type') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                </select>
                            </div>

                            <div class="w-110 mw-120px me-2">
                                <input name="from_date" type="date" value="{{ request('from_date') }}" class="form-control form-control-solid" />
                            </div>

                            <div class="w-110 mw-120px me-2">
                                <input name="to_date" type="date" value="{{ request('to_date') }}" class="form-control form-control-solid" />
                            </div>

                            <button type="submit" class="btn btn-light-primary">Search</button>
                        </form>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    @if (request('from_date') && request('to_date'))
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-700 fw-bolder fs-7 gs-0">
                                    {{-- <th class="min-w-70px">
                                        <div class="badge badge-light-info" style="font-size: 14px;">Invoice => {{ $invoice }}</div>
                                    </th> --}}

                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info" style="font-size: 14px;">Invoice Value => {{ number_format($invoice_value, 2) }}</div>
                                    </th>

                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info" style="font-size: 14px;">Discount => {{ number_format($discount_value, 2) }}</div>
                                    </th>

                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info" style="font-size: 14px;">Payable => {{ number_format($payable_value, 2) }}</div>
                                    </th>

                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info" style="font-size: 14px;">Paid => {{ number_format($paid, 2) }}</div>
                                    </th>

                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info" style="font-size: 14px;">Adjustment => {{ number_format($adjustment, 2) }}</div>
                                    </th>

                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info" style="font-size: 14px;">Due => {{ number_format($due, 2) }}</div>
                                    </th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                        </table>
                    @endif

                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table_">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-10px">S.N</th>
                                <th class="min-w-80px">Invoice No</th>
                                <th class="min-w-80px">Sale Point Name</th>
                                <th class="min-w-80px">Type</th>
                                <th class="min-w-80px">Invoice Date</th>
                                <th class="min-w-50px">Payment Type</th>
                                <th class="min-w-60px text-end">Invoice Value</th>
                                <th class="min-w-60px text-end">Discount</th>
                                <th class="min-w-60px text-end">Payable</th>
                                <th class="min-w-60px text-end">Paid</th>
                                <th class="min-w-60px text-end">Adjustment</th>
                                <th class="min-w-60px text-end">Due</th>

                                <th class="w-10px text-end">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_permissions_table_ .form-check-input" value="1" />
                                    </div>
                                </th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody class="text-black-600">
                            @foreach ($orderInvoices as $key => $orderInvoice)
                                <tr class="hover-row">
                                    <td>{{ $key + 1 }}</td>

                                    <td><a href="javascript:void(0)">{{ $orderInvoice->invoice_number }}</a></td>

                                    <td>{{ $orderInvoice->salePoint->name }}</td>

                                    <td>{{ $orderInvoice->type }}</td>

                                    <td>{{ $orderInvoice->invoice_date->setTimezone('Asia/Dhaka')->format('d M, Y') }}</td>

                                    <td>
                                        @if ($orderInvoice->payment_type === 'Cash')
                                            {{ $orderInvoice->payment_type }} ({{ $orderInvoice->discount }} %)
                                        @else
                                            {{ $orderInvoice->payment_type }}
                                        @endif
                                    </td>

                                    <td class="text-end">{{ number_format($orderInvoice->total_amount, 2) }} Tk</td>

                                    <td class="text-end">
                                        @if ($orderInvoice->payment_type === 'Cash')
                                            {{ number_format($orderInvoice->discount_value, 2) }} Tk
                                        @endif
                                    </td>

                                    <td class="text-end">{{ number_format($orderInvoice->total_amount - $orderInvoice->discount_value, 2) }} Tk</td>

                                    <td class="text-end">
                                        @if ($orderInvoice->paid)
                                            {{ number_format($orderInvoice->paid, 2) }} Tk
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        @if ($orderInvoice->addi_discount)
                                            {{ number_format($orderInvoice->addi_discount, 2) }} Tk
                                        @endif
                                    </td>

                                    <td class="text-end">{{ number_format($orderInvoice->due, 2) }} Tk</td>

                                    <td class="text-end">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input row-checkbox" type="checkbox" value="1" data-order_invoice_id="{{ $orderInvoice->id }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->

                        <tfoot>
                            <tr class="text-end">
                                <td colspan="11" class="fw-bold">Total Payable:</td>

                                <td class="fw-bold">
                                    <div id="totalPayable" class="badge badge-light-info" style="font-size: 14px;">0.00 Tk</div>
                                </td>
                            </tr>

                            <tr class="text-end">
                                <td colspan="11" class="fw-bold"></td>

                                <td class="fw-bold">
                                    <form id="paymentForm" action="{{ route('collection.update_due') }}" method="POST">
                                        @csrf
                                        <input type="number" name="addi_discount" step="0.01" class="form-control mt-3 no-spinner" placeholder="Adjustment">

                                        <input type="number" name="total_collect" step="0.01" class="form-control mt-3 no-spinner" placeholder="Collect Payment">

                                        <div id="selectedInvoicesContainer"></div>

                                        <button id="payButton" type="submit" class="btn btn-sm btn-primary w-100 mt-3" style="display: none;">Pay</button>
                                    </form>
                                </td>
                            </tr>
                        </tfoot>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            function numberFormat(num) {
                return num.toLocaleString("en-US", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }

            function calculateTotal() {
                let total = 0;

                // Reset selected invoices container
                $("#selectedInvoicesContainer").empty();

                $(".row-checkbox:checked").each(function () {
                    // Find payable amount from the same row
                    let payableText = $(this).closest("tr").find("td:nth-child(12)").text().trim();

                    if (!payableText || payableText === "NULL") payableText = "0";

                    let payable = parseFloat(payableText.replace(/[^0-9.-]+/g, "")) || 0;

                    total += payable;

                    // Add hidden input for selected invoice
                    let invoiceId = $(this).data("order_invoice_id");
                    $("#selectedInvoicesContainer").append(
                        `<input type="hidden" name="selected_invoices[]" value="${invoiceId}">`
                    );
                });

                // Update the total payable in footer with number_format style
                $("#totalPayable").text(numberFormat(total) + " Tk");

                if ($(".row-checkbox:checked").length > 0) {
                    $("#payButton").show();
                } else {
                    $("#payButton").hide();
                }

                return total;
            }

            // $(".row-checkbox").on("change", calculateTotal);

            // Trigger on row checkbox change
            $(document).on("change", ".row-checkbox", function () {
                calculateTotal();
            });

            // Trigger on header checkbox (select all)
            $("[data-kt-check]").on("change", function () {
                let isChecked = $(this).is(":checked");
                $(".row-checkbox").prop("checked", isChecked).trigger("change");
            });

            $("#paymentForm").on("submit", function (e) {
                let totalPayable = calculateTotal(); // recalc total
                let addiDiscount = parseFloat($("input[name='addi_discount']").val()) || 0;
                let totalCollect = parseFloat($("input[name='total_collect']").val()) || 0;

                // Check if total payable is less than sum of discount + payment
                if ((addiDiscount + totalCollect) > totalPayable) {
                    e.preventDefault(); // prevent submission
                    toastr.error("Total payable is less than Addi Discount + Collect Payment!");
                    return false;
                }
            });

            // Initial total calculation
            calculateTotal();
        });
    </script>
@endpush
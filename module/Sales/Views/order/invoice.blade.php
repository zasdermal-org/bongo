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
                <!-- begin::Invoice 3-->
                <div class="card">
                    <!-- begin::Body-->
                    <div class="card-body py-20">
                        <!-- begin::Wrapper-->
                        <div class="mw-lg-950px mx-auto w-100">
                            <div id="invoice-content">
                                <!-- begin::Header-->
                                <div class="d-flex justify-content-center mb-19">
                                    <h4 class="fw-boldest text-gray-800 fs-2qx text-center show-in-invoice">INVOICE</h4>
                                    <h4 class="fw-boldest text-gray-800 fs-2qx text-center show-in-chalan">CHALLAN</h4>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="pb-12">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column gap-7 gap-md-10">
                                        <!--begin::Separator-->
                                        <div class="separator"></div>
                                        <!--begin::Separator-->

                                        <!--begin::Order details-->
                                        <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                            <div class="flex-root d-flex flex-column">
                                                <span class="text-muted">Invoice Number</span>
                                                <span class="fs-5">{{ $orderInvoice->invoice_number }} / {{ $orderInvoice->id }}</span>
                                            </div>

                                            <div class="flex-root d-flex flex-column">
                                                <span class="text-muted">Order Date</span>
                                                <span class="fs-5">{{ $orderInvoice->created_at->format('d M, Y / h:i A') }}</span>
                                            </div>

                                            <div class="flex-root d-flex flex-column">
                                                <span class="text-muted">Payment Type</span>
                                                <span class="fs-5">
                                                    {{ $orderInvoice->payment_type }} 
                                                    @if ($orderInvoice->payment_type === 'Cash')
                                                        ({{ $orderInvoice->discount }} %)
                                                    @endif
                                                </span>
                                            </div>

                                            <div class="flex-root d-flex flex-column">
                                                <span class="text-muted">Depot</span>
                                                <span class="fs-5">
                                                    {{ $orderInvoice->depot->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Order details-->

                                        <!--begin::Billing & shipping-->
                                        <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                            <div class="flex-root d-flex flex-column">
                                                <span class="text-muted">Billing Address</span>
                                                <span class="fs-6">
                                                    ({{ $orderInvoice->salePoint->code_number }}) {{ $orderInvoice->salePoint->name }}
                                                    @foreach (explode(',', $orderInvoice->salePoint->address) as $part)
                                                        <br />{{ trim($part) }},
                                                    @endforeach
                                                    <br />Phone: {{ $orderInvoice->salePoint->contact_number }}
                                                </span>
                                            </div>

                                            <div class="flex-root d-flex flex-column">
                                                <span class="text-muted">Order By</span>
                                                <span class="fs-6">
                                                    Territory: {{ $orderInvoice->territory->name }}
                                                </span>

                                                {{-- @if ($orderInvoice->delivery_man)
                                                    <span class="text-muted mt-2">Delivery By</span>
                                                    <span class="fs-6">
                                                        Delivery Man: {{ $order_invoice->delivery_man->employee->name }}
                                                        <br />Phone: {{ $order_invoice->delivery_man->employee->contact }}
                                                    </span>
                                                @endif --}}
                                            </div>
                                        </div>
                                        <!--end::Billing & shipping-->

                                        <!--begin:Order summary-->
                                        <div class="d-flex justify-content-between flex-column">
                                            <!--begin::Table-->
                                            <div class="table-responsive border-bottom mb-9">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                    <thead>
                                                        <tr class="border-bottom fs-6 fw-bolder text-muted">
                                                            <th class="min-w-50px pb-2">S.N</th>
                                                            <th class="min-w-100px pb-2">Products</th>
                                                            {{-- <th class="min-w-70px pb-2">SKU</th> --}}
                                                            <th class="min-w-80px text-end pb-2">QTY</th>
                                                            <th class="min-w-80px text-end pb-2 show-in-chalan">CTN</th>
                                                            <th class="min-w-80px text-end pb-2 hide-in-chalan">Unit Price</th>
                                                            <th class="min-w-100px text-end pb-2 hide-in-chalan">Total</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="fw-bold text-black-600">
                                                        <!--begin::Products-->
                                                        @foreach ($orderInvoice->orders as $key => $order)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>

                                                                <!--begin::Product-->
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <a class="symbol symbol-50px">
                                                                            <div class="fw-bolder">{{ $order->stock->product->title }}</div>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <!--end::Product-->

                                                                <!--begin::SKU-->
                                                                {{-- <td>{{ $order->sku }}</td> --}}
                                                                <!--end::SKU-->

                                                                <!--begin::Quantity-->
                                                                <td class="text-end">{{ $order->quantity }}</td>
                                                                <!--end::Quantity-->

                                                                <!--begin::PCS Per carton-->
                                                                <td class="text-end show-in-chalan">
                                                                    @if ($order->stock->product->pcs_per_carton)
                                                                        {{ $order->quantity / $order->stock->product->pcs_per_carton }}
                                                                    @else
                                                                        0
                                                                    @endif
                                                                </td>
                                                                <!--end::PCS Per Carton-->

                                                                <!--begin::Price-->
                                                                <td class="text-end hide-in-chalan">{{ $order->unit_price }}</td>
                                                                <!--end::Price-->

                                                                <!--begin::Total-->
                                                                <td class="text-end hide-in-chalan">
                                                                    Tk {{ number_format($order->total_amount, 2) }}
                                                                </td>
                                                                <!--end::Total-->
                                                            </tr>
                                                        @endforeach
                                                        <!--end::Products-->

                                                        <!--begin::Subtotal-->
                                                        <tr class="hide-in-chalan">
                                                            <td colspan="4" class="text-end">Subtotal</td>
                                                            <td class="text-end">Tk {{ number_format($orderInvoice->total_amount, 2) }}</td>
                                                        </tr>
                                                        <!--end::Subtotal-->

                                                        <!--begin::Dis Amount-->
                                                        <tr class="hide-in-chalan">
                                                            <td colspan="4" class="text-end">Discount</td>
                                                            <td class="text-end">Tk {{ number_format($discountAmount, 2) }}</td>
                                                        </tr>
                                                        <!--end::Dis Amount-->

                                                        <!--begin::Grand total-->
                                                        <tr class="hide-in-chalan">
                                                            <td colspan="4" class="fs-3 text-dark fw-bolder text-end">Grand Total</td>
                                                            @php
                                                                $grand_total = $orderInvoice->total_amount
                                                            @endphp
                                                            
                                                            <td class="text-dark fs-3 fw-boldest text-end">
                                                                @if ($orderInvoice->payment_type === 'Credit')
                                                                    Tk {{ number_format($grand_total, 2) }}
                                                                @else
                                                                    Tk {{ number_format($totalAfterDiscount, 2) }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <!--end::Grand total-->
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end:Order summary-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Body-->
                            </div>

                            <!-- begin::Footer-->
                            <div id="invoice-footer">
                                <div class="mt-2 hide-in-chalan">
                                    <h6 class="text-black-400">In Words: {{ $grand_total_in_words }}</h6>
                                </div>

                                <div class="d-flex justify-content-between mt-20 pt-5">
                                    <div class="text-center">
                                        <div class="border-top border-dark w-150px mx-auto"></div>
                                        <span class="fw-bold">Customer Signature</span>
                                    </div>

                                    <div class="text-center">
                                        <div class="border-top border-dark w-150px mx-auto"></div>
                                        <span class="fw-bold">Authorized Signature</span>
                                    </div>
                                </div>

                                <div class="text-center mt-5 hide-in-chalan">
                                    <h6 class="fw-bold">This invoice has been generated electronically.</h6>
                                </div>

                                <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                                    <!-- begin::Action-->
                                    <button type="button" class="btn btn-success my-1 me-12" onclick="printInvoice()">Print Invoice</button>
                                    <button type="button" class="btn btn-primary my-1" onclick="printChalan()">Print Chalan</button>
                                    <!-- end::Action-->
                                </div>
                            </div>
                            <!-- end::Footer-->
                        </div>
                        <!-- end::Wrapper-->
                    </div>
                    <!-- end::Body-->
                </div>
                <!-- end::Invoice 1-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection

<style>
    .show-in-chalan {
        display: none;
    }
    .show-in-invoice {
        display: block;
    }
    @media print {
        body * {
            visibility: hidden;
        }
        #invoice-content, #invoice-content *, 
        #invoice-footer, #invoice-footer * {
            visibility: visible;
        }
        #invoice-content, #invoice-footer {
            position: relative;
            left: 0;
            top: 0;
            width: 100%;
        }
        /* Hide buttons only */
        .btn {
            display: none !important;
        }

        .show-in-chalan { display: none !important; }
        .show-in-invoice { display: block !important; }

        /* If chalan mode is active */
        body.chalan-mode .show-in-chalan { display: block !important; }
        body.chalan-mode .show-in-invoice { display: none !important; }

        body.chalan-mode .hide-in-chalan {
            display: none !important;
        }

       /***** 2) Page-margin / top-gap for dot-matrix printers *****/
        /* Adjust this value to the blank header height you need (e.g. 30mm = 3cm). */
        /* Use mm/cm for finer control. */
        @page {
            /* top margin that will be reserved on EVERY printed page */
            margin-top: 50mm;
            /* tune left/right/bottom as you like */
            margin-left: 10mm;
            margin-right: 10mm;
            margin-bottom: 10mm;
        }

        /* If you want the FIRST page to have a smaller top-gap,
           set :first to a smaller value (or remove this block to keep the same gap on all pages). */
        @page :first {
            margin-top: 10mm; /* e.g. smaller top-gap on page 1 */
        }

        /* 3) Fallback visual placeholder so print-preview shows the gap */
        /* Some browsers/printers ignore @page in preview; this fixed pseudo-element is a visual fallback.
           It is transparent/empty, repeated on every page (fixed), and won't print text. */
        body::before {
            content: "";
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 30mm;              /* match @page margin-top */
            visibility: visible !important;
            /* background: transparent;  keep it empty so it prints blank space */
        }

        body.chalan-mode #invoice-content {
            margin-top: 10mm !important; /* adjust this gap */
        }

        /* Ensure the invoice content isn't accidentally hidden behind the placeholder in preview */
        #invoice-content, #invoice-footer {
            /* keep them positioned below the visible area in preview — but @page controls printed layout */
            /* This margin only affects layout in the preview; real printed pages follow @page margins. */
            margin-top: 0;
        }

        /* 4) Avoid breaking important rows across pages if possible */
        /* (won't always prevent breaks for very large rows) */
        tr, td {
            page-break-inside: avoid;
        }
    }
</style>

<script>
    function printInvoice() {
        document.body.classList.remove('chalan-mode');
        window.print();
    }

    function printChalan() {
        document.body.classList.add('chalan-mode'); // activate chalan mode
        window.print();
        document.body.classList.remove('chalan-mode'); // reset after print
    }
</script>
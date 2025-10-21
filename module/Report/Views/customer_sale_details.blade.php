@extends('Access::layouts.app')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
                                <div class="d-flex justify-content-between flex-column flex-sm-row mb-10">
                                    <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">{{ $salePoint->name }}</h4>
                                    <!--end::Logo-->
                                    <div class="text-sm-end fs-4">
                                        <!--begin::Message-->
                                        <div class="fs-6">
                                            ( {{ $salePoint->address }})
                                            <span class="fw-bolder fs-6"> Address</span>
                                            <br />
                                            @if (request('from_date') && request('to_date'))
                                                (
                                                    {{ \Carbon\Carbon::parse(request('from_date'))->format('d M, Y') }} to 
                                                    {{ \Carbon\Carbon::parse(request('to_date'))->format('d M, Y') }}
                                                )
                                            @else
                                                ({{ $today->format('d M, Y') }} to {{ $today->format('d M, Y') }})
                                            @endif
                                            <span class="fw-bolder fs-6"> Invoice Date From/To</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="pb-12">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column gap-7 gap-md-10">
                                        <!--begin::Separator-->
                                        <div class="separator"></div>
                                        <!--begin::Separator-->

                                        <!--begin:Order summary-->
                                        <div class="d-flex justify-content-between flex-column">
                                            <!--begin::Table-->
                                            <div class="table-responsive border-bottom mb-9">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                    <thead>
                                                        <tr class="border-bottom fs-6 fw-bolder">
                                                            <th class="min-w-100px pb-2">Invoices</th>
                                                            <th class="min-w-100px text-end pb-2">Products</th>
                                                            <th class="min-w-70px text-end pb-2">SKU</th>
                                                            <th class="min-w-70px text-end pb-2">Unit Price</th>
                                                            <th class="min-w-50px text-end pb-2">Qty</th>
                                                            <th class="min-w-80px text-end pb-2">Total</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="fw-bold text-black-600">
                                                        <!-- Iterate through Sales Points -->
                                                        @foreach ($orderInvoices as $key => $invoice)
                                                            <!-- Calculate rowspan for Sales Point -->
                                                            @php
                                                                $rowCount = count($invoice->orders);
                                                                $invoiceTotalQty = $invoice->orders->sum('quantity');
                                                            @endphp
                                                            @foreach ($invoice->orders as $order)
                                                                <tr>
                                                                    <!-- Display Sales Point Name only for the first row -->
                                                                    @if ($loop->first)
                                                                        <td rowspan="{{ $rowCount }}">
                                                                            <div class="d-flex align-items-center">
                                                                                <a class="symbol symbol-50px">
                                                                                    <div class="fw-bolder">
                                                                                        {{ $invoice->invoice_number }} / {{ $invoice->payment_type }} @if ($invoice->payment_type === 'Cash') ({{ $invoice->discount }} %) @endif <br>
                                                                                        {{ $invoice->invoice_date->setTimezone('Asia/Dhaka')->format('d M, Y') }}
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    @endif
                                                
                                                                    <!-- Product -->
                                                                    <td class="text-end">{{ $order->stock->product->title }}</td>
                                                
                                                                    <!-- SKU -->
                                                                    <td class="text-end">{{ $order->sku }}</td>
                                                
                                                                    <td class="text-end">{{ $order->unit_price }} Tk</td>

                                                                    <!-- Quantity -->
                                                                    <td class="text-end">{{ $order->quantity }}</td>

                                                                    <td class="text-end">{{ number_format($order->total_amount, 2) }} Tk</td>

                                                                </tr>
                                                            @endforeach

                                                            <tr class="bg-light fw-bold">
                                                                <td colspan="5" class="text-end text-dark">Subtotal</td>
                                                                <td class="text-end text-dark">{{ number_format($invoice->total_amount, 2) }} Tk</td>
                                                            </tr>

                                                            <tr class="bg-light fw-bold">
                                                                <td colspan="5" class="text-end text-dark">Discount</td>
                                                                <td class="text-end text-dark">{{ number_format($invoice->discount_amount, 2) }} Tk</td>
                                                            </tr>

                                                            <tr class="bg-light fw-bold">
                                                                <td colspan="4" class="text-end fw-bolder">Invoice Total</td>
                                                                <td class="text-end fw-bolder">{{ $invoiceTotalQty }}</td>
                                                                <td class="text-end fw-bolder">{{ number_format($invoice->total_amount - $invoice->discount_amount, 2) }} Tk</td>
                                                            </tr>
                                                        @endforeach
                                                
                                                        <!-- Totals -->
                                                        <tr>
                                                            <td colspan="4" class="text-end fw-bolder">Grand Total</td>
                                                            <td class="text-end fw-bolder">{{ $totalQuantity }}</td>
                                                            <td class="text-end fw-bolder">{{ number_format($totalInvoiceValue, 2) }} Tk</td>
                                                        </tr>
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
                            {{-- <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                                <!-- begin::Action-->
                                <button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Invoice</button>
                                <!-- end::Action-->
                            </div> --}}
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
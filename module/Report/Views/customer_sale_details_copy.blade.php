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
        <div class="text-sm-end fs-4">
            <div class="fs-6">
                ({{ $salePoint->address }})
                <span class="fw-bolder fs-6"> Address</span>
                <br/>
                @if (request('from_date') && request('to_date'))
                    ({{ \Carbon\Carbon::parse(request('from_date'))->format('d M, Y') }} 
                     to {{ \Carbon\Carbon::parse(request('to_date'))->format('d M, Y') }})
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
        <div class="d-flex flex-column gap-7 gap-md-10">
            <div class="separator"></div>

            <!--begin:Product Summary-->
            <div class="d-flex justify-content-between flex-column">
                <div class="table-responsive border-bottom mb-9">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <thead>
                            <tr class="border-bottom fs-6 fw-bolder">
                                <th class="min-w-200px pb-2">Products</th>
                                <th class="min-w-100px pb-2">SKU</th>
                                <th class="min-w-70px text-end pb-2">Unit Price</th>
                                <th class="min-w-50px text-end pb-2">Qty</th>
                                <th class="min-w-80px text-end pb-2">Total</th>
                            </tr>
                        </thead>

                        <tbody class="fw-bold text-black-600">
                            @foreach ($groupedProducts as $item)
                                <tr>
                                    <td>{{ $item['product_name'] }}</td>
                                    <td>{{ $item['sku'] }}</td>
                                    <td class="text-end">{{ number_format($item['unit_price'], 2) }} Tk</td>
                                    <td class="text-end">{{ $item['quantity'] }}</td>
                                    <td class="text-end">{{ number_format($item['total_amount'], 2) }} Tk</td>
                                </tr>
                            @endforeach

                            <tr class="bg-light fw-bold">
                                <td colspan="3" class="text-end text-dark">Grand Total</td>
                                <td class="text-end text-dark">{{ $totalQuantity }}</td>
                                <td class="text-end text-dark">{{ number_format($totalInvoiceValue, 2) }} Tk</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end:Product Summary-->
        </div>
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
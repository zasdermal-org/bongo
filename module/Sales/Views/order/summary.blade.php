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
                            <form class="d-flex align-items-center position-relative my-1" action="{{ route('order.order_summary') }}" method="GET">
                                <div class="w-110 mw-120px me-2">
                                    <input name="from_date" type="date" value="{{ request('from_date') ?? \Carbon\Carbon::now()->toDateString() }}" class="form-control form-control-solid" />
                                </div>

                                <div class="w-110 mw-120px me-2">
                                    <input name="to_date" type="date" value="{{ request('to_date') ?? \Carbon\Carbon::now()->toDateString() }}" class="form-control form-control-solid" />
                                </div>
        
                                <button type="submit" class="btn btn-light-primary">Search</button>
                            </form>
                        </div>
                        <!--begin::Card title-->
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
                                    <th class="min-w-60px text-end">Required Stock</th>
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
                                            <div class="badge badge-light-info">{{ $order->available_stock - $order->total_quantity }} </div>
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


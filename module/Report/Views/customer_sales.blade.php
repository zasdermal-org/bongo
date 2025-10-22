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
                        <form class="d-flex align-items-center position-relative my-1" action="{{ route('report.customer_sales') }}" method="GET">
                            <div class="w-110 mw-120px me-2">
                                <select name="code_number" class="form-select form-select-solid" data-control="select2">
                                    <option value="">All Sale Points</option>
                                    @foreach ($sale_points as $sale_point)
                                        <option value="{{ $sale_point->code_number }}" {{ request('code_number') == $sale_point->code_number ? 'selected' : '' }}>
                                            {{ $sale_point->name }} — ({{ $sale_point->code_number }})
                                        </option>
                                    @endforeach
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
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-10px">S.N</th>
                                <th class="min-w-80px">Sales Point Name</th>
                                <th class="min-w-50px">Code Number</th>
                                <th class="min-w-150px">Address</th>
                                <th class="min-w-80px text-end">Value</th>
                                <th class="min-w-60px text-end">Invoice Count</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody class="text-black-600">
                            @foreach ($salePoints as $key => $salePoint)
                                <tr class="hover-row">
                                    <td>{{ $salePoints->firstItem() + $key }}</td>

                                    <td class="pe-0">
                                        <a href="{{ route('report.customer_sale_details', $salePoint->id) }}?from_date={{ request('from_date') }}&to_date={{ request('to_date') }}">{{ $salePoint->name }}</a>
                                    </td>

                                    <td>{{ $salePoint->code_number }}</td>

                                    <td>{{ $salePoint->address }}</td>

                                    <td class="text-end">{{ number_format($salePoint->total_amount, 2) }} Tk</td>

                                    <td class="text-end">
                                        <div class="badge badge-light-info">
                                            {{ $salePoint->invoice_count }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->

                    <div class="pagination-container mt-10">
                        <nav>
                            {{ $salePoints->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
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




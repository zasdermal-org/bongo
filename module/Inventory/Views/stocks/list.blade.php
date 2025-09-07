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
                            
                            <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Product" />
                        </div>
                        <!--end::Search-->

                        <form class="d-flex align-items-center position-relative my-1" action="{{ route('stocks') }}" method="GET">
                            <div class="w-110 mw-120px me-2">
                                <input name="date" type="date" value="{{ request('date') ?? \Carbon\Carbon::now()->toDateString() }}" class="form-control form-control-solid" />
                            </div>

                            <button type="submit" class="btn btn-light-primary">Search</button>
                        </form>
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        @if(auth()->user()->hasPermission('stock', 'stocks', 'create'))
                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_add_permission">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->

                                Add Stoks
                            </button>
                        @endif
                        <!--end::Button-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_ecommerce_category_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-10px">S.N</th>
                                <th class="min-w-80px">Stock Kipping Unit (SKU)</th>
                                <th class="min-w-80px">Product Name</th>
                                <th class="min-w-80px text-end">Current Stock</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody class="text-black-200">
                            @foreach ($stocks as $key => $stock)
                                <tr class="hover-row">
                                    <td>{{ $key + 1 }}</td>

                                    <!--begin::SKU=-->
                                    <td>{{ $stock->sku }}</td>
                                    <!--end::SKU=-->

                                    <!--begin::Product=-->
                                    <td>{{ $stock->product_name }}</td>
                                    <!--end::Product=-->

                                    <!-- Closing Stock -->
                                    <td class="text-end">{{ $stock->transaction->curr_stock }} pcs</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

            <!--begin::Modals-->
            <!--begin::Modal - Add Sale Point-->
            @include('Inventory::stocks.modals.add')
            <!--end::Modal - Add Sale Point-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>  
@endsection

@push('scripts')
    <script>
        // Trigger addPair() when the modal is fully shown
        $('#kt_modal_add_permission').on('shown.bs.modal', function () {
            // Only add one initial pair when opening the modal
            if ($('#stockContainer .pair-group').length === 0) {
                addPair();
            }
        });
    </script>
@endpush
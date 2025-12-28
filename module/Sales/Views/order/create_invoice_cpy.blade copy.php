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
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body p-12">
                                <!--begin::Form-->
                                <form action="" id="kt_invoice_form">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-start flex-xxl-row">
                                        <!--begin::Input group-->
                                        <div class="d-flex align-items-center flex-equal fw-row me-4 order-2">
                                            <!--begin::Input-->
                                            <div class="position-relative d-flex align-items-center w-300px">
                                                <select id="sale_point_id" data-control="select2" data-placeholder="Select Sale Point" class="form-select form-select-solid">
                                                    <option></option>
                                                    @foreach ($salePoints as $salePoint)
                                                        <option value="{{ $salePoint->id }}">{{ $salePoint->name }} ({{ $salePoint->code_number }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Top-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-10"></div>
                                    <!--end::Separator-->
                                    <!--begin::Wrapper-->
                                    <div class="mb-0">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive mb-10">
                                            <!--begin::Table-->
                                            <table class="table g-5 gs-0 mb-0 fw-bolder text-gray-700" data-kt-element="items">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                                                        <th class="min-w-300px w-475px">Product</th>
                                                        <th class="min-w-100px w-100px">QTY</th>
                                                        <th class="min-w-150px w-150px">Price</th>
                                                        <th class="min-w-100px w-150px text-end">Total</th>
                                                        <th class="min-w-75px w-75px text-end">Action</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                                        {{-- <td class="pe-7">
                                                            <input type="text" class="form-control form-control-solid mb-2" name="name[]" placeholder="Item name" />
                                                        </td> --}}

                                                        <td class="pe-7">
                                                            <select id="product_id" name="product_id[]" class="product-select form-select form-select-solid" data-control="select2" data-placeholder="Select products">
                                                                <option></option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        

                                                        <td class="ps-0">
                                                            <input class="form-control form-control-solid" type="number" min="1" name="quantity[]" placeholder="1" value="1" data-kt-element="quantity" />
                                                        </td>

                                                        <td>
                                                            <input type="text" class="form-control form-control-solid text-end" name="price[]" placeholder="0.00" value="0.00" data-kt-element="price" />
                                                        </td>

                                                        <td class="pt-8 text-end text-nowrap">$
                                                            <span data-kt-element="total">0.00</span>
                                                        </td>

                                                        <td class="pt-5 text-end">
                                                            <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                                <span class="svg-icon svg-icon-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                                <!--begin::Table foot-->
                                                <tfoot>
                                                    <tr class="border-top border-top-dashed align-top fs-6 fw-bolder text-gray-700">
                                                        <th class="text-primary">
                                                            <button class="btn btn-link py-1" data-kt-element="add-item">Add item</button>
                                                        </th>
                                                    </tr>
                                                    <tr class="align-top fw-bolder text-gray-700">
                                                        <th></th>
                                                        <th colspan="2" class="fs-4 ps-0">Total</th>
                                                        <th colspan="2" class="text-end fs-4 text-nowrap">$
                                                        <span data-kt-element="grand-total">0.00</span></th>
                                                    </tr>
                                                </tfoot>
                                                <!--end::Table foot-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                        <!--begin::Item template-->
                                        <table class="table d-none" data-kt-element="item-template">
                                            <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                                {{-- <td class="pe-7">
                                                    <input type="text" class="form-control form-control-solid mb-2" name="name[]" placeholder="Item name" />
                                                </td> --}}

                                                <td class="pe-7">
                                                    <select id="product_id" name="product_id[]" class="product-select form-select form-select-solid" data-control="select2" data-placeholder="Select products">
                                                        <option></option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td class="ps-0">
                                                    <input class="form-control form-control-solid" type="number" min="1" name="quantity[]" placeholder="1" data-kt-element="quantity" />
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control form-control-solid text-end" name="price[]" placeholder="0.00" data-kt-element="price" />
                                                </td>

                                                <td class="pt-8 text-end">$
                                                    <span data-kt-element="total">0.00</span>
                                                </td>

                                                <td class="pt-5 text-end">
                                                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="table d-none" data-kt-element="empty-template">
                                            <tr data-kt-element="empty">
                                                <th colspan="5" class="text-muted text-center py-10">No items</th>
                                            </tr>
                                        </table>
                                        <!--end::Item template-->
                                    </div>
                                    <!--end::Wrapper-->

                                    <div class="d-flex justify-content-end">
                                        <!--begin::Button-->
                                        <button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Save Invoice</span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@push('scripts')

@endpush
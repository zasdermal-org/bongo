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
                            <form class="d-flex align-items-center position-relative my-1" action="{{ route('order.accepted_invoices') }}" method="GET">
                                <div class="w-110 mw-120px me-2">
                                    <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid" placeholder="Search..." />
                                </div>

                                <div class="w-110 mw-120px me-2">
                                    <select name="code_number" class="form-select form-select-solid" data-control="select2">
                                        <option value="">All Sales Point</option>
                                        @foreach ($sale_points as $sale_point)
                                            <option value="{{ $sale_point->code_number }}" {{ request('code_number') == $sale_point->code_number ? 'selected' : '' }}>
                                                {{ $sale_point->name }} — ({{ $sale_point->code_number }})
                                            </option>
                                        @endforeach
                                    </select>                                
                                </div>

                                <div class="w-110 mw-120px me-2">
                                    <select name="type" class="form-select form-select-solid" data-control="select2">
                                        <option value="">All Type</option>
                                        <option value="seed" {{ request('type') == 'seed' ? 'selected' : '' }}>Seed</option>
                                        <option value="agrochemicals" {{ request('type') == 'agrochemicals' ? 'selected' : '' }}>Agrochemicals</option>
                                    </select>
                                </div>

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
                        
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            {{-- <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base"></div>
                            <!--end::Toolbar-->

                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                                <div class="fw-bolder me-5">
                                    <label class="fs-6 fw-bolder text-gray-700 form-label">
                                        <span class="me-2" data-kt-user-table-select="selected_count"></span>
                                        Selected
                                    </label>

                                    <select data-order_invoice_id="" class="form-select form-select-solid status_select" data-control="select2">
                                        <option>Select a Delivery Man</option>
                                        @foreach($delivery_men as $delivery_man)
                                            <option value="{{ $delivery_man->id }}">
                                                @if ($delivery_man->employee)
                                                    {{ $delivery_man->employee->name }} - {{ $delivery_man->depot->name }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Group actions-->

                            <!-- Confirmation Modal -->
                            <div class="modal fade" id="confirmation_modal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirm Update</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to update the delivery man for the selected invoice?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="confirm_update_button">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <!--begin::Export dropdown-->
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor" />
                                        <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor" />
                                        <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                Export Report
                            </button>

                            <!--begin::Menu-->
                            <div id="kt_ecommerce_report_views_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ request()->fullUrlWithQuery(['export'=>'excel']) }}" class="menu-link px-3">Export as Excel</a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ request()->fullUrlWithQuery(['export'=>'csv']) }}" class="menu-link px-3">Export as CSV</a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ request()->fullUrlWithQuery(['export'=>'pdf']) }}" class="menu-link px-3">Export as PDF</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Export dropdown-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-700 fw-bolder fs-7 gs-0">
                                    <th class="min-w-70px">
                                        <div class="badge badge-light-info" style="font-size: 14px;">Invoice => {{ $invoice }}</div>
                                    </th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                        </table>

                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                    {{-- <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                        </div>
                                    </th> --}}
                                    <th class="min-w-10px">S.N</th>
                                    <th class="min-w-80px">Invoice No</th>
                                    <th class="min-w-80px">Order By</th>
                                    <th class="min-w-80px">Sale Point Name</th>
                                    <th class="min-w-50px">Type</th>
                                    <th class="min-w-50px">Payment Type</th>
                                    <th class="min-w-50px">Territory</th>
                                    <th class="min-w-80px">Order Date</th>
                                    <th class="min-w-80px">Invoice Date</th>
                                    <th class="min-w-60px">Payable Amount</th>
                                    <th class="min-w-60px text-end">status</th>
                                    @if (auth()->user()->role->slug === 'admin')
                                        <th class="min-w-50px text-end">Actions</th>
                                    @endif
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-black-600">
                                <!--begin::Table row-->
                                @foreach ($orderInvoices as $key => $orderInvoice)
                                    <tr class="hover-row">
                                        <!--begin::Checkbox-->
                                        {{-- <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input row-checkbox" type="checkbox" value="1" data-order_invoice_id="{{ $orderInvoice->id }}" />
                                            </div>
                                        </td> --}}
                                        <!--end::Checkbox-->

                                        <!--begin::S.N=-->
                                        <td>{{ $key + 1 }}</td>
                                        <!--end::S.N=-->

                                        <!--begin::Invoice No=-->
                                        <td class="pe-0">
                                            {{-- <a href="{{ route('order_management.order_invoice', $order_invoice->id) }}" class="text-gray-700 text-hover-primary fs-5 fw-bolder">{{ $order_invoice->invoice_number }}</a> --}}
                                            <a href="{{ route('order.invoice', $orderInvoice->id) }}">{{ $orderInvoice->invoice_number }}</a>
                                        </td>
                                        <!--end::Invoice No=-->

                                        <!--begin::Order By=-->
                                        <td>
                                            {{ $orderInvoice->user->name }} <br>
                                            ({{ $orderInvoice->user->username }})
                                        </td>
                                        <!--end::Order By=-->

                                        <!--begin::Sales Point Name=-->
                                        <td>
                                            {{ $orderInvoice->salePoint->name }} <br>
                                            ({{ $orderInvoice->salePoint->code_number }})
                                        </td>
                                        <!--end::Sales Point Name=-->
                                        
                                        <td>{{ $orderInvoice->type }}</td>

                                        <td>{{ $orderInvoice->payment_type }}</td>

                                        <!--begin::Territory=-->
                                        <td>{{ $orderInvoice->territory->name }}</td>
                                        <!--end::Territory=-->

                                        <!--begin::Order Date=-->
                                        <td>
                                            {{-- {{ $order_invoice->created_at->setTimezone('Asia/Dhaka')->format('d M, Y / h:i A') }} --}}

                                            {{ $orderInvoice->created_at->setTimezone('Asia/Dhaka')->format('d M, Y') }}
                                            {{-- <br> --}}
                                            {{-- {{ $order_invoice->created_at->setTimezone('Asia/Dhaka')->format('h:i A') }} --}}
                                        </td>
                                        <!--end::Order Date=-->

                                        <!--begin::Invoice Date=-->
                                        <td>
                                            {{-- {{ $order_invoice->updated_at->setTimezone('Asia/Dhaka')->format('d M, Y / h:i A') }} --}}

                                            {{ $orderInvoice->invoice_date->setTimezone('Asia/Dhaka')->format('d M, Y') }}
                                            {{-- <br> --}}
                                            {{-- {{ $order_invoice->updated_at->setTimezone('Asia/Dhaka')->format('h:i A') }} --}}
                                        </td>
                                        <!--end::Invoice Date=-->

                                        <!--begin::Delivery Man=-->
                                        {{-- <td>
                                            @if ($order_invoice->delivery_man_id === null)
                                                <div class="badge badge-light-danger">Not Assigned</div>
                                            @else
                                                @if ($order_invoice->delivery_man->employee)
                                                    {{ $order_invoice->delivery_man->employee->name }} <br>
                                                    ({{ $order_invoice->delivery_man->depot->name }})
                                                @endif
                                            @endif
                                        </td> --}}
                                        <!--end::Delivery Man=-->
                                        
                                        <!--begin::Payable Amount=-->
                                        <td>{{ $orderInvoice->total_amount }} Tk</td>
                                        <!--end::Payable Amount=-->

                                        <!--begin::Status=-->
                                        <td class="text-end">
                                            <div class="badge badge-light-warning">{{ $orderInvoice->status }}</div>
                                        </td>
                                        <!--end::Status=-->

                                        @if (auth()->user()->role->slug === 'admin')
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions

                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </a>

                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a id="full_return_invoice_{{ $orderInvoice->id }}" data-invoice_id="{{ $orderInvoice->id }}" href="javascript:void(0);" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#full_return_confirmation">
                                                            Full Return
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                <!--end::Table row-->
                            </tbody>
                            <!--end::Table body-->

                            <tfoot>
                                <tr>
                                    {{-- <td colspan="{{ auth()->user()->role->slug === 'admin' ? 9 : 9 }}" class="text-end fw-bold"> --}}
                                    <td colspan="9" class="text-end fw-bold">
                                        <div class="badge badge-light-info" style="font-size: 14px;">Total:</div>
                                    </td>
                                    <td class="fw-bold">
                                        <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($order_value, 2) }} Tk</div>
                                    </td>
                                    {{-- <td class="fw-bold">
                                        <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($discount_value, 2) }} Tk</div>
                                    </td>
                                    <td class="fw-bold">
                                        <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($payable_value, 2) }} Tk</div>
                                    </td> --}}
                                </tr>
                            </tfoot>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->

                <div class="modal fade" id="full_return_confirmation" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Full Return Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to Fully Return all orders?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" id="confirmReturn">Return</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post--> 
    </div>
@endsection

@push('scripts')
    <script>
        // $(document).ready(function() {
        //     let selected_delivery_man_id = null;

        //     // Show the confirmation modal on select change
        //     $('.status_select').on('change', function() {
        //         selected_delivery_man_id = $(this).val();
        //         if (selected_delivery_man_id) {
        //             $('#confirmation_modal').modal('show');
        //         }
        //     });

        //     // Handle the confirmation button click
        //     $('#confirm_update_button').on('click', function() {
        //         // Collect all selected order invoice IDs
        //         let selected_order_invoice_ids = [];
        //         $('.row-checkbox:checked').each(function() {
        //             selected_order_invoice_ids.push($(this).data('order_invoice_id'));
        //         });

        //         // Send AJAX requests to update each selected item
        //         selected_order_invoice_ids.forEach(function(order_invoice_id) {
        //             let action = url.replace(':order_invoice_id', order_invoice_id);

        //             $.ajax({
        //                 url: action,
        //                 type: 'PUT',
        //                 headers: {
        //                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //                 },
        //                 data: {
        //                     delivery_man_id: selected_delivery_man_id
        //                 },
        //                 success: function(response) {
        //                     console.log('Order invoice updated successfully');
        //                 },
        //                 error: function(xhr) {
        //                     console.error('Failed to update order invoice', xhr);
        //                 }
        //             });
        //         });

        //         // Optionally, reload the page after updates
        //         location.reload();

        //         // Hide the modal
        //         $('#confirmation_modal').modal('hide');
        //     });
        // });

        document.querySelectorAll('[id^="full_return_invoice_"]').forEach(link => {
            // console.log(test);
            
            link.addEventListener('click', function () {
                const invoiceId = this.getAttribute('data-invoice_id');
                const confirmButton = document.getElementById('confirmReturn');

                // Update the click event for the confirm button dynamically
                confirmButton.onclick = function () {
                    const url = "{{ route('order.return_invoice', ':id') }}".replace(':id', invoiceId);
                    window.location.href = url;
                };
            });
        });
    </script>
@endpush


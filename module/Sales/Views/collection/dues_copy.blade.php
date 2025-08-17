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
                        <form class="d-flex align-items-center position-relative my-1" action="{{ route('collection.dues_copy') }}" method="GET">
                            <!--begin::Depot-->
                            <div class="w-110 mw-120px me-2">
                                <!--begin::Select2-->
                                <select name="sale_point_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Sale Point" data-kt-ecommerce-product-filter="status">
                                    <option></option>
                                    @foreach ($salePoints as $salePoint)
                                        <option value="{{ $salePoint->id }}" {{ request('sale_point_id') == $salePoint->id ? 'selected' : '' }}>
                                            {{ $salePoint->name }} / ({{ $salePoint->address }})
                                        </option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->
                            </div>
                            <!--end::Depot-->

                            <button type="submit" class="btn btn-light-primary">Search</button>
                        </form>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table_">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-10px">S.N</th>
                                <th class="min-w-80px">Invoice No</th>
                                <th class="min-w-80px">Sale Point Name</th>
                                <th class="min-w-80px">Order By</th>
                                <th class="min-w-50px">Territory</th>
                                <th class="min-w-80px">Invoice Date/Time</th>
                                <th class="min-w-60px">Amount</th>
                                <th class="min-w-60px">Discount</th>
                                <th class="min-w-60px">Payable Amount</th>
                                <th class="min-w-60px">Paid</th>

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
                            @foreach ($collections as $key => $collection)
                                <tr class="invoice-row">
                                    <!--begin::S.N=-->
                                    <td>{{ $key + 1 }}</td>
                                    <!--end::S.N=-->

                                    <!--begin::Invoice number=-->
                                    <td>
                                        <a href="javascript:void(0)">{{ $collection->orderInvoice->invoice_number }}</a>
                                    </td>
                                    <!--end::Invoice number=-->

                                    <!--begin::Sale point name=-->
                                    <td>{{ $collection->orderInvoice->salePoint->name }} ({{ $collection->orderInvoice->salePoint->code_number }})</td>
                                    <!--end::Sale point name=-->

                                    <!--begin::Order by=-->
                                    <td>{{ $collection->orderInvoice->user->name }}</td>
                                    <!--end::Order by=-->

                                    <!--begin::Territory name=-->
                                    <td>{{ $collection->orderInvoice->territory->name }}</td>
                                    <!--end::Territory name=-->

                                    <!--begin::Invoice Date/Time=-->
                                    <td>{{ $collection->orderInvoice->invoice_date->setTimezone('Asia/Dhaka')->format('d M, Y / h:i A') }}</td>
                                    <!--end::Invoice Date/Time=-->

                                    <!--begin::Amount=-->
                                    <td>
                                        {{ $collection->collection_amount }} Tk
                                        <input type="hidden" class="total-amount" value="{{ $collection->collection_amount }}">
                                    </td>
                                    <!--end::Amount=-->

                                    <!--begin::Payable Amount=-->
                                    <td class="discount-amount"></td>
                                    <td class="payable-amount"></td>
                                    <td> <input type="number" class="form-control no-spinner paid-amount"></td>
                                    <!--end::Payable Amount=-->

                                    <td class="text-end">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input row-checkbox" type="checkbox" value="1" data-collection_id="{{ $collection->id }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->

                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-end fw-bold"></td>
                                <td class="fw-bold">
                                    <div id="selectedTotalAmount" class="badge badge-light-info" style="font-size: 14px;">0.00 Tk</div>
                                </td>

                                <td class="fw-bold">
                                    <div id="totalDiscount" class="badge badge-light-info" style="font-size: 14px;">0.00 Tk</div>
                                </td>

                                <td class="fw-bold">
                                    <div id="totalPayable" class="badge badge-light-info" style="font-size: 14px;">0.00 Tk</div>
                                </td>

                                <td class="fw-bold">
                                    <form id="paymentForm" action="{{ route('collection.update_due_copy') }}" method="POST">
                                        @csrf
                                        <input id="discountInput" type="number" name="discount" class="form-control mt-3 no-spinner" placeholder="Set Discount (%)">
                                        
                                         <div id="selectedInvoicesContainer"></div>

                                        <button type="submit" class="btn btn-sm btn-primary w-100 mt-3">Make Payment</button>
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

            <!--begin::Modals-->
            @include('Sales::collection.modals.due')

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
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>  
@endsection

@push('scripts')
    <script>
        document.getElementById('discountInput').addEventListener('input', function () {
            const discountPercent = parseFloat(this.value) || 0;
            let totalDiscount = 0;
            let totalPayable = 0;
            let selectedTotalAmount = 0;

            document.querySelectorAll('.invoice-row').forEach(function (row) {
                const checkbox = row.querySelector('.row-checkbox');
                const payableField = row.querySelector('.payable-amount');
                const paidField = row.querySelector('.paid-amount');
                const discountField = row.querySelector('.discount-amount');

                const totalAmount = parseFloat(row.querySelector('.total-amount').value);

                if (checkbox.checked) {
                    const discountAmount = (discountPercent / 100) * totalAmount;
                    const payable = totalAmount - discountAmount;
                    payableField.textContent = payable.toFixed(2);
                    discountField.textContent = discountAmount.toFixed(2);
                    paidField.value = payable;

                    totalDiscount += discountAmount;
                    totalPayable += payable;
                    selectedTotalAmount += totalAmount;
                } else {
                    // Clear payable amount for unselected rows
                    payableField.textContent = '';
                    discountField.textContent = '';
                    paidField.value = '';
                }
            });

            document.getElementById('selectedTotalAmount').textContent = selectedTotalAmount.toFixed(2) + ' Tk';
            document.getElementById('totalDiscount').textContent = totalDiscount.toFixed(2) + ' Tk';
            document.getElementById('totalPayable').textContent = totalPayable.toFixed(2) + ' Tk';
        });

        document.querySelectorAll('.row-checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                document.getElementById('discountInput').dispatchEvent(new Event('input'));
            });
        });

        const selectAllCheckbox = document.querySelector('input[data-kt-check="true"]');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                const targetSelector = this.getAttribute('data-kt-check-target');
                const targets = document.querySelectorAll(targetSelector);

                targets.forEach(function (checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                    checkbox.dispatchEvent(new Event('change')); // 💡 manually trigger change
                });
            });
        }

        function updateSelectedInvoicesForSubmit() {
            const container = document.getElementById('selectedInvoicesContainer');
            container.innerHTML = ''; // Clear previous inputs

            document.querySelectorAll('.invoice-row').forEach(function (row) {
                const checkbox = row.querySelector('.row-checkbox');
                if (checkbox.checked) {
                    const collectionId = checkbox.getAttribute('data-collection_id');
                    const discountAmount = row.querySelector('.discount-amount').textContent.trim();
                    const payableAmount = row.querySelector('.payable-amount').textContent.trim();
                    const paidAmount = row.querySelector('.paid-amount').value.trim();

                    if (collectionId && payableAmount) {
                        container.innerHTML += `
                            <input type="hidden" name="collections[${collectionId}][collection_id]" value="${collectionId}">
                            <input type="hidden" name="collections[${collectionId}][discount_amount]" value="${parseFloat(discountAmount)}">
                            <input type="hidden" name="collections[${collectionId}][collection_amount]" value="${parseFloat(payableAmount)}">
                            <input type="hidden" name="collections[${collectionId}][paid_amount]" value="${parseFloat(paidAmount)}">
                        `;
                    }
                }
            });
        }

        document.getElementById('paymentForm').addEventListener('submit', function (e) {
            updateSelectedInvoicesForSubmit();
        });
    </script>
@endpush
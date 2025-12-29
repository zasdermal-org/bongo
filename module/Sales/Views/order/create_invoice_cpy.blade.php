@extends('Access::layouts.app')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    @include('Access::layouts.breadcrumb')

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-body p-12">

                    {{-- FORM --}}
                    <form action="{{ route('order.store_invoice_cpy') }}" method="POST" id="kt_invoice_form">
                        @csrf

                        {{-- SALE POINT --}}
                        <div class="mb-10">
                            <select name="sale_point_id" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Select Sale Point" required>
                                <option></option>
                                @foreach ($salePoints as $salePoint)
                                    <option value="{{ $salePoint->id }}">
                                        {{ $salePoint->name }} ({{ $salePoint->code_number }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        {{-- ITEMS TABLE --}}
                        <div class="table-responsive mb-10">
                            <table class="table g-5 gs-0 mb-0 fw-bolder text-gray-700">
                                <thead>
                                    <tr class="border-bottom fs-7 text-uppercase">
                                        <th class="min-w-300px">Product</th>
                                        <th class="min-w-100px">Qty</th>
                                        <th class="min-w-150px">Price</th>
                                        <th class="min-w-150px text-end">Total</th>
                                        <th class="min-w-75px text-end">Action</th>
                                    </tr>
                                </thead>

                                <tbody data-kt-items="body">
                                    <tr data-kt-item="row">
                                        <td>
                                            <select name="stock_id[]" class="form-select form-select-solid"
                                                data-control="select2" data-placeholder="Select product" required>
                                                <option></option>
                                                @foreach ($stocks as $stock)
                                                    <option value="{{ $stock->id }}">
                                                        {{ $stock->product->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input type="number" name="quantity[]" min="1"
                                                class="form-control form-control-solid qty">
                                        </td>

                                        <td>
                                            <input type="number" name="price[]" step="any" class="form-control form-control-solid price text-end">
                                        </td>

                                        <td class="text-end pt-3">
                                            ৳ <span class="row-total">0.00</span>
                                        </td>

                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-danger remove-row">
                                                ✕
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>
                                            <button type="button" class="btn btn-link add-row">
                                                + Add Item
                                            </button>
                                        </th>
                                    </tr>
                                    <tr class="fs-4">
                                        <th colspan="3" class="text-end">Grand Total</th>
                                        <th class="text-end">
                                            ৳ <span id="grandTotal">0.00</span>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        {{-- SUBMIT --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                Save Invoice
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
$(document).ready(function () {

    function initSelect2(context = document) {
        $(context).find('[data-control="select2"]').select2({ width: '100%' });
    }

    initSelect2();

    // Calculate row total
    function calculateRow(row) {
        let qty = parseFloat($(row).find('.qty').val()) || 0;
        let price = parseFloat($(row).find('.price').val()) || 0;
        let total = qty * price;

        $(row).find('.row-total').text(total.toFixed(2));
        calculateGrandTotal();
    }

    // Calculate grand total
    function calculateGrandTotal() {
        let grand = 0;
        $('.row-total').each(function () {
            grand += parseFloat($(this).text()) || 0;
        });
        $('#grandTotal').text(grand.toFixed(2));
    }

    // Add row
    $('.add-row').on('click', function () {

    // Destroy select2 on first row before cloning
    let firstRow = $('[data-kt-item="row"]:first');
    firstRow.find('[data-control="select2"]').select2('destroy');

    // Clone row
    let row = firstRow.clone();

    // Reset values
    row.find('select').val('');
    row.find('.qty').val(1);
    row.find('.price').val(0);
    row.find('.row-total').text('0.00');

    // Append row
    $('[data-kt-items="body"]').append(row);

    // Re-init select2 on ALL rows
    initSelect2();

});

    // Remove row
    $(document).on('click', '.remove-row', function () {
        if ($('[data-kt-item="row"]').length > 1) {
            $(this).closest('tr').remove();
            calculateGrandTotal();
        }
    });

    // Recalculate on input
    $(document).on('input', '.qty, .price', function () {
        calculateRow($(this).closest('tr'));
    });

});
</script>
@endpush

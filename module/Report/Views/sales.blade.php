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
                        <form class="d-flex align-items-center position-relative my-1" action="{{ route('report.sales') }}" method="GET">
                            <!--begin::Search-->
                            <div class="w-110 mw-120px me-2">
                                <select name="code_number" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Sales Point">
                                    <option></option>
                                    @foreach ($sale_points as $sale_point)
                                        <option value="{{ $sale_point->code_number }}" {{ request('code_number') == $sale_point->code_number ? 'selected' : '' }}>
                                            {{ $sale_point->name }} — ({{ $sale_point->code_number }})
                                        </option>
                                    @endforeach
                                </select>                                
                            </div>
                            <!--end::Search-->

                            <!--begin::Search-->
                            <div class="w-110 mw-120px me-2">
                                <select name="type" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Type">
                                    <option></option> {{-- placeholder --}}
                                    <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="seed" {{ request('type') == 'seed' ? 'selected' : '' }}>Seed</option>
                                    <option value="agrochemicals" {{ request('type') == 'agrochemicals' ? 'selected' : '' }}>Agrochemicals</option>
                                </select>
                            </div>
                            <!--end::Search-->

                            <!-- Region -->
                            <div class="w-110 mw-120px me-2">
                                <select onchange="loadAreas(this.value)" name="region_id" id="region_id" class="form-select form-select-solid" data-control="select2">
                                    <option value="">All Regions</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? 'selected' : '' }}>
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Area -->
                            <div class="w-110 mw-120px me-2">
                                <select onchange="loadTerritories(this.value)" name="area_id" id="area_id" class="form-select form-select-solid" data-control="select2">
                                    <option value="">All Areas</option>
                                    @if(request('region_id'))
                                        @foreach ($areas->where('region_id', request('region_id')) as $area)
                                            <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                                                {{ $area->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Territory -->
                            <div class="w-110 mw-120px me-2">
                                <select name="territory_id" id="territory_id" class="form-select form-select-solid" data-control="select2">
                                    <option value="">All Territories</option>
                                    @if(request('area_id'))
                                        @foreach ($territories->where('area_id', request('area_id')) as $territory)
                                            <option value="{{ $territory->id }}" {{ request('territory_id') == $territory->id ? 'selected' : '' }}>
                                                {{ $territory->name }}
                                            </option>
                                        @endforeach
                                    @endif
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
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-700 fw-bolder fs-7 gs-0">
                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Invoice => {{ $invoice }}</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Order => {{ number_format($invoice_value, 2) }} Tk</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Discount => {{ number_format($discount_value, 2) }} Tk</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Return => {{ number_format($return_value, 2) }} Tk</div>
                                </th>

                                <th>
                                    <div class="badge badge-light-info" style="font-size: 14px;">Payable => {{ number_format($payable_value, 2) }} Tk</div>
                                </th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                    </table>

                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <!--begin::Table head-->
                        

                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-10px">S.N</th>
                                <th class="min-w-80px">Invoice No</th>
                                <th class="min-w-80px">Order By</th>
                                <th class="min-w-80px">Sales Point Name</th>
                                <th class="min-w-50px">Type</th>
                                <th class="min-w-80px">Order Date</th>
                                <th class="min-w-80px">Invoice Date</th>
                                <th class="min-w-50px">Payment Type</th>
                                <th class="min-w-60px text-end">Invoice Value</th>
                                <th class="min-w-60px text-end">Discount</th>
                                <th class="min-w-60px text-end">Return</th>
                                <th class="min-w-60px text-end">Payable</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody class="text-black-600">
                            @foreach ($order_invoices as $key => $order_invoice)
                                <tr class="hover-row">
                                    <td>{{ $order_invoices->firstItem() + $key }}</td>

                                    <td class="pe-0">
                                        {{-- <a href="{{ route('order_management.order_invoice', $order_invoice->id) }}" class="text-gray-700 text-hover-primary fs-5 fw-bolder"> --}}
                                        <a href="{{ route('order.invoice', $order_invoice->id) }}">{{ $order_invoice->invoice_number }}</a>
                                    </td>

                                    <td>{{ $order_invoice->user->name }}</td>

                                    <td>{{ $order_invoice->salePoint->name }}</td>

                                    <td>{{ ucwords($order_invoice->type) }}</td>

                                    <td class="pe-0">{{ $order_invoice->created_at->setTimezone('Asia/Dhaka')->format('d M, Y') }}</td>

                                    <td class="pe-0">{{ $order_invoice->updated_at->setTimezone('Asia/Dhaka')->format('d M, Y') }}</td>

                                    <td>
                                        @if ($order_invoice->payment_type === 'Cash')
                                            {{ $order_invoice->payment_type }} ({{ $order_invoice->discount }} %)
                                        @else
                                            {{ $order_invoice->payment_type }}
                                        @endif
                                    </td>

                                    <td class="text-end">{{ number_format($order_invoice->total_amount, 2) }} Tk</td>

                                    <td class="text-end">
                                        @if ($order_invoice->discount)
                                            {{ number_format($order_invoice->discount_value, 2) }} Tk
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        @if ($order_invoice->return_amount)
                                            {{ number_format($order_invoice->return_amount, 2) }} Tk
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td class="text-end">{{ number_format($order_invoice->total_amount - $order_invoice->discount_value, 2) }} Tk</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->

                        <tfoot>
                            <tr>
                                <td colspan="8" class="text-end fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">Total:</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($invoice_value, 2) }} Tk</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($discount_value, 2) }} Tk</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($return_value, 2) }} Tk</div>
                                </td>
                                <td class="fw-bold text-end">
                                    <div class="badge badge-light-info" style="font-size: 14px;">{{ number_format($payable_value, 2) }} Tk</div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <!--end::Table-->

                    <div class="pagination-container mt-10">
                        <nav>
                            {{ $order_invoices->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
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

{{-- <script>
$(document).ready(function () {

    // ===== When region changes → load areas =====
    $('#region_id').on('change', function () {
        let regionId = $(this).val();
        $('#area_id').empty().append('<option value="">Select Area</option>');
        $('#territory_id').empty().append('<option value="">Select Territory</option>');

        if (regionId) {
            $.ajax({
                url: "{{ route('report.get_areas', ':id') }}".replace(':id', regionId),
                type: "GET",
                success: function (data) {
                    $.each(data, function (key, area) {
                        $('#area_id').append('<option value="' + area.id + '">' + area.name + '</option>');
                    });

                    // If page has old selected area → reselect it
                    let selectedArea = "{{ request('area_id') }}";
                    if (selectedArea) {
                        $('#area_id').val(selectedArea).trigger('change');
                    }
                },
                error: function (xhr) {
                    console.error("Error fetching areas:", xhr.responseText);
                }
            });
        }
    });

    // ===== When area changes → load territories =====
    $('#area_id').on('change', function () {
        let areaId = $(this).val();
        $('#territory_id').empty().append('<option value="">Select Territory</option>');

        if (areaId) {
            $.ajax({
                url: "{{ route('report.get_territories', ':id') }}".replace(':id', areaId),
                type: "GET",
                success: function (data) {
                    $.each(data, function (key, territory) {
                        $('#territory_id').append('<option value="' + territory.id + '">' + territory.name + '</option>');
                    });

                    // If page has old selected territory → reselect it
                    let selectedTerritory = "{{ request('territory_id') }}";
                    if (selectedTerritory) {
                        $('#territory_id').val(selectedTerritory).trigger('change');
                    }
                },
                error: function (xhr) {
                    console.error("Error fetching territories:", xhr.responseText);
                }
            });
        }
    });

    // ===== Auto-load if region already selected =====
    let selectedRegion = "{{ request('region_id') }}";
    if (selectedRegion) {
        $('#region_id').trigger('change');
    }
});
</script> --}}

<script>
function loadAreas(regionId) {
    let areaSelect = document.getElementById('area_id');
    let territorySelect = document.getElementById('territory_id');

    // Reset areas and territories
    areaSelect.innerHTML = '<option value="">All Areas</option>';
    territorySelect.innerHTML = '<option value="">All Territories</option>';

    if (!regionId) return; // Nothing selected

    fetch('/report/get-areas/' + regionId)
        .then(response => response.json())
        .then(data => {
            data.forEach(area => {
                let option = document.createElement('option');
                option.value = area.id;
                option.text = area.name;
                areaSelect.add(option);
            });

            // Trigger Select2 refresh
            $('#area_id').val('').trigger('change.select2');
        })
        .catch(err => console.error('Error fetching areas:', err));
}

function loadTerritories(areaId) {
    let territorySelect = document.getElementById('territory_id');
    territorySelect.innerHTML = '<option value="">All Territories</option>';

    if (!areaId) return;

    fetch('/report/get-territories/' + areaId)
        .then(response => response.json())
        .then(data => {
            data.forEach(territory => {
                let option = document.createElement('option');
                option.value = territory.id;
                option.text = territory.name;
                territorySelect.add(option);
            });

            // Trigger Select2 refresh
            $('#territory_id').val('').trigger('change.select2');
        })
        .catch(err => console.error('Error fetching territories:', err));
}
</script>




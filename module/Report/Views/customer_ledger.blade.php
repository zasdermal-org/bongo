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
                        <form class="d-flex align-items-center position-relative my-1" action="{{ route('report.customer_ledger') }}" method="GET">
                            <div class="w-110 mw-120px me-2">
                                <select name="sale_point_id" class="form-select form-select-solid" data-control="select2">
                                    <option value="">All Sales Point</option>
                                    @foreach ($sale_points as $sale_point)
                                        <option value="{{ $sale_point->id }}" {{ request('sale_point_id') == $sale_point->id ? 'selected' : '' }}>
                                            {{ $sale_point->name }} — ({{ $sale_point->code_number }})
                                        </option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- <div class="w-110 mw-120px me-2">
                                <select name="type" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Type">
                                    <option></option>
                                    <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="seed" {{ request('type') == 'seed' ? 'selected' : '' }}>Seed</option>
                                    <option value="agrochemicals" {{ request('type') == 'agrochemicals' ? 'selected' : '' }}>Agrochemicals</option>
                                </select>
                            </div>

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
                            </div> --}}

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
                <div class="card-body">
                    <style>
                        .ledger-container {
                            font-size: 13px;
                            font-family: Arial, sans-serif;
                            color: #000;
                        }

                        .ledger-header, .ledger-row {
                            display: grid;
                            grid-template-columns: 110px 1.5fr 140px 120px 120px 120px;
                            padding: 3px 0;
                            align-items: center;
                        }

                        /* Only header has lines */
                        .ledger-header {
                            border-top: 1px solid #000;
                            border-bottom: 1px solid #000;
                            font-weight: bold;
                        }

                        /* NO row borders */
                        .ledger-row {
                            border: none;
                        }

                        .text-end {
                            text-align: right;
                        }

                        .particulars span.type {
                            display: inline-block;
                            width: 25px;
                            font-weight: bold;
                        }

                        .bold {
                            font-weight: bold;
                        }

                        /* HALF LINE (right side only like image) */
                        .half-line {
                            display: flex;
                            justify-content: flex-end;
                            margin-top: 10px;
                        }

                        .half-line div {
                            width: 240px; /* matches Debit + Credit width */
                            border-top: 1px solid #000;
                        }

                        .double-line {
                            display: flex;
                            justify-content: flex-end;
                            margin-top: 3px;
                        }

                        .double-line div {
                            width: 240px;
                            border-top: 2px solid #000;
                        }
                    </style>

                    @php
                        $totalDebit = $openingBalance > 0 ? $openingBalance : 0;
                        $totalCredit = $openingBalance < 0 ? abs($openingBalance) : 0;
                        $closingBlance = 0;
                    @endphp

                    <div class="ledger-container">

                        <!-- Header -->
                        <div class="ledger-header">
                            <div>Date</div>
                            <div>Particulars</div>
                            <div>Vch Type</div>
                            <div>Vch No.</div>
                            <div class="text-end">Debit</div>
                            <div class="text-end">Credit</div>
                        </div>

                        <div class="ledger-row bold">
                            <div></div>
                            <div></div>
                            <div>Opening Balance</div>
                            <div></div>
                            <div class="text-end">{{ number_format($openingBalance, 2) }}</div>
                        </div>

                        <!-- Rows -->
                        @foreach($ledger as $row)
                            @php
                                $totalDebit += $row['debit'];
                                $totalCredit += $row['credit'];
                                $closingBlance = $totalDebit - $totalCredit;
                            @endphp

                            <div class="ledger-row">
                                <div>{{ $row['date'] }}</div>

                                <div class="particulars">
                                    <span class="type">{{ $row['type'] }}</span>
                                    {{ $row['particular'] }}
                                </div>

                                <div>{{ $row['vch_type'] }}</div>
                                <div>{{ $row['vch_no'] }}</div>

                                <div class="text-end">
                                    {{ $row['debit'] ? number_format($row['debit'], 2) : '' }}
                                </div>

                                <div class="text-end">
                                    {{ $row['credit'] ? number_format($row['credit'], 2) : '' }}
                                </div>
                            </div>
                        @endforeach

                        <!-- HALF LINE (like your image) -->
                        <div class="half-line">
                            <div></div>
                        </div>

                        <!-- Totals -->
                        <div class="ledger-row bold">
                            <div></div>
                            <div></div>
                            <div>Total</div>
                            <div></div>

                            <div class="text-end">
                                {{ number_format($totalDebit, 2) }}
                            </div>

                            <div class="text-end">
                                {{ number_format($totalCredit, 2) }}
                            </div>
                        </div>

                        <!-- Final Totals -->
                        <div class="ledger-row bold">
                            <div></div>
                            <div></div>
                            <div>Closing Balance</div>
                            <div></div>
                            <div></div>
                            {{-- <div class="text-end">{{ number_format($totalDebit, 2) }}</div> --}}
                            <div class="text-end">{{ number_format($closingBlance, 2) }}</div>
                        </div>

                        <div class="half-line">
                            <div></div>
                        </div>

                        <div class="ledger-row bold">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div class="text-end">{{ number_format($totalDebit, 2) }}</div>
                            <div class="text-end">{{ number_format($totalCredit + $closingBlance, 2) }}</div>
                        </div>

                        <!-- DOUBLE LINE -->
                        <div class="double-line">
                            <div></div>
                        </div>

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




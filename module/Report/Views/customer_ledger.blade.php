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

                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <button type="button" class="btn btn-primary mb-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor" />
                                    <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor" />
                                    <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                </svg>
                            </span>

                            Export Report
                        </button>

                        <div id="kt_ecommerce_report_views_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0);" class="menu-link px-3" data-kt-ecommerce-export="excel">Export as Excel</a>
                            </div>

                            <div class="menu-item px-3">
                                <a href="javascript:void(0);" class="menu-link px-3" data-kt-ecommerce-export="pdf">Export as PDF</a>
                            </div>
                        </div>
                    </div>
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

@push('scripts')
    <script>
        document.querySelector('[data-kt-ecommerce-export="pdf"]').addEventListener('click', function (e) {
            e.preventDefault();
            window.location.href = "{{ route('report.customer_ledger_pdf_export') }}" + window.location.search;
        });
    </script>
@endpush




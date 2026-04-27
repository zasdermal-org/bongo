<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px;
    }

    .header {
        text-align: center;
        margin-bottom: 12px;
        line-height: 1.2;
    }

    .header h2,
    .header h3,
    .header p {
        margin: 0;           /* 🔥 removes default gaps */
        padding: 0;
    }

    .header h3 {
        font-size: 16px;
        font-weight: bold;
    }

    .header h2 {
        font-size: 14px;
        margin-top: 2px;     /* small controlled spacing */
    }

    .header p {
        font-size: 11px;
        margin-top: 1px;     /* minimal spacing */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 5px;
        font-size: 12px;
    }

    th {
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        text-align: left;
    }

    .text-end {
        text-align: right;
    }

    .bold {
        font-weight: bold;
    }
</style>

<div class="header">
    <h3>{{ $companyName }}</h3>
    <p>{{ $companyAddress }}</p>
    <h2>{{ $customerName }} ({{ $customerCode }})</h2>
    <p>Ledger Account</p>
    <p>{{ $customerAddress }}</p>
    <p><strong>Date Range:</strong> {{ $fromDate }} to {{ $toDate }}</p>
</div>

@php
    $totalDebit = $openingBalance > 0 ? $openingBalance : 0;
    $totalCredit = $openingBalance < 0 ? abs($openingBalance) : 0;
    $closingBlance = 0;
@endphp

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Particulars</th>
            <th>Vch Type</th>
            <th>Vch No.</th>
            <th class="text-end">Debit</th>
            <th class="text-end">Credit</th>
        </tr>
    </thead>

    <tbody>
        <!-- Opening -->
        <tr class="bold">
            <td></td>
            <td></td>
            <td>Opening Balance</td>
            <td></td>
            <td class="text-end">{{ number_format($openingBalance, 2) }}</td>
            <td></td>
        </tr>

        @foreach($ledger as $row)
            @php
                $totalDebit += $row['debit'];
                $totalCredit += $row['credit'];
                $closingBlance = $totalDebit - $totalCredit;
            @endphp

            <tr>
                <td>{{ $row['date'] }}</td>
                <td>{{ $row['type'] }} {{ $row['particular'] }}</td>
                <td>{{ $row['vch_type'] }}</td>
                <td>{{ $row['vch_no'] }}</td>
                <td class="text-end">
                    {{ $row['debit'] ? number_format($row['debit'], 2) : '' }}
                </td>
                <td class="text-end">
                    {{ $row['credit'] ? number_format($row['credit'], 2) : '' }}
                </td>
            </tr>
        @endforeach

        <!-- HALF LINE -->
        <tr>
            <td colspan="6">
                <div style="width: 240px; border-top: 1px solid #000; margin-left: auto;"></div>
            </td>
        </tr>

        <!-- Total -->
        <tr class="bold">
            <td></td>
            <td></td>
            <td>Total</td>
            <td></td>
            <td class="text-end">{{ number_format($totalDebit, 2) }}</td>
            <td class="text-end">{{ number_format($totalCredit, 2) }}</td>
        </tr>

        <!-- Closing -->
        <tr class="bold">
            <td></td>
            <td></td>
            <td>Closing Balance</td>
            <td></td>
            <td></td>
            <td class="text-end">{{ number_format($closingBlance, 2) }}</td>
        </tr>

        <!-- HALF LINE -->
        <tr>
            <td colspan="6">
                <div style="width: 240px; border-top: 1px solid #000; margin-left: auto;"></div>
            </td>
        </tr>

        <tr class="bold">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-end">{{ number_format($totalDebit, 2) }}</td>
            <td class="text-end">{{ number_format($totalCredit + $closingBlance, 2) }}</td>
        </tr>

        <!-- DOUBLE LINE -->
        <tr>
            <td colspan="6">
                <div style="width: 240px; border-top: 2px solid #000; margin-left: auto;"></div>
            </td>
        </tr>
    </tbody>
</table>
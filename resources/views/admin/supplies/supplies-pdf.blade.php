<!DOCTYPE html>
<html>

<head>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        margin: 20px;
    }

    .page-border {
        border: 2px solid black;
        padding: 10px;
    }

    h2 {
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        margin: 5px 0;
    }

    h4 {
        text-align: center;
        margin: 5px 0 15px 0;
        font-weight: normal;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid black;
    }

    th, td {
        border: 1px solid black;
        text-align: center;
        padding: 4px 6px;
    }

    thead th {
        background-color: #f9f9f9;
        font-weight: bold;
    }

    tfoot th {
        font-weight: bold;
        background-color: #f2f2f2;
    }

    /* Tighten row spacing */
    tr td {
        padding: 3px 5px;
    }
</style>

</head>

<body class="page-border">

    <h2>{{ $company_Name }}</h2>

    <h4>
        FFB Supplies Details For Supplier = [ {{ $supplierName }} ] From [ {{ $startDate }} ] To [ {{ $endDate }} ]
    </h4>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Supplier</th>
                <th rowspan="2">Vehicle</th>
                <th rowspan="2">TRX Date</th>
                <th rowspan="2">Ticket No</th>

                <th colspan="{{ $allMills->count() }}" style="text-align:center">Palm Oil Mills</th>

                <th rowspan="2">Total Weight (MT)</th>
            </tr>
            <tr>
                @foreach ($allMills as $mill)
                    <th>{{ $mill->name }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @php
                $grandTotals = [];
                foreach ($allMills as $mill) {
                    $grandTotals['mill_' . $mill->id] = 0;
                }
                $grandTotals['total_weight'] = 0;
            @endphp

            @foreach ($transactions as $transaction)
                @php
                    $totalWeight = 0;
                @endphp
                <tr>
                    <td>{{ $transaction->supplier->supplier_id ?? 'N/A' }}</td>
                    <td>{{ $transaction->vehicle->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->trx_date)->format('d-M-Y') }}</td>
                    <td>{{ $transaction->ticket_no }}</td>

                    @foreach ($allMills as $mill)
                        @php
                            $weight = ($transaction->mill_id == $mill->id) ? number_format($transaction->weight, 2) : '';
                            $totalWeight += ($weight !== '') ? floatval($transaction->weight) : 0;
                            $grandTotals['mill_' . $mill->id] += ($weight !== '') ? floatval($transaction->weight) : 0;
                        @endphp
                        <td>{{ $weight }}</td>
                    @endforeach

                    <td>{{ number_format($totalWeight, 2) }}</td>
                    @php $grandTotals['total_weight'] += $totalWeight; @endphp
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="4" style="text-align:right;">Total:</th>
                @foreach ($allMills as $mill)
                    <th>{{ number_format($grandTotals['mill_' . $mill->id], 2) }}</th>
                @endforeach
                <th>{{ number_format($grandTotals['total_weight'], 2) }}</th>
            </tr>

            <tr>
                <th colspan="4" style="text-align:right;">G. Total:</th>
                @foreach ($allMills as $mill)
                    <th>{{ number_format($grandTotals['mill_' . $mill->id], 2) }}</th>
                @endforeach
                <th>{{ number_format($grandTotals['total_weight'], 2) }}</th>
            </tr>
        </tfoot>
    </table>

</body>

</html>
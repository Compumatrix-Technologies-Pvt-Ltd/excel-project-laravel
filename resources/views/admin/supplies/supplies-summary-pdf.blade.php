<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
            border: 1px solid black;
        }

        h2,
        h4 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <h2>{{ $company_Name }}</h2>

    <h4>
        FFB Supplies Summary For Supplier =[{{ $supplierName }}] From [ {{ $startDate }} ] To [ {{ $endDate }} ]
    </h4>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Supplier</th>
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
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['supplier_id'] }}</td>
                    @php $totalWeight = 0; @endphp
                    @foreach ($allMills as $mill)
                        @php
                            $weight = $transaction['mill_' . $mill->id] ?? 0;
                            $totalWeight += $weight;
                        @endphp
                        <td>{{ number_format($weight, 2) }}</td>
                    @endforeach
                    <td>{{ number_format($totalWeight, 2) }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
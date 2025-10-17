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
        FFB Supplies By [ {{ $type }} ] For The Year [ {{ $year }} ]
    </h4>
    <table>
        <thead>
            <tr>
                <th>{{ $type === 'supplier' ? 'Supplier' : 'Mill' }}</th>
                <th>Jan</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>May</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Aug</th>
                <th>Sep</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dec</th>
                <th>Total (M/Ton)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row['supplier'] }}</td>
                    <td>{{ $row['month_1'] }}</td>
                    <td>{{ $row['month_2'] }}</td>
                    <td>{{ $row['month_3'] }}</td>
                    <td>{{ $row['month_4'] }}</td>
                    <td>{{ $row['month_5'] }}</td>
                    <td>{{ $row['month_6'] }}</td>
                    <td>{{ $row['month_7'] }}</td>
                    <td>{{ $row['month_8'] }}</td>
                    <td>{{ $row['month_9'] }}</td>
                    <td>{{ $row['month_10'] }}</td>
                    <td>{{ $row['month_11'] }}</td>
                    <td>{{ $row['month_12'] }}</td>
                    <td>{{ $row['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Grand Total</th>
                @for ($m = 1; $m <= 12; $m++)
                    <th>{{ $grandTotals['month_' . $m] }}</th>
                @endfor
                <th>{{ $grandTotals['total'] }}</th>
            </tr>
        </tfoot>
    </table>
</body>

</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Credit Purchase Analysis {{ $year }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
            margin: 20px;
        }
        h3, h4 { text-align: center; margin: 4px 0; }
        table { width: 100%; border-collapse: collapse; page-break-inside: auto; }
        th, td { border: 1px solid #000; padding: 4px 6px; text-align: right; }
        th:first-child, td:first-child { text-align: left; width: 230px; }
        thead { background: #f0f0f0; }
        tfoot td { font-weight: bold; background: #f9f9f9; }
        .footer { text-align: center; font-size: 10px; margin-top: 10px; }
        .page-break { page-break-after: always; }
        .header-title { text-align: center; font-size: 12px; font-weight: bold; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="header-title">{{ $companyName }}</div>
    <h3>Credit Purchase Analysis by Supplier in {{ $unit }} for [ {{ $year }} ]</h3>
    <h4>For {{ $mspo_certification }} MSPO License Supplier</h4>

    <table>
        <thead>
            <tr>
                <th>Supplier ID & Name</th>
                @php
                    $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                @endphp
                @foreach ($months as $m)
                    <th>{{ $m }}</th>
                @endforeach
                <th>Total ({{ $unit }})</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records['data'] as $row)
                <tr>
                    <td>{{ $row['sID'] }} - {{ $row['supplier_name'] }}</td>
                    @foreach ($months as $m)
                        <td>{{ $row[$m] ?? '0.00' }}</td>
                    @endforeach
                    <td>{{ $row['total'] ?? '0.00' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td><strong>Total</strong></td>
                @foreach (array_slice($records['footerTotals'], 1) as $v)
                    <td>{{ $v }}</td>
                @endforeach
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        {{ $companyName }}<br>
        Credit Purchase Analysis by Supplier in {{ $unit }} for [ {{ $year }} ]<br>
        for {{ $mspo_certification }} MSPO License Supplier<br>
        Generated on {{ date('d-M-Y h:i A') }}
    </div>
</body>
</html>

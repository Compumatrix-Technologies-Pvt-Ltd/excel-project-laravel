<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Purchase Analysis (Credit vs Cash in M/Ton) - {{ $year }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }
        h2, h3, h4 {
            margin: 0;
            padding: 0;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: right;
        }
        th:first-child, td:first-child {
            text-align: left;
        }
        tfoot td {
            font-weight: bold;
            background: #f0f0f0;
        }
        .summary {
            margin-top: 30px;
        }
        .chart-placeholder {
            border: 1px dashed #ccc;
            height: 200px;
            text-align: center;
            line-height: 200px;
            color: #777;
            margin-top: 20px;
        }
        .company-name {
            text-align: right;
            font-size: 11px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="company-name">Company: {{ $company_name ?? 'Main Tree Company' }}</div>
    <h2>Purchase Analysis (Credit vs Cash in M/Ton)</h2>
    <h4>For [ {{ $year }} ]</h4>

    <table>
        <thead>
            <tr>
                <th>Purchases</th>
                <th>Credit</th>
                <th>Cash</th>
                <th>Total (M/Ton)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records['monthly'] as $row)
                <tr>
                    <td>{{ $row['month'] }}</td>
                    <td>{{ number_format($row['credit'], 2) }}</td>
                    <td>{{ number_format($row['cash'], 2) }}</td>
                    <td>{{ number_format($row['total'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td>{{ number_format($records['summary']['credit'], 2) }}</td>
                <td>{{ number_format($records['summary']['cash'], 2) }}</td>
                <td>{{ number_format($records['summary']['total'], 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        <h4>Summary</h4>
        <p>Credit Share: {{ round(($records['summary']['credit'] / max($records['summary']['total'], 1)) * 100, 1) }}%</p>
        <p>Cash Share: {{ round(($records['summary']['cash'] / max($records['summary']['total'], 1)) * 100, 1) }}%</p>
    </div>

    {{-- Optional: Chart image placeholders --}}
    @if(!empty($chart1))
        <img src="{{ $chart1 }}" style="width:100%; margin-top:20px;">
    @else
        <div class="chart-placeholder">[ {{ date('M Y') }} Purchases Pie Chart ]</div>
    @endif

    @if(!empty($chart2))
        <img src="{{ $chart2 }}" style="width:100%; margin-top:20px;">
    @else
        <div class="chart-placeholder">[ Jan–Dec {{ $year }} Purchases Pie Chart ]</div>
    @endif


    <div style="text-align:center;margin-top:40px;font-size:11px;">
        Generated on {{ date('d-M-Y h:i A') }}
    </div>
</body>
</html>

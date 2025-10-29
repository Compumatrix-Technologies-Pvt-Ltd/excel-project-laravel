<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Branch Credit Purchase Analysis {{ $year }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #000; margin: 20px; }
        h3, h4 { text-align: center; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: right; }
        th:first-child, td:first-child { text-align: left; }
        th:nth-child(2), td:nth-child(2) { text-align: left; }
        thead { background: #f0f0f0; }
        tfoot td { font-weight: bold; background: #f9f9f9; }
    </style>
</head>
<body>
    <h3>{{ $company_name }}</h3>
    <h4>Credit Purchase Analysis by Supplier for Branch: {{ $branch->name }} ({{ $year }})</h4>

    <table>
        <thead>
            <tr>
                <th>Supplier Name</th>
                @php
                    $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                @endphp
                @foreach ($months as $m)
                    <th>{{ $m }}</th>
                @endforeach
                <th>Total (M/Ton)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $s)
                <tr>
                    <td>{{ $s['supplier_name'] }}</td>
                    @foreach (range(1,12) as $m)
                        <td>{{ $s["month_{$m}"] ?? '0.00' }}</td>
                    @endforeach
                    <td>{{ $s['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
        @if(!empty($footer))
        <tfoot>
            <tr>
                <td colspan="1"><strong>Total</strong></td>
                @foreach (range(1,12) as $m)
                    <td>{{ $footer["month_{$m}"] }}</td>
                @endforeach
                <td>{{ $footer['total'] }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div style="text-align:center;margin-top:25px;font-size:10px;">
        Generated on {{ date('d-M-Y h:i A') }}
    </div>
</body>
</html>

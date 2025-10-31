<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Via Bank Deduction PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background: #f2f2f2; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h3 style="text-align:center;">{{ $company->company_name ?? 'Company Name' }}</h3>
    <h4 style="text-align:center;">Via Bank Deduction Report - Period: {{ $period }}</h4>

    <table>
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Payment Type</th>
                <th>Account No</th>
                <th>BIC</th>
                <th>Full Name</th>
                <th>ID No</th>
                <th>Amount</th>
                <th>Reference</th>
                <th>Email 1</th>
                <th>Email 2</th>
                <th>Bene Email 1</th>
                <th>Bene Email 2</th>
                <th>Bene Mobile 1</th>
                <th>Bene Mobile 2</th>
                <th>Joint Bene Name</th>
                <th>Joint Bene ID</th>
                <th>E-mail Content Line 1</th>
                <th>E-mail Content Line 2</th>
                <th>E-mail Content Line 3</th>
                <th>E-mail Content Line 4</th>
                <th>E-mail Content Line 5</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $i => $r)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ ucfirst($r->supplier->bankDetails->pay_type ?? '-') }}</td>
                    <td>{{ $r->supplier->bank_acc_no ?? '-' }}</td>
                    <td>{{ $r->supplier->bankDetails->bic_code ?? '-' }}</td>
                    <td>{{ $r->supplier->supplier_name ?? '-' }}</td>
                    <td>{{ $r->supplier->supplier_id ?? '-' }}</td>
                    <td class="text-right">{{ number_format($r->net_pay, 2) }}</td>
                    <td>{{ 'FFB Final - ' . $r->period }}</td>
                    <td>{{ $r->supplier->email ?? '-' }}</td>
                    <td>{{  '-' }}</td>
                    <th>{{ '-' }}</th>
                    <th>{{ '-' }}</th>
                    <td>{{ $r->supplier->telphone_1 ?? '-' }}</td>
                    <td>{{ $r->supplier->telphone_2 ?? '-' }}</td>
                    <td>{{ '-' }}</td>
                    <td>{{ '-' }}</td>
                    <td>{{ '-' }}</td>
                    <td>{{ '-' }}</td>
                    <td>{{ '-' }}</td>
                    <td>{{ '-' }}</td>
                    <td>{{ '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

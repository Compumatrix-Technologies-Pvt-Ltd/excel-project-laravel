<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment List PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #000; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #eee; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .header { margin-bottom: 15px; }
        .footer { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header text-center">
        <h3>VC MAJUMAS SDN BHD</h3>
        <p><strong>Payment List for the Month of [ {{ substr($monthPeriod, -2) }}/{{ substr($monthPeriod, 0, 4) }} ]<br>
        for Pay Method = [ {{ strtoupper($method) }} ]</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Inv. No.</th>
                <th>Id.</th>
                <th>Supplier Name</th>
                <th>Invoice Date</th>
                <th class="text-end">Amount Paid (RM)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $p)
                <tr>
                    <td>{{ $p->invoice_no }}</td>
                    <td>{{ $p->supplier->supplier_id ?? '-' }}</td>
                    <td>{{ $p->supplier->supplier_name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->bill_date)->format('d-M-Y') }}</td>
                    <td class="text-end">{{ number_format($p->net_pay, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-end fw-bold">Total</td>
                <td class="text-end fw-bold">{{ number_format($grandTotal, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer text-center">
        <p>Page 1 of 1</p>
    </div>
</body>
</html>

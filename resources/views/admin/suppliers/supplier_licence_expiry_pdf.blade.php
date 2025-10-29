<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Supplier Licence Expiry</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #000; margin: 20px; }
        h3, h4 { text-align: center; margin: 4px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        thead { background: #f0f0f0; }
        tfoot td { font-weight: bold; }
    </style>
</head>
<body>
    <h3>{{ $company_name }}</h3>
    <h4>Supplier Licence Expiry Report ({{ $expiryType }} Expired on/before {{ \Carbon\Carbon::parse($expiryDate)->format('d-M-Y') }})</h4>

    <table>
      <thead>
            <tr>
                <th rowspan="2">Supplier Id</th>
                <th rowspan="2">Supplier Name</th>
                <th colspan="2">MPOB</th>
                <th colspan="2">MSPO</th>
            </tr>
            <tr>
                <th>Licence No.</th>
                <th>Expiry Date</th>
                <th>Certificate No.</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->supplier_id }}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->mpob_lic_no ?? '-' }}</td>
                    <td>{{ date('d-M-Y', strtotime($supplier->mpob_exp_date)) ?? '-' }}</td>
                    <td>{{ $supplier->mspo_cert_no ?? '-' }}</td>
                    <td>{{ date('d-M-Y', strtotime($supplier->mspo_exp_date)) ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;">No records found.</td></tr>
            @endforelse
        </tbody>

    </table>
</body>
</html>

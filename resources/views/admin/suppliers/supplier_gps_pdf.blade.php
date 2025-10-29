<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Supplier GPS Coordinates</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #000; margin: 20px; }
        h3, h4 { text-align: center; margin: 4px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th:first-child, td:first-child { text-align: left; }
        thead { background: #f0f0f0; }
    </style>
</head>
<body>
    <h3>{{ $company_name }}</h3>
    <h4>Supplier GPS Coordinates Report</h4>

    <table>
         <thead>
            <tr>
                <th rowspan="2">Supplier Id</th>
                <th rowspan="2">Supplier Name</th>
                <th colspan="1">MPOB</th>
                <th colspan="1">MSOP</th>
                <th rowspan="2">Land Size (Ha)</th>
                <th colspan="2" style="text-align: center;">GPS Coordinates </th>
            </tr>
            <tr>
                <th>Licence No.</th>
                <th>Certificate No.</th>
                <th>Latitude(°)</th>
                <th>Longitude(°)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->supplier_id }}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->mpob_lic_no ?? '-' }}</td>
                    <td>{{ $supplier->mspo_cert_no ?? '-' }}</td>
                    <td>{{ number_format($supplier->land_size ?? 0, 2) ?? '-' }}</td>
                    <td>{{ $supplier->latitude ?? '-' }}</td>
                    <td>{{ $supplier->longitude ?? '-' }}</td>

                </tr>
            @empty
                <tr><td colspan="8" style="text-align:center;">No records found.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

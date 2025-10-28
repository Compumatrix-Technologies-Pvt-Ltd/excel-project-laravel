<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Supplier Cash Bill - {{ $invoice->invoice_no }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .header-table td {
            vertical-align: top;
        }
        .company-info {
            font-size: 10px;
            line-height: 1.1;
            padding-left: 10px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin: 15px 0;
            letter-spacing: 0.05em;
        }
        .details-table {
            width: 100%;
            font-size: 11px;
            margin-bottom: 15px;
        }
        .details-label {
            white-space: nowrap;
            text-align: right;
            padding-right: 5px;
            vertical-align: top;
            width: 150px;
            font-weight: bold;
        }
        .details-dotted {
            border-bottom: 1px dotted #000;
            width: 100%;
            padding-left: 5px;
            vertical-align: top;
        }
        .details-row {
            padding-bottom: 3px;
        }
        .cashbill-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .cashbill-table th,
        .cashbill-table td {
            border: 1px solid #000;
            padding: 4px 6px;
        }
        .cashbill-table th {
            font-weight: bold;
            font-size: 12px;
            text-align: center;
            letter-spacing: 0.1em;
        }
        .cashbill-table td {
            vertical-align: middle;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .no-border-top {
            border-top: none;
        }
        .amount-row td {
            font-weight: bold;
        }
        .amount-label {
            text-align: right;
            padding-right: 10px;
        }
        .amount-value {
            text-align: right;
            padding-right: 6px;
        }
        .words {
            text-align: center;
            margin: 10px 0 15px 0;
            font-style: italic;
            font-size: 11px;
        }
        .signature-table {
            width: 100%;
            margin-top: 30px;
            font-size: 11px;
        }
        .signature-table td {
            border: 1px solid #000;
            height: 70px;
            padding: 5px 10px;
            vertical-align: bottom;
        }
        .signature-label {
            font-size: 11px;
            font-weight: normal;
            text-align: center;
            padding-top: 3px;
        }
        .logo-img {
            max-height: 80px;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td style="width:120px;">
                <img src="{{ asset('/assets/admin/images/c_logo.png') }}" class="logo-img" alt="LKS Logo">
            </td>
            <td class="company-info">
                <strong>VC MAJUMAS SDN BHD</strong><br>
                Company No.: 201301008844(1038686-V)<br>
                NT No. 093021053, Kampung Berjaya 1, Batu 4,<br>
                Bukit Garam, 90200 Kinabatangan, Sabah.<br>
                Tel: 017-4769299 Fax: 089-227299<br>
                eMail: vc@lkscom.my<br>
                MPOB License No.: 588961-115000<br>
                TIN: C 23803909090
            </td>
        </tr>
    </table>

    <div class="title">SUPPLIER CASH BILL</div>

    <table class="details-table">
        <tr class="details-row">
            <td class="details-label">Supplier:</td>
            <td class="details-dotted">
                {{ $invoice->supplier->supplier_name ?? 'N/A' }} ({{ $invoice->supplier->supplier_id ?? '-' }})<br>
                {{ $invoice->supplier->address1 ?? '' }}<br>
                {{ $invoice->supplier->address2 ?? '' }}
            </td>
            <td class="details-label">Cash Bill No.:</td>
            <td class="details-dotted">{{ $invoice->invoice_no }}</td>
        </tr>
        <tr class="details-row">
            <td class="details-label">&nbsp;</td>
            <td class="details-dotted">{{ $invoice->supplier->mpob_lic_no ?? '-' }}</td>
            <td class="details-label">Date:</td>
            <td class="details-dotted">{{ date('d-M-Y', strtotime($invoice->bill_date)) }}</td>
        </tr>
        <tr class="details-row">
            <td class="details-label">MPOB License No.:</td>
            <td class="details-dotted">{{ $invoice->supplier->mpob_lic_no ?? '-' }}</td>
            <td class="details-label">Expired On:</td>
            <td class="details-dotted">{{ $invoice->supplier->mpob_exp_date ? date('d-M-Y', strtotime($invoice->supplier->mpob_exp_date)) : 'N/A' }}</td>
        </tr>
        <tr class="details-row">
            <td class="details-label">MSPO Certification No.:</td>
            <td class="details-dotted">{{ $invoice->supplier->mspo_cert_no ?? '-' }}</td>
            <td class="details-label">Expired On:</td>
            <td class="details-dotted">{{ $invoice->supplier->mspo_exp_date ? date('d-M-Y', strtotime($invoice->supplier->mspo_exp_date)) : 'N/A' }}</td>
        </tr>
        <tr class="details-row">
            <td class="details-label">TIN:</td>
            <td class="details-dotted">{{ $invoice->supplier->tin ?? '-' }}</td>
            <td class="details-label">&nbsp;</td>
            <td class="details-dotted">&nbsp;</td>
        </tr>
    </table>

    <table class="cashbill-table">
        <thead>
            <tr>
                <th>Particulars</th>
                <th class="text-center">Net Weight (M Ton)</th>
                <th class="text-center">Price/MT (RM)</th>
                <th class="text-right">Amount (RM)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>FFB Ticket No. {{ $invoice->ticket_no ?? 'N/A' }}</td>
                <td class="text-center">{{ number_format($invoice->weight_mt, 2) }}</td>
                <td class="text-center">{{ number_format($invoice->price, 2) }}</td>
                <td class="text-right">{{ number_format($invoice->weight_mt * $invoice->price, 2) }}</td>
            </tr>
            <tr>
                <td class="text-right" colspan="2">Subsidy:</td>
                <td class="text-center">{{ number_format($invoice->subsidy_amt, 2) }}</td>
                <td class="text-right">0.00</td>
            </tr>
            <tr>

                <td class="text-right" colspan="2">Total Amount Payable:</td>
                <td class="text-center">RM </td>
                <td class="text-right">{{ number_format(($invoice->weight_mt * $invoice->price) - $invoice->subsidy_amt, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="words">
        Ringgit Malaysia {{ App\Helpers\Helper::convertNumberToWords(($invoice->weight_mt * $invoice->price) - $invoice->subsidy_amt) }} Only
    </div>

    <table class="signature-table">
        <tr>
            <td>
                Paid by<br><br>
                <img src="{{ public_path('assets/admin/images/signature.png') }}" alt="Signature" style="max-height: 40px;"><br>
                for VC MAJUMAS SDN BHD
            </td>
            <td>Received By</td>
            <td>Authorised Signature</td>
        </tr>
    </table>

</body>
</html>

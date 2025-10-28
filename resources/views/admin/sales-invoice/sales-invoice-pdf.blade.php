<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{ $moduleAction ?? 'Sales Invoice' }}</title>
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #000; margin: 20px; }
    table { width: 100%; border-collapse: collapse; }
    .table-bordered td, .table-bordered th { border: 1px solid #000; padding: 4px 6px; }
    .text-end { text-align: right; }
    .fw-semibold { font-weight: 600; }
    .fw-bold { font-weight: 700; }
    .small { font-size: 11px; }
    .border-bottom { border-bottom: 1px solid #000; }
    .mt-2 { margin-top: 8px; }
    .mt-3 { margin-top: 12px; }
    .ps-3 { padding-left: 12px; }
    .text-center { text-align: center; }
    .mb-1 { margin-bottom: 4px; }
    .border { border: 1px solid #000; }
    .p-3 { padding: 8px; }
    .container { width: 100%; }
    .page-break { page-break-after: always; }
</style>
</head>
<body>
<div class="container">

    {{-- Company Header --}}
    <table style="margin-bottom: 10px;">
        <tr>
            <td style="width: 25%; text-align:center;">
                <img src="{{ public_path('assets/admin/images/c_logo.png') }}" alt="Logo" style="max-height:80px;">
            </td>
            <td style="width: 75%;">
                <strong>VC MAJUMAS SDN BHD</strong><br>
                Company No.: 201301008844(1038686-V)<br>
                NT No.: 093021053, Kampung Berjaya 1, Batu 4,<br>
                Bukit Garam, 90200 Kinabatangan, Sabah.<br>
                Tel: 017-4769299 &nbsp; Fax: 089-227299<br>
                Email: vc@lkscom.my<br>
                MPOB License No.: 588961-115000<br>
                TIN: C 23803909090
            </td>
        </tr>
    </table>

    <h4 class="text-center" style="margin: 6px 0;"><strong>SUPPLIER INVOICE</strong></h4>

    {{-- Supplier + Invoice Info --}}
    <table style="margin-bottom: 10px;">
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <strong>Supplier:</strong><br>
                {{ $invoice->supplier->supplier_name ?? 'N/A' }} ({{ $invoice->supplier->supplier_id ?? '-' }})<br>
                {{ $invoice->supplier->address1 ?? '' }} {{ $invoice->supplier->address2 ?? '' }}<br><br>
                MPOB License No.: {{ $invoice->supplier->mpob_lic_no ?? '-' }}
                &nbsp; Expired On: {{ \Carbon\Carbon::parse($invoice->supplier->mpob_exp_date)->format('d-M-Y') ?? '-' }}<br>
                MSPO Certification No.: {{ $invoice->supplier->mspo_cert_no ?? '-' }}
                &nbsp; Expired On: {{ \Carbon\Carbon::parse($invoice->supplier->mspo_exp_date)->format('d-M-Y') ?? '-' }}<br>
                TIN: {{ $invoice->supplier->tin ?? '-' }}
            </td>
            <td style="width: 40%; vertical-align: top;">
                <table>
                    <tr><td style="width: 55%;">Invoice No.</td><td>{{ $invoice->invoice_no ?? '-' }}</td></tr>
                    <tr><td>Date</td><td>{{ \Carbon\Carbon::parse($invoice->bill_date)->format('d-M-Y') }}</td></tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- Line Items --}}
    <table class="table-bordered">
        <thead>
            <tr>
                <th style="width:40px;">No.</th>
                <th>Descriptions</th>
                <th style="width:150px;" class="text-end">Amount (RM)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>
                    FFB Supply For The Month Of {{ $invoice->period ?? '-' }} —
                    {{ number_format($invoice->weight_mt, 2) }} MT × RM{{ number_format($invoice->price, 2) }}
                </td>
                <td class="text-end">{{ number_format($invoice->gross_amount ?? $invoice->net_pay, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td>- Incentive</td>
                <td class="text-end">{{ number_format($invoice->incentive_rate ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td>- Less: Subsidy</td>
                <td class="text-end">{{ number_format($invoice->subsidy_amt ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td><strong>Amount Before Deductions:</strong></td>
                <td class="text-end fw-semibold">{{ number_format($invoice->amt_before_ded ?? $invoice->net_pay, 2) }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td><strong>Deductions:</strong>
                    @if($invoice->transport > 0)
                        <div class="ps-3 d-flex justify-content-between">
                            <span>Transport</span>
                            <span class="text-end">{{ number_format($invoice->transport, 2) }}</span>
                        </div>
                    @endif
                    @if($invoice->advance > 0)
                        <div class="ps-3 d-flex justify-content-between">
                            <span>Advance</span>
                            <span class="text-end">{{ number_format($invoice->advance, 2) }}</span>
                        </div>
                    @endif
                    @if($invoice->others > 0)
                        <div class="ps-3 d-flex justify-content-between">
                            <span>Others</span>
                            <span class="text-end">{{ number_format($invoice->others, 2) }}</span>
                        </div>
                    @endif
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><strong>Total Deductions:</strong></td>
                <td class="text-end fw-semibold">{{ number_format($invoice->total_deductions, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td><strong>Total Amount Payable:</strong></td>
                <td class="text-end fw-bold">RM {{ number_format($invoice->net_pay, 2) }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Remarks + Amount in Words --}}
    <div style="margin-top: 10px;">
        <div><strong>Remark:</strong> {{ $invoice->remark ?? '' }}</div>
        <div style="margin-top: 5px; font-style: italic;">
            Ringgit Malaysia {{ App\Helpers\Helper::convertNumberToWords($invoice->net_pay) }}
        </div>
    </div>

    {{-- Footer --}}
    <table style="margin-top: 30px;">
        <tr>
            <td style="width:33%; text-align:center;">
                <div class="border p-3" style="min-height:80px;">
                    <div><strong>Paid By</strong></div>
                    <div style="margin-top: 20px;">for VC MAJUMAS SDN BHD</div>
                </div>
            </td>
            <td style="width:33%; text-align:center;">
                <div class="border p-3" style="min-height:80px;">
                    <div><strong>Received By</strong></div>
                </div>
            </td>
            <td style="width:33%; text-align:center;">
                <div class="border p-3" style="min-height:80px;">
                    <div><strong>Authorised Signature</strong></div>
                </div>
            </td>
        </tr>
    </table>

</div>
</body>
</html>

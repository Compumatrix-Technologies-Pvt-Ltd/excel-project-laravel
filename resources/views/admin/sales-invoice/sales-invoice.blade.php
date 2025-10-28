@extends('layouts.admin.master')

@section('title', $moduleAction)

@section('toolbar')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
            <h4 class="mb-sm-0">Sales Invoice</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Sales Invoice Management</a></li>
                    <li class="breadcrumb-item active">Sales Invoice Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">{{ $moduleAction }}</h4>
                <div>
                    {{-- <button class="btn btn-outline-secondary btn-sm">Preview</button> --}}
                    <button class="btn btn-secondary btn-sm">Create PDF</button>
                </div>
            </div>

            <div class="card-body">
                <div class="container-fluid invoice-sheet p-3">

                    {{-- Company Header --}}
                    <div class="row align-items-start g-2 border-bottom pb-2">
                        <div class="col-3 col-md-2 text-center">
                            <img src="{{ asset('/assets/admin/images/c_logo.png') }}" alt="Logo" class="img-fluid" style="max-height:80px">
                        </div>
                        <div class="col-9 col-md-6">
                            <h5 class="mb-1">VC MAJUMAS SDN BHD</h5>
                            <div class="small">
                                Company No: 201301008844(1038686-V)<br>
                                NT No: 093021053, Kampung Berjaya 1, Batu 4,<br>
                                Bukit Garam, 90200 Kinabatangan, Sabah.<br>
                                Tel: 017-4769299 | Fax: 089-227299<br>
                                Email: vc@lkscom.my<br>
                                MPOB License No.: 588961-115000<br>
                                TIN: C 23803909090
                            </div>
                        </div>
                    </div>

                    {{-- Title --}}
                    <div class="row">
                        <div class="col-12 text-center py-2">
                            <strong>SUPPLIER INVOICE</strong>
                        </div>
                    </div>

                    {{-- Supplier + Invoice Meta --}}
                    <div class="row g-2 border-bottom pb-2">
                        <div class="col-md-7">
                            <div class="small"><em>Supplier:</em></div>
                            <div class="small">{{ $invoice->supplier->supplier_name ?? 'N/A' }} ({{ $invoice->supplier->supplier_id ?? '-' }})</div>
                            <div class="small">{{ $invoice->supplier->address1 ?? '' }}</div>
                            <div class="small">{{ $invoice->supplier->address2 ?? '' }}</div>
                            <div class="small">MPOB License No.: {{ $invoice->supplier->mpob_lic_no ?? '-' }}</div>
                            <div class="small">MPOB Certificate No.: {{ $invoice->supplier->mspo_cert_no ?? '-' }}</div>
                            <div class="small">TIN.: {{ $invoice->supplier->tin ?? '-' }}</div>
                        </div>

                        <div class="col-md-5">
                            <div class="row small g-1">
                                <div class="col-6 text-muted">Invoice No.</div>
                                <div class="col-6">{{ $invoice->invoice_no ?? 'N/A' }}</div>

                                <div class="col-6 text-muted">Date</div>
                                <div class="col-6">{{ \Carbon\Carbon::parse($invoice->bill_date)->format('d-M-Y') }}</div>

                                <div class="col-6 text-muted"></div>
                                <div class="col-6"></div>

                                <div class="col-6 text-muted">License Expired On</div>
                                <div class="col-6">{{ Carbon\Carbon::parse($invoice->supplier->mpob_exp_date)->format('d-M-Y') }}</div>

                                <div class="col-6 text-muted">Certificate Expired On</div>
                                <div class="col-6">{{ Carbon\Carbon::parse($invoice->supplier->mspo_exp_date)->format('d-M-Y') }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Line Items --}}
                    <div class="row mt-2">
                        <div class="col-12">
                            <table class="table table-sm table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:50px;">No.</th>
                                        <th>Descriptions</th>
                                        <th style="width:160px;" class="text-end">Amount (RM)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            FFB Supply for {{ $invoice->period ?? '-' }} — 
                                            {{ number_format($invoice->weight_mt, 2) }} MT × RM{{ number_format($invoice->price, 2) }}
                                        </td>
                                        <td class="text-end">{{ number_format($invoice->net_pay, 2) }}</td>
                                    </tr>
                                    <tr class="table-active">
                                        <td></td>
                                        <td class="fw-semibold">- Incentive:</td>
                                        <td class="text-end fw-semibold">{{ number_format($invoice->incentive_rate, 2) }}</td>
                                    </tr>
                                    <tr class="table-active">
                                        <td></td>
                                        <td class="fw-semibold">- Less: Subsidy:</td>
                                        <td class="text-end fw-semibold">{{ number_format($invoice->subsidy_amt, 2) }}</td>
                                    </tr>

                                    <tr class="table-active">
                                        <td></td>
                                        <td class="fw-semibold">Amount Before Deductions:</td>
                                        <td class="text-end fw-semibold">{{ number_format($invoice->amt_before_ded, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div class="fw-semibold">Deductions:</div>
                                            @if($invoice->transport > 0)
                                                <div class="ps-3 d-flex justify-content-between">
                                                    <span>Transport</span>
                                                    <span style="min-width:120px;" class="text-end">{{ number_format($invoice->transport, 2) }}</span>
                                                </div>
                                            @endif
                                            @if($invoice->advance > 0)
                                                <div class="ps-3 d-flex justify-content-between">
                                                    <span>Advance</span>
                                                    <span style="min-width:120px;" class="text-end">{{ number_format($invoice->advance, 2) }}</span>
                                                </div>
                                            @endif
                                            @if($invoice->others > 0)
                                                <div class="ps-3 d-flex justify-content-between">
                                                    <span>Others</span>
                                                    <span style="min-width:120px;" class="text-end">{{ number_format($invoice->others, 2) }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr class="table-active">
                                        <td></td>
                                        <td class="fw-semibold">Total Deductions:</td>
                                        <td class="text-end fw-semibold">{{ number_format($invoice->total_deductions, 2) }}</td>
                                    </tr>

                                    <tr class="table-active">
                                        <td></td>
                                        <td class="fw-bold">Total Amount Payable:</td>
                                        <td class="text-end fw-bold">
                                            RM {{ number_format($invoice->net_pay, 2) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Amount in Words --}}
                    <div class="row">
                        <div class="col-12 small fst-italic py-2 border-bottom">
                            Ringgit Malaysia {{ App\Helpers\Helper::convertNumberToWords($invoice->net_pay) }} Only
                        </div>
                    </div>

                    {{-- Remarks --}}
                    <div class="row mt-2">
                        <div class="col-12">
                            <label class="small text-muted">Remark:</label>
                            <textarea class="form-control form-control-sm" rows="2">{{ $invoice->remark ?? '' }}</textarea>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="border p-3" style="min-height:120px;">
                                <div class="small fw-semibold">Paid By</div>
                                <div class="mt-4 small">for VC MAJUMAS SDN BHD</div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <div class="border p-3" style="min-height:120px;">
                                <div class="small fw-semibold">Received By</div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <div class="border p-3" style="min-height:120px;">
                                <div class="small fw-semibold">Authorised Signature</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const invoiceId = "{{ $invoice->id ?? 0 }}";

        // Preview in new tab
        document.querySelector('.btn-outline-secondary').addEventListener('click', function() {
            window.open(`${ADMINURL}/sales-invoice/${invoiceId}/preview`, '_blank');
        });

        // Download PDF
        document.querySelector('.btn-secondary').addEventListener('click', function() {
            window.location.href = `${ADMINURL}/sales-invoice/${invoiceId}/pdf`;
        });
    });
</script>
@endsection

@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Supplier Cash Bill</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Supplier Cash Bill</a></li>
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
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">SCB</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid p-3">

                        <!-- Header: logo + company identity + top buttons -->
                        <div class="row g-2 align-items-start border-bottom pb-2">
                            <div class="col-3 col-md-2 text-center">
                                <img src="{{ asset('/assets/admin/images/c_logo.png') }}" alt="Logo" class="img-fluid"
                                    style="max-height:80px">
                            </div>
                            <div class="col-9 col-md-7">
                                <h5 class="mb-1" id="coName">VC MAJUMAS SDN BHD</h5>
                                <div class="small" id="coLines">
                                    Company No.: <span id="coReg">201301008844(1038686‑V)</span><br>
                                    NT No: <span id="coNT">093021053</span>, Kampung Berjaya 1, Batu 4, Bukit Garam,
                                    90200 Kinabatangan, Sabah.<br>
                                    Tel: <span id="coTel">017‑4769299</span> &nbsp; Fax: <span
                                        id="coFax">089‑227299</span><br>
                                    eMail: <span id="coEmail">vc@lkscom.my</span><br>
                                    MPOB License No.: <span id="coMpob">588961‑115000</span><br>
                                    TIN: <span id="coTin">C 23803909090</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 d-flex justify-content-md-end align-items-start gap-2">
                                <button type="button"  data-bs-toggle="modal" data-bs-target="#branchModal" class="btn btn-outline-secondary btn-sm">Preview</button>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#printCashBillModal">By SCB No.</button>
                                </div>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="row">
                            <div class="col-12 text-center py-2">
                                <strong>SUPPLIER CASH BILL</strong>
                            </div>
                        </div>


                        <!-- Supplier + Cash Bill meta + record panel -->
                        <div class="row g-2">
                            <div class="col-md-7">
                                <div class="small"><em>Supplier:</em></div>
                                <div class="small">{{ $invoice->supplier->supplier_name ?? 'N/A' }} ({{ $invoice->supplier->supplier_id ?? '-' }})</div>
                                <div class="small">{{ $invoice->supplier->address1 ?? '' }}</div>
                                <div class="small">{{ $invoice->supplier->address2 ?? '' }}</div>

                                <div class="row small g-1 mt-1">
                                    <div class="col-6 text-muted">MPOB Licence No.</div>
                                    <div class="col-6" id="supMpob"> {{ $invoice->supplier->mpob_lic_no ?? '-' }}</div>
                                    <div class="col-6 text-muted">MSPO Certification #</div>
                                    <div class="col-6" id="supMspo">{{ $invoice->supplier->mspo_cert_no ?? '-' }}</div>
                                    <div class="col-6 text-muted">TIN</div>
                                    <div class="col-6" id="supTin">{{ $invoice->supplier->tin ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="row small g-1">
                                    <div class="col-6 text-muted">Cash Bill No.</div>
                                    <div class="col-6" id="cbNo">{{ $invoice->invoice_no ?? 'N/A' }}</div>

                                    <div class="col-6 text-muted">Date</div>
                                    <div class="col-6" id="cbDate">{{ $invoice->bill_date ? date('d-M-Y', strtotime($invoice->bill_date)) : 'N/A' }}</div>

                                    <div class="col-6 text-muted">Expired On (MPOB)</div>
                                    <div class="col-6" id="mpobExp">{{ $invoice->supplier->mpob_exp_date ? date('d-M-Y', strtotime($invoice->supplier->mpob_exp_date)) : 'N/A' }}</div>

                                    <div class="col-6 text-muted">Expired On (MSPO)</div>
                                    <div class="col-6" id="mspoExp">{{ $invoice->supplier->mspo_exp_date ? date('d-M-Y', strtotime($invoice->supplier->mspo_exp_date)) : 'N/A' }}</div>
                                </div>

                                <!-- Record panel -->
                                {{-- <div class="border mt-2 p-2 small">
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="microCash">
                                        <label class="form-check-label" for="microCash">Micro Cash Bill?</label>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Starting Record:</span><span id="startRec">1</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Ending Record:</span><span id="endRec">1</span>
                                    </div>
                                    <div class="mt-1 text-muted">Record 1 of 122</div>
                                </div> --}}
                            </div>
                        </div>

                        <!-- Particulars table: ticket → weight × price → amount, subsidy, total -->
                      <div id="cashBillDetailsContainer">
                            <div class="row mt-2">
                                <div class="col-12">
                                    <table class="table table-sm table-bordered align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:60%;">Particulars</th>
                                                <th style="width:15%;" class="text-center">Net Weight (M/Ton)</th>
                                                <th style="width:15%;" class="text-center">Price/MT (RM)</th>
                                                <th style="width:10%;" class="text-end">Amount (RM)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cbBody">
                                            <!-- Ticket line -->
                                            <tr>
                                                <td>{{ $invoice->particulars }}</td>
                                                <td class="text-center" id="netWeight">{{ number_format($invoice->weight_mt, 2) }}</td>
                                                <td class="text-center" id="priceMt">{{ number_format($invoice->price, 2) }}</td>
                                                <td class="text-end" id="amount">{{ number_format($invoice->weight_mt * $invoice->price, 2) }}</td>
                                            </tr>

                                            <!-- Subsidy line -->
                                            <tr>
                                                <td></td> <!-- empty first column -->
                                                <td class="text-end pe-3 fw-semibold">Subsidy:</td> <!-- label here, right aligned -->
                                                <td class="text-center">—</td>
                                                <td class="text-end" id="subsidy">{{ number_format($invoice->subsidy_amt, 2) }}</td>
                                            </tr>

                                            <!-- Total payable -->
                                            <tr class="table-active">
                                                <td></td> <!-- empty first column -->
                                                <td class="text-end fw-bold">Total Amount Payable:</td> <!-- label here -->
                                                <td class="text-center">RM</td>
                                                <td class="text-end fw-bold" id="totalPay">{{ number_format(($invoice->weight_mt * $invoice->price) - $invoice->subsidy_amt, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Amount in words -->
                            <div class="row">
                                <div class="col-12 small fst-italic py-2 border-bottom">
                                    Ringgit Malaysia <span id="amtWords">{{ App\Helpers\Helper::convertNumberToWords(($invoice->weight_mt * $invoice->price) - $invoice->subsidy_amt) }} Only</span>
                                </div>
                            </div>

                            <!-- Remark -->
                            <div class="row mt-2">
                                <div class="col-12">
                                    <label class="small text-muted">Remark:</label>
                                    <textarea class="form-control form-control-sm" rows="2" id="remark">{{ $invoice->remark }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Footer: Paid/Received/Signature blocks -->
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="border p-3" style="min-height:120px;">
                                    <div class="small fw-semibold">Paid by</div>
                                    <div class="mt-4 small">for VC MAJUMAS SDN BHD</div>
                                    <!-- place stamp image here -->
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
        
            <!-- Modal -->
            <div id="printCashBillModal" class="modal fade" tabindex="-1" aria-labelledby="printCashBillLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="printCashBillLabel">Supplier Cash Bill Print Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form id="printCashBillForm" action="javascript:void(0);">
                            <div class="modal-body">
                                <div class="row g-3">

                                    <!-- Cash Bill selector -->
                                    <div class="col-12">
                                        <label class="form-label">Supplier Cash Bill:</label>
                                        <div class="input-group">
                                            <select class="form-select" id="cbSelect">
                                                <option value="">Select…</option>
                                                @foreach ($otherInvoices as $invoice)
                                                    <option>{{ $invoice }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           <div id="branchModal" class="modal fade" tabindex="-1" aria-labelledby="bankEditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bankEditModalLabel">View PDF</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="height: 80vh;">
                        <iframe id="pdfIframe" src="" width="100%" height="100%" style="border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('#cbSelect').on('change', function() {
            let invoiceNo = $(this).val();
            if (invoiceNo === '') return;

            $.ajax({
                url: ADMINURL+`/supplier/cash-bill/details/${invoiceNo}`,
                type: 'GET',
                beforeSend: function() {
                    $('#cbBody').html('<tr><td colspan="4" class="text-center text-muted">Loading...</td></tr>');
                },
                success: function(response) {
                    if (response.success) {
                        // Insert the HTML into your display section
                        $('#cashBillDetailsContainer').html(response.html);
                        $('#cbDate').html(response.cbDate);
                        $('#cbNo').html(response.cbNo);
                    } else {
                        alert('Could not load invoice details.');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Error loading invoice details.');
                }
            });
        });
    });

    </script>
    <script>
    $(document).ready(function () {
        // When clicking the "Preview" button
        $('.btn[data-bs-target="#branchModal"]').on('click', function () {
            let invoiceNo = $('#cbNo').text().trim(); // read current invoice number

            if (!invoiceNo || invoiceNo === 'N/A') {
                alert('No invoice selected to preview.');
                return;
            }

            // Construct PDF URL
            let pdfUrl = `${ADMINURL}/supplier/cash-bill/pdf/${invoiceNo}`;

            // Update iframe source
            $('#pdfIframe').attr('src', pdfUrl);
        });
    });
    </script>

@endsection

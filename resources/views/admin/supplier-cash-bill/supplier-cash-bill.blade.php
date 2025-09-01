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
                                <div class="small" id="supLine">Mohd Wan Hafiz Bin Rahman (K/P: 941210‑12‑5763)
                                    (VC‑B‑M063)</div>
                                <div class="small" id="supAddr1">W.D.T 23 Pekan Kota Kinabatangan</div>
                                <div class="small" id="supAddr2">90200 Kota Kinabatangan, Sabah.</div>

                                <div class="row small g-1 mt-1">
                                    <div class="col-6 text-muted">MPOB Licence No.</div>
                                    <div class="col-6" id="supMpob">549749601000</div>
                                    <div class="col-6 text-muted">MSPO Certification #</div>
                                    <div class="col-6" id="supMspo">04 300 92 082</div>
                                    <div class="col-6 text-muted">TIN</div>
                                    <div class="col-6" id="supTin">-</div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="row small g-1">
                                    <div class="col-6 text-muted">Cash Bill No.</div>
                                    <div class="col-6" id="cbNo">VCCB2505001</div>

                                    <div class="col-6 text-muted">Date</div>
                                    <div class="col-6" id="cbDate">02‑May‑2025</div>

                                    <div class="col-6 text-muted">Expired On (MPOB)</div>
                                    <div class="col-6" id="mpobExp">31‑Jul‑2025</div>

                                    <div class="col-6 text-muted">Expired On (MSPO)</div>
                                    <div class="col-6" id="mspoExp">04‑Jan‑2022</div>
                                </div>

                                <!-- Record panel -->
                                <div class="border mt-2 p-2 small">
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
                                </div>
                            </div>
                        </div>

                        <!-- Particulars table: ticket → weight × price → amount, subsidy, total -->
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-sm table-bordered align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width:60%;">Particulars</th>
                                            <th style="width:20%;" class="text-center">Net Weight (M/Ton)</th>
                                            <th style="width:20%;" class="text-center">Price/MT (RM)</th>
                                            <th style="width:20%;" class="text-end">Amount (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cbBody">
                                        <!-- Ticket line -->
                                        <tr>
                                            <td>FFB Ticket No. <span id="tktNo">089316</span></td>
                                            <td class="text-center" id="netWeight">0.20</td>
                                            <td class="text-center" id="priceMt">700.00</td>
                                            <td class="text-end" id="amount">140.00</td>
                                        </tr>

                                        <!-- Subsidy line -->
                                        <tr>
                                            <td class="text-end pe-3">Subsidy:</td>
                                            <td class="text-center">—</td>
                                            <td class="text-center">—</td>
                                            <td class="text-end" id="subsidy">0.00</td>
                                        </tr>

                                        <!-- Total payable -->
                                        <tr class="table-active">
                                            <td class="fw-semibold text-end">Total Amount Payable:</td>
                                            <td class="text-center">—</td>
                                            <td class="text-center">RM</td>
                                            <td class="text-end fw-bold"><span id="totalPay">140.00</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Amount in words -->
                        <div class="row">
                            <div class="col-12 small fst-italic py-2 border-bottom">
                                Ringgit Malaysia <span id="amtWords">One Hundred Forty And Cents Zero Only</span>
                            </div>
                        </div>

                        <!-- Remark -->
                        <div class="row mt-2">
                            <div class="col-12">
                                <label class="small text-muted">Remark:</label>
                                <textarea class="form-control form-control-sm" rows="2" id="remark"></textarea>
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
            <!-- Trigger -->
            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#printCashBillModal">
                Print Cash Bill
            </button>

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
                                                <option>VCCB2505001</option>
                                                <option>VCCB2505002</option>
                                                <option>VCCB2505003</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Copies group (looks like Excel's 'Copies' frame) -->
                                    <div class="col-12">
                                        <fieldset class="border rounded p-2">
                                            <legend class="float-none w-auto px-2 small mb-0">Copies</legend>
                                            <label for="copiesInput" class="form-label mb-1 small">No. of copies:</label>
                                            <input type="number" class="form-control form-control-sm" id="copiesInput"
                                                value="1" min="1" step="1" style="max-width: 120px;">
                                        </fieldset>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#branchModal">Ok</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div id="branchModal" class="modal fade" tabindex="-1" aria-labelledby="bankEditModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bankEditModalLabel">View PDF</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="height: 80vh;">
                            <iframe
                                src="{{ asset('storage/app/public/scb/SUPPLIER_CASH_bILL.pdf') }}"
                                width="100%" height="100%" style="border: none;"></iframe>
                            <!-- OR -->
                            <!-- <embed src="assets/docs/sample.pdf" type="application/pdf" width="100%" height="100%"> -->
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
            $('#SupplierListing').DataTable({
                paging: true,
                searching: true,
                ordering: true

            });
        });
    </script>
@endsection

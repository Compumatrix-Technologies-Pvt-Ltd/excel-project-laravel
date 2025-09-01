@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Sales Invoice </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Sales Invoice Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Sales Invoice
                                Listing</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Sales Invoice</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid invoice-sheet p-3">

                        <!-- Company header with logo and identity -->
                        <div class="row align-items-start g-2 border-bottom pb-2">
                            <div class="col-3 col-md-2 text-center">
                                <img src="{{ asset('/assets/admin/images/c_logo.png') }}" alt="Logo" class="img-fluid" style="max-height:80px">
                            </div>
                            <div class="col-9 col-md-6">
                                <h5 class="mb-1" id="coName">VC MAJUMAS SDN BHD</h5>
                                <div class="small" id="coLines">
                                    Company No: <span id="coReg">201301008844(1038686‑V)</span><br>
                                    NT No: <span id="coNT">093021053</span>, Kampung Berjaya 1, Batu 4,<br>
                                    Bukit Garam, 90200 Kinabatangan, Sabah.<br>
                                    Tel: <span id="coTel">017‑4769299</span> &nbsp; Fax: <span
                                        id="coFax">089‑227299</span><br>
                                    email: <span id="coEmail">vc@lkscom.my</span><br>
                                    MPOB License No.: <span id="coMpob">588961‑115000</span><br>
                                    TIN: <span id="coTin">C 23803909090</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 d-flex justify-content-md-end align-items-start gap-2">
                                <button class="btn btn-outline-secondary btn-sm">Preview</button>
                                <button class="btn btn-secondary btn-sm">Create PDF</button>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="row">
                            <div class="col-12 text-center py-2">
                                <strong>SUPPLIER INVOICE</strong>
                            </div>
                        </div>

                        <!-- Supplier + Invoice meta -->
                        <div class="row g-2 border-bottom pb-2">
                            <div class="col-md-7">
                                <div class="small"><em>Supplier:</em></div>
                                <div class="small" id="supLine1">Aliasa Bin Ismail (K/P: 541005‑12‑5155) (VC‑A‑A081)</div>
                                <div class="small" id="supAddr1">Kampung Usaha Jaya W.D.T.404, Bukit Garam</div>
                                <div class="small" id="supAddr2">90200 Kinabatangan Sabah</div>
                                <div class="small">MPOB License No.: <span id="supMpob">596861801000</span></div>
                                <div class="small">MSPO Certification No.: <span id="supMspo">04 300 92 082</span></div>
                                <div class="small">TIN: <span id="supTin">-</span></div>
                            </div>
                            <div class="col-md-5">
                                <div class="row small g-1">
                                    <div class="col-6 text-muted">Invoice No.</div>
                                    <div class="col-6" id="invNo">VCSI2504033</div>

                                    <div class="col-6 text-muted">Date</div>
                                    <div class="col-6" id="invDate">30‑Apr‑2025</div>

                                    <div class="col-6 text-muted">Expired On (MPOB)</div>
                                    <div class="col-6" id="mpobExp">31‑Dec‑2027</div>

                                    <div class="col-6 text-muted">Expired On (MSPO)</div>
                                    <div class="col-6" id="mspoExp">04‑Jan‑2022</div>

                                    <div class="col-6 text-muted">Starting Record</div>
                                    <div class="col-6" id="startRec">33</div>

                                    <div class="col-6 text-muted">Ending Record</div>
                                    <div class="col-6" id="endRec">33</div>
                                </div>
                            </div>
                        </div>

                        <!-- Line items grid (Descriptions vs Amount) -->
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
                                    <tbody id="invBody">
                                        <!-- Row 1: FFB Supply -->
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div>FFB Supply For The Month Of <span id="periodLbl">05/2025</span> —
                                                    <span id="qty">2.28</span> MT × RM<span
                                                        id="price">834.00</span>
                                                </div>
                                                <div class="ps-3">‑ Incentive <span class="text-muted">(RM)</span></div>
                                                <div class="ps-3">‑ Less: Subsidy <span class="text-muted">(RM)</span>
                                                </div>
                                            </td>
                                            <td class="text-end" id="amountBefore">1,901.52</td>
                                        </tr>

                                        <!-- Amount Before Deductions separator row -->
                                        <tr class="table-active">
                                            <td></td>
                                            <td class="fw-semibold">Amount Before Deductions:</td>
                                            <td class="text-end fw-semibold" id="amtBeforeDed">1,901.52</td>
                                        </tr>

                                        <!-- Row 2: Deductions -->
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <div class="fw-semibold">Deductions:</div>
                                                <div class="ps-3 d-flex justify-content-between">
                                                    <span>Advance</span>
                                                    <span class="text-end" style="min-width:120px;"
                                                        id="dedAdvance">1,250.00</span>
                                                </div>
                                            </td>
                                            <td class="text-end"> </td>
                                        </tr>

                                        <!-- Totals rows -->
                                        <tr class="table-active">
                                            <td></td>
                                            <td class="fw-semibold">Total Deductions:</td>
                                            <td class="text-end fw-semibold" id="totalDed">1,250.00</td>
                                        </tr>
                                        <tr class="table-active">
                                            <td></td>
                                            <td class="fw-bold">Total Amount Payable:</td>
                                            <td class="text-end fw-bold">
                                                RM <span id="netPay">651.52</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Amount in words -->
                        <div class="row">
                            <div class="col-12 small fst-italic py-2 border-bottom">
                                Ringgit Malaysia <span id="amtWords">Six Hundred Fifty One And Cents Fifty Two Only</span>
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="row mt-2">
                            <div class="col-12">
                                <label class="small text-muted">Remark:</label>
                                <textarea class="form-control form-control-sm" rows="2" id="remark"></textarea>
                            </div>
                        </div>

                        <!-- Footer: Paid/Received/Signature -->
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="border p-3" style="min-height:120px;">
                                    <div class="small fw-semibold">Paid By</div>
                                    <div class="mt-4 small">for VC MAJUMAS SDN BHD</div>
                                    <!-- stamp image can be placed here -->
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
        <!--end col-->
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
            $('#UsersTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection

@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Main Module</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Main Module</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.create') }}">Main Form</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Masters Form</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid mt-3">

                        <!-- Search controls row -->
                        <div class="row align-items-center gy-2">
                            <div class="col-lg-6 d-flex flex-wrap align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="supplierDetails" id="byTicket"
                                        checked>
                                    <label class="form-check-label" for="byTicket">By Ticket No.</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="supplierDetails" id="bySupName">
                                    <label class="form-check-label" for="bySupName">By Supplier Name</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="supplierDetails" id="bySupId">
                                    <label class="form-check-label" for="bySupId">By Supplier Id</label>
                                </div>

                                <div class="input-group input-group-sm ms-2" style="max-width: 320px;">
                                    <input class="form-control" id="searchInput" placeholder="T02014127" />
                                    <button class="btn btn-outline-secondary"><i class="ri-arrow-down-s-line"></i></button>
                                </div>

                                <div class="btn-group btn-group-sm ms-2">
                                    <button class="btn btn-outline-secondary">&laquo;</button>
                                    <button class="btn btn-outline-secondary">&lt; Previous</button>
                                    <button class="btn btn-outline-secondary">Next &gt;</button>
                                    <button class="btn btn-outline-secondary">&raquo;</button>
                                </div>
                            </div>

                            <div class="col-lg-6 d-flex align-items-center justify-content-lg-end gap-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 small text-muted">Branch Code</span>
                                    <span class="badge bg-dark-subtle text-dark-emphasis px-3 py-2">HQ</span>
                                </div>
                                <button class="btn btn-outline-secondary btn-sm"><i class="ri-refresh-line"></i></button>
                            </div>
                        </div>

                        <!-- Main two-column content -->
                        <div class="row mt-3">
                            <!-- Left: ticket snapshot -->
                            <div class="col-xl-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row g-2 align-items-center">
                                            <div class="col-4 text-muted">Ticket No.</div>
                                            <div class="col-8"><strong id="tktNo">T02014127</strong></div>

                                            <div class="col-4 text-muted">Trx. Date</div>
                                            <div class="col-8" id="tktDate">10‑Oct‑2024</div>

                                            <div class="col-4 text-muted">Vehicle</div>
                                            <div class="col-8" id="vehicle">QAB8330G</div>

                                            <div class="col-4 text-muted">Mill Id.</div>
                                            <div class="col-8 d-flex gap-3">
                                                <span id="millId">KSBA</span>
                                                <span id="millName" class="text-muted">FGV Trading Sdn Bhd</span>
                                            </div>

                                            <div class="col-4 text-muted">Weight (MT)</div>
                                            <div class="col-8" id="weight">17.43</div>

                                            <div class="col-12 mt-2">
                                                <!-- placeholder image area to mimic Excel truck photo -->
                                                <div class="ratio ratio-16x9 border bg-light-subtle">
                                                    <img id="ticketPhoto"
                                                        src="{{ asset('/assets/admin/images/palm-oil.jpg') }}" alt=""
                                                        class="img-fluid" onerror="this.style.display='none'">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action bar (left side group) -->
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            <a href="{{route('admin.suppliersHq.index')}}"
                                                class="btn btn-secondary btn-sm">Add Supplier</a>
                                            <a href="{{route('admin.suppliersHq.index')}}"
                                                class="btn btn-secondary btn-sm">Edit Supplier</a>
                                            <a href="{{ route('admin.transaction.management') }}"
                                                class="btn btn-secondary btn-sm">Add Trx</a>
                                            <a href="{{ route('admin.transaction.management') }}"
                                                class="btn btn-secondary btn-sm">Edit Trx</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: supplier identity panel -->
                            <div class="col-xl-6 mt-3 mt-xl-0">
                                <div class="card h-100">
                                    <div class="card-header py-2">
                                        <strong id="tenantName">LKS COMMODITIES SDN BHD</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-4 text-muted">Supplier Id.</div>
                                            <div class="col-8" id="supId">Segama Maju</div>

                                            <div class="col-4 text-muted">Supplier Name</div>
                                            <div class="col-8" id="supName">Segama Maju Sawit Sdn Bhd 202101009811
                                                (1410110‑V)</div>

                                            <div class="col-4 text-muted">Address</div>
                                            <div class="col-8" id="supAddr">
                                                Room 448, 4th Floor, West Wing, Wisma Sabah, Jalan Tun Razak, 88000 Kota
                                                Kinabalu, Sabah.
                                            </div>

                                            <div class="col-4 text-muted">eMail</div>
                                            <div class="col-8" id="supEmail">segamasawitsdnbhd@gmail.com</div>

                                            <div class="col-4 text-muted">Tel. No. 1</div>
                                            <div class="col-8" id="tel1">0128370803</div>

                                            <div class="col-4 text-muted">Tel. No. 2</div>
                                            <div class="col-8" id="tel2">01110151992</div>

                                            <div class="col-4 text-muted">Bank Id.</div>
                                            <div class="col-8" id="bankId">BPT</div>

                                            <div class="col-4 text-muted">Bank A/C No.</div>
                                            <div class="col-8" id="bankNo">1007601000012737</div>
                                        </div>

                                        <!-- Right side action bar -->
                                        <div class="d-flex flex-wrap gap-2 mt-3 justify-content-start">
                                            <button class="btn btn-secondary btn-sm">Reports</button>
                                            <button class="btn btn-secondary btn-sm">Penjualan</button>
                                            <button class="btn btn-secondary btn-sm">Merge</button>
                                        </div>
                                    </div>
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
    <script>
        $(document).ready(function () {
            $('input[name=="supplierDetails"]').on('change', function () {

            });
        });
    </script>
@endsection
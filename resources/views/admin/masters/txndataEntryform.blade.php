@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Master Module</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Master Module</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.create') }}">Masters Form</a></li>
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
                        <!-- Search & Header Row -->
                        <div class="row align-items-center gy-2">
                            <div class="col-md-8 d-flex flex-wrap align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="byInv" checked>
                                    <label class="form-check-label" for="byInv">By Supp. Inv / Cash Bill</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="byId">
                                    <label class="form-check-label" for="byId">By Supplier Id</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="byName">
                                    <label class="form-check-label" for="byName">By Supplier Name</label>
                                </div>

                                <!-- Nav arrows mimic Excel Previous/Next -->
                                <div class="btn-group ms-2">
                                    <button class="btn btn-outline-secondary btn-sm">&laquo;</button>
                                    <button class="btn btn-outline-secondary btn-sm">&lt; Previous</button>
                                    <button class="btn btn-outline-secondary btn-sm">Next &gt;</button>
                                    <button class="btn btn-outline-secondary btn-sm">&raquo;</button>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex gap-2">
                                <select class="form-select form-select-sm" id="searchSelect">
                                    <option selected>VCCB2505001</option>
                                </select>
                                <button class="btn btn-outline-secondary btn-sm"><i class="ri-refresh-line"></i></button>
                            </div>
                        </div>

                        <!-- Branch/Period row + FFB Master button -->
                        <div class="row mt-3 gy-2">
                            <div class="col-6 col-lg-3">
                                <label class="form-label mb-0 small">Branch Code</label>
                                <input type="text" class="form-control form-control-sm" id="branchCode" value="VC">
                            </div>
                            <div class="col-6 col-lg-3">
                                <label class="form-label mb-0 small">Period</label>
                                <input type="month" class="form-control form-control-sm" id="period">
                            </div>
                            <div class="col-12 col-lg-3">
                                <button class="btn btn-outline-secondary btn-sm mt-4" type="button">FFB Master</button>
                            </div>
                            <div class="col-12 col-lg-3 text-lg-end">
                                <div class="badge bg-light text-dark mt-4 fs-6" id="periodBadge">202505</div>
                            </div>
                        </div>

                        <!-- Main two-column Excel-like layout -->
                        <div class="row mt-3">
                            <!-- LEFT: Supplier Master block -->
                            <div class="col-lg-7">
                                <div class="card">
                                    <div class="card-header py-2">
                                        <strong>Supplier</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label small">Supplier Id</label>
                                                <input type="text" class="form-control form-control-sm" id="supId"
                                                    value="VC-B-M063">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Supp. Inv. No / CB No.</label>
                                                <input type="text" class="form-control form-control-sm" id="docNo"
                                                    value="VCCB2505001">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label small">Supplier Name</label>
                                                <input type="text" class="form-control form-control-sm" id="supName"
                                                    value="MOHD WAN HAFIZ BIN RAHMAN (K/P: 941210-12-5763)">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label small">Address</label>
                                                <textarea class="form-control form-control-sm" rows="2" id="address">W.D.T 23  PEKAN KOTA KINABATANGAN
90200 KINABATANGAN  SABAH.</textarea>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">MPOB Licence No.</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    value="549749601000">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Expiry Date</label>
                                                <input type="date" class="form-control form-control-sm"
                                                    value="2025-07-31">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">MSPO Cert. No.</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    value="04 300 92 082">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Expiry Date</label>
                                                <input type="date" class="form-control form-control-sm"
                                                    value="2022-01-04">
                                            </div>

                                            <div class="col-4">
                                                <label class="form-label small">Land Size (Ha)</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Latitude (°)</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Longitude (°)</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-4">
                                                <label class="form-label small">Email</label>
                                                <input type="email" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Tel No. 1</label>
                                                <input type="tel" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Tel No. 2</label>
                                                <input type="tel" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Bank Id</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Bank A/C No.</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label small">Supplier Remark</label>
                                                <textarea class="form-control form-control-sm" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT: Calculation stack block (matches Excel right column) -->
                            <div class="col-lg-5 mt-3 mt-lg-0">
                                <div class="card">
                                    <div class="card-header py-2">
                                        <strong>Invoice / Cash Bill</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-7">
                                                <label class="form-label small">Invoice Date</label>
                                                <input type="date" class="form-control form-control-sm"
                                                    value="2025-05-02">
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label small">Weight (M/Ton)</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.20">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Price</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="700.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Incentive Rate</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Subsidy</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Amt. Before Ded.</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="140.00">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Debit Bal B/F</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>

                                            <!-- Deduction lines aligned like Excel -->
                                            <div class="col-12">
                                                <hr class="my-1">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Transport</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Advance</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Others</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Total Deduction</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>

                                            <div class="col-12">
                                                <hr class="my-1">
                                            </div>
                                            <div class="col-7">
                                                <label class="form-label small">Net Pay (RM)</label>
                                                <input type="number" step="0.01"
                                                    class="form-control form-control-sm fw-bold" value="140.00">
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label small">Date Paid</label>
                                                <input type="date" class="form-control form-control-sm"
                                                    value="2025-05-02">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Paid By</label>
                                                <select class="form-select form-select-sm">
                                                    <option>Cash</option>
                                                    <option>Bank</option>
                                                    <option>Cheque</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Debit Bal C/F</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label small">Invoice Remark</label>
                                                <textarea class="form-control form-control-sm" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button strip aligned like Excel -->
                                <div class="d-flex flex-wrap gap-2 justify-content-between mt-2">
                                    <div class="btn-group">
                                        <a href="{{route('admin.transactions.index')}}" class="btn btn-secondary btn-sm">Add Trx</a>
                                        <a href="{{route('admin.transactions.index')}}" class="btn btn-secondary btn-sm">Edit Trx</a>
                                        <a href="{{route('admin.transactions.index')}}" class="btn btn-secondary btn-sm">Trx Details</a>
                                        <a href="{{route('admin.deductions.index')}}" class="btn btn-secondary btn-sm">Add Deduction</a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-secondary btn-sm">Reports</a>
                                        <a href="" class="btn btn-secondary btn-sm">Pembelian</a>
                                        <a href="" class="btn btn-secondary btn-sm" disabled>Merge</a>
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

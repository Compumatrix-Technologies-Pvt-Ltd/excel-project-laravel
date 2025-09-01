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
                    <div class="container-fluid mt-4">
                        <div class="row gy-4">

                            <div class="row mb-4">
                                <div class="col-md-8 d-flex align-items-center gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" id="radio1" checked>
                                        <label class="form-check-label" for="radio1">By Supplier. Inv/ Cash Bill</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" id="radio2">
                                        <label class="form-check-label" for="radio2">By Supplier Id</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" id="radio3">
                                        <label class="form-check-label" for="radio3">By Supplier Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select">
                                        <option selected>VC-A-001</option>
                                        <option>VC-A-002</option>
                                        <option>VC-A-003</option>

                                    </select>
                                </div>
                            </div>

                            <form>
                                <div class="row g-3">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <label class="form-label">Branch Code</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Period</label>
                                        <input type="month" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Supplier Id</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Supplier Name</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-control" rows="2"></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">MPOB Licence No.</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">MSPO Cert. No.</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputlandSize" class="form-label">Land Size(Ha)</label>
                                        <input type="text" class="form-control" id="inputlandSize">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputLatitude" class="form-label">Latitude</label>
                                        <input type="text" class="form-control" id="inputLatitude">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="inputLongitude" class="form-label">Longitude</label>
                                        <input type="text" class="form-control" id="inputLongitude">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputEmail" class="form-label">Email<span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="inputEmail">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputTel1" class="form-label">Telphone 1<span
                                                class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="inputTel1">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputTel2" class="form-label">Telephone 2</label>
                                        <input type="tel" class="form-control" id="inputTel2">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Bank ID</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Bank A/C No.</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Supp. Inv. No / CB No.</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Invoice Date</label>
                                        <input type="date" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Weight (M/Ton)</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Price</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Incentive Rate</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Subsidy</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Amt. Before Ded.</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Debit Bal B/F</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Transport</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Advance</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Others</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Total Deduction</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Net Pay</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Date Paid</label>
                                        <input type="date" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Paid By</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Debit Bal C/F</label>
                                        <input type="number" step="0.01" class="form-control">
                                    </div>


                                    <div class="col-md-6">
                                        <label class="form-label">Supplier Remark</label>
                                        <textarea class="form-control" rows="2"></textarea>
                                    </div>


                                    <div class="col-md-6">
                                        <label class="form-label">Invoice Remark</label>
                                        <textarea class="form-control" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-secondary btn-sm">Add Trx</button>
                                    <button type="button" class="btn btn-secondary btn-sm">Edit Trx</button>
                                    <button type="button" class="btn btn-secondary btn-sm">Trx Details</button>
                                    <button type="button" class="btn btn-secondary btn-sm">Add Deduction</button>
                                    <button type="button" class="btn btn-secondary btn-sm">Reports</button>
                                    <button type="button" class="btn btn-secondary btn-sm">Pembelian</button>
                                    <button type="button" class="btn btn-secondary btn-sm" disabled>Merge</button>
                                </div>
                            </form>



                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection
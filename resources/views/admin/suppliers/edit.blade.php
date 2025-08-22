@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Supplier Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Supplier Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.suppliers.create') }}">Edit Supplier</a>
                        </li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Supplier</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row gy-4">
                            <form action="javascript:void(0);" class="row g-3">
                                <div class="col-md-6">
                                    <label for="suplierType" class="form-label">Supplier Type</label>
                                    <select id="suplierType" class="form-select">
                                        <option selected>Credit</option>
                                        <option>Credit</option>
                                        <option>Cash User</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="supplierCodeInput" class="form-label">
                                        Supplier Code <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="prefixInput">A</span>
                                        <input type="text" class="form-control" id="supplierCodeInput"
                                            aria-label="Supplier Code" aria-describedby="prefixInput" value="VC-A-001">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="supplierNameInput" class="form-label">Supplier Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="supplierNameInput" value="Green Palm Suppliers">
                                </div>
                                <div class="col-6">
                                    <label for="inputStatus" class="form-label">Status</label>
                                    <select id="inputStatus" class="form-select">
                                        <option selected>Active</option>
                                        <option>Active</option>
                                        <option>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="supplierAddress1" class="form-label">Address 1<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="supplierAddress1" rows="3">123, Dummy Street, Green Park</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="supplierAddress2" class="form-label">Address 2</label>
                                    <textarea class="form-control" id="supplierAddress2" rows="3">Near City Mall, Sample Town, 400001</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="inputMPOB" class="form-label">MPOB License No</label>
                                    <input type="text" class="form-control" id="inputMPOB" value="MPOB-1001	">
                                </div>

                                <div class="col-md-6">
                                    <label for="MPOBExpiryDate" class="form-label">MPOB Expiry Date</label>
                                    <input type="date" class="form-control" id="MPOBExpiryDate" value="2025-12-31">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputMSOPCertficate" class="form-label">MSPO Cert. No</label>
                                    <input type="text" class="form-control" id="inputMSOPCertficate" value="MSPO-5001">
                                </div>
                                <div class="col-md-6">
                                    <label for="MSPOExpiryDate" class="form-label">MSPO Expiry Date</label>
                                    <input type="date" class="form-control" id="MSPOExpiryDate" value="2026-06-15">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputTIN" class="form-label">TIN</label>
                                    <input type="text" class="form-control" id="inputTIN" value="TIN123456789">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputSupsidy" class="form-label">Subsidy Rate(%)</label>
                                    <input type="text" class="form-control" id="inputSupsidy" value="12.5">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputlandSize" class="form-label">Land Size(Ha)</label>
                                    <input type="text" class="form-control" id="inputlandSize" value="25.5">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputLatitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" id="inputLatitude" value="101.6869">
                                </div>

                                <div class="col-md-4">
                                    <label for="inputLongitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control" id="inputLongitude" value="3.1390">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail" class="form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="inputEmail" value="greenpalm@example.com">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputTel1" class="form-label">Telphone 1<span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="inputTel1" value="+91 9876543210">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputTel2" class="form-label">Telephone 2</label>
                                    <input type="tel" class="form-control" id="inputTel2" value="+91 9123456780">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputBankId" class="form-label">Bank ID</label>
                                    <input type="tel" class="form-control" id="inputBankId" value="BANK123">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputBankAcc" class="form-label">Bank Acc.No</label>
                                    <input type="tel" class="form-control" id="inputBankAcc" value="1234567890123456">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputRemark" class="form-label">Remark</label>
                                    <textarea class="form-control" id="inputRemark" rows="3">This is a dummy remark for testing purposes.</textarea>

                                </div>

                                <div class="col-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
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
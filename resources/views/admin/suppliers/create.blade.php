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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.suppliers.create') }}">Create
                                Supplier</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Create Supplier</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid mt-4">
                        <form id="AddForm" action="{{ route('admin.suppliers.store') }}" method="post" class="form"
                            autocomplete="off" role="form">
                            @csrf

                            <div class="row align-items-center mb-3">
                                @if (Auth::user()->role == 'branch-user')
                                    <div class="col-md-6 d-flex align-items-center form-group">
                                        <label class="me-3">Supplier Type: <span class="text-danger">*</span></label>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="supplier_type" id="creditType"
                                                value="credit" checked>
                                            <label class="form-check-label" for="creditType">Credit</label>
                                        </div>

                                        <div class="form-check form-check-inline ms-3">
                                            <input class="form-check-input" type="radio" name="supplier_type" id="cashType"
                                                value="cash">
                                            <label class="form-check-label" for="cashType">Cash</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex align-items-center">
                                        <label class="me-2">Supplier ID:</label>
                                        <input type="text" name="prefix" class="form-control form-control-sm me-1"
                                            style="width: 60px;" value="" required>
                                        <input type="text" name="type" id="supplierTypeLetter"
                                            class="form-control form-control-sm me-1" style="width: 60px;"
                                            value="" required>
                                        <input type="text" name="sequence" class="form-control form-control-sm"
                                            style="width: 100px;" value="Auto" readonly>
                                    </div>


                                @else
                                    <div class="col-md-6 form-group">
                                        <label for="supplier_id" class="form-label">Supplier Id: <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="supplier_id" id="supplier_id"
                                            class="form-control form-control-sm" required data-error="Please enter Supplier Id">
                                        <span class="help-block with-errors err_supplier_id" style="color:red;"></span>
                                    </div>
                                @endif
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 form-group">
                                    <label for="name" class="form-label">Supplier Name: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="supplier_name" id="supplier_name"
                                        class="form-control form-control-sm" required data-error="Please enter name">
                                    <span class="help-block with-errors err_supplier_name" style="color:red;"></span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="address" class="form-label">Address 1 <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="address1" id="address1" class="form-control form-control-sm"
                                        required data-error="Please enter address">
                                    <span class="help-block with-errors err_address1" style="color:red;"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                @if (Auth::user()->role == 'branch-user')
                                    <div class="col-md-3 form-group">
                                        <label for="mpob_lic_no" class="form-label">MPOB Licence No.: <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="mpob_lic_no" id="mpob_lic_no"
                                            class="form-control form-control-sm" required
                                            data-error="Please enter licence number">
                                        <span class="help-block with-errors err_mpob_lic_no" style="color:red;"></span>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="mpob_exp_date" class="form-label">Expiry Date: <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="mpob_exp_date" id="mpob_exp_date"
                                            class="form-control form-control-sm" required data-error="Please enter Expiry Date">
                                        <span class="help-block with-errors err_mpob_exp_date" style="color:red;"></span>
                                    </div>
                                @endif
                                <div class="col-md-6 form-group">
                                    <label for="address2" class="form-label">Address 2</label>
                                    <input type="text" name="address2" id="address2" class="form-control form-control-sm">
                                </div>
                            </div>
                            @if (Auth::user()->role == 'branch-user')
                                <div class="row mb-3">
                                    <div class="col-md-3 form-group">
                                        <label for="mspo_cert_no" class="form-label">MSPO Cert. No.: <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="mspo_cert_no" id="mspo_cert_no"
                                            class="form-control form-control-sm" required
                                            data-error="Please enter Certificate Number">
                                        <span class="help-block with-errors err_mspo_cert_no" style="color:red;"></span>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="mspo_exp_date" class="form-label">Expiry Date: <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="mspo_exp_date" id="mspo_exp_date"
                                            class="form-control form-control-sm" required data-error="Please enter expiry Date">
                                        <span class="help-block with-errors err_mspo_exp_date" style="color:red;"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 form-group">
                                        <label for="tin" class="form-label">TIN:</label>
                                        <input type="text" name="tin" id="tin" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="subsidy_rate" class="form-label">Subsidy (%):</label>
                                        <input type="number" name="subsidy_rate" id="subsidy_rate"
                                            class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="land_size" class="form-label">Land Size (Ha):</label>
                                        <input type="text" name="land_size" id="land_size" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="latitude" class="form-label">Lat:</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="longitude" class="form-label">Long:</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control form-control-sm">
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-md-4 form-group">
                                    <label for="email" class="form-label">Email: <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm"
                                        required data-error="Please enter Email">
                                    <span class="help-block with-errors err_email" style="color:red;"></span>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="telphone_1" class="form-label">Tel. 1: <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" name="telphone_1" id="telphone_1" class="form-control form-control-sm"
                                        required data-error="Please enter Telephone number">
                                    <span class="help-block with-errors err_telphone_1" style="color:red;"></span>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="telphone_2" class="form-label">Tel. 2:</label>
                                    <input type="tel" name="telphone_2" id="telphone_2"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="bank_id" class="form-label">Bank ID: <span
                                            class="text-danger">*</span></label>
                                    <select name="bank_id" id="bank_id" class="form-select form-select-sm" required
                                        data-error="Please select bank Id">
                                        <option value="">Select</option>
                                        <option value="MBBS">MBBS</option>
                                        <option value="RHB">RHB</option>
                                    </select>
                                    <span class="help-block with-errors err_bank_id" style="color:red;"></span>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="bank_acc_no" class="form-label">Bank A/C No.: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="bank_acc_no" id="bank_acc_no"
                                        class="form-control form-control-sm" required
                                        data-error="Please bank account number">
                                    <span class="help-block with-errors err_bank_acc_no" style="color:red;"></span>
                                </div>
                            </div>

                            @if (Auth::user()->role == 'branch-user')
                                <div class="row mb-3">
                                    <div class="col form-group">
                                        <label for="remark" class="form-label">Remark:</label>
                                        <input type="text" name="remark" id="remark" class="form-control form-control-sm">
                                    </div>
                                </div>
                            @endif
                            <div class="row mb-3">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-success btn-sm">OK</button>
                                    <button type="reset" class="btn btn-outline-secondary btn-sm me-2">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Supplier Type A/B
     function updateType() {
        if ($("#creditType").is(":checked")) {
            $("#supplierTypeLetter").val("A");
        } else if ($("#cashType").is(":checked")) {
            $("#supplierTypeLetter").val("B");
        }
    }

    updateType();

    $("input[name='supplier_type']").on("change", function () {
        updateType();
    });

        });
    </script>
@endsection
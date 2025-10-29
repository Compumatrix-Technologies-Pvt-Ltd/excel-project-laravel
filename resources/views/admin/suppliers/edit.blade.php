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
                </div>
                <div class="card-body">
                    <div class="container-fluid mt-4">
                        <form id="updateForm"
                            action="{{ route('admin.suppliers.update', base64_encode(base64_encode($supplier->id))) }}"
                            method="post" class="form" autocomplete="off" role="form">
                            @csrf
                            @method('PUT')
                            <div class="row align-items-center mb-3">
                                <input type="hidden" id="hidden_id" name="id">
                                <div class="col-md-6 d-flex align-items-center form-group">
                                    @php
                                        $encodedId = request()->query('encodedId');
                                    @endphp
                                    <input type="hidden" name="hidden_user_id" id="hidden_user_id" value="{{ $encodedId }}">
                                    <label class="me-3">Supplier Type: <span class="text-danger">*</span></label>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="supplier_type" id="creditType"
                                            value="credit" {{ old('supplier_type', $supplier->supplier_type) == 'credit' ? 'checked' : '' }} readonly>
                                        <label class="form-check-label" for="creditType">Credit</label>
                                    </div>

                                    <div class="form-check form-check-inline ms-3">
                                        <input class="form-check-input" type="radio" name="supplier_type" id="cashType"
                                            value="cash" {{ old('supplier_type', $supplier->supplier_type) == 'cash' ? 'checked' : '' }} readonly>
                                        <label class="form-check-label" for="cashType">Cash</label>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <label class="me-2">Supplier ID:</label>
                                    <input type="text" name="prefix" class="form-control form-control-sm me-1"
                                        style="width: 60px;" value="{{ old('prefix', $supplier->prefix) }}" required readonly>

                                    <input type="text" name="type" id="supplierTypeLetter"
                                        class="form-control form-control-sm me-1" style="width: 60px;"
                                        value="{{ old('type', $supplier->type) }}" required readonly>

                                    <input type="text" name="sequence" class="form-control form-control-sm"
                                        style="width: 100px;" value="{{ old('sequence', $supplier->sequence) }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="supplier_name" class="form-label">Supplier Name:</label>
                                    <input type="text" name="supplier_name" id="supplier_name"
                                        class="form-control form-control-sm"
                                        value="{{ old('supplier_name', $supplier->supplier_name) }}" required>
                                         <span class="help-block with-errors err_supplier_name" style="color:red;"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="address1" class="form-label">Address 1</label>
                                    <input type="text" name="address1" id="address1" class="form-control form-control-sm"
                                        value="{{ old('address1', $supplier->address1) }}">
                                        <span class="help-block with-errors err_address1" style="color:red;"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="mpob_lic_no" class="form-label">MPOB Licence No.:</label>
                                    <input type="text" name="mpob_lic_no" id="mpob_lic_no"
                                        class="form-control form-control-sm"
                                        value="{{ old('mpob_lic_no', $supplier->mpob_lic_no) }}">
                                        <span class="help-block with-errors err_mpob_lic_no" style="color:red;"></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="mpob_exp_date" class="form-label">Expiry Date:</label>
                                    <input type="date" name="mpob_exp_date" id="mpob_exp_date"
                                        class="form-control form-control-sm"
                                        value="{{ old('mpob_exp_date', $supplier->mpob_exp_date) }}">
                                        <span class="help-block with-errors err_mpob_exp_date" style="color:red;"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="address2" class="form-label">Address 2</label>
                                    <input type="text" name="address2" id="address2" class="form-control form-control-sm"
                                        value="{{ old('address2', $supplier->address2) }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="mspo_cert_no" class="form-label">MSPO Cert. No.:</label>
                                    <input type="text" name="mspo_cert_no" id="mspo_cert_no"
                                        class="form-control form-control-sm"
                                        value="{{ old('mspo_cert_no', $supplier->mspo_cert_no) }}">
                                        <span class="help-block with-errors err_mspo_cert_no" style="color:red;"></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="mspo_exp_date" class="form-label">Expiry Date:</label>
                                    <input type="date" name="mspo_exp_date" id="mspo_exp_date"
                                        class="form-control form-control-sm"
                                        value="{{ old('mspo_exp_date', $supplier->mspo_exp_date) }}">
                                        <span class="help-block with-errors err_mspo_exp_date" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="tin" class="form-label">TIN:</label>
                                    <input type="text" name="tin" id="tin" class="form-control form-control-sm"
                                        value="{{ old('tin', $supplier->tin) }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="subsidy_rate" class="form-label">Subsidy (%):</label>
                                    <input type="number" name="subsidy_rate" id="subsidy_rate" class="form-control form-control-sm"
                                        value="{{ old('subsidy_rate', $supplier->subsidy_rate) }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="land_size" class="form-label">Land Size (Ha):</label>
                                    <input type="text" name="land_size" id="land_size" class="form-control form-control-sm"
                                        value="{{ old('land_size', $supplier->land_size) }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="latitude" class="form-label">Lat:</label>
                                    <input type="text" name="latitude" id="latitude" class="form-control form-control-sm"
                                        value="{{ old('latitude', $supplier->latitude) }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="longitude" class="form-label">Long:</label>
                                    <input type="text" name="longitude" id="longitude" class="form-control form-control-sm"
                                        value="{{ old('longitude', $supplier->longitude) }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm"
                                        value="{{ old('email', $supplier->email) }}">
                                        <span class="help-block with-errors err_email" style="color:red;"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="telphone_1" class="form-label">Tel. 1:</label>
                                    <input type="tel" name="telphone_1" id="telphone_1" class="form-control form-control-sm"
                                        value="{{ old('telphone_1', $supplier->telphone_1) }}">
                                        <span class="help-block with-errors err_telphone_1" style="color:red;"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="telphone_2" class="form-label">Tel. 2:</label>
                                    <input type="tel" name="telphone_2" id="telphone_2" class="form-control form-control-sm"
                                        value="{{ old('telphone_2', $supplier->telphone_2) }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="bank_id" class="form-label">Bank ID:</label>
                                    <select name="bank_id" id="bank_id" class="form-select form-select-sm">
                                        <option value="">Select</option>
                                        <option value="MBBS" {{ old('bank_id', $supplier->bank_id) == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                        <option value="RHB" {{ old('bank_id', $supplier->bank_id) == 'RHB' ? 'selected' : '' }}>RHB</option>
                                    </select>
                                     <span class="help-block with-errors err_bank_id" style="color:red;"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="bank_acc_no" class="form-label">Bank A/C No.:</label>
                                    <input type="text" name="bank_acc_no" id="bank_acc_no"
                                        class="form-control form-control-sm"
                                        value="{{ old('bank_acc_no', $supplier->bank_acc_no) }}">
                                        <span class="help-block with-errors err_bank_acc_no" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="remark" class="form-label">Remark:</label>
                                    <input type="text" name="remark" id="remark" class="form-control form-control-sm"
                                        value="{{ old('remark', $supplier->remark) }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-end">
                                    <a href="{{route('admin.suppliers.index')}}" class="btn btn-outline-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-success">Save</button>

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
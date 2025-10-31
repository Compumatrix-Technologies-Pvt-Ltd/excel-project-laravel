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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.suppliers.index') }}">Supplier
                                Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Supplier Listing</h4>
                    <div class="card-toolbar">
                         <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#supplierModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add Supplier
                        </button>
                        <div id="supplierModal" class="modal fade" tabindex="-1" aria-labelledby="supplierModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="supplierModalLabel">Add New Supplier</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                               <form id="AddForm" action="{{ route('admin.hq-suppliers.store') }}" method="post" class="form row g-3"
                            autocomplete="off" role="form">
                            @csrf
                                                <div class="col-md-6 form-group">
                                                    <label for="supplierCodeInput" class="form-label">
                                                        Supplier Id <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="supplierCodeInput" name="supplier_id" required data-error="Please enter supplier id.">
                                                    <span class="help-block with-errors err_supplier_id" style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="supplierNameInput" class="form-label">Supplier Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="supplierNameInput" name="supplier_name" required data-error="Please enter supplier name.">
                                                    <span class="help-block with-errors err_supplier_name" style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="supplierAddressEdit1" class="form-label">Address 1<span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" name="address1" id="supplierAddressEdit1"
                                                        rows="3" required data-error="Please enter address."></textarea>
                                                    <span class="help-block with-errors err_address1" style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="supplierAddressEdit2" class="form-label">Address 2</label>
                                                    <textarea class="form-control" id="supplierAddressEdit2"
                                                        rows="3" name="address2"></textarea>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="inputEmail" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="inputEmail" name="email" data-error="Please enter a valid email address.">
                                                    <span class="help-block with-errors err_email" style="color:red;"></span>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="inputTel1" class="form-label">Telphone 1</label>
                                                    <input type="tel" class="form-control" id="inputTel1" name="telphone_1">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="inputTel2" class="form-label">Telephone 2</label>
                                                    <input type="tel" class="form-control" id="inputTel2" name="telphone_2">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="inputBankAcc" class="form-label">Bank<span
                                                            class="text-danger">*</span></label>
                                                    <select id="bank_id" name="bank_id" class="form-select bank-select" style="font-family: monospace;" required data-error="Please select bank.">
                                                        <option value="" >
                                                            {{ str_pad('Bank ID', 124) }}{{ str_pad('Bank Name', 422) }}{{ str_pad('BIC Code', 15) }}{{ str_pad('Pay Type', 10) }}
                                                        </option>
                                                        @foreach ($banks as $val)
                                                            <option value="{{ $val->id }}">
                                                                {{ str_pad($val->bank_id, 132) }}
                                                                {{ str_pad($val->name, 322) }}
                                                                {{ str_pad($val->bic_code ?? '-', 15) }}
                                                                {{ str_pad($val->pay_type ?? '-', 10) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block with-errors err_bank_id" style="color:red;"></span>

                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="inputBankAcc" class="form-label">Bank Acc.No<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="inputBankAcc" name="bank_acc_no" required data-error="Please enter bank account number.">
                                                    <span class="help-block with-errors err_bank_acc_no " style="color:red;"></span>
                                                </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success ">Save Changes</button>
                                    </div>
                                    </form>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="HqSupplierListing" class="table nowrap dt-responsive align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR No.</th>
                                        <th>Supplier Id</th>
                                        <th>Supplier Name</th>
                                        <th>Telephone Number</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                         <div id="editSupplierModal" class="modal fade" tabindex="-1"
                                aria-labelledby="editSupplierModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row gy-4">
                                                <form id="updateForm"
                                                    action="{{ route('admin.hq-suppliers.update') }}"
                                                    method="post" class="form row g-3" autocomplete="off" role="form">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-md-6 form-group">
                                                        <label for="supplierCodeInputEdit1" class="form-label">
                                                            Supplier Id <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="supplierCodeInputEdit1" name="supplier_id" required data-error="Please enter supplier id.">
                                                        <input type="hidden" class="form-control" id="hidden_id" name="hidden_id">
                                                        <span class="help-block with-errors err_supplier_id" style="color:red;"></span>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="supplierNameInputEdit1" class="form-label">Supplier Name<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="supplierNameInputEdit1" name="supplier_name" required data-error="Please enter supplier name.">
                                                        <span class="help-block with-errors err_supplier_name" style="color:red;"></span>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="supplierAddressEdit2" class="form-label">Address 1<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="supplierAddressEdit2"
                                                            rows="3" name="address1" required data-error="Please enter address 1."></textarea>
                                                        <span class="help-block with-errors err_address1" style="color:red;"></span>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="supplierAddressEdit2" class="form-label">Address 2</label>
                                                        <textarea class="form-control" id="supplierAddressEdit2"
                                                            rows="3" name="address2"></textarea>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="inputEmailEdit" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="inputEmailEdit" name="email" data-error="Please enter a valid email address.">
                                                        <span class="help-block with-errors err_email" style="color:red;"></span>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="inputTelEdit1" class="form-label">Telphone 1<span
                                                                class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" id="inputTelEdit1" name="telphone_1" required data-error="Please enter telephone 1.">
                                                        <span class="help-block with-errors err_telphone_1" style="color:red;"></span>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="inputTelEdit2" class="form-label">Telephone 2</label>
                                                        <input type="tel" class="form-control" id="inputTelEdit2" name="telphone_2">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="inputBankAccEdit" class="form-label">Bank<span
                                                                class="text-danger">*</span></label>
                                                       <select id="bank_id2" name="bank_id" class="form-select bank-select" style="font-family: monospace;" required data-error="Please select bank.">
                                                        <option value="" >
                                                            {{ str_pad('Bank ID', 124) }}{{ str_pad('Bank Name', 422) }}{{ str_pad('BIC Code', 15) }}{{ str_pad('Pay Type', 10) }}
                                                        </option>
                                                        @foreach ($banks as $val)
                                                            <option value="{{ $val->id }}">
                                                                {{ str_pad($val->bank_id, 132) }}
                                                                {{ str_pad($val->name, 322) }}
                                                                {{ str_pad($val->bic_code ?? '-', 15) }}
                                                                {{ str_pad($val->pay_type ?? '-', 10) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block with-errors err_bank_id" style="color:red;"></span>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="inputBankAccEdit" class="form-label">Bank Acc.No<span
                                                                class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" id="inputBankAccEdit" name="bank_acc_no" required data-error="Please enter bank account number.">
                                                        <span class="help-block with-errors err_bank_acc_no" style="color:red;"></span>
                                                    </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="submitBtn" class="btn btn-success ">Save Changes</button>
                                        </div>
                                        </form>

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>
@endsection
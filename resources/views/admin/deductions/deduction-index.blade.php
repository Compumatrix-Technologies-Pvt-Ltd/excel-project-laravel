@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Deductions</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Deductions</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.deductions.index') }}">Deduction
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
                <div class="card-header align-items-center d-flex justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">Deduction Listing</h4>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#deductionModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add Deduction
                        </button>
                        <div id="deductionModal" class="modal fade" tabindex="-1" aria-labelledby="deductionModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deductionModalLabel">Add Deduction</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="AddForm" action="{{ route('admin.deductions.store') }}" method="post"
                                        class="form row g-3" autocomplete="off" role="form">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row gy-4">
                                                <div class="col-md-6 form-group">
                                                    <label for="deductionDate" class="form-label">Date<span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="date" id="deductionDate"
                                                        required data-error="Please select date">
                                                    <span class="help-block with-errors err_date" style="color:red;"></span>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="periodInput" class="form-label">Period<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="period" id="periodInput"
                                                        required readonly>
                                                    <span class="help-block with-errors err_period"
                                                        style="color:red;"></span>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="inputSupplier" class="form-label">Suppliers<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputSupplier" name="supplier_id" class="form-select"
                                                        required data-error="Please select supplier">
                                                        <option selected>Select Supplier Id</option>
                                                        @foreach ($Suppliers as $supplier )
                                                        <option value="{{ $supplier->id }}">
                                                        {{ $supplier->supplier_id }}</option>
                                                        @endforeach                                      
                                                    </select>

                                                    <span class="help-block with-errors err_supplier_id"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="typeInput" class="form-label">Type<span
                                                            class="text-danger">*</span></label>
                                                    <select id="typeInput" name="type" class="form-select">
                                                        <option selected>Select Type</option>
                                                        <option value="transport">Transpost</option>
                                                        <option value="advance">Advance</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                    <span class="help-block with-errors err_type" style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="amountInput" class="form-label">Amount</label>
                                                    <input type="text" class="form-control" name="amount" id="amountInput"
                                                        required data-error="Please enter amount">
                                                    <span class="help-block with-errors err_amount"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="remarkInput" class="form-label">Remark</label>
                                                    <input type="text" name="remark" class="form-control" id="remarkInput">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success ">Save Changes</button>
                                        </div>
                                    </form>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="DeductionListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead class="table-light">
                                    <tr>                                        
                                        <th>SR No.</th>
                                        <th>Date</th>
                                        <th>Period</th>
                                        <th>Supplier ID</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Remark</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>

                        </div><!--end row-->
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

    <script>
        $(document).ready(function () {
               
        $('#deductionDate').on('change', function () {
            var selectedDate = new Date($(this).val());

            var year = selectedDate.getFullYear();
            var month = (selectedDate.getMonth() + 1).toString().padStart(2, '0');  // Ensure two digits for month

            // Combine the year and month 
            var period = year + month;

            $('#periodInput').val(period);
        });
    });

    </script>


@endsection
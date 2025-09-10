@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Transaction Management</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Transaction Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.transactions.index') }}">Transaction
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
                    <h4 class="card-title mb-0 flex-grow-1">Transaction Listing</h4>
                    <div class="card-toolbar">
                        <!-- <a href="javascript:void(0)" class="btn btn-primary fw-bold me-2">
                                                                                                                                                                                    <i class="flaticon2-plus"></i> Create Branch
                                                                                                                                                                                </a> -->
                        <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#transactionModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Create Transaction
                        </button>
                        <div id="transactionModal" class="modal fade" tabindex="-1" aria-labelledby="transactionModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transactionModalLabel">Add Transaction</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="AddForm" action="{{ route('admin.transactions.store') }}" method="post"
                                        class="form row g-3" autocomplete="off" role="form">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row gy-4">

                                                <div class="col-md-6 form-group">
                                                    <label for="ticketInput" class="form-label">Ticket Number<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ticketInput"
                                                        name="ticket_no" required
                                                        data-error="Please enter the ticket number">
                                                    <span class="help-block with-errors err_ticket_no"
                                                        style="color:red;"></span>

                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="TRXDate" class="form-label">TRX Date</label>
                                                    <input type="date" class="form-control" id="TRXDate" name="trx_date"
                                                        required data-error="Please enter the TRX date">
                                                    <span class="help-block with-errors err_trx_date"
                                                        style="color:red;"></span>

                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="inputSupplier" class="form-label">Vehicles<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputSupplier" class="form-select" name="vehicle_id"
                                                        required data-error="Please select the Vehicle">
                                                        <span class="help-block with-errors err_vehicle_id"
                                                            style="color:red;"></span>
                                                        <option selected>Select Vehicles</option>
                                                        @foreach ($Vehicles as $vehicle)
                                                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="inputVehicle" class="form-label">Supplier Id<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputVehicle" class="form-select" name="supplier_id"
                                                        required data-error="Please select supplier">
                                                        <span class="help-block with-errors err_supplier_id"
                                                            style="color:red;"></span>
                                                        <option selected>Select Supplier</option>
                                                        @foreach ($Suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_id }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="inputMill" class="form-label">Mill Id<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputMill" class="form-select" name="mill_id" required
                                                        data-error="Please select mill">
                                                        <span class="help-block with-errors err_mill_id"
                                                            style="color:red;"></span>
                                                        <option selected>Select Mill </option>
                                                        @foreach ($Mills as $mill)
                                                            <option value="{{ $mill->id }}">{{ $mill->mill_id }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="wieghtMt" class="form-label">Weight (MT)<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="wieghtMt" name="weight"
                                                        required data-error="Please enter weight">
                                                    <span class="help-block with-errors err_weight"
                                                        style="color:red;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success ">Save Changes</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content ------>
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="selectMonth" class="form-label">Select Month</label>
                            <select id="selectMonth" class="form-select">
                                <option value="">--Month--</option>
                                <option>January</option>
                                <option>February</option>
                                <option>March</option>
                                <option>April</option>
                                <option>May</option>
                                <option>June</option>
                                <option>July</option>
                                <option>August</option>
                                <option>September</option>
                                <option>October</option>
                                <option>November</option>
                                <option>December</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="selectYear" class="form-label">Select Year</label>
                            <select id="selectYear" class="form-select">
                                <option value="">--Year--</option>
                                @for ($i = date('Y'); $i >= 2000; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-warning btn-label waves-effect waves-light">
                                <i class="mdi mdi-database-export label-icon align-middle fs-16 me-2"></i> Export Data
                            </button>
                        </div>
                    </div>
                    <div class="container-fluid mt-4">
                        <div class="row">
                            <table id="TransactionListingHq" class="table nowrap dt-responsive align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Ticket_No</th>
                                        <th>Trx_Date</th>
                                        <th>Supplier_Id</th>
                                        <th>Vehicle</th>
                                        <th>Mill_Id</th>
                                        <th>Weight</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                </tbody>
                            </table>
                        </div><!--end row-->

                        <div id="transactionEditModalHQ" class="modal fade" tabindex="-1"
                            aria-labelledby="transactionEditModalHQLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transactionEditModalHQLabel">Edit Transaction</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="updateForm" action="{{ route('admin.transactions.store') }}" method="post"
                                        class="form row g-3" autocomplete="off" role="form">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row gy-4">

                                                <div class="col-md-6 form-group">
                                                    <label for="ticketNoInput" class="form-label">Ticket Number<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ticketNoInput"
                                                        name="ticket_no">
                                                    <span class="help-block with-errors err_ticket_no"
                                                        style="color:red;"></span>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="TRXDateInput" class="form-label">TRX Date</label>
                                                    <input type="date" class="form-control" id="TRXDateInput" name="trx_date">
                                                    <span class="help-block with-errors err_trx_date"
                                                        style="color:red;"></span>

                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="SupplierInput" class="form-label">Vehicles<span
                                                            class="text-danger">*</span></label>
                                                    <select id="SupplierInput" class="form-select" name="vehicle_id">
                                                        <span class="help-block with-errors err_vehicle_id"
                                                            style="color:red;"></span>
                                                        <option selected>Select Vehicles</option>
                                                        @foreach ($Vehicles as $vehicle)
                                                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="VehicleInput" class="form-label">Supplier Id<span
                                                            class="text-danger">*</span></label>
                                                    <select id="VehicleInput" class="form-select" name="supplier_id">
                                                        <span class="help-block with-errors err_supplier_id"
                                                            style="color:red;"></span>
                                                        <option selected>Select Supplier</option>
                                                        @foreach ($Suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_id }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="MillInput" class="form-label">Mill Id<span
                                                            class="text-danger">*</span></label>
                                                    <select id="MillInput" class="form-select" name="mill_id">
                                                        <span class="help-block with-errors err_mill_id"
                                                            style="color:red;"></span>
                                                        <option selected>Select Mill </option>
                                                        @foreach ($Mills as $mill)
                                                            <option value="{{ $mill->id }}">{{ $mill->mill_id }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="wieghtMtInput" class="form-label">Weight (MT)<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="wieghtMtInput" name="weight">
                                                    <span class="help-block with-errors err_weight"
                                                        style="color:red;"></span>
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
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>

   
@endsection
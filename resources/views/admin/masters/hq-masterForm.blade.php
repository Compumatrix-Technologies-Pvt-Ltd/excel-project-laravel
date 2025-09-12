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
                                    <input class="form-check-input supplierDetails" type="radio" name="supplierDetails"
                                        id="byTicket" value="byTicket" checked>
                                    <label class="form-check-label" for="byTicket">By Ticket No.</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input supplierDetails" type="radio" name="supplierDetails"
                                        id="bySupName" value="bySupName">
                                    <label class="form-check-label" for="bySupName">By Supplier Name</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input supplierDetails" type="radio" name="supplierDetails"
                                        id="bysupId" value="bysupId">
                                    <label class="form-check-label" for="bysupId">By Supplier Id</label>
                                </div>

                                <div class="input-group input-group-sm ms-2" style="max-width: 320px;">
                                    <select class="form-control" id="SuppliersInput">
                                        <option value="">Select Value</option>
                                    </select>
                                    <button class="btn btn-outline-secondary"><i class="ri-arrow-down-s-line"></i></button>
                                </div>

                                <div class="btn-group btn-group-sm ms-2">
                                    <button type="button" id="firstBtn" class="btn btn-outline-secondary">&laquo;</button>
                                    <button type="button" id="prevBtn" class="btn btn-outline-secondary">&lt;
                                        Previous</button>
                                    <button type="button" id="nextBtn" class="btn btn-outline-secondary">Next &gt;</button>
                                    <button type="button" id="lastBtn" class="btn btn-outline-secondary">&raquo;</button>
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
                                            <input type="hidden" name="id" id="trx_hidden_id">

                                            <div class="col-4 text-muted">Ticket No.</div>
                                            <div class="col-8"><strong id="ticketNo"></strong></div>

                                            <div class="col-4 text-muted">Trx. Date</div>
                                            <div class="col-8" id="ticketDate"></div>

                                            <div class="col-4 text-muted">Vehicle</div>
                                            <div class="col-8" id="vehicle_id"></div>

                                            <div class="col-4 text-muted">Mill Id.</div>
                                            <div class="col-8 d-flex gap-3">
                                                <span id="millId"></span>
                                                <span id="millName" class="text-muted"></span>
                                            </div>

                                            <div class="col-4 text-muted">Weight (MT)</div>
                                            <div class="col-8" id="weight"></div>

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
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#SupplierMainModal" class="btn btn-secondary btn-sm">Add
                                                Supplier</a>
                                            <a href=<a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-toggle="modal" data-bs-target="#editsupfirstModal"
                                                class="btn btn-secondary btn-sm">Edit Supplier</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#mainTransactionModal" class="btn btn-secondary btn-sm">Add
                                                Trx</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edittrxfirstModal" class="btn btn-secondary btn-sm">Edit
                                                Trx</a>
                                        </div>
                                        <!-- Add transaction Modal -->
                                        <div id="mainTransactionModal" class="modal fade" tabindex="-1"
                                            aria-labelledby="mainTransactionModalLabel" aria-hidden="true"
                                            data-generate-ticket-url="{{ route('admin.generate.ticket.number') }}">

                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mainTransactionModalLabel">Add
                                                            Transaction
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form id="AddForm" action="{{ route('admin.transactions.store') }}"
                                                        method="post" class="form row g-3" autocomplete="off" role="form">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row gy-4">

                                                                <div class="col-md-6 form-group">
                                                                    <label for="ticketNo" class="form-label">Ticket
                                                                        Number<span class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        class="form-control auto-ticket-number"
                                                                        id="ticketNo" name="ticket_no" required
                                                                        data-error="Please enter the ticket number">
                                                                    <span class="help-block with-errors err_ticket_no"
                                                                        style="color:red;"></span>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="TRXDate" class="form-label">TRX Date</label>
                                                                    <input type="date" class="form-control" id="TRXDate"
                                                                        name="trx_date" required
                                                                        data-error="Please enter the TRX date">
                                                                    <span class="help-block with-errors err_trx_date"
                                                                        style="color:red;"></span>

                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="inputVehicle"
                                                                        class="form-label">Vehicles<span
                                                                            class="text-danger">*</span></label>
                                                                    <select id="inputVehicle" class="form-select"
                                                                        name="vehicle_id" required
                                                                        data-error="Please select the Vehicle">
                                                                        <span class="help-block with-errors err_vehicle_id"
                                                                            style="color:red;"></span>
                                                                        <option selected>Select Vehicles</option>
                                                                        @foreach ($Vehicles as $vehicle)
                                                                            <option value="{{ $vehicle->id }}">
                                                                                {{ $vehicle->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="inputSupplier"
                                                                        class="form-label">Suppliers<span
                                                                            class="text-danger">*</span></label>
                                                                    <select id="inputSupplier" class="form-select"
                                                                        name="supplier_id" required
                                                                        data-error="Please select supplier">
                                                                        <span class="help-block with-errors err_supplier_id"
                                                                            style="color:red;"></span>
                                                                        <option>Select Supplier</option>
                                                                        @foreach ($Suppliers as $supplier)
                                                                            <option value="{{ $supplier->id }}">
                                                                                {{ $supplier->supplier_id . ' ' . $supplier->supplier_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="inputMill" class="form-label">Mill Id<span
                                                                            class="text-danger">*</span></label>
                                                                    <select id="inputMill" class="form-select"
                                                                        name="mill_id" required
                                                                        data-error="Please select mill">
                                                                        <span class="help-block with-errors err_mill_id"
                                                                            style="color:red;"></span>
                                                                        <option selected>Select Mill </option>
                                                                        @foreach ($Mills as $mill)
                                                                            <option value="{{ $mill->id }}">{{ $mill->mill_id }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="wieghtMt" class="form-label">Weight
                                                                        (MT)<span class="text-danger">*</span></label>
                                                                    <input type="tel" class="form-control" id="wieghtMt"
                                                                        name="weight" required
                                                                        data-error="Please enter weight">
                                                                    <span class="help-block with-errors err_weight"
                                                                        style="color:red;"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success ">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div><!-- /.modal-content ------>
                                            </div><!-- /.modal-dialog -->
                                        </div>



                                        <!-- First transaction edit modal -->
                                        <div class="modal fade" id="edittrxfirstModal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Supplier Data Form</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <form id="AddForm" action="" method="post" class="form row g-3"
                                                        autocomplete="off" role="form">
                                                        @csrf
                                                        <div class="modal-body">

                                                            <fieldset class="border p-3">
                                                                <legend class="float-none w-auto px-2 fs-6 text-muted">
                                                                    Transaction Edit Option
                                                                </legend>

                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="edit_trx_option" id="normal_trx_edit"
                                                                        value="normal_trx_edit" checked>
                                                                    <label class="form-check-label"
                                                                        for="normal_trx_edit">Normal
                                                                        Edit</label>
                                                                </div>

                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="edit_trx_option" id="edit_trx_id"
                                                                        value="edit_trx_id">
                                                                    <label class="form-check-label" for="edit_trx_id">Edit
                                                                        Ticket Numer</label>
                                                                </div>
                                                            </fieldset>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#trxEditsecondModal">Ok</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Second edit transaction modal -->
                                        <div class="modal fade" id="trxEditsecondModal" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Supplier Details</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <form id="updateForm"
                                                        action="{{ route('admin.transactionshq.update') }}" method="post"
                                                        class="form row g-3" autocomplete="off" role="form">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" id="hidden_trx_id" name="id">
                                                        <div class="modal-body">
                                                            <div class="row gy-4">

                                                                <div class="col-md-6 form-group">
                                                                    <label for="ticketNoInput" class="form-label">Ticket
                                                                        Number<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="ticketNoInput" name="ticket_no">
                                                                    <span class="help-block with-errors err_ticket_no"
                                                                        style="color:red;"></span>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="TRXDateInput" class="form-label">TRX
                                                                        Date</label>
                                                                    <input type="date" class="form-control"
                                                                        id="TRXDateInput" name="trx_date">
                                                                    <span class="help-block with-errors err_trx_date"
                                                                        style="color:red;"></span>

                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="VehicleInput"
                                                                        class="form-label">Vehicles<span
                                                                            class="text-danger">*</span></label>
                                                                    <select id="VehicleInput" class="form-select"
                                                                        name="vehicle_id">
                                                                        <span class="help-block with-errors err_vehicle_id"
                                                                            style="color:red;"></span>VehicleInput
                                                                        <option>Select Vehicles</option>
                                                                        @foreach ($Vehicles as $vehicle)
                                                                            <option value="{{ $vehicle->id }}">
                                                                                {{ $vehicle->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="SupplierInput"
                                                                        class="form-label">Supplier<span
                                                                            class="text-danger">*</span></label>
                                                                    <select id="SupplierInput" class="form-select"
                                                                        name="supplier_id">
                                                                        <span class="help-block with-errors err_supplier_id"
                                                                            style="color:red;"></span>
                                                                        @foreach ($Suppliers as $supplier)
                                                                            <option value="{{ $supplier->id }}">
                                                                                {{ $supplier->supplier_id . ' ' . $supplier->supplier_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="MillInput" class="form-label">Mill Id<span
                                                                            class="text-danger">*</span></label>
                                                                    <select id="MillInput" class="form-select"
                                                                        name="mill_id">
                                                                        <span class="help-block with-errors err_mill_id"
                                                                            style="color:red;"></span>
                                                                        <option>Select Mill </option>
                                                                        @foreach ($Mills as $mill)
                                                                            <option value="{{ $mill->id }}">{{ $mill->mill_id }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="wieghtMtInput" class="form-label">Weight
                                                                        (MT)<span class="text-danger">*</span></label>
                                                                    <input type="tel" class="form-control"
                                                                        id="wieghtMtInput" name="weight">
                                                                    <span class="help-block with-errors err_weight"
                                                                        style="color:red;"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success ">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Add Supplier Modal -->

                                        <div id="SupplierMainModal" class="modal fade" tabindex="-2"
                                            aria-labelledby="SupplierMainModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="SupplierMainModalLabel">Add
                                                            Supplier
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.suppliers.store') }}" method="post"
                                                        class="form commonForm" autocomplete="off" role="form">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="supplier_id" class="form-label">Supplier
                                                                        Id:
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="supplier_id" id="supplier_id"
                                                                        class="form-control form-control-sm" required
                                                                        data-error="Please enter Supplier Id">
                                                                    <span class="help-block with-errors err_supplier_id"
                                                                        style="color:red;"></span>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="name" class="form-label">Supplier Name:
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="supplier_name"
                                                                        id="supplier_name"
                                                                        class="form-control form-control-sm" required
                                                                        data-error="Please enter name">
                                                                    <span class="help-block with-errors err_supplier_name"
                                                                        style="color:red;"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">

                                                                <div class="col-md-6 form-group">
                                                                    <label for="address" class="form-label">Address 1
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="address1" id="address1"
                                                                        class="form-control form-control-sm" required
                                                                        data-error="Please enter address">
                                                                    <span class="help-block with-errors err_address1"
                                                                        style="color:red;"></span>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="email" class="form-label">Email: <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="email" name="email" id="email"
                                                                        class="form-control form-control-sm" required
                                                                        data-error="Please enter Email">
                                                                    <span class="help-block with-errors err_email"
                                                                        style="color:red;"></span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">

                                                                <div class="col-md-6 form-group">
                                                                    <label for="telphone_1" class="form-label">Tel. 1:
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="tel" name="telphone_1" id="telphone_1"
                                                                        class="form-control form-control-sm" required
                                                                        data-error="Please enter Telephone number">
                                                                    <span class="help-block with-errors err_telphone_1"
                                                                        style="color:red;"></span>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="telphone_2" class="form-label">Tel.
                                                                        2:</label>
                                                                    <input type="tel" name="telphone_2" id="telphone_2"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="bank_id" class="form-label">Bank ID:
                                                                        <span class="text-danger">*</span></label>
                                                                    <select name="bank_id" id="bank_id"
                                                                        class="form-select form-select-sm" required
                                                                        data-error="Please select bank Id">
                                                                        <option value="">Select</option>
                                                                        <option value="MBBS">MBBS</option>
                                                                        <option value="RHB">RHB</option>
                                                                    </select>
                                                                    <span class="help-block with-errors err_bank_id"
                                                                        style="color:red;"></span>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="bank_acc_no" class="form-label">Bank A/C
                                                                        No.:
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="bank_acc_no" id="bank_acc_no"
                                                                        class="form-control form-control-sm" required
                                                                        data-error="Please bank account number">
                                                                    <span class="help-block with-errors err_bank_acc_no"
                                                                        style="color:red;"></span>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success ">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div><!-- /.modal-content ------>
                                            </div><!-- /.modal-dialog -->
                                        </div>

                                        <!-- First edit supplier modal -->
                                        <div class="modal fade" id="editsupfirstModal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Supplier Data Form</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <form id="AddForm" action="" method="post" class="form row g-3"
                                                        autocomplete="off" role="form">
                                                        @csrf
                                                        <div class="modal-body">

                                                            <fieldset class="border p-3">
                                                                <legend class="float-none w-auto px-2 fs-6 text-muted">
                                                                    Supplier Edit Option
                                                                </legend>

                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="edit_option" id="normal_edit"
                                                                        value="normal_edit" checked>
                                                                    <label class="form-check-label" for="normal_edit">Normal
                                                                        Edit</label>
                                                                </div>

                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="edit_option" id="edit_id" value="edit_id">
                                                                    <label class="form-check-label" for="edit_id">Edit
                                                                        Supplier Id</label>
                                                                </div>
                                                            </fieldset>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#suppEditsecondModal">Ok</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Second edit suplier modal -->
                                        <div class="modal fade" id="suppEditsecondModal" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Supplier Details</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <form id="updateForm" action="{{ route('admin.supplier.update') }}"
                                                        method="post" class="form row g-3" autocomplete="off" role="form">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <input type="hidden" id="s_id_1" name="id">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="supplier_id" class="form-label">Supplier
                                                                        Id:
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="supplier_id" id="s_id"
                                                                        class="form-control form-control-sm">
                                                                    <span class="help-block with-errors err_supplier_id"
                                                                        style="color:red;"></span>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="name" class="form-label">Supplier Name:
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="supplier_name" id="s_name"
                                                                        class="form-control form-control-sm">
                                                                    <span class="help-block with-errors err_supplier_name"
                                                                        style="color:red;"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">

                                                                <div class="col-md-6 form-group">
                                                                    <label for="address" class="form-label">Address 1
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="address1" id="s_add"
                                                                        class="form-control form-control-sm">
                                                                    <span class="help-block with-errors err_address1"
                                                                        style="color:red;"></span>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="email" class="form-label">Email: <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="email" name="email" id="s_email"
                                                                        class="form-control form-control-sm">
                                                                    <span class="help-block with-errors err_email"
                                                                        style="color:red;"></span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">

                                                                <div class="col-md-6 form-group">
                                                                    <label for="telphone_1" class="form-label">Tel. 1:
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="tel" name="telphone_1" id="s_tel_1"
                                                                        class="form-control form-control-sm">
                                                                    <span class="help-block with-errors err_telphone_1"
                                                                        style="color:red;"></span>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="telphone_2" class="form-label">Tel.
                                                                        2:</label>
                                                                    <input type="tel" name="telphone_2" id="s_tel_2"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="bank_id" class="form-label">Bank ID:
                                                                        <span class="text-danger">*</span></label>
                                                                    <select name="bank_id" id="s_bank_id"
                                                                        class="form-select form-select-sm">
                                                                        <option value="">Select</option>
                                                                        <option value="MBBS">MBBS</option>
                                                                        <option value="RHB">RHB</option>
                                                                    </select>
                                                                    <span class="help-block with-errors err_bank_id"
                                                                        style="color:red;"></span>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="bank_acc_no" class="form-label">Bank A/C
                                                                        No.:
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="bank_acc_no" id="s_bank_acc_no"
                                                                        class="form-control form-control-sm">
                                                                    <span class="help-block with-errors err_bank_acc_no"
                                                                        style="color:red;"></span>
                                                                </div>
                                                            </div>


                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success ">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                            </div>

                            <!-- Right: supplier identity panel -->
                            <div class="col-xl-6 mt-3 mt-xl-0">
                                <div class="card h-100">
                                    <div class="card-header py-2">
                                        <strong id="company_name"></strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <input type="hidden" name="id" id="supplier_hidden_id">
                                            <div class="col-4 text-muted">Supplier Id.</div>
                                            <div class="col-8" id="supplierId"></div>

                                            <div class="col-4 text-muted">Supplier Name</div>
                                            <div class="col-8" id="supplierName"></div>

                                            <div class="col-4 text-muted">Address</div>
                                            <div class="col-8" id="supplierAddress">

                                            </div>

                                            <div class="col-4 text-muted">eMail</div>
                                            <div class="col-8" id="supplierEmail"></div>

                                            <div class="col-4 text-muted">Tel. No. 1</div>
                                            <div class="col-8" id="tel1"></div>

                                            <div class="col-4 text-muted">Tel. No. 2</div>
                                            <div class="col-8" id="tel2"></div>

                                            <div class="col-4 text-muted">Bank Id.</div>
                                            <div class="col-8" id="bankId"></div>

                                            <div class="col-4 text-muted">Bank A/C No.</div>
                                            <div class="col-8" id="bankAccNo"></div>
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
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>
    <script>
        $(document).ready(function () {
            let options = [];
            let currentIndex = 0;

            function loadCurrentOption() {
                const selectedType = $('.supplierDetails:checked').val();
                const selectedValue = options[currentIndex];

                $('#SuppliersInput').val(selectedValue);
                fetchDetails(selectedType, selectedValue);
            }

            $('.supplierDetails').change(function () {
                const selectedType = $(this).val();

                $.ajax({
                    url: '{{ route("admin.hqMainForm.getValues") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: selectedType
                    },
                    success: function (response) {
                        options = response;
                        $('#SuppliersInput').empty();

                        options.forEach(function (item, index) {
                            const selected = index === 0 ? 'selected' : '';
                            $('#SuppliersInput').append(`<option ${selected}>${item}</option>`);
                        });

                        currentIndex = 0;

                        if (options.length > 0) {
                            loadCurrentOption();
                        } else {
                            $('#SuppliersInput').append('<option selected>No options found</option>');
                        }
                    }
                });
            });

            $('#SuppliersInput').change(function () {
                currentIndex = $('#SuppliersInput').prop('selectedIndex');
                const selectedType = $('.supplierDetails:checked').val();
                const selectedValue = $(this).val();
                fetchDetails(selectedType, selectedValue);
            });

            $('#prevBtn').click(function () {
                if (currentIndex > 0) {
                    currentIndex--;
                    loadCurrentOption();

                }
            });

            $('#nextBtn').click(function () {
                if (currentIndex < options.length - 1) {
                    currentIndex++;
                    loadCurrentOption();

                }
            });

            $('#firstBtn').click(function () {
                currentIndex = 0;
                loadCurrentOption();

            });

            $('#lastBtn').click(function () {
                currentIndex = options.length - 1;
                loadCurrentOption();

            });

            //  initial load
            $('.supplierDetails:checked').trigger('change');

            function fetchDetails(type, value) {
                $.ajax({
                    url: '{{ route("admin.hqMainForm.getAllDetails") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: type,
                        value: value
                    },
                    success: function (data) {
                        $('#trx_hidden_id').text(data.trx_hidden_id || '-');
                        $('#ticketNo').text(data.ticket_no || '-');
                        $('#ticketDate').text(data.trx_date || '-');
                        $('#vehicle_id').text(data.vehicle_id || '-');
                        $('#millId').text(data.mill_id || '-');
                        $('#millName').text(data.mill_name || '-');
                        $('#weight').text(data.weight || '-');
                        $('#ticketPhoto').attr('src', data.ticket_photo || '{{ asset("/assets/admin/images/palm-oil.jpg") }}');

                        $('#company_name').text(data.company_name || '-');
                        $('#supplier_hidden_id').text(data.supplier_hidden_id || '-');
                        $('#supplierId').text(data.supplier_id || '-');
                        $('#supplierName').text(data.supplier_name || '-');
                        $('#supplierAddress').text(data.address || '-');
                        $('#supplierEmail').text(data.email || '-');
                        $('#tel1').text(data.telphone_1 || '-');
                        $('#tel2').text(data.telphone_2 || '-');
                        $('#bankId').text(data.bank_id || '-');
                        $('#bankAccNo').text(data.bank_no || '-');
                    }
                });
            }
            $(document).on('show.bs.modal', '.modal', function () {
                const zIndex = 1040 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'), 0);
            });


            $('#editsupfirstModal button.btn-primary').click(function () {
                const selectedSupplierId = $('#supplier_hidden_id').text();
                const encodedSupplierId = btoa(btoa(selectedSupplierId));
                if (!encodedSupplierId || encodedSupplierId === '-') {
                    alert('No supplier selected');
                    return;
                }

                $.ajax({
                    url: ADMINURL + '/supplier/edit/' + encodedSupplierId, 
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        supplier_id: encodedSupplierId
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            $('#s_id_1').val(encodedSupplierId);
                            $('#s_id').val(response.data.supplier_id);
                            $('#s_name').val(response.data.supplier_name);
                            $('#s_add').val(response.data.address1);
                            $('#s_email').val(response.data.email);
                            $('#s_tel_1').val(response.data.telphone_1);
                            $('#s_tel_2').val(response.data.telphone_2);
                            $('#s_bank_id').val(response.data.bank_id);
                            $('#s_bank_acc_no').val(response.data.bank_acc_no);

                            $('#secondModal').modal('show');
                        }
                        else {
                            alert('Failed to fetch supplier details.');
                        }
                    }
                });
            });

            $('#edittrxfirstModal button.btn-primary').click(function () {
                const selectedTrxId = $('#trx_hidden_id').text();
                const encodedTrxId = btoa(btoa(selectedTrxId));
                if (!encodedTrxId || encodedTrxId === '-') {
                    alert('No supplier selected');
                    return;
                }

                $.ajax({
                    url: ADMINURL + '/transactions/' + encodedTrxId + '/edit', 
                    type: 'GET',
                    dataType: "json",
                     data: {
                        _token: '{{ csrf_token() }}',
                        id: encodedTrxId
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            $('#ticketNoInput').val(response.data.ticket_no);
                            $("#TRXDateInput").val(response.data.trx_date);
                            $('#SupplierInput').val(response.data.supplier_id);
                            $('#VehicleInput').val(response.data.vehicle_id);
                            $('#MillInput').val(response.data.mill_id);
                            $('#wieghtMtInput').val(response.data.weight);
                            $('#hidden_trx_id').val(encodedTrxId);
                            $('#submitBtn').removeClass('disabled');
                        } else {
                            alert('Something went wrong');
                        }
                    }
                });
            });


        });
    </script>

@endsection
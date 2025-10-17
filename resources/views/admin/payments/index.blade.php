@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Payments Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Payments Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.banks.index') }}">Payments Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Payments Listing</h4>
                                        <h4 class="card-title mb-0 flex-grow-1"><strong>Branch:</strong> VC Majumas SDN BHD</h4>

                    <div class="card-toolbar">
                                                                            
                        <button type="button" class="btn btn-primary btn-label waves-effect waves-ligh"  data-bs-toggle="modal"
                            data-bs-target="#branchModal">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                        </button>
                        <button type="button" class="btn btn-info btn-label waves-effect waves-ligh"  data-bs-toggle="modal"
                            data-bs-target="#branchModal">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button> 
                    </div>
                </div>

                <div class="card-body">
                    <form data-toggle="validator" method="POST" action="" class="d-flex row" novalidate="true">
                        <input type="hidden" name="_token" value="" autocomplete="off">                        
                        <input type="hidden" name="_method" value="POST">                        <div class="col-md-2">
                            <label class="form-label">Start  Date</label>
                            <input type="date" class="form-control" placeholder="Select Start Date" name="start_date" id="start_date" value="">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" placeholder="Select End Date" name="end_date" id="end_date" value="">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Payment Method</label>
                            <select name="status" id="statusFilter" class="form-select">
                                <option value="">Select Method</option>
                               <option value="pending">Pending</option>
                               <option value="delivered">Delivered</option>
                               <option value="cancel">Cancel</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Supplier </label>
                            <select name="supplier_id" id="supplierFilter" class="form-select">
                                <option value="">Select Supplier</option>
                                    <option value="TVRZPQ==">Aisa Binti Sidayar (K/P: 580513-12-5444)	</option>
                                    <option value="TVRjPQ==">Asrim @ Asrim Bin Omar Maya (K/P: 630720-12-5837)	</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info btn-label waves-effect waves-light mt-4"><i class="mdi mdi-database-export label-icon align-middle fs-16 me-2"></i> Export Data</button>
                        </div>
                    </form>
                    <div class="container-fluid mt-4">
                        <div class="row">
                            <table id="PaymentListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>Inv. No.</th>
                                        <th>Id.</th>
                                        <th>Supplier Name</th>
                                        <th>Invoice Date</th>
                                        <th>Amount Paid (RM)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    
                                </tbody>
                            </table>
                        </div>

                        <div id="branchModal" class="modal fade" tabindex="-1" aria-labelledby="bankEditModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bankEditModalLabel">Payment Method Selection Form</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="bankIdInput" class="form-label">Payment Method<span
                                                            class="text-danger">*</span></label>
                                                    <select name="payment_method" id="" class="form-select" required>
                                                        <option value="cash">Cash</option>
                                                        <option value="cheque">Cheque</option>
                                                        <option value="bank_transfer">Bank Transfer</option>
                                                    </select>
                                                </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success ">Submit</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>

@endsection
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

                        @if (Auth::user()->role == 'hq')
                            <a download href="{{ asset('storage/app/public/sample-excel/hq-suppliers-sample.xlsx') }}"
                                class="btn btn-sm btn-primary btn-label waves-effect waves-light">
                                <i class="mdi mdi-file-download label-icon align-middle fs-16 me-2"></i> Sample Excel</a>
                        @else
                            <a download href="{{ asset('storage/app/public/sample-excel/branch-suppliers-sample-excel.xlsx') }}"
                                class="btn btn-sm btn-primary btn-label waves-effect waves-light">
                                <i class="mdi mdi-file-download label-icon align-middle fs-16 me-2"></i> Sample Excel</a>
                        @endif
                        <button type="button" class="btn btn-sm btn-warning btn-label waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                            <i class="mdi mdi-file-excel label-icon align-middle fs-16 me-2"></i>
                            Import Excel
                        </button>

                        <button type="button" class="btn btn-sm btn-info btn-label waves-effect waves-light">
                            <i class="mdi mdi-database-export label-icon align-middle fs-16 me-2"></i> Export Data
                        </button>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="SuppliersListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Supplier Id</th>
                                        <th>Supplier Name</th>
                                        <th>Email</th>
                                        <th>Telephone Number</th>
                                        <th>Extra Info</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div><!--end row-->
                        <div class="modal fade" id="supplierDetailsModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Supplier Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <table class="table table-bordered table-sm">
                                            <tbody>
                                                <tr>
                                                    <th>Address 1</th>
                                                    <td id="address1_value"></td>
                                                </tr>
                                                <tr>
                                                    <th>Address 2</th>
                                                    <td id="address2_value"></td>
                                                </tr>
                                                <tr>
                                                    <th>Bank ID</th>
                                                    <td id="bank_id_value"></td>
                                                </tr>
                                                <tr>
                                                    <th>Bank A/C No.</th>
                                                    <td id="bank_acc_no_value"></td>
                                                </tr>

                                                @if (Auth::user()->role == 'branch-user')
                                                    <tr>
                                                        <th>Supplier Type</th>
                                                        <td id="supplier_type"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MPOB Licence No.</th>
                                                        <td id="mpob_lic_no_value"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MPOB Expiry Date</th>
                                                        <td id="mpob_exp_date_value"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MSPO Cert. No.</th>
                                                        <td id="mspo_cert_no_value"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MSPO Expiry Date</th>
                                                        <td id="mspo_exp_date_value"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>TIN</th>
                                                        <td id="tin_value"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Subsidy (%)</th>
                                                        <td id="subsidy_rate_value"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Land Size (Ha)</th>
                                                        <td id="land_size_value"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Latitude</th>
                                                        <td id="latitude_value"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Longitude</th>
                                                        <td id="longitude_value"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Remark</th>
                                                        <td id="remark_value"></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModalLong" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sam">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Supplier Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" action="{{ route('admin.suppliers.import') }}" data-toggle="validator" role="form" method="POST"
                                            id="AddForm" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <label class="control-label col-md-12">Choose File
                                                        <span class="required">*</span></label>
                                                    <input type="file" name="file" class="form-control" required
                                                        data-error="Please select file.">
                                                    <span class="help-block with-errors">
                                                        <ul class="list-unstyled">
                                                            <li class="err_file"></li>
                                                        </ul>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-12 text-end">
                                                    <button type="submit"
                                                        class="btn btn-success font-weight-bold">Submit</button>
                                                </div>
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
        <!--end col-->
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>
@endsection
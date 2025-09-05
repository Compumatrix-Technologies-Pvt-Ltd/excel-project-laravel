@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Mill Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Mill Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.mill.management') }}">Mill Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Mill Listing</h4>
                    <div class="card-toolbar">
                        <a href="{{ asset('storage/app/public/cash-purchase-pdf/VC_202505 _Cash_Purchase_Summary.pdf') }}"
                            class="btn btn-primary btn-label waves-effect waves-light"
                            download="VC_202505 _Cash_Purchase_Summary.pdf">
                            <i class="mdi mdi-microsoft-excel label-icon align-middle fs-17 me-2"></i>Sample Excel
                        </a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#branchModal"
                            class="btn btn-warning btn-label waves-effect waves-ligh">
                            <i class="mdi mdi-cloud-download-outline label-icon align-middle fs-16 me-2"></i> Import Excel
                        </button>
                        <button type="button" class="btn btn-info btn-label waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#MillModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add Mill
                        </button>
                        <div id="MillModal" class="modal fade" tabindex="-1" aria-labelledby="MillModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="MillModalLabel">Mill Data Entry</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="AddForm" action="{{ route('admin.mill.store') }}" method="post" class="form"
                                        autocomplete="off" role="form">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row gy-4">
                                                <div class="col-md-6 form-group">
                                                    <label for="millId" class="form-label">
                                                        Mill Id <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="millId" name="mill_id"
                                                        required data-error="Please enter Mill Id">
                                                    <span class="help-block with-errors err_mill_id"
                                                        style="color:red;"></span>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="millName" class="form-label">
                                                        Mill Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="millName" name="name"
                                                        required data-error="Please enter Mill Name">
                                                    <span class="help-block with-errors err_name" style="color:red;"></span>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="mpobNo" class="form-label">
                                                        MPOB Licence Number <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="mpobNo" name="mpob_lic_no"
                                                        required data-error="Please enter MPOB Licence Number">
                                                    <span class="help-block with-errors err_mpob_lic_no"
                                                        style="color:red;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
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
                            <table class="table nowrap dt-responsive align-middle CommonListing" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR.No</th>
                                        <th>Mill_Id</th>
                                        <th>Mill_Name</th>
                                        <th>MPOB_Lic_No</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mills as $index => $mill)
                                        <tr>
                                            <td>
                                                <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                                </div>
                                            </td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $mill->mill_id }}</td>
                                            <td>{{ $mill->name }}</td>
                                            <td>{{ $mill->mpob_lic_no }}</td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown"><i
                                                            class="ri-more-fill align-middle"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                                data-id="{{base64_encode(base64_encode($mill->id))}}"
                                                                id="edit-mill-btn">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li><a href="javascript:void(0)" onclick="return deleteCollection(this)"
                                                                data-href="{{route('admin.mill.destroy', [base64_encode(base64_encode($mill->id))])}}"
                                                                class="dropdown-item remove-item-btn"><i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--end row-->
                    </div>
                    <div id="editMillModal" class="modal fade" tabindex="-1" aria-labelledby="editMillModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMillModalLabel">Mill Data Entry</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <form id="updateForm" action="{{ route('admin.mill.update') }}" method="post" class="form"
                                    autocomplete="off" role="form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" id="hidden_id" name="id">
                                        <div class="row gy-4">
                                            <div class="col-md-6 form-group">
                                                <label for="millIdInput" class="form-label">
                                                    Mill Id <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="millIdInput" name="mill_id">
                                                <span class="help-block with-errors err_mill_id" style="color:red;"></span>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="millNameInput" class="form-label">
                                                    Mill Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="millNameInput" name="name">
                                                <span class="help-block with-errors err_name" style="color:red;"></span>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="mpobNoInput" class="form-label">
                                                    MPOB Licence Number <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="mpobNoInput" name="mpob_lic_no"
                                                    required data-error="Please enter MPOB Licence Number">
                                                <span class="help-block with-errors err_mpob_lic_no"
                                                    style="color:red;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </div>
                                </form>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
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

@endsection
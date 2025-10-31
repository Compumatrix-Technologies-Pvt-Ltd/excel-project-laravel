@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Branch Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Branch Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.branch.index') }}">Branch Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Branch Listing</h4>
                    <div class="card-toolbar">
                       
                        <button type="button" class="btn btn-info btn-label waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#BranchModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add Branch
                        </button>
                        <div id="BranchModal" class="modal fade" tabindex="-1" aria-labelledby="BranchModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="BranchModalLabel">Branch Data Entry</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="AddForm" action="{{ route('admin.branch.store') }}" method="post" class="form"
                                        autocomplete="off" role="form">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row gy-4">
                                                <div class="col-md-6 form-group">
                                                    <label for="branchName" class="form-label">
                                                        Branch Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="branchName" name="name"
                                                        required data-error="Please enter Branch Name" max="100">
                                                    <span class="help-block with-errors err_name" style="color:red;"></span>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="branchCode" class="form-label">
                                                        Branch Code <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="branchCode" name="code"
                                                        required data-error="Please enter Branch Code">
                                                    <span class="help-block with-errors err_code"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="branchPhone" class="form-label">
                                                        Phone <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control numericInput" id="branchPhone" name="phone" maxlength="15"
                                                        required data-error="Please enter Branch Phone">
                                                    <span class="help-block with-errors err_phone"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="branchAddress" class="form-label">
                                                        Address
                                                    </label>
                                                    <textarea name="address" id="branchAddress" class="form-control" cols="4" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <th>Branch Code</th>
                                        <th>Branch Name</th>
                                        <th>Branch Phone</th>
                                        <th>Users</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($branches as $index => $branch)

                                        <tr>
                                            <td>
                                                <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                                </div>
                                            </td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $branch->code }}</td>
                                            <td>{{ $branch->name }}</td>
                                            <td>{{ $branch->phone }}</td>
                                            <td><a href="{{route('admin.branch-users',[base64_encode(base64_encode($branch->id))])}}" class="btn btn-primary btn-label waves-effect waves-light"><i class="mdi mdi-account-supervisor-outline label-icon align-middle fs-16 me-2"></i>{{ $branch->users_count }}</a></td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown"><i
                                                            class="ri-more-fill align-middle"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-branch-btn" href="javascript:void(0);"
                                                                data-id="{{base64_encode(base64_encode($branch->id))}}"
                                                                id="edit-branch-btn">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li><a href="javascript:void(0)" onclick="return deleteCollection(this)"
                                                                data-href="{{route('admin.branch.destroy', [base64_encode(base64_encode($branch->id))])}}"
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
                    <div id="editBranchModal" class="modal fade" tabindex="-1" aria-labelledby="editBranchModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editBranchModalLabel">Branch Data Entry</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <form id="updateForm" action="{{ route('admin.update-branch') }}" method="post" class="form"
                                    autocomplete="off" role="form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row gy-4">
                                                <div class="col-md-6 form-group">
                                                    <label for="branchName" class="form-label">
                                                        Branch Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="hidden" name="hidden_id" id="hidden_id">
                                                    <input type="text" class="form-control" id="branchName1" name="name"
                                                        required data-error="Please enter Branch Name" max="100">
                                                    <span class="help-block with-errors err_name" style="color:red;"></span>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="branchCode" class="form-label">
                                                        Branch Code <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="branchCode1" name="code"
                                                        required data-error="Please enter Branch Code">
                                                    <span class="help-block with-errors err_code"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="branchPhone" class="form-label">
                                                        Phone <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"  maxlength="15" class="form-control numericInput" id="branchPhone1" name="phone"
                                                        required data-error="Please enter Branch Phone">
                                                    <span class="help-block with-errors err_phone"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="branchAddress" class="form-label">
                                                        Address
                                                    </label>
                                                    <textarea name="address" id="branchAddress1" class="form-control" cols="4" rows="2"></textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success submitBtn2">Save Changes</button>
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
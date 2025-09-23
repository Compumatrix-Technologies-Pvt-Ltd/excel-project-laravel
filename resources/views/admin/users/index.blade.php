@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Branch User Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Branch User Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">User Listing</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Branch User Listing</h4>
                    <div class="card-toolbar">
                        <a href="{{route('admin.users.create')}}" class="btn btn-info btn-label waves-effect waves-light">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add User
                    </a>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="UsersTable" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($BranchUsers as $index => $user)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                                </div>
                                            </th>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile_number }}</td>
                                            <td>{{$user->branch->name}}</td>
                                            <td><span class="badge bg-success">{{$user->status}}</span></td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown"><i
                                                            class="ri-more-fill align-middle"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                                data-id="{{base64_encode(base64_encode($user->id))}}"
                                                                id="edit-user-btn">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li><a href="javascript:void(0)" onclick="return deleteCollection(this)"
                                                                data-href="{{route('admin.mill.destroy', [base64_encode(base64_encode($user->id))])}}"
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

                        <div id="editUserModal" class="modal fade" tabindex="-1" aria-labelledby="editUerModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUerModalLabel">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="updateForm" action="{{ route('admin.user.update') }}" role="form"
                                        class="row g-3" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <input type="hidden" name="id" id="hidden_id">
                                            <div class="row">
                                                <div class="col-md-6 mb-3 form-group">
                                                    <label for="fullnameInput" class="form-label">Name<span
                                                            class="text-danger">*</span></label>
                                                    <input name="name" type="text" class="form-control" id="fullnameInput">
                                                    <span class="help-block with-errors err_name" style="color:red;"></span>

                                                </div>
                                                <div class="col-md-6 mb-3 form-group">
                                                    <label for="inputEmail4" class="form-label">Email<span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control" id="inputEmail4">
                                                    <span class="help-block with-errors err_email"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 mb-3 form-group">
                                                    <label for="phoneNumberInput" class="form-label">Phone Number</label>
                                                    <input type="tel" name="mobile_number" class="form-control"
                                                        id="phoneNumberInput">
                                                    <span class="help-block with-errors err_mobile_number"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputRole" class="form-label">Assign Role<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control role" tabindex="1" name="role" id="user_role">
                                                        <option selected value="" name="role">Select Role</option>
                                                        @php
                                                            $user_role = '';
                                                                $user_role = auth()->user()->getRoleNames()->first();
                                                            
                                                        @endphp
                                                        @if(!empty($rolesCollection) && sizeof($rolesCollection) > 0)
                                                            @foreach($rolesCollection as $key => $role)
                                                                <option value="{{ base64_encode(base64_encode($role->id)) }}"
                                                                    name="{{$role->name}}" @if($role->name == $user_role) selected
                                                                    @endif>
                                                                    {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="help-block with-errors err_role" style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 mb-3 form-group">
                                                    <label for="inputBranch" class="form-label">Assign Branch<span
                                                            class="text-danger">*</span></label>
                                                    <select name="branch_id" id="inputBranch" class="form-select">
                                                        <option selected>Select Branch</option>
                                                        @foreach ($Branches as $branch)
                                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block with-errors err_branch_id"
                                                        style="color:red;"></span>
                                                </div>

                                                <div class="col-6 mb-3 form-group">
                                                    <label for="status" class="form-label d-block">Status</label>
                                                    <div class="d-flex gap-3">
                                                        <div class="form-check form-check-inline form-radio-success">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="statusActive" value="active">
                                                            <label class="form-check-label"
                                                                for="statusActive">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-inline form-radio-warning">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="statusInactive" value="inactive">
                                                            <label class="form-check-label"
                                                                for="statusInactive">Inactive</label>
                                                        </div>
                                                        <div class="form-check form-check-inline form-radio-danger">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="statusLocked" value="locked">
                                                            <label class="form-check-label"
                                                                for="statusLocked">Locked</label>
                                                        </div>
                                                    </div>
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
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#UsersTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>


@endsection
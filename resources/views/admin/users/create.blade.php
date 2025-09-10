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
                        <li class="breadcrumb-item active"><a href="">BranchUser Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.create') }}">Create Branch
                                User</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Create Branch User</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row gy-4">
                            <form id="AddForm" action="{{ route('admin.users.store') }}" role="form" class="row g-3"
                                method="post">
                                @csrf
                                <div class="col-md-6 form-group">
                                    <label for="fullnameInput" class="form-label">Name<span
                                            class="text-danger">*</span></label>
                                    <input name="name" type="text" class="form-control" id="fullnameInput" required
                                        data-error="Please enter name">
                                    <span class="help-block with-errors err_name" style="color:red;"></span>

                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="inputEmail4" class="form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="inputEmail4" required
                                        data-error="Please enter email">
                                    <span class="help-block with-errors err_email" style="color:red;"></span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="phoneNumberInput" class="form-label">Phone Number</label>
                                    <input type="tel" name="mobile_number" class="form-control" id="phoneNumberInput"
                                        required data-error="Please enter mobile number">
                                    <span class="help-block with-errors err_mobile_number" style="color:red;"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputRole" class="form-label">Assign Role<span
                                            class="text-danger">*</span></label>
                                    <select required class="form-control role" tabindex="1" name="role"
                                        data-error="Please select role" id="user_role">
                                        <option value="" name="">Select Role</option>
                                        @if(!empty($rolesCollection) && count($rolesCollection) > 0)
                                            @foreach($rolesCollection as $key => $role)
                                                <option value="{{ base64_encode(base64_encode($role->id)) }}"
                                                    name="{{$role->name}}">
                                                    {{ ucwords(str_replace('-', ' ', $role->name)) }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="help-block with-errors err_role" style="color:red;"></span>

                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="inputBranch" class="form-label">Assign Branch<span
                                            class="text-danger">*</span></label>
                                    <select name="branch_id" id="inputBranch" class="form-select" required
                                        data-error="Please enter name">
                                        <option selected>Select Branch</option>
                                        @foreach ($Branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block with-errors err_branch_id" style="color:red;"></span>
                                </div>

                                {{--<div class="col-6 form-group">
                                    <label for="status" class="form-label d-block">Status</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check form-check-inline form-radio-success">
                                            <input class="form-check-input" type="radio" name="status" id="statusActive"
                                                value="active" checked>
                                            <label class="form-check-label" for="statusActive">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-warning">
                                            <input class="form-check-input" type="radio" name="status" id="statusInactive"
                                                value="inactive">
                                            <label class="form-check-label" for="statusInactive">Inactive</label>
                                        </div>
                                        <div class="form-check form-check-inline form-radio-danger">
                                            <input class="form-check-input" type="radio" name="status" id="statusLocked"
                                                value="locked">
                                            <label class="form-check-label" for="statusLocked">Locked</label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12 form-group">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>

@endsection
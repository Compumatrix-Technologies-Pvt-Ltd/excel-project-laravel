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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.create') }}">Create Branch User</a></li>
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
                            <form action="javascript:void(0);" class="row g-3">
                                <div class="col-md-6">
                                    <label for="fullnameInput" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="fullnameInput">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="inputEmail4">
                                </div>
                                <div class="col-md-6">
                                    <label for="phoneNumberInput" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phoneNumberInput">
                                </div>
                                {{-- <div class="col-md-6">
                                    <label for="inputRole" class="form-label">Roles<span class="text-danger">*</span></label>
                                    <select id="inputRole" class="form-select">
                                        <option selected>Select Role</option>
                                        <option>HQ</option>
                                        <option>Branch User</option>
                                        <option>Auditor </option>
                                    </select>
                                </div> --}}
                                <div class="col-md-6">
                                    <label for="inputBranch" class="form-label">Assign Branch<span class="text-danger">*</span></label>
                                    <select id="inputBranch" class="form-select">
                                        <option selected>Select Branch</option>
                                        <option>Branch 1</option>
                                        <option>Branch 2</option>
                                        <option>Branch 3</option>
                                    </select>
                                </div>

                                <div class="col-6">
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
                                </div>
                                <div class="col-12">
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
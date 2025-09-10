@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Roles And Permissions</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Role And Permissions</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.roles.index') }}">Roles</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Roles</h4>
                    <div class="card-toolbar">
                            <button type="button" class="btn btn-info btn-label waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#AddRoleModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add Role
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <table id="rolesListingTable" class="table nowrap dt-responsive align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SR</th>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>

                    <div id="AddRoleModal" class="modal fade" tabindex="-1" aria-labelledby="adminUserLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.roles.store') }}"  data-toggle="validator" role="form" method="POST" id="AddForm" autocomplete="off">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="adminUserLabel">Add Role</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12"><label class="form-label">Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="name" id="name" required data-error="Please enter name" pattern="^[A-Za-z0-9 ]*$" data-pattern-error="Please enter a valid name" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="EditRoleModal" class="modal fade" tabindex="-1" aria-labelledby="adminUserLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.roles.updateRole') }}"  data-toggle="validator" role="form" method="POST" id="updateForm" autocomplete="off">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="adminUserLabel">Edit Role</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12"><label class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="hidden" name="hidden_id" id="hidden_id">
                                                <input class="form-control" type="text" name="name" id="nameInput1" required data-error="Please enter name" pattern="^[A-Za-z0-9 ]*$" data-pattern-error="Please enter a valid name" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success" type="submit">Save</button>
                                    </div>
                                </form>
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
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/roles/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>
@endsection



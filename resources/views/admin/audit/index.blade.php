@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Security And Audit </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Security And Audit</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.banks.index') }}">Admin Users & Roles</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Admin Users & Roles</h4>
                    <div class="card-toolbar">
                         <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#adminUserModal">Invite Admin</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <table id="AdminUsersTable" class="table nowrap dt-responsive align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SR</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>MFA</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Owner Root</td>
                                    <td>owner@example.com</td>
                                    <td>SUPER_ADMIN</td>
                                    <td><span class="badge bg-success">Enabled</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>2025‑08‑30 10:22</td>
                                    <td><button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#adminUserModal">Edit</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Ops Support</td>
                                    <td>ops@example.com</td>
                                    <td>SUPPORT_ADMIN</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>2025‑08‑28 16:02</td>
                                    <td><button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#adminUserModal">Edit</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="adminUserModal" class="modal fade" tabindex="-1" aria-labelledby="adminUserLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="adminUserForm" action="javascript:void(0);">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="adminUserLabel">Invite / Edit Admin</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12"><label class="form-label">Name</label><input
                                                    class="form-control" id="auName"></div>
                                            <div class="col-12"><label class="form-label">Email</label><input type="email"
                                                    class="form-control" id="auEmail"></div>
                                            <div class="col-12"><label class="form-label">Role</label>
                                                <select class="form-select" id="auRole">
                                                    <option>SUPER_ADMIN</option>
                                                    <option>SUPPORT_ADMIN</option>
                                                    <option>BILLING_ADMIN</option>
                                                    <option>READONLY_AUDIT</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="auMfa">
                                                    <label class="form-check-label" for="auMfa">Require MFA</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" id="auStatus">
                                                    <option>Active</option>
                                                    <option>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
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
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#BranchListing').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection

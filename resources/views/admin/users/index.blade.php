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
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </th>
                                        <td>1</td>
                                        <td>Rajesh Kumar</td>
                                        <td>rajesh.kumar@example.com</td>
                                        <td>+91 9876543210</td>
                                        <td>Branch 1</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                     <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </th>
                                        <td>2</td>
                                        <td>Anita Sharma</td>
                                        <td>anita.sharma@example.com</td>
                                        <td>+91 9123456780</td>
                                        <td>Branch 2</td>
                                        <td><span class="badge bg-warning">Inactive</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                     <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </th>
                                        <td>3</td>
                                        <td>Sunil Patil</td>
                                        <td>sunil.patil@example.com</td>
                                        <td>+91 9988776655</td>
                                        <td>Branch 3</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                     <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </th>
                                        <td>4</td>
                                        <td>Pooja Mehta</td>
                                        <td>pooja.mehta@example.com</td>
                                        <td>+91 9876001122</td>
                                        <td>Branch 2</td>
                                        <td><span class="badge bg-danger">Locked</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                     <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </th>
                                        <td>5</td>
                                        <td>Imran Khan</td>
                                        <td>imran.khan@example.com</td>
                                        <td>+91 9765432100</td>
                                        <td>Branch 1</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                     <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </th>
                                        <td>6</td>
                                        <td>Kavita Desai</td>
                                        <td>kavita.desai@example.com</td>
                                        <td>+91 9350011223</td>
                                        <td>Branch 3</td>
                                        <td><span class="badge bg-warning">Inactive</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                     <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
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
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="fullnameInput" class="form-label">Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="fullnameInput" value="Rajesh Kumar">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Email<span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="inputEmail4" value="rajesh.kumar@example.com">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phoneNumberInput" class="form-label">Phone Number</label>
                                                    <input type="tel" class="form-control" id="phoneNumberInput" value="+91 9876543210">
                                                </div>
                                                {{-- <div class="col-md-6">
                                                    <label for="inputRole" class="form-label">Roles<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputRole" class="form-select">
                                                        <option selected>HQ</option>
                                                        <option>HQ</option>
                                                        <option>Branch User</option>
                                                        <option>Auditor </option>
                                                    </select>
                                                </div> --}}
                                                <div class="col-md-6">
                                                    <label for="inputBranch" class="form-label">Assign Branch<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputBranch" class="form-select">
                                                        <option selected>Branch 1</option>
                                                        <option>Branch 1</option>
                                                        <option>Branch 2</option>
                                                        <option>Branch 3</option>
                                                    </select>
                                                </div>

                                                <div class="col-6">
                                                    <label for="status" class="form-label d-block">Status</label>
                                                    <div class="d-flex gap-3">
                                                        <div class="form-check form-check-inline form-radio-success">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="statusActive" value="active" checked>
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
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success ">Save Changes</button>
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
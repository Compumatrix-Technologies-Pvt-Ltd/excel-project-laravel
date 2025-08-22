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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.branches.index') }}">Branch Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Branch Listing</h4>
                    <div class="card-toolbar">
                        <!-- <a href="javascript:void(0)" class="btn btn-primary fw-bold me-2">
                                                                        <i class="flaticon2-plus"></i> Create Branch
                                                                    </a> -->
                        <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#branchModal">
                            <i class="flaticon2-plus"></i> Create Branch
                        </button>
                        <div id="branchModal" class="modal fade" tabindex="-1" aria-labelledby="branchModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="branchModalLabel">Create Branch</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="branchCodeInput" class="form-label">Branch Code<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="branchCodeInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="branchNameInput" class="form-label">Branch Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="branchNameInput">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="addressInput" class="form-label">Branch Address<span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="addressInput" rows="3"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="branchPersonInput" class="form-label"></label>
                                                    <input type="text" class="form-control" id="branchPersonInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="branchContactInput" class="form-label">Branch Contact
                                                        Phone</label>
                                                    <input type="tel" class="form-control" id="branchContactInput">
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

                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="BranchListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR No.</th>
                                        <th>Branch Code</th>
                                        <th>Branch Name</th>
                                        <th>Branch Contact Person</th>
                                        <th>Branch Contact Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll">
                                            </div>
                                        </th>
                                        <td>1</td>
                                        <td>BR-001</td>
                                        <td>Branch 1</td>
                                        <td>John Doe</td>
                                        <td>+91 9876543210</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#branchEditModal">
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
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll">
                                            </div>
                                        </th>
                                        <td>2</td>
                                        <td>BR-002</td>
                                        <td>Branch 2</td>
                                        <td>Jane Smith</td>
                                        <td>+91 9123456780</td>
                                        <td><span class="badge bg-warning">Inactive</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#branchEditModal">
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
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll">
                                            </div>
                                        </th>
                                        <td>3</td>
                                        <td>BR-003</td>
                                        <td>Branch 3</td>
                                        <td>Rajesh Kumar</td>
                                        <td>+91 9988776655</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#branchEditModal">
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

                        <div id="branchEditModal" class="modal fade" tabindex="-1" aria-labelledby="branchEditModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="branchEditModalLabel">Edit Branch</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="branchCodeInput1" class="form-label">Branch Code<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="branchCodeInput1" value="BR-001">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="branchNameInput1" class="form-label">Branch Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="branchNameInput1" value="Branch 1">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="addressInput1" class="form-label">Branch Address<span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="addressInput1" rows="3">123, Dummy Street, Sample City - 400001</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="branchPersonInput1" class="form-label">Branch Contact
                                                        Person</label>
                                                    <input type="text" class="form-control" id="branchPersonInput1" value="John Doe	">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="branchContactInput1" class="form-label">Branch Contact
                                                        Phone</label>
                                                    <input type="tel" class="form-control" id="branchContactInput1" value="+91 9876543210">
                                                </div>
                                                <div class="col-6">
                                                    <label for="status1" class="form-label d-block">Status</label>
                                                    <div class="d-flex gap-3">
                                                        <div class="form-check form-check-inline form-radio-success">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="statusActive1" value="active" checked>
                                                            <label class="form-check-label"
                                                                for="statusActive">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-inline form-radio-warning">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="statusInactive1" value="inactive">
                                                            <label class="form-check-label"
                                                                for="statusInactive">Inactive</label>
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
            $('#BranchListing').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>


@endsection
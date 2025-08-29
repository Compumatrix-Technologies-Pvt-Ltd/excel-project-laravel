@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Subscription Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Subscription Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.plans') }}">Plans Listing</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Plans Listing</h4>
                    <div class="card-toolbar">

                        <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#plansModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Create Plan
                        </button>
                        <div id="plansModal" class="modal fade" tabindex="-1" aria-labelledby="plansModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="plansModalLabel">Create Plan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="fullnameInput" class="form-label">Plan Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="fullnameInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Plan Sub-Title<span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phoneNumberInput" class="form-label">Plan Price</label>
                                                    <input type="tel" class="form-control" id="phoneNumberInput">
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label for="inputStatus" class="form-label">Plan For</label>
                                                    <select id="inputStatus" class="form-select">
                                                        <option selected>Select User</option>
                                                        <option>HQ</option>
                                                        <option>Branch User</option>
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
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div id="featuresWrapper">
                                                        <div class="row mb-2 feature-row">
                                                            <div class="col-md-10">
                                                                <label class="form-label">Plan Features <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="features[]">
                                                            </div>
                                                            <div class="col-md-2 d-flex align-items-end">
                                                                <button type="button" class="btn btn-md btn-primary addBtn">
                                                                    <i class="mdi mdi-plus"></i>
                                                                </button>
                                                            </div>
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
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="PlansListing" class="table table-striped nowrap dt-responsive align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SR No.</th>
                                        <th>Plan Title</th>
                                        <th>Plan Sub-Title</th>
                                        <th>Plan Price</th>
                                        <th>Plan Features</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Plan A</td>
                                        <td>For Startup</td>
                                        <td>19</td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-warning btn-sm d-flex justify-content-center align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#viewFeatures"
                                                style="width:32px; height:32px;">
                                                <i class="mdi mdi-eye fs-16"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editPlansModal">
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
                                        <td>2</td>
                                        <td>Pro Business</td>
                                        <td>Professional plans</td>
                                        <td>29</td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-warning btn-sm d-flex justify-content-center align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#viewFeatures"
                                                style="width:32px; height:32px;">
                                                <i class="mdi mdi-eye fs-16"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editPlansModal">
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
                                        <td>3</td>
                                        <td>Enterprise Businesses</td>
                                        <td>Platinum Plan</td>
                                        <td>39</td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-warning btn-sm d-flex justify-content-center align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#viewFeatures"
                                                style="width:32px; height:32px;">
                                                <i class="mdi mdi-eye fs-16"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editPlansModal">
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


                        <!-- View Features Modal -->
                        <div id="viewFeatures" class="modal fade" tabindex="-1" aria-labelledby="viewFeaturesLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewFeaturesLabel">Plan Features</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="mdi mdi-check-circle text-success me-2"></i>
                                                1 HQ user + 1 Branch user
                                            </li>
                                            <li class="mb-2">
                                                <i class="mdi mdi-check-circle text-success me-2"></i>
                                                Unlimited suppliers, standard reports, PDF export
                                            </li>
                                            <li class="mb-2">
                                                <i class="mdi mdi-check-circle text-success me-2"></i>
                                                Email support
                                            </li>
                                            <li class="mb-2">
                                                <i class="mdi mdi-close-circle text-danger me-2"></i>
                                                <strong>24/7</strong> Support
                                            </li>
                                            <li class="mb-2">
                                                <i class="mdi mdi-close-circle text-danger me-2"></i>
                                                <strong>Unlimited</strong> Storage
                                            </li>
                                            <li class="mb-2">
                                                <i class="mdi mdi-close-circle text-danger me-2"></i>
                                                Domain
                                            </li>
                                        </ul>
                                    </div>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <!-- Edit Modal -->
                        <div id="editPlansModal" class="modal fade" tabindex="-1" aria-labelledby="editPlansModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPlansModalLabel">Edit Plan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="fullnameInput" class="form-label">Plan Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="fullnameInput"
                                                        value="Plan A">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Plan Sub-Title<span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="inputEmail4"
                                                        value="For Startups">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phoneNumberInput" class="form-label">Plan Price</label>
                                                    <input type="tel" class="form-control" id="phoneNumberInput" value="19">
                                                </div>
                                                 <div class="col-md-6">
                                                    <label for="inputStatus" class="form-label">Plan For</label>
                                                    <select id="inputStatus" class="form-select">
                                                        <option selected>HQ</option>
                                                        <option>HQ</option>
                                                        <option>Branch User</option>
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
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div id="featuresWrapper">
                                                        <div class="row mb-2 feature-row">
                                                            <div class="col-md-10">
                                                                <label class="form-label">Plan Features <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="features[]"
                                                                    value="1 HQ user + 1 Branch user">
                                                                <input type="text" class="form-control mt-3"
                                                                    name="features[]"
                                                                    value="Unlimited suppliers, standard reports, PDF export">
                                                                <input type="text" class="form-control mt-3"
                                                                    name="features[]" value="Email support">
                                                                <input type="text" class="form-control mt-3"
                                                                    name="features[]" value="24/7 Support">
                                                                <input type="text" class="form-control mt-3"
                                                                    name="features[]" value="Unlimited Storage">
                                                                <input type="text" class="form-control mt-3"
                                                                    name="features[]" value="Domain">
                                                                <input type="text" class="form-control mt-3"
                                                                    name="features[]">

                                                            </div>
                                                            <div class="col-md-2 d-flex align-items-end">
                                                                <button type="button" class="btn btn-md btn-primary addBtn">
                                                                    <i class="mdi mdi-plus"></i>
                                                                </button>
                                                            </div>
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
            $('#PlansListing').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });

            $(document).on('click', '.addBtn', function () {
                let wrapper = $('#featuresWrapper');
                let firstRow = wrapper.find('.feature-row:first');
                let newRow = firstRow.clone();

                newRow.find('input').val('');

                newRow.find('label').remove();

                newRow.find('.addBtn').remove();
                newRow.find('.col-md-2').append(`
                                <button type="button" class="btn btn-danger btn-md removeBtn">
                                    <i class="mdi mdi-minus"></i>
                                </button>
                            `);

                wrapper.append(newRow);
            });

            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.feature-row').remove();
            });
        });
    </script>



@endsection
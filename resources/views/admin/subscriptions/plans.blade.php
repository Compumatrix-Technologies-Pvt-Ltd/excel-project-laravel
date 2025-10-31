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
                    </div>
                </div>

                <div class="card-body">
                    <table id="PlansListing" class="table table-striped nowrap dt-responsive align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>SR No.</th>
                                <th>Plan Title</th>
                                <th>Plan Sub-Title</th>
                                <th>Plan Price</th>
                                <th>Plan Duration</th>
                                <th>Plan Features</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $key => $plan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $plan->plan_name }}</td>
                                    <td>{{ $plan->plan_sub_title }}</td>
                                    <td>{{ $plan->plan_price }}</td>
                                    <td>{{ ucfirst($plan->plan_duration) }}</td>

                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm view-features-btn"
                                            data-bs-toggle="modal" data-bs-target="#viewFeatures"
                                            data-features='@json($plan->features->pluck("features"))'>
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
                                                <li>
                                                    <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                        data-id="{{ base64_encode(base64_encode($plan->id)) }}">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>Edit
                                                    </a>
                                                </li>
                                                <li><a href="javascript:void(0)" onclick="return deleteCollection(this)"
                                                        data-href="{{route('admin.plans.delete', [base64_encode(base64_encode($plan->id))])}}"
                                                        class="dropdown-item remove-plan-btn"><i
                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Create Plan Modal -->
                    <div id="plansModal" class="modal fade" tabindex="-1" aria-labelledby="plansModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="plansModalLabel">Create Plan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="AddForm" action="{{ route('admin.plans.store') }}" method="POST"
                                        autocomplete="off">
                                        @csrf
                                        <div class="row gy-3">
                                            <div class="col-md-6">
                                                <label for="fullnameInput" class="form-label">Plan Name<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="fullnameInput" name="plan_name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Plan Sub-Title<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputEmail4"
                                                    name="plan_sub_title">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phoneNumberInput" class="form-label">Plan Price</label>
                                                <input type="text" class="form-control" id="phoneNumberInput"
                                                    name="plan_price">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phoneNumberInput" class="form-label">Plan Duration</label>
                                                <select name="plan_duration" class="form-control">
                                                    <option value="">Select Duration</option>
                                                    <option value="3-month">For 3 Month</option>
                                                    <option value="6-month">For 6 Month</option>
                                                    <option value="year">For Year</option>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label for="status" class="form-label d-block">Status</label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check form-check-inline form-radio-success">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="statusActive" value="active" checked>
                                                        <label class="form-check-label" for="statusActive">Active</label>
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
                                                <div id="createFeaturesWrapper">
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
                                        <div class="modal-footer mt-3">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View Features Modal -->
                    <div id="viewFeatures" class="modal fade" tabindex="-1" aria-labelledby="viewFeaturesLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="viewFeaturesLabel">Plan Features</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <ul id="featuresList" class="list-unstyled mb-0"></ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Plan Modal -->
                    <div id="editPlansModal" class="modal fade" tabindex="-1" aria-labelledby="editPlansModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="editPlansModalLabel">Edit Plan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="updateForm" action="{{ route('admin.plans.update') }}" method="POST"
                                        autocomplete="off">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" id="hidden_id">
                                        <div class="row gy-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Plan Name</label>
                                                <input type="text" class="form-control" name="plan_name"
                                                    id="fullnameInput1">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Plan Sub-Title</label>
                                                <input type="text" class="form-control" name="plan_sub_title" id="subtitle">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Plan Price</label>
                                                <input type="number" class="form-control" name="plan_price" id="planprice">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phoneNumberInput" class="form-label">Plan Duration</label>
                                                <select name="plan_duration" id="plan_duration" class="form-control">
                                                    <option value="3-month">For 3 Month</option>
                                                    <option value="6-month">For 6 Month</option>
                                                    <option value="year">For Year</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="editStatus" class="form-label d-block">Status</label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check form-check-inline form-radio-success">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="editStatusActive" value="active">
                                                        <label class="form-check-label"
                                                            for="editStatusActive">Active</label>
                                                    </div>
                                                    <div class="form-check form-check-inline form-radio-warning">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="editStatusInactive" value="inactive">
                                                        <label class="form-check-label"
                                                            for="editStatusInactive">Inactive</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <label class="form-label">Plan Features</label>
                                                <div id="editFeaturesWrapper"></div>
                                                <button type="button" class="btn btn-sm btn-secondary mt-2"
                                                    id="addFeatureBtn" name="features[]"><i class="mdi mdi-plus"></i> Add
                                                    More
                                                    Feature</button>
                                            </div>
                                        </div>
                                        <div class="modal-footer mt-3">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div>
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

    <script>
        $(document).ready(function () {
            $('#PlansListing').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });

            $(document).on('click', '.view-features-btn', function () {
                let features = $(this).data('features');
                let $list = $('#featuresList');
                $list.empty();

                if (features && features.length > 0) {
                    features.forEach(feature => {
                        $list.append(`<li class="mb-2"><i class="mdi mdi-check-circle text-success me-2"></i>${feature}</li>`);
                    });
                } else {
                    $list.append('<li class="text-muted">No features available.</li>');
                }
            });


            $(document).on('click', '.edit-item-btn', function () {
                let encrypted_id = $(this).data('id');
                let action = "{{ url('admin/plans/edit') }}/" + encrypted_id;

                $('#editPlansModal').modal('show');
                $('#updateForm')[0].reset();
                $('#editFeaturesWrapper').empty();

                $.ajax({
                    type: "GET",
                    url: action,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 'success') {
                            const data = response.data;

                            $('#hidden_id').val(encrypted_id);
                            $('#fullnameInput1').val(data.plan_name);
                            $('#subtitle').val(data.sub_title);
                            $('#planprice').val(data.price);
                            $('#plan_duration').val(data.plan_duration);
                            // Set status
                            if (data.status === 'active') {
                                $('#editStatusActive').prop('checked', true);
                            } else {
                                $('#editStatusInactive').prop('checked', true);
                            }


                            if (data.features && data.features.length > 0) {
                                data.features.forEach((feature, index) => {
                                    $('#editFeaturesWrapper').append(`
                                                <div class="row mb-2 feature-row">
                                                    <div class="col-md-10">
                                                        ${index === 0 ? '<label class="form-label">Plan Features <span class="text-danger">*</span></label>' : ''}
                                                        <input type="text" class="form-control mt-2" name="features[]" value="${feature}">
                                                    </div>
                                                    <div class="col-md-2 d-flex align-items-end">
                                                        ${index === 0
                                            ? `<button type="button" class="btn btn-md btn-primary addBtn"><i class="mdi mdi-plus"></i></button>`
                                            : `<button type="button" class="btn btn-md btn-danger removeBtn"><i class="mdi mdi-minus"></i></button>`}
                                                    </div>
                                                </div>
                                            `);
                                });
                            } else {
                                $('#editFeaturesWrapper').append(`
                                                                        <div class="row mb-2 feature-row">
                                                                            <div class="col-md-10">
                                                                                <input type="text" class="form-control" name="features[]" value="">
                                                                            </div>
                                                                            <div class="col-md-2 d-flex align-items-end">
                                                                                <button type="button" class="btn btn-md btn-primary addBtn"><i class="mdi mdi-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    `);
                            }
                        } else {
                            alert('Error loading plan data.');
                        }
                    },
                    error: function () {
                        alert('Failed to fetch plan details.');
                    }
                });
            });

            // Add/Remove feature rows dynamically
            $(document).on('click', '.addBtn', function () {
                let newRow = `
                                    <div class="row mb-2 feature-row">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mt-2" name="features[]" value="">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-md btn-danger removeBtn"><i class="mdi mdi-minus"></i></button>
                                        </div>
                                    </div>`;
                $('#createFeaturesWrapper').append(newRow);
            });


            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.feature-row').remove();
            });

            // Fix: Add More Feature button inside Edit Modal
            $(document).on('click', '#addFeatureBtn', function () {
                $('#editFeaturesWrapper').append(`
                                <div class="row mb-2 feature-row">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mt-2" name="features[]" value="">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-md btn-danger removeBtn">
                                            <i class="mdi mdi-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            `);
            });

            // Make sure all preloaded feature rows show remove buttons when Edit Modal opens
            $(document).on('shown.bs.modal', '#editPlansModal', function () {
                let $wrapper = $('#editFeaturesWrapper');
                $wrapper.find('.addBtn')
                    .removeClass('btn-primary addBtn')
                    .addClass('btn-danger removeBtn')
                    .html('<i class="mdi mdi-minus"></i>');
            });


        });
    </script>
@endsection
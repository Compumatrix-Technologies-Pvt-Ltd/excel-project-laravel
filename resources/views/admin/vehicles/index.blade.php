@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Vehicle Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Vehicle Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.vehicles.index') }}">Vehicle Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Vehicle Listing</h4>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-info btn-label waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#VehicleModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add Vehicle
                        </button>
                        <div id="VehicleModal" class="modal fade" tabindex="-1" aria-labelledby="VehicleModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="VehicleModalLabel">Add Vehicle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="AddForm" action="{{ route('admin.vehicles.store') }}" method="post"
                                        class="form" autocomplete="off" role="form">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row gy-4">
                                              
                                                <div class="col-md-12 form-group">
                                                    <label for="VehicleName" class="form-label">
                                                        Vehicle Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="VehicleName" name="name"
                                                        required data-error="Please enter Vehicle Name">
                                                    <span class="help-block with-errors err_name" style="color:red;"></span>
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
                </div><!-- end card header -->
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
                                        <th>Vehicle Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Vehicles as $index => $vehicle)
                                        <tr>
                                            <td>
                                                <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                                </div>
                                            </td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $vehicle->name }}</td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown"><i
                                                            class="ri-more-fill align-middle"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                                data-id="{{base64_encode(base64_encode($vehicle->id))}}"
                                                                id="edit-vehicle-btn">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li><a href="javascript:void(0)" onclick="return deleteCollection(this)"
                                                                data-href="{{route('admin.vehicles.destroy', [base64_encode(base64_encode($vehicle->id))])}}"
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
                    <div id="editVehicleModal" class="modal fade" tabindex="-1" aria-labelledby="editVehicleModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editVehicleModalLabel">Edit Vehicle</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <form id="updateForm" action="{{ route('admin.vehicles.update') }}" method="post"
                                    class="form" autocomplete="off" role="form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" id="hidden_id" name="id">
                                        <div class="row gy-4">

                                            <div class="col-md-12 form-group">
                                                <label for="VehicleName" class="form-label">
                                                    Vehicle Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="Vehicle_Name" name="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
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
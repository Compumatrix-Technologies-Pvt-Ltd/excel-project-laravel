@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Mill Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Mill Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.mill.management') }}">Mill Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Mill Listing</h4>
                    <div class="card-toolbar">
                        <a href="{{ asset('storage/app/public/cash-purchase-pdf/VC_202505 _Cash_Purchase_Summary.pdf') }}"
                            class="btn btn-primary btn-label waves-effect waves-light"
                            download="VC_202505 _Cash_Purchase_Summary.pdf">
                            <i class="mdi mdi-microsoft-excel label-icon align-middle fs-17 me-2"></i>Sample Excel
                        </a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#branchModal"
                            class="btn btn-warning btn-label waves-effect waves-ligh">
                            <i class="mdi mdi-cloud-download-outline label-icon align-middle fs-16 me-2"></i> Import Excel
                        </button>
                        <button type="button" class="btn btn-info btn-label waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#MillModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add Mill
                        </button>
                        <div id="MillModal" class="modal fade" tabindex="-1" aria-labelledby="MillModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="MillModalLabel">Mill Data Entry</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="millIdInput" class="form-label">
                                                        Mill Id <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="millIdInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="millNameInput" class="form-label">Mill Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="millNameInput">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="mpobNo" class="form-label">MPOB Licence Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="mpobNo">
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
                            <table id="MillListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR.No</th>
                                        <th>Mill_Id</th>
                                        <th>Mill_Name</th>
                                        <th>MPOB_Lic_No</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>1.</td>
                                        <td>Atlantica</td>
                                        <td>Atlantica Palm Oil Mill Sdn. Bhd.</td>
                                        <td>500262404000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>2.</td>
                                        <td>Bell</td>
                                        <td>Kilang Sawit Bell Sdn Bhd</td>
                                        <td>500359104000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>3.</td>
                                        <td>FGVPM-Baidur</td>
                                        <td>Felda Global Ventures Plantations</td>
                                        <td>594461015000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>4.</td>
                                        <td>HCahaya</td>
                                        <td>Halus Cahaya Sdn Bhd</td>
                                        <td>543034115000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>5.</td>
                                        <td>HCahaya (Ban)</td>
                                        <td>Halus Cahaya Sdn Bhd</td>
                                        <td>537245015000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>6.</td>
                                        <td>KLK Agri</td>
                                        <td>KLK Agri Oils Sdn Bhd</td>
                                        <td>579635004000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>7.</td>
                                        <td>KSBA</td>
                                        <td>FGV Trading Sdn Bhd</td>
                                        <td>618460015000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>8.</td>
                                        <td>LCH</td>
                                        <td>LCH Palm Oil Mill Sdn. Bhd.</td>
                                        <td>617919104000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>9.</td>
                                        <td>LHassan</td>
                                        <td>Ladang Hassan Palm Oil Mill</td>
                                        <td>508118404000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>10.</td>
                                        <td>LPermai (BPPC)</td>
                                        <td>Ladang Permai Sdn Bhd</td>
                                        <td>500224104000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>11.</td>
                                        <td>LPermai (PPO)</td>
                                        <td>Ladang Permai Sdn Bhd</td>
                                        <td>500115604000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>12.</td>
                                        <td>Prolific</td>
                                        <td>Prolific Yield Palm Oil Mill</td>
                                        <td>500256004000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>13.</td>
                                        <td>TEOPP</td>
                                        <td>Tanah Emas Oil Palm Processing Sdn. Bhd.</td>
                                        <td>500282904000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>14.</td>
                                        <td>THP</td>
                                        <td>THP Sabaco Sdn. Bhd.</td>
                                        <td>509162704000</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editMillModal">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item remove-item-btn"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--end row-->
                    </div>
                    <div id="editMillModal" class="modal fade" tabindex="-1" aria-labelledby="editMillModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMillModalLabel">Mill Data Entry</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row gy-4">
                                        <form action="javascript:void(0);" class="row g-3">
                                            <div class="col-md-6">
                                                <label for="millIdInput" class="form-label">
                                                    Mill Id <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="millIdInput" value="Atlantica">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="millNameInput" class="form-label">Mill Name<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="millNameInput"
                                                    value="Atlantica Palm Oil Mill Sdn. Bhd.">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="mpobNo" class="form-label">MPOB Licence Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mpobNo" value="500262404000">
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
        $(document).ready(function () {
            $('#MillListing').DataTable({
                paging: true,
                searching: true,
                ordering: true

            });
        });
    </script>
@endsection
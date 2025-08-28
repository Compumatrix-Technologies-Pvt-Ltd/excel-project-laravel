@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Supplier Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Supplier Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.suppliers.index') }}">Supplier
                                Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Supplier Listing</h4>
                    <div class="card-toolbar">
                         <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#supplierModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add Supplier
                        </button>
                        <div id="supplierModal" class="modal fade" tabindex="-1" aria-labelledby="supplierModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="supplierModalLabel">Add New Supplier</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="supplierCodeInput" class="form-label">
                                                        Supplier Id <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="supplierCodeInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="supplierNameInput" class="form-label">Supplier Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="supplierNameInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="supplierAddress1" class="form-label">Address 1<span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="supplierAddress1"
                                                        rows="3"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="supplierAddress2" class="form-label">Address 2</label>
                                                    <textarea class="form-control" id="supplierAddress2"
                                                        rows="3"></textarea>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="inputEmail" class="form-label">Email<span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="inputEmail">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="inputTel1" class="form-label">Telphone 1<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="inputTel1">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="inputTel2" class="form-label">Telephone 2</label>
                                                    <input type="tel" class="form-control" id="inputTel2">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputBankId" class="form-label">Bank ID<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="inputBankId">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputBankAcc" class="form-label">Bank Acc.No<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="inputBankAcc">
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
                            <table id="HqSupplierListing" class="table nowrap dt-responsive align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR No.</th>
                                        <th>Supplier Id</th>
                                        <th>Supplier Name</th>
                                        <th>Telephone Number</th>
                                        <th>Email</th>
                                        <th>Bank Id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>1</td>
                                        <td>ACH</td>
                                        <td>ACH FFB Collecting (KDT/2022/3545)</td>
                                        <td>0196685729</td>
                                        <td>venusleong18@yahoo.com</td>
                                        <td>AMB</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>2</td>
                                        <td>Aplas</td>
                                        <td>Aplas Sawit Sdn Bhd 201801007441 (1269455-K)</td>
                                        <td>0124119791</td>
                                        <td>-</td>
                                        <td>PBB</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>3</td>
                                        <td>Arunamari</td>
                                        <td>Arunamari Estates Sdn Bhd 200501006007 (683054-D)</td>
                                        <td>0126291283</td>
                                        <td>arunamarisandakan@gmail.com</td>
                                        <td>CIMB</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>4</td>
                                        <td>B&F Coll.</td>
                                        <td>B & F Collection Sdn Bhd</td>
                                        <td>0168068982</td>
                                        <td>zihjunfam524@gmail.com</td>
                                        <td>-</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>5</td>
                                        <td>B&F Collection</td>
                                        <td>B & F Collection Centre Sdn Bhd 201001035502 (919421-P)</td>
                                        <td>0168318581</td>
                                        <td>-</td>
                                        <td>PBB</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>6</td>
                                        <td>BF</td>
                                        <td>B & F Enterprise</td>
                                        <td>-</td>
                                        <td>bf@gmail.com</td>
                                        <td>-</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>7</td>
                                        <td>Borneo Crops</td>
                                        <td>Borneo Crops Sdn Bhd 197901008441 (52728-T)</td>
                                        <td>089237900</td>
                                        <td>borneocrops@yahoo.com</td>
                                        <td>CIMB</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>8</td>
                                        <td>Bumimas</td>
                                        <td>Bumimas Sawit 88 Sdn Bhd 200901020762 (1376992-U)</td>
                                        <td>0185931315</td>
                                        <td>bumimas88sdnbhd@gmail.com</td>
                                        <td>CIMB</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>9</td>
                                        <td>Cemerleng</td>
                                        <td>Cemerleng Enterprise</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>10</td>
                                        <td>COC Sawit</td>
                                        <td>COC Sawit Sdn Bhd 201401022839 (109825-P)</td>
                                        <td>089631368</td>
                                        <td>cocsawit.sdk@gmail.com</td>
                                        <td>CIMB</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                                        <td>11</td>
                                        <td>Emasawit</td>
                                        <td>Emasawit Awana Sdn Bhd (116081-H)</td>
                                        <td>0138371223</td>
                                        <td>habibal.79@yahoo.com</td>
                                        <td>ALB</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown"><i
                                                        class="ri-more-fill align-middle"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#editSupplierModal">
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
                         <div id="editSupplierModal" class="modal fade" tabindex="-1"
                                aria-labelledby="editSupplierModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row gy-4">
                                                <form action="javascript:void(0);" class="row g-3">
                                                    <div class="col-md-6">
                                                        <label for="supplierCodeInput" class="form-label">
                                                            Supplier Id <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="supplierCodeInput" value="ACH">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="supplierNameInput" class="form-label">Supplier Name<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="supplierNameInput" value="ACH FFB Collecting (KDT/2022/3545)">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="supplierAddress1" class="form-label">Address 1<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="supplierAddress1"
                                                            rows="3">CL 055311414, Kg Tinangol, Jalan Tinangol, 89050 Kudat, Sabah.</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="supplierAddress2" class="form-label">Address 2</label>
                                                        <textarea class="form-control" id="supplierAddress2"
                                                            rows="3"></textarea>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputEmail" class="form-label">Email<span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="inputEmail" value="venusleong18@yahoo.com">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputTel1" class="form-label">Telphone 1<span
                                                                class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" id="inputTel1" value="0196685729">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputTel2" class="form-label">Telephone 2</label>
                                                        <input type="tel" class="form-control" id="inputTel2">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputBankId" class="form-label">Bank ID<span
                                                                class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" id="inputBankId" value="AMB">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputBankAcc" class="form-label">Bank Acc.No<span
                                                                class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control" id="inputBankAcc" value="1692022005890">
                                                    </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success ">Save Changes</button>
                                        </div>
                                        </form>

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
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
            $('#HqSupplierListing').DataTable({
                paging: true,
                searching: true,
                ordering: true

            });
        });
    </script>


@endsection
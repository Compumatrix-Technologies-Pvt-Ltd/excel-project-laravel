@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Deductions</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Deductions</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.deductions.index') }}">Deduction
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
                <div class="card-header align-items-center d-flex justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">Deduction Listing</h4>
                    <div class="card-toolbar">
                        <!-- <a href="javascript:void(0)" class="btn btn-primary fw-bold me-2">
                                                                                                                                                                            <i class="flaticon2-plus"></i> Create Branch
                                                                                                                                                                        </a> -->
                        <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#deductionModal">
                            <i class="flaticon2-plus"></i> Add Deduction
                        </button>
                        <div id="deductionModal" class="modal fade" tabindex="-1" aria-labelledby="deductionModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deductionModalLabel">Add Deduction</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="deductionDate" class="form-label">Date<span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="deductionDate">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="periodInput" class="form-label">Period<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="periodInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputSupplier" class="form-label">Suppliers<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputSupplier" class="form-select">
                                                        <option selected>Select Supplier code</option>
                                                        <option>VC-A-F013</option>
                                                        <option>VC-A-M106</option>
                                                        <option>VC-A-R027</option>
                                                        <option>VC-A-S070</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="typeInput" class="form-label">Type<span
                                                            class="text-danger">*</span></label>
                                                    <select id="typeInput" class="form-select">
                                                        <option selected>Select Type</option>
                                                        <option>Transpost</option>
                                                        <option>Advance</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="amountInput" class="form-label">Amount</label>
                                                    <input type="text" class="form-control" id="amountInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="remarkInput" class="form-label">Remark</label>
                                                    <input type="text" class="form-control" id="remarkInput">
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
                            <table id="DeductionListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR No.</th>
                                        <th>Period</th>
                                        <th>Date</th>
                                        <th>Supplier ID</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Remark</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>1</td>
                                        <td>2025-Q1</td>
                                        <td>2025-01-12</td>
                                        <td>VC-A-F013</td>
                                        <td>Advance</td>
                                        <td>1,000.00</td>
                                        <td>S.ADV 026</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>2</td>
                                        <td>2025-Q1</td>
                                        <td>2025-01-20</td>
                                        <td>VC-A-M106</td>
                                        <td>Transport</td>
                                        <td>2,500.00</td>
                                        <td>S.TRN 045</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>3</td>
                                        <td>2025-Q1</td>
                                        <td>2025-01-28</td>
                                        <td>VC-A-R027</td>
                                        <td>Others</td>
                                        <td>3,200.00</td>
                                        <td>S.OTH 011</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>4</td>
                                        <td>2025-Q2</td>
                                        <td>2025-02-05</td>
                                        <td>VC-A-S070</td>
                                        <td>Advance</td>
                                        <td>1,800.00</td>
                                        <td>S.ADV 030</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>5</td>
                                        <td>2025-Q2</td>
                                        <td>2025-02-12</td>
                                        <td>VC-A-F013</td>
                                        <td>Transport</td>
                                        <td>4,100.00</td>
                                        <td>S.TRN 052</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>6</td>
                                        <td>2025-Q2</td>
                                        <td>2025-02-19</td>
                                        <td>VC-A-M106</td>
                                        <td>Others</td>
                                        <td>950.00</td>
                                        <td>S.OTH 018</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>7</td>
                                        <td>2025-Q3</td>
                                        <td>2025-03-03</td>
                                        <td>VC-A-R027</td>
                                        <td>Advance</td>
                                        <td>2,750.00</td>
                                        <td>S.ADV 037</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>8</td>
                                        <td>2025-Q3</td>
                                        <td>2025-03-15</td>
                                        <td>VC-A-S070</td>
                                        <td>Transport</td>
                                        <td>5,600.00</td>
                                        <td>S.TRN 060</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>9</td>
                                        <td>2025-Q3</td>
                                        <td>2025-03-22</td>
                                        <td>VC-A-F013</td>
                                        <td>Others</td>
                                        <td>1,450.00</td>
                                        <td>S.OTH 025</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox"></td>
                                        <td>10</td>
                                        <td>2025-Q4</td>
                                        <td>2025-04-02</td>
                                        <td>VC-A-M106</td>
                                        <td>Advance</td>
                                        <td>3,900.00</td>
                                        <td>S.ADV 042</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Clear Deduction
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div><!--end row-->
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
            $('#DeductionListing').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>


@endsection
@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Transaction Management</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Transaction Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.transactions.index') }}">Transaction
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
                    <h4 class="card-title mb-0 flex-grow-1">Transaction Listing</h4>
                    <div class="card-toolbar">
                        <!-- <a href="javascript:void(0)" class="btn btn-primary fw-bold me-2">
                                                                                                                                <i class="flaticon2-plus"></i> Create Branch
                                                                                                                            </a> -->
                        <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#transactionModal">
                            <i class="flaticon2-plus"></i> Create Transaction
                        </button>
                        <div id="transactionModal" class="modal fade" tabindex="-1" aria-labelledby="transactionModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transactionModalLabel">Add Transaction</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="TRXDate" class="form-label">TRX Date</label>
                                                    <input type="date" class="form-control" id="TRXDate">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="trxNoInput" class="form-label">TRX No.<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="trxNoInput">
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
                                                    <label for="ticketNoInput" class="form-label">Ticket Number<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ticketNoInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="wieghtMtInput" class="form-label">Weight (MT)<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="wieghtMtInput">
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
                                        <th>TRX No</th>
                                        <th>TRX Date</th>
                                        <th>Supplier Code</th>
                                        <th>Weight</th>
                                        <th>Ticket No</th>
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
                                        <td>T25010001</td>
                                        <td>02-Jan-2025</td>
                                        <td>VC-A-N044</td>
                                        <td>0.60</td>
                                        <td>088019</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>2</td>
                                        <td>T25010002</td>
                                        <td>03-Jan-2025</td>
                                        <td>VC-B-N045</td>
                                        <td>1.20</td>
                                        <td>088020</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>3</td>
                                        <td>T25010003</td>
                                        <td>04-Jan-2025</td>
                                        <td>VC-C-N046</td>
                                        <td>0.95</td>
                                        <td>088021</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>4</td>
                                        <td>T25010004</td>
                                        <td>05-Jan-2025</td>
                                        <td>VC-D-N047</td>
                                        <td>1.40</td>
                                        <td>088022</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>5</td>
                                        <td>T25010005</td>
                                        <td>06-Jan-2025</td>
                                        <td>VC-E-N048</td>
                                        <td>0.75</td>
                                        <td>088023</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>6</td>
                                        <td>T25010006</td>
                                        <td>07-Jan-2025</td>
                                        <td>VC-F-N049</td>
                                        <td>1.10</td>
                                        <td>088024</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>7</td>
                                        <td>T25010007</td>
                                        <td>08-Jan-2025</td>
                                        <td>VC-G-N050</td>
                                        <td>0.85</td>
                                        <td>088025</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>8</td>
                                        <td>T25010008</td>
                                        <td>09-Jan-2025</td>
                                        <td>VC-H-N051</td>
                                        <td>1.30</td>
                                        <td>088026</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>9</td>
                                        <td>T25010009</td>
                                        <td>10-Jan-2025</td>
                                        <td>VC-I-N052</td>
                                        <td>0.70</td>
                                        <td>088027</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>10</td>
                                        <td>T25010010</td>
                                        <td>11-Jan-2025</td>
                                        <td>VC-J-N053</td>
                                        <td>1.50</td>
                                        <td>088028</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>11</td>
                                        <td>T25010011</td>
                                        <td>12-Jan-2025</td>
                                        <td>VC-K-N054</td>
                                        <td>0.65</td>
                                        <td>088029</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>12</td>
                                        <td>T25010012</td>
                                        <td>13-Jan-2025</td>
                                        <td>VC-L-N055</td>
                                        <td>1.25</td>
                                        <td>088030</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>13</td>
                                        <td>T25010013</td>
                                        <td>14-Jan-2025</td>
                                        <td>VC-M-N056</td>
                                        <td>0.80</td>
                                        <td>088031</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>14</td>
                                        <td>T25010014</td>
                                        <td>15-Jan-2025</td>
                                        <td>VC-N-N057</td>
                                        <td>1.35</td>
                                        <td>088032</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>15</td>
                                        <td>T25010015</td>
                                        <td>16-Jan-2025</td>
                                        <td>VC-O-N058</td>
                                        <td>0.90</td>
                                        <td>088033</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>16</td>
                                        <td>T25010016</td>
                                        <td>17-Jan-2025</td>
                                        <td>VC-P-N059</td>
                                        <td>1.45</td>
                                        <td>088034</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>17</td>
                                        <td>T25010017</td>
                                        <td>18-Jan-2025</td>
                                        <td>VC-Q-N060</td>
                                        <td>0.55</td>
                                        <td>088035</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>18</td>
                                        <td>T25010018</td>
                                        <td>19-Jan-2025</td>
                                        <td>VC-R-N061</td>
                                        <td>1.10</td>
                                        <td>088036</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>19</td>
                                        <td>T25010019</td>
                                        <td>20-Jan-2025</td>
                                        <td>VC-S-N062</td>
                                        <td>0.95</td>
                                        <td>088037</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>20</td>
                                        <td>T25010020</td>
                                        <td>21-Jan-2025</td>
                                        <td>VC-T-N063</td>
                                        <td>1.20</td>
                                        <td>088038</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#transactionEditModal">
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

                        <div id="transactionEditModal" class="modal fade" tabindex="-1"
                            aria-labelledby="transactionEditModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transactionEditModalLabel">Edit Transaction</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="TRXDate" class="form-label">TRX Date</label>
                                                    <input type="" class="form-control" id="TRXDate" value="03-Jan-2025">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="trxNoInput" class="form-label">TRX No.<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="trxNoInput"
                                                        value="T25010002">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputSupplier" class="form-label">Suppliers<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputSupplier" class="form-select">
                                                        <option selected>VC-A-F013</option>
                                                        <option>VC-A-F013</option>
                                                        <option>VC-A-M106</option>
                                                        <option>VC-A-R027</option>
                                                        <option>VC-A-S070</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="ticketNoInput" class="form-label">Ticket Number<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ticketNoInput"
                                                        value="088020">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="wieghtMtInput" class="form-label">Weight (MT)<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="wieghtMtInput" value="1.20">
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
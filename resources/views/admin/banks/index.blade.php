@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Bank Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Bank Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.banks.index') }}">Bank Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Bank Listing</h4>
                    <div class="card-toolbar">

                        <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#bankModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Create Bank
                        </button>
                        <div id="bankModal" class="modal fade" tabindex="-1" aria-labelledby="bankModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bankModalLabel">Create Bank</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="AddForm" action="{{ route('admin.banks.store') }}" method="post" class="form"
                                        autocomplete="off" role="form">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row gy-4">
                                                <div class="col-md-6 form-group">
                                                    <label for="bankId" class="form-label">Bank ID<span
                                                            class="text-danger">*</span></label>
                                                    <input type="hidden" name="hidden_user_id" id="hidden_user_id" value="{{ isset($userId) ? $userId : null }}">
                                                    <input type="text" class="form-control" id="bankId" name="bank_id"
                                                        required data-error="Please enter bank Id">
                                                    <span class="help-block with-errors err_bank_id"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="bankName" class="form-label">Bank Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="bankName" name="name"
                                                        required data-error="Please enter bank name">
                                                    <span class="help-block with-errors err_name" style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="bicCode" class="form-label">BIC Code</label>
                                                    <input type="text" class="form-control" id="bicCode" name="bic_code"
                                                        required data-error="Please enter BIC code">
                                                    <span class="help-block with-errors err_bic_code"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-6 form-group">
                                                    <label for="payType" class="form-label d-block">Pay Type</label>
                                                    <div class="d-flex gap-3">
                                                        <div class="form-check form-check-inline form-radio-info">
                                                            <input class="form-check-input" type="radio" name="pay_type" value="pbb" checked required
                                                                data-error="Please select a pay type.">
                                                            <label class="form-check-label" for="PBBType">PBB</label>
                                                        </div>
                                                        <div class="form-check form-check-inline form-radio-info">
                                                            <input class="form-check-input" type="radio" name="pay_type" value="ibg">
                                                            <label class="form-check-label" for="IBGType">IBG</label>
                                                        </div>
                                                        <div class="form-check form-check-inline form-radio-info">
                                                            <input class="form-check-input" type="radio" name="pay_type" value="ren">
                                                            <label class="form-check-label" for="RENType">REN</label>
                                                        </div>
                                                    </div>
                                                    <span class="help-block with-errors err_pay_type"
                                                        style="color:red;"></span>
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
                </div>

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
                                        <th>SR No.</th>
                                        <th>Bank ID</th>
                                        <th>Bank Name</th>
                                        <th>BIC Code</th>
                                        <th>Pay type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banks as $index => $bank)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                        name="checkAll"></div>
                                            </th>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $bank->bank_id }}</td>
                                            <td>{{ $bank->name }}</td>
                                            <td>{{ $bank->bic_code }}</td>
                                            <td><span class="badge bg-info">IBG</span></td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown"><i
                                                            class="ri-more-fill align-middle"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                                                data-id="{{base64_encode(base64_encode($bank->id))}}"
                                                                id="edit-bank-btn">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li><a href="javascript:void(0)" onclick="return deleteCollection(this)"
                                                                data-href="{{route('admin.banks.destroy', [base64_encode(base64_encode($bank->id))])}}"
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

                        <div id="bankEditModal" class="modal fade" tabindex="-1" aria-labelledby="bankEditModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bankEditModalLabel">Edit Bank</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="updateForm" action="{{ route('admin.banks.update') }}" method="post" class="form"
                                        autocomplete="off" role="form">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row gy-4">
                                                <div class="col-md-6 form-group">
                                                    <input type="hidden" id="hidden_id" name="id">
                                                    <input type="hidden" name="hidden_user_id" id="hidden_user_id" value="{{ isset($userId) ? $userId : null }}">
                                                    <label for="bankIdInput" class="form-label">Bank ID<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="bankIdInput" name="bank_id">
                                                    <span class="help-block with-errors err_bank_id"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="bankNameInput" class="form-label">Bank Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="bankNameInput" name="name">
                                                    <span class="help-block with-errors err_name" style="color:red;"></span>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="bicCodeInput" class="form-label">BIC Code</label>
                                                    <input type="text" class="form-control" id="bicCodeInput" name="bic_code"
                                                        required data-error="Please enter BIC code">
                                                    <span class="help-block with-errors err_bic_code"
                                                        style="color:red;"></span>
                                                </div>
                                                <div class="col-6 form-group">
                                                    <label for="payTypeInput" class="form-label d-block">Pay Type</label>
                                                    <div class="d-flex gap-3">
                                                        <div class="form-check form-check-inline form-radio-info">
                                                            <input class="form-check-input" type="radio" name="pay_type"
                                                                id="PBBType" value="pbb">
                                                            <label class="form-check-label" for="PBBType">PBB</label>
                                                        </div>
                                                        <div class="form-check form-check-inline form-radio-info">
                                                            <input class="form-check-input" type="radio" name="pay_type"
                                                                id="IBGType" value="ibg">
                                                            <label class="form-check-label" for="IBGType">IBG</label>
                                                        </div>
                                                        <div class="form-check form-check-inline form-radio-info">
                                                            <input class="form-check-input" type="radio" name="pay_type"
                                                                id="RENType" value="ren">
                                                            <label class="form-check-label" for="RENType">REN</label>
                                                        </div>
                                                    </div>
                                                    <span class="help-block with-errors err_pay_type"
                                                        style="color:red;"></span>
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
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>

@endsection
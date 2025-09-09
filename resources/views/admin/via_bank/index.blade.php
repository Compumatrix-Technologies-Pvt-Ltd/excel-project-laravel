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
            
                    </div>
                </div>

                <div class="card-body">
                   <div class="container-fluid">
                        <div class="row">
                            <table id="UsersTable" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    id="checkAll"></div>
                                        </th>
                                        <th>SR No.</th>
                                        <th>Payment Type</th>
                                        <th>Bene Account No.</th>
                                        <th>BIC</th>
                                        <th>Bene Full Name</th>
                                        <th>ID Type</th>
                                        <th>Bene ID No.</th>
                                        <th>Amount</th>
                                        <th>Recipient Reference</th>
                                        <th>Bene Email 1</th>
                                        <th>Bene Email 2</th>
                                        <th>Bene Mobile 1</th>
                                        <th>Bene Mobile 2</th>
                                        <th>Joint Bene Name</th>
                                        <th>Joint Bene ID</th>
                                        <th>E-mail Content Line 1</th>
                                        <th>E-mail Content Line 2</th>
                                        <th>E-mail Content Line 3</th>
                                        <th>E-mail Content Line 4</th>
                                        <th>E-mail Content Line 5</th>
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
                                        <td>PBB</td>
                                        <td>4854993131</td>
                                        <td>PBBEMYKL</td>
                                        <td>ASHARIN BIN SUHARDI (K/P: 810504-12-5507)</td>
                                        <td>N</td>
                                        <td>810504125507</td>
                                        <td class="text-end">3,486.36</td>
                                        <td>FFB Final - 042025</td>
                                        <td>asharin@email.com</td>
                                        <td></td>
                                        <td>0138772457</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Congrats! Your payment…</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#paymentModal">
                                                <i class="ri-eye-line align-middle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Other rows ... (copy as needed) -->
                                </tbody>
                            </table>
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
            $('#DeductionListing').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>


@endsection
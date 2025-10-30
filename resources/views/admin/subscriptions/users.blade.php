@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Clients Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Clients Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Clients Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Clients Listing</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="UsersTable" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR No.</th>
                                        <th>Company Logo</th>
                                        <th>Company Name</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($allPlanUsers as $index => $user)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                                </div>
                                            </th>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($user->company && $user->company->logo && file_exists(storage_path('app/public/company-logos/' . $user->company->logo)))
                                                    <img src="{{ asset('storage/company-logos/' . $user->company->logo) }}"
                                                        class="avatar-sm p-2 rounded" alt="Company Logo">
                                                @else
                                                    <img src="{{ asset('assets/admin/images/companies/img-2.png') }}"
                                                        class="avatar-sm p-2 rounded" alt="Default Logo">
                                                @endif
                                            </td>

                                            <td>{{$user->company->name}}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile_number }}</td>
                                            <td>@if ($user->status == 'active')
                                                <span class="badge bg-success">{{ $user->status }}</span>
                                            @else
                                                    <span class="badge bg-warning">{{ $user->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning openCompanyModal"
                                                    data-bs-toggle="modal" data-bs-target="#myModal"
                                                    data-company-id="{{ $user->company->id }}">
                                                    <i class="ri-eye-line align-middle"></i>
                                                </button>
                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div><!--end row-->

                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title" id="myModalLabel">Company Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row g-3">
                                            {{-- User Details --}}

                                            {{-- Company Details --}}
                                            <div class="col-md-6">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" id="modal_company_name" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Code</label>
                                                <input type="text" id="modal_company_code" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="text" id="modal_company_email" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Phone</label>
                                                <input type="text" id="modal_company_phone" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Address</label>
                                                <textarea id="modal_company_address" class="form-control" readonly rows="3"
                                                    cols="3"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Registration No.</label>
                                                <input type="text" id="modal_company_registration" class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">MPOB License No.</label>
                                                <input type="text" id="modal_company_mpob_license" class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">MPOB Expiry</label>
                                                <input type="text" id="modal_company_mpob_expiry" class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">MSPO Certificate No.</label>
                                                <input type="text" id="modal_company_mspo_cert" class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">MSPO Expiry</label>
                                                <input type="text" id="modal_company_mspo_expiry" class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Status</label>
                                                <input type="text" id="modal_company_status" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
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
            $('#UsersTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });

        $(document).on('click', '.openCompanyModal', function () {
            let companyId = $(this).data('company-id');
            let modal = $('#myModal');

            $.ajax({
                url: ADMINURL + '/company/details/' + companyId,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    modal.find('input').val('');
                },
                success: function (response) {
                    if (response.status) {
                        let data = response.data;

                        $('#modal_company_name').val(data.company_name);

                        $('#modal_company_code').val(data.code);
                        $('#modal_company_email').val(data.company_email);
                        $('#modal_company_phone').val(data.company_mobile);
                        $('#modal_company_address').val(data.address);
                        $('#modal_company_registration').val(data.registration_no);
                        $('#modal_company_mpob_license').val(data.mpob_license_no);
                        $('#modal_company_mpob_expiry').val(data.mpob_expiry);
                        $('#modal_company_mspo_cert').val(data.mspo_cert_no);
                        $('#modal_company_mspo_expiry').val(data.mspo_expiry);
                        $('#modal_company_status').val(data.status);
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Failed to load company details.');
                }
            });
        });

    </script>



@endsection
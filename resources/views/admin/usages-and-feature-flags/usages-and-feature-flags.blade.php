@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Usages & Feature Flags </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Usages & Feature Flags Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Usages & Feature Flags Listing</a></li>
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
                                        <th>SR No.</th>
                                        <th>Client</th>
                                        <th>Plan</th>
                                        <th>Cycle</th>
                                        <th>Status</th>
                                        <th>Next Renewal</th>
                                        <th>Balance (RM)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>TCS</td>
                                        <td>Pro</td>
                                        <td>Monthly</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>2025‑09‑30</td>
                                        <td class="text-end">0.00</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#subViewModal">
                                                <i class="ri-eye-line align-middle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>NovaPlant</td>
                                        <td>Plan A</td>
                                        <td>Annual</td>
                                        <td><span class="badge bg-warning text-dark">Trialing</span></td>
                                        <td>2025‑10‑15</td>
                                        <td class="text-end">0.00</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#subViewModal">
                                                <i class="ri-eye-line align-middle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>GreenOil</td>
                                        <td>Platinum</td>
                                        <td>Monthly</td>
                                        <td><span class="badge bg-danger">Past Due</span></td>
                                        <td>2025‑08‑28</td>
                                        <td class="text-end">349.00</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#subViewModal">
                                                <i class="ri-eye-line align-middle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>EastPalm</td>
                                        <td>Pro</td>
                                        <td>Monthly</td>
                                        <td><span class="badge bg-secondary">Suspended</span></td>
                                        <td>—</td>
                                        <td class="text-end">0.00</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#subViewModal">
                                                <i class="ri-eye-line align-middle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>VC Majumas</td>
                                        <td>Pro</td>
                                        <td>Annual</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>2026‑05‑01</td>
                                        <td class="text-end">0.00</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#subViewModal">
                                                <i class="ri-eye-line align-middle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>PalmOne</td>
                                        <td>Plan A</td>
                                        <td>Monthly</td>
                                        <td><span class="badge bg-danger">Canceled</span></td>
                                        <td>—</td>
                                        <td class="text-end">0.00</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#subViewModal">
                                                <i class="ri-eye-line align-middle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <!-- View/Action modal -->


                        </div><!--end row-->


                    </div>

                </div>
                <div id="subViewModal" class="modal fade" tabindex="-1" aria-labelledby="subViewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subViewLabel">Subscription</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body small">
                                <div class="d-flex justify-content-between"><span>Client</span><span
                                        id="svTenant">TCS</span></div>
                                <div class="d-flex justify-content-between"><span>Plan</span><span id="svPlan">Pro
                                        (Monthly)</span></div>
                                <div class="d-flex justify-content-between"><span>Status</span><span id="svStatus"
                                        class="badge bg-success">Active</span></div>
                                <hr>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-secondary btn-sm">Change Plan</button>
                                    <button class="btn btn-outline-secondary btn-sm">Retry Charge</button>
                                    <button class="btn btn-outline-secondary btn-sm">Send Pay Link</button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#UsersTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection

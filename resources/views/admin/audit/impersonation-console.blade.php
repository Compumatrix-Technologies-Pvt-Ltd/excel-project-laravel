@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Security And Audit </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Impersonation Console</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Impersonation</h4>
                    <div class="card-toolbar">

                    </div>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <h5 class="mb-3"></h5>
                        <form id="impersonateForm" class="row g-3">
                            <div class="col-md-6"><label class="form-label">Tenant</label>
                                <select class="form-select" id="impTenant">
                                    <option>TCS</option>
                                    <option>GreenOil</option>
                                    <option>NovaPlant</option>
                                </select>
                            </div>
                            <div class="col-md-3"><label class="form-label">Duration (mins)</label><input type="number"
                                    class="form-control" id="impDuration" value="30" min="5" max="120">
                            </div>
                            <div class="col-md-3 d-flex align-items-end"><button class="btn btn-primary">Start
                                    Session</button></div>
                        </form>

                        <div class="card mt-3">
                            <div class="card-header py-2"><strong>Recent Sessions</strong></div>
                            <div class="card-body p-0">
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>Started</th>
                                            <th>Actor</th>
                                            <th>Tenant</th>
                                            <th>Expires</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025‑08‑30 06:20</td>
                                            <td>ops@example.com</td>
                                            <td>TCS</td>
                                            <td>06:50</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>2025‑08‑29 13:00</td>
                                            <td>owner@example.com</td>
                                            <td>GreenOil</td>
                                            <td>13:30</td>
                                            <td><span class="badge bg-secondary">Ended</span></td>
                                        </tr>
                                    </tbody>
                                </table>
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
            $('#BranchListing').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection

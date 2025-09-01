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
                        <li class="breadcrumb-item active"><a href="">Security And Audit</a></li>
                        <li class="breadcrumb-item active"><a href="">Audit Logs</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Audit Logs</h4>
                    <div class="card-toolbar">
                       
                    </div>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex gap-2">
                                <input class="form-control form-control-sm" style="width:220px" placeholder="Actor / Email"
                                    id="fActor">
                                <input class="form-control form-control-sm" style="width:220px"
                                    placeholder="Client / Company" id="fTenant">
                                <select class="form-select form-select-sm" id="fEntity" style="width:auto;">
                                    <option value="">Entity</option>
                                    <option>Clients</option>
                                    <option>plans</option>
                                    <option>subscriptions</option>
                                    <option>invoices</option>
                                    <option>payments</option>
                                    <option>feature_flags</option>
                                </select>
                                <select class="form-select form-select-sm" id="fAction" style="width:auto;">
                                    <option value="">Action</option>
                                    <option>create</option>
                                    <option>update</option>
                                    <option>delete</option>
                                    <option>issue</option>
                                    <option>void</option>
                                    <option>pay</option>
                                    <option>allocate</option>
                                    <option>lock</option>
                                    <option>impersonate</option>
                                </select>
                                <input type="date" class="form-control form-control-sm" id="fFrom">
                                <input type="date" class="form-control form-control-sm" id="fTo">
                                <button class="btn btn-outline-secondary btn-sm">Filter</button>
                            </div>
                        </div>

                        <table id="AuditTable" class="table nowrap dt-responsive align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Time (UTC)</th>
                                    <th>Actor</th>
                                    <th>Client</th>
                                    <th>Entity</th>
                                    <th>Entity ID</th>
                                    <th>Action</th>
                                    <th>IP</th>
                                    <th>UA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025‑08‑30 06:12:41</td>
                                    <td>owner@example.com</td>
                                    <td>TCS</td>
                                    <td>subscriptions</td>
                                    <td>9821</td>
                                    <td>change_plan</td>
                                    <td>203.223.45.10</td>
                                    <td>Chrome/126</td>
                                </tr>
                                <tr>
                                    <td>2025‑08‑29 14:05:03</td>
                                    <td>ops@example.com</td>
                                    <td>GreenOil</td>
                                    <td>feature_flags</td>
                                    <td>—</td>
                                    <td>update</td>
                                    <td>203.12.77.8</td>
                                    <td>Firefox/128</td>
                                </tr>
                                <tr>
                                    <td>2025‑08‑28 03:22:10</td>
                                    <td>owner@example.com</td>
                                    <td>—</td>
                                    <td>auth</td>
                                    <td>—</td>
                                    <td>impersonate</td>
                                    <td>203.223.45.10</td>
                                    <td>Chrome/126</td>
                                </tr>
                            </tbody>
                        </table>
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

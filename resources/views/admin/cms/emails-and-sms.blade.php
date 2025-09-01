@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Global Masters & CMS </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Global Masters & CMS Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Global Masters & CMS
                                Listing</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Template Listing</h4>
                    <a href="#" class="btn btn-primary btn-sm">New Template</a>

                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        </div>

                        <table id="TplTable" class="table nowrap dt-responsive align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SR</th>
                                    <th>Name</th>
                                    <th>Channel</th>
                                    <th>Subject / Title</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Dunning: Retry 1</td>
                                    <td>Email</td>
                                    <td>[Action Required] Payment retry scheduled</td>
                                    <td>2025‑08‑29</td>
                                    <td><a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.emails.and.sms.edit', 1) }}">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Welcome (Trial)</td>
                                    <td>Email</td>
                                    <td>Welcome to the platform</td>
                                    <td>2025‑08‑18</td>
                                    <td><a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.emails.and.sms.edit', 2) }}">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Payment Reminder</td>
                                    <td>SMS</td>
                                    <td>Invoice due reminder</td>
                                    <td>2025‑08‑15</td>
                                    <td><a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.emails.and.sms.edit', 3) }}">Edit</a>
                                    </td>
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
            $('#TplTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection

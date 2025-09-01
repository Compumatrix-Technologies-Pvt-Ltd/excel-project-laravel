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
                    <h4 class="card-title mb-0 flex-grow-1">Template Edit</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex gap-2">
                                <button class="btn btn-light btn-sm">Preview</button>
                                <button class="btn btn-success btn-sm" id="saveTemplateBtn">Save</button>
                            </div>
                        </div>

                        <form id="tplForm" action="javascript:void(0);" class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name<span class="text-danger">*</span></label>
                                <input class="form-control" id="tplName" value="Dunning: Retry 1">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Channel</label>
                                <select class="form-select" id="tplChannel">
                                    <option>Email</option>
                                    <option>SMS</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Locale</label>
                                <select class="form-select" id="tplLocale">
                                    <option>en-MY</option>
                                    <option>ms-MY</option>
                                </select>
                            </div>

                            <div class="col-12" id="emailFields">
                                <label class="form-label">Subject</label>
                                <input class="form-control" id="tplSubject"
                                    value="[Action Required] Payment retry scheduled">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Body (supports variables)</label>
                                <textarea class="form-control" id="tplBody" rows="10"></textarea>
                                <div class="small text-muted mt-1"></div>
                            </div>
                        </form>
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

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
                        <li class="breadcrumb-item active"><a href="">Security Settings</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Security Settings</h4>
                    <div class="card-toolbar">

                    </div>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <form id="secPolicyForm" class="row g-3">
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="policyMfaRequired" checked>
                                    <label class="form-check-label" for="policyMfaRequired">Require MFA for all admin
                                        users</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Session Timeout (minutes)</label>
                                <input type="number" class="form-control" id="policySession" value="30" min="10"
                                    max="240">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">IP Allowlist (comma-separated CIDR)</label>
                                <input class="form-control" id="policyIpList"
                                    placeholder="203.0.113.0/24, 198.51.100.12/32">
                            </div>

                            <div class="col-12 mt-2">
                                <h6>Webhook Signing</h6>
                                <div class="d-flex gap-2">
                                    <input class="form-control" id="webhookKey" value="whsec_********" readonly
                                        style="max-width:360px">
                                    <button class="btn btn-outline-secondary btn-sm" type="button">Rotate Key</button>
                                </div>
                                <div class="small text-muted mt-1">Rotate regularly and update in payment gateway/webhook
                                    sources.</div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-success mt-3" type="submit">Save Policies</button>
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
   
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>

    
@endsection

@extends('layouts.admin.master')
@section('title')
{{ $moduleAction}}
@endsection
@section('toolbar')
<div  class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
   <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
      <li class="breadcrumb-item text-muted">
         <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">
         Dashboards                           </a>
      </li>
      <li class="breadcrumb-item">
         <span class="bullet bg-gray-500 w-5px h-2px"></span>
      </li>
      <li class="breadcrumb-item text-muted">
         <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">
         Change Password                            </a>                                            
      </li>
   </ul>
</div>
@endsection
@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container  container-xxl ">
  <form class="form d-flex flex-column flex-lg-row" id="updateForm" method="PUT" data-toggle="validator" action="{{ route('admin.storeUpdatePassword',[base64_encode(base64_encode($id))]) }}" autocomplete="off">
    @csrf
    @method('PUT')
      <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="d-flex flex-column gap-7 gap-lg-10">
            <div class="card card-flush py-4">
              <div class="card-header">
                  <div class="card-title">
                    <h2>Change Password</h2>
                  </div>
              </div>
                  <div class="card-body pt-0">
                    <div class="d-flex flex-wrap gap-5">
                        <div class="fv-row w-100 flex-md-root form-group">
                          <label class="required form-label">Current Password</label>
                          <input type="password" name="current_password" class="form-control mb-2" placeholder="Current Password" required data-error="Please enter current password." />
                          <input type="hidden" name="h_id" id="" value="{{base64_encode(base64_encode($id))}}">
                          <span class="help-block with-errors">
                              <ul class="list-unstyled">
                                <li class="err_current_password"></li>
                              </ul>
                          </span>
                        </div>
                        <div class="fv-row w-100 flex-md-root form-group">
                          <label class="required form-label">New Password</label>
                          <input type="password" name="new_password" class="form-control mb-2" placeholder="New Password" required data-error="Please enter new password." />
                          <span class="help-block with-errors">
                              <ul class="list-unstyled">
                                <li class="err_new_password"></li>
                              </ul>
                          </span>
                        </div>
                    </div>
                    <div class="fv-row w-100 flex-md-root gap-5 form-group">
                        <div class="col-md-6">
                          <label class="required form-label">Confirm Password</label>
                          <input type="password" name="confirm_password" class="form-control mb-2" placeholder="Confirm Password" required data-error="Please enter confirm password." />
                          <span class="help-block with-errors">
                              <ul class="list-unstyled">
                                <li class="err_confirm_password"></li>
                              </ul>
                          </span>
                        </div>
                    </div>
                  </div>
                  <div class="card-footer d-flex pt-0">
                    <div class="row">
                        <div class="col-lg-12">
                          <button type="submit" class="btn btn-primary mr-2">Save</button>
                          <a href="{{route('admin.dashboard')}}" class="btn btn-secondary me-5">Cancel</a>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
      </form>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('/assets/admin/js/user-profile/index.js') }}"></script>
@endsection
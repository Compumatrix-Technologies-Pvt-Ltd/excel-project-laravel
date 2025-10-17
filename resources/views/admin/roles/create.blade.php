@extends('layouts.admin.master')
@section('title')
{{ $moduleAction }}
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">@lang('admin.TITLE_ADD_ROLE')</h5>
        </div>
     </div>
</div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
           <!--begin::Card-->
           <div class="card card-custom">
              <div class="card-header">
                 <h3 class="card-title">@lang('admin.TITLE_ADD_ROLE')</h3>
              </div>
              <!--begin::Form-->
              <form class="form" action="{{ route('admin.roles.store') }}" data-toggle="validator" role="form" method="POST" id="AddForm" autocomplete="off">
                @csrf
                @method('POST')
                 <div class="card-body">
                    <div class="form-group row">
                       <div class="col-lg-6">
                                <label for="name" class="control-label col-md-12">@lang('admin.TITLE_NAME')
                                <span class="required">*</span></label>                    
                                <input class="form-control" type="text" name="name" id="name" required data-error="@lang('admin.ERR_ROLE_NAME')" pattern="^[A-Za-z0-9 ]*$" data-pattern-error="@lang('admin.ERR_ALPHABETS_ONLY')" autocomplete="off">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_name"></li>
                                </ul> 
                            </span>
                       </div>
                    </div>
                 </div>
                 <div class="card-footer">
                    <div class="row">
                       <div class="col-lg-6">
                          <button type="submit" class="btn btn-primary mr-2">@lang('admin.TITLE_SAVE_BUTTON')</button>
                          <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">@lang('admin.TITLE_CANCEL_BUTTON')</a>
                       </div>
                    </div>
                 </div>
              </form>
              <!--end::Form-->
           </div>
           <!--end::Card-->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/assets/admin/js/common/common-create-edit.js') }}"></script>
@endsection

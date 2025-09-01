@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">CMS Pages</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">CMS Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">CMS Listing</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Page</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex gap-2">
                                <select class="form-select form-select-sm" id="cmsStatus" style="width:auto;">
                                    <option>Draft</option>
                                    <option>Published</option>
                                </select>
                            </div>
                        </div>
                        <form id="cmsForm" action="javascript:void(0);" class="row g-3">
                            <div class="col-md-6"><label class="form-label">Title</label><input class="form-control"
                                    id="cmsTitle" value="Terms & Conditions"></div>
                            <div class="col-md-6"><label class="form-label">Slug</label><input class="form-control"
                                    id="cmsSlug" value="terms"></div>
                            <div class="col-12">
                                <label class="form-label">Content</label>
                                <textarea class="form-control" id="cmsContent" rows="16"><h2>Introduction</h2><p>…</p></textarea>
                            </div>
                             <div class="col-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>
    </script>
@endsection

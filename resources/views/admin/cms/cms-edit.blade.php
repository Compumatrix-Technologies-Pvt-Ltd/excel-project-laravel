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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.cms.pages') }}">CMS Listing</a></li>
                        <li class="breadcrumb-item active"><a href="">Edit CMS page</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit CMS Page</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">

                        <form id="updateForm" action="{{ route('admin.cmsPage.update', $pageId) }}" method="post"
                            class="row g-3 form" autocomplete="off" role="form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="id" name="id" value="{{ $pageId }}">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Name</label>
                                        <input type="text" name="page_name" class="form-control" placeholder="Page Name"
                                            required data-error="Please enter name." value="{{ $pageName }}" />
                                        <input type="hidden" name="hidden_id" v>
                                        <span class="help-block with-errors">
                                            <ul class="list-unstyled">
                                                <li class="err_page_name"></li>
                                            </ul>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Content</label>
                                        <textarea name="page_content" id="page_content" class="form-control" cols="30"
                                            rows="15">{{ $content }}</textarea>
                                        <span class="help-block with-errors">
                                            <ul class="list-unstyled">
                                                <li class="err_page_content"></li>
                                            </ul>
                                        </span>
                                    </div>
                                </div>
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
    <script type="text/javascript" src="{{ asset('/assets/admin/plugins/custom/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>


    </script>
    <script>
        CKEDITOR.replace('page_content', {
            allowedContent: true,
            on: {
                change: function () {
                    const editor = this;
                    const content = editor.getData().trim();
                    const errorSpan = document.querySelector('.help-block.with-errors');
                    if (page_content === '') {
                        errorSpan.textContent = 'Please enter content.';
                        $(document).find('.submitBtn').addClass('disabled');

                    } else {
                        errorSpan.textContent = '';
                        $(document).find('.submitBtn').removeClass('disabled');
                    }
                }
            }
        });
    </script>
@endsection
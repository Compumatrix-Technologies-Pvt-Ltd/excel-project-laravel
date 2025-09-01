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
                    <h4 class="card-title mb-0 flex-grow-1">Pages Listing</h4>
                    <a href="" class="btn btn-primary btn-sm">New Page</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        </div>
                        <table id="CmsTable" class="table nowrap dt-responsive align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SR</th>
                                    <th>Slug</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>terms</td>
                                    <td>Terms & Conditions</td>
                                    <td><span class="badge bg-success">Published</span></td>
                                    <td>2025‑08‑20</td>
                                    <td><a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.cms.pages.edit', ['id' => 1]) }}">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>privacy</td>
                                    <td>Privacy Policy</td>
                                    <td><span class="badge bg-success">Published</span></td>
                                    <td>2025‑08‑18</td>
                                    <td><a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.cms.pages.edit', ['id' => 2]) }}">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>help</td>
                                    <td>Help & FAQs</td>
                                    <td><span class="badge bg-warning text-dark">Draft</span></td>
                                    <td>2025‑08‑10</td>
                                    <td><a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.cms.pages.edit', ['id' => 3]) }}">Edit</a>
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
            $('#CmsTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection

@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">FAQ's</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">FAQ's</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.faq.index') }}">FAQ Listing</a>
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
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">FAQ Listing</h4>
                    <div class="card-toolbar">

                        <button type="button" class="btn btn-info btn-label waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#MillModal">
                            <i class="mdi mdi-plus-circle label-icon align-middle fs-16 me-2"></i> Add FAQ
                        </button>
                        <div id="MillModal" class="modal fade" tabindex="-1" aria-labelledby="MillModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="MillModalLabel">Mill Data Entry</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form id="AddForm" action="{{ route('admin.faq.store') }}" method="post" class="form"
                                        autocomplete="off" role="form">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row gy-4">
                                                <div class="col-md-6 form-group">
                                                    <label for="question" class="form-label">
                                                        Question<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="question" name="question"
                                                        required data-error="Please enter Question">
                                                    <span class="help-block with-errors err_question"
                                                        style="color:red;"></span>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="answer" class="form-label">
                                                        Answer <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="answer" name="answer"
                                                        required data-error="Please enter answer">
                                                    <span class="help-block with-errors err_answer"
                                                        style="color:red;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                    </form>


                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table class="table nowrap dt-responsive align-middle CommonListing" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR.No</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $index => $faq)
                                        <tr>
                                            <td>
                                                <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                                </div>
                                            </td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $faq->question }}</td>
                                            <td>{{ $faq->answer }}</td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown"><i
                                                            class="ri-more-fill align-middle"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-faq-btn" href="javascript:void(0);"
                                                                data-id="{{base64_encode(base64_encode($faq->id))}}"
                                                                id="edit-faq-btn">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li><a href="javascript:void(0)" onclick="return deleteCollection(this)"
                                                                data-href="{{route('admin.mill.destroy', [base64_encode(base64_encode($faq->id))])}}"
                                                                class="dropdown-item remove-item-btn"><i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--end row-->
                    </div>
                    <div id="editMillModal" class="modal fade" tabindex="-1" aria-labelledby="editMillModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMillModalLabel">Update FAQ's</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <form id="updateForm" action="{{ route('admin.faq.updateFaq') }}" method="post"
                                    class="form" autocomplete="off" role="form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" id="hidden_id" name="id">
                                        <div class="row gy-4">
                                            <div class="col-md-6 form-group">
                                                <label for="question" class="form-label">
                                                    Question<span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="question1" name="question"
                                                    required data-error="Please enter Question">
                                                <span class="help-block with-errors err_question" style="color:red;"></span>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="answer" class="form-label">
                                                    Answer <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="answer1" name="answer" required
                                                    data-error="Please enter answer">
                                                <span class="help-block with-errors err_answer" style="color:red;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </div>
                                </form>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
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
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#PlansListing').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });

            $(document).on('click', '#edit-faq-btn', function () {

                $('#editMillModal').modal('show');
                var encrypted_id = $(this).attr("data-id");
                // alert(encrypted_id);
                var action = ADMINURL + '/faq/'+ encrypted_id + '/edit';

                $.ajax({
                    type: "GET",
                    url: action,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 'success') {
                            $("#question1").val(response.data.question);
                            $('#answer1').val(response.data.answer);
                            $('#hidden_id').val(encrypted_id);
                            $('#submitBtn ').removeClass('disabled');
                        } else {
                            alert('Something went wrong');
                        }
                    }
                });
            });
        });
    </script>

@endsection
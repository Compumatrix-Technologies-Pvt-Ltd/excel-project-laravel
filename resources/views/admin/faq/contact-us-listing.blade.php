@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Contact Management </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                        <li class="breadcrumb-item active">Contact Us Listing </li>
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
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Contact Us Listing</h5>
                </div>
                <div class="card-body">
                    <table id="ContactListing"
                        class="table table-bordered dt-responsive nowrap table-striped align-middle CustTable"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>SR No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <div id="viewModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Contact Deatils</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-12 mb-5">
                                    <div>
                                        <label for="description">Subject</label>
                                        <p id="Subject"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-5">
                                <div>
                                    <label for="description">Message</label>
                                    <p id="description"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end col-->
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>

    <script>

        $(document).ready(function () {
            var action = ADMINURL + '/contacts/getRecords';
            const DefectsTable = $('#ContactListing').DataTable({
                scroller: true,
                serverSide: true,
                responsive: false,
                scrollX: true,
                ajax: {
                    "url": action,
                },
                columns: [
                    { 'data': null, render: (data, type, row, meta) => meta.row + 1 + meta.settings._iDisplayStart }, // Serial number
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "status" },
                    { "data": "actions" },
                ],
                columnDefs: [
                    { "orderable": false, "targets": [1, 2, 3, 4] },
                ],
                aaSorting: [
                    [0, 'DESC']
                ],
            });

            $(document).on('click', '.contact-view-btn', function () {
                $('#viewModal').modal('show');
                var encrypted_id = $(this).attr("data-id");
                var action = ADMINURL + '/view-contact-us-message/' + encrypted_id;
                $.ajax({
                    type: "GET",
                    url: action,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 'success') {
                            $("#description").html(response.data.message);
                            $('#Subject').html(response.data.subject);
                            $(document).find('#read' + response.data.id).html('Read').removeClass('text-danger').addClass('text-success');
                            $(document).find('#badge' + response.data.id).remove();

                        } else {
                            alert('Something went wrong');
                        }
                    }
                });
            });
        });

    </script>
@endsection
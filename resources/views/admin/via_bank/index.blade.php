@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Via Bank</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Via Bank</a></li>
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
                <div class="card-header align-items-center d-flex justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">Via Bank Listing</h4>
                    <div class="card-toolbar">
                        <button type="button" id="viewPdfBtn"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <button type="button" id="createPdf"
                            class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="mdi mdi-download label-icon align-middle fs-16 me-2"></i> Create PDF
                        </button>
                    </div>
                </div>

                <div class="card-body">
                   <div class="container-fluid">
                        <div class="row">
                            <input type="hidden" name="hidden_user_id" id="hidden_user_id" value="{{ isset($userId) ? $userId : null }}">
                            <table id="viaBankDeductionListing"  class="table dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                       
                                        <th>SR No.</th>
                                        <th>Payment Type</th>
                                        <th>Bene Account No.</th>
                                        <th>BIC</th>
                                        <th>Bene Full Name</th>
                                        <th>ID Type</th>
                                        <th>Bene ID No.</th>
                                        <th>Amount</th>
                                        <th>Recipient Reference</th>
                                        <th>Bene Email 1</th>
                                        <th>Bene Email 2</th>
                                        <th>Bene Mobile 1</th>
                                        <th>Bene Mobile 2</th>
                                        <th>Joint Bene Name</th>
                                        <th>Joint Bene ID</th>
                                        <th>E-mail Content Line 1</th>
                                        <th>E-mail Content Line 2</th>
                                        <th>E-mail Content Line 3</th>
                                        <th>E-mail Content Line 4</th>
                                        <th>E-mail Content Line 5</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">PDF Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <iframe id="pdfPreviewFrame" src="" width="100%" height="700px"
                                    style="border:none;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>

    <script>
     function generateLicencePDF(preview = true) {
        let userId = $('#hidden_user_id').val();
            let url = `${ADMINURL}/via-bank-deduction/pdf?hidden_user_id=${userId}`;

            if (preview) {
                // Show PDF in modal for preview
                url += `&preview=1`;
                $('#pdfPreviewFrame').attr('src', url);
                $('#pdfPreviewModal').modal('show');
            } else {
                // Trigger direct download instead of opening in a new tab
                const link = document.createElement('a');
                link.href = url;
                link.download = 'licence.pdf'; // optional: suggest a filename
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        $('#viewPdfBtn, #previewPDF').on('click', function() {
            generateLicencePDF(true);
        });

        $('#createPdf').on('click', function() {
            generateLicencePDF(false);
        });


    </script>
@endsection
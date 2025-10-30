@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Supplier Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Supplier Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.suppliersGps.index') }}">Supplier GPS
                                Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Supplier GPS Listing</h4>
                    <div class="card-toolbar">
                        <button type="button" id="PreviewPdf" data-bs-toggle="modal" data-bs-target="#supplierGPSModal"
                            class="btn btn-danger btn-label waves-effect waves-light">
                            <i class="mdi mdi-calendar-clock label-icon align-middle fs-16 me-2"></i> Lic Expiry PDF
                        </button>
                       
                        <button type="button" id="gpsPdfBtn"
                            class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="mdi mdi-crosshairs-gps label-icon align-middle fs-16 me-2"></i>View GPS Coord
                        </button>
                        <button type="button" id="CreateGpsPdfBtn"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-crosshairs-gps label-icon align-middle fs-16 me-2"></i> GPS Coord PDF
                        </button>

                        <div id="supplierGPSModal" class="modal fade" tabindex="-1" aria-labelledby="supplierGPSModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="supplierGPSModalLabel">Supplier Licence Expiry</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="javascript:void(0);" class="row g-3">
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <fieldset class="border rounded-3 p-3">
                                                        <legend class="float-none w-auto px-2 small fw-bold">Licence
                                                            Expiry Option:</legend>
                                                        <div class="form-check form-radio-primary mb-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="licence_expiry" id="mpobExpired" value="mpob" checked>
                                                            <label class="form-check-label" for="mpobExpired">MPOB Licence
                                                                Expired</label>
                                                        </div>

                                                        <div class="form-check form-radio-primary mb-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="licence_expiry" id="mspoExpired" value="mspo">
                                                            <label class="form-check-label" for="mspoExpired">MSPO
                                                                Certification Expired</label>
                                                        </div>

                                                        <div class="form-check form-radio-primary">
                                                            <input class="form-check-input" type="radio"
                                                                name="licence_expiry" id="allExpired" value="all">
                                                            <label class="form-check-label" for="allExpired">All Expiry
                                                                Details</label>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <label for="expiry_date" class="form-label">Expired On Or Before</label>
                                                    <input type="date" class="form-control" id="expiry_date"
                                                        name="expiry_date">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="viewPdfBtn" class="btn btn-success">View
                                                    PDF</button>
                                                <button type="button" id="createPdf" class="btn btn-success">Download
                                                    PDF</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <input type="hidden" name="hidden_user_id" id="hidden_user_id" value="{{ isset($userId) ? $userId : null }}">
                            <table id="SuppliergpsListing" class="table table-bordered nowrap dt-responsive align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Supplier Id</th>
                                        <th rowspan="2">Supplier Name</th>
                                        <th>MPOB</th>
                                        <th>MSOP</th>
                                        <th rowspan="2">Land Size (Ha)</th>
                                        <th colspan="2" style="text-align: center;">GPS Coordinates </th>
                                    </tr>
                                    <tr>
                                        <th>Licence No.</th>
                                        <th>Certificate No.</th>
                                        <th>Latitude(°)</th>
                                        <th>Longitude(°)</th>
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
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>

   
    <script>
        function generateGPSPDF(preview = true) {
            let url = `${ADMINURL}/suppliers/pdf/gps-coordinates`;

            if (preview) {
                // Add preview flag and show in modal
                url += `?preview=1`;
                $('#pdfPreviewFrame').attr('src', url);
                $('#pdfPreviewModal').modal('show');
            } else {
                // Trigger actual PDF download
                window.open(url, '_blank');
            }
        }

        // Button events
        $('#gpsPdfBtn').on('click', function() {
            generateGPSPDF(true);
        });

        $('#CreateGpsPdfBtn').on('click', function() {
            generateGPSPDF(false);
        });

       function generateLicencePDF(preview = true) {
            let expiryType = $('input[name="licence_expiry"]:checked').val();
            let expiryDate = $('#expiry_date').val();

            let url = `${ADMINURL}/suppliers/pdf/licence-expiry?expiry_type=${expiryType}&expiry_date=${expiryDate}`;

            if (preview) {
                // Add preview flag and show in modal
                url += `&preview=1`;
                $('#pdfPreviewFrame').attr('src', url);
                $('#pdfPreviewModal').modal('show');
            } else {
                // Trigger actual PDF download
                window.open(url, '_blank');
            }
        }

        // Button events
        $('#viewPdfBtn, #previewPDF').on('click', function() {
            generateLicencePDF(true);
        });

        $('#createPdf').on('click', function() {
            generateLicencePDF(false);
        });

    </script>


@endsection
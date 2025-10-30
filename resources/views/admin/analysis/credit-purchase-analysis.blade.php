@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Credit Purchase Analysis Listing</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Credit Purchases</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.creditPurchase.index') }}">Credit
                                Purchase Analysis Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1 title">Credit Purchase Analysis by Supplier in M/Ton for [ {{date('Y')}} ] for Registered MSPO License Suppliers</h4>
                    <div class="card-toolbar">
                        <button type="button" id="previewPDF" class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <button type="button" id="createPDF" class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="selectYear" class="form-label">Year</label>
                            <select id="yearSelect" class="form-select">
                                @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="bankIdInput" class="form-label">MSPO Certification</label>
                            <select name="mspo_certification" id="mspo_certification" class="form-select">
                                <option value="registered" selected>Registered</option>
                                <option value="non-registered">Non-Registered</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="bankIdInput" class="form-label">Purchases</label>
                            <select name="purchases" id="purchases" class="form-select">
                                <option value="credit" selected>Credit</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="bankIdInput" class="form-label">Analysis In</label>
                            <select name="analysis_in" id="analysis_in" class="form-select">
                                <option value="mton" selected>M/Ton</option>
                                <option value="rm">RM</option>
                            </select>
                        </div>
                    </div>
                    <div class="container-fluid mt-4">
                        <div class="table-responsive">
                            <input type="hidden" name="hidden_user_id" id="hidden_user_id" value="{{ isset($userId) ? $userId : null }}">
                            <table id="CreditPurchaseAnalysisListing" class="table nowrap dt-responsive align-middle"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>Supplier Id & Name</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Total(M/Ton)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="table-light fw-bold">
                                    <tr>
                                        <td>Total</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">PDF Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <iframe id="pdfFrame" src="" width="100%" height="700px"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
        function generateCreditPDF(preview = false) {
            const params = {
                year: $('#yearSelect').val(),
                mspo_certification: $('#mspo_certification').val(),
                purchases: $('#purchases').val(),
                analysis_in: $('#analysis_in').val(),
                _token: '{{ csrf_token() }}'
            };
            $.ajax({
                url: ADMINURL + '/credit-purchase-analysis/pdf' + (preview ? '?preview=1' : ''),
                type: 'GET',
                data: params,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(blob) {
                    const pdfUrl = URL.createObjectURL(blob);
                    if (preview) {
                        $('#pdfFrame').attr('src', pdfUrl);
                        $('#pdfPreviewModal').modal('show');
                    } else {
                        const a = document.createElement('a');
                        a.href = pdfUrl;
                        a.download = `Credit_Purchase_Analysis_${params.year}.pdf`;
                        a.click();
                    }
                },
                error: function(xhr) {
                    console.error('PDF generation failed:', xhr.responseText);
                }
            });
        }

        $('#previewPDF').on('click', function() {
            generateCreditPDF(true);

        });

        $('#createPDF').on('click', function() {
            generateCreditPDF(false);
        });
    </script>
@endsection

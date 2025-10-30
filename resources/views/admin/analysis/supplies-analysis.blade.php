@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Supplies Analysis Listing</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href=""> Analysis</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.supplies.analysis.index') }}">Supplies
                                Analysis</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Supplies Analysis</h4>
                    <div class="card-toolbar">
                        <button type="button" id="PreviewPdf" data-bs-toggle="modal" data-bs-target="#suppliesAnalysis"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <button type="button" class="btn btn-info btn-label waves-effect waves-light">
                            <i class="mdi mdi-database-export label-icon align-middle fs-16 me-2"></i> Export Data
                        </button>
                        <div id="suppliesAnalysis" class="modal fade" tabindex="-1" aria-labelledby="suppliesAnalysisLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="suppliesAnalysisLabel">Analysis Report Option Form
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="javascript:void(0);" class="row g-3">
                                            <div class="row mt-3">
                                                <label for="selectYear" class="form-label">Year</label>
                                                <select id="selectYear" class="form-select">
                                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                                        <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <div class="col-md-12 mt-3">
                                                    <fieldset class="border rounded-3 p-3">
                                                        <legend class="float-none w-auto px-2 small fw-bold">Analysis Based
                                                            On</legend>

                                                        <div class="form-check form-radio-primary mb-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="analysis_type" value="supplier" checked>
                                                            <label class="form-check-label">Supplier</label>
                                                        </div>

                                                        <div class="form-check form-radio-primary mb-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="analysis_type" value="mill">
                                                            <label class="form-check-label">Mill</label>
                                                        </div>
                                                    </fieldset>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect waves-light"
                                                    data-bs-dismiss="modal">Close</button>

                                                <button type="button" id="showPdfBtn"
                                                    class="btn btn-warning btn-label waves-effect waves-light">
                                                    <i class="ri-eye-fill label-icon align-middle fs-16 me-2"></i>Preview
                                                    PDF</button>
                                                <button type="button" id="createPdfBtn"
                                                    class="btn btn-primary btn-label waves-effect waves-light">
                                                    <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i>
                                                    Create
                                                    PDF</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <h6 id="dynamicHeading" style="text-align:center; font-weight:bold;">
                        FFB Supplies By [ Supplier ] For The Year [ {{ date('Y') }} ]
                    </h6>
                    <div class="container-fluid mt-4">
                        <div class="table-responsive">
                            <table id="SuppliesAnalysisListing" class="table nowrap dt-responsive align-middle"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>Supplier</th>
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
                                <tfoot></tfoot>
                            </table>
                        </div>
                        <!--end row-->
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
        $(document).ready(function () {

            var action = ADMINURL + '/supplies-analysis/getRecords';

            window.table = $('#SuppliesAnalysisListing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: action,
                    data: function (d) {
                        d.year = $('#selectYear').val();
                        d.type = $('input[name="analysis_type"]:checked').val();
                    },
                    error: function (xhr, status, error) {
                    if (status === 'error') {
                        showToast(false, 'Server Error (' + xhr.status + '). Please refresh the page.');
                    } else {
                        alert('Server Error (' + xhr.status + '): ' + xhr.responseText);
                    }
                }

                },
                columns: [
                    { data: 'supplier', title: 'Supplier' },
                    { data: 'month_1', title: 'Jan' },
                    { data: 'month_2', title: 'Feb' },
                    { data: 'month_3', title: 'Mar' },
                    { data: 'month_4', title: 'Apr' },
                    { data: 'month_5', title: 'May' },
                    { data: 'month_6', title: 'Jun' },
                    { data: 'month_7', title: 'Jul' },
                    { data: 'month_8', title: 'Aug' },
                    { data: 'month_9', title: 'Sep' },
                    { data: 'month_10', title: 'Oct' },
                    { data: 'month_11', title: 'Nov' },
                    { data: 'month_12', title: 'Dec' },
                    { data: 'total', title: 'Total (M/Ton)' }
                ],
                drawCallback: function (settings) {
                    const grandTotals = settings.json.grandTotals;

                    if (grandTotals) {
                        let footerHtml = `
                                    <tr>
                                        <th>Total</th>
                                        ${[...Array(12)].map((_, i) =>
                            `<th>${grandTotals['month_' + (i + 1)] ?? '0.00'}</th>`
                        ).join('')}
                                        <th>${grandTotals.total ?? '0.00'}</th>
                                    </tr>
                                `;

                        $('#SuppliesAnalysisListing tfoot').html(footerHtml);
                    }
                }

            });

            $('#selectYear, input[name="analysis_type"]').change(function () {

                window.table.ajax.reload();

                let selectedYear = $('#selectYear').val();
                let analysisType = $('input[name="analysis_type"]:checked').val();
                $('#dynamicHeading').html(
                    `FFB Supplies Details For Supplier = [ ${supplierText} ] From [ ${startDate} ] To [ ${endDate} ]`
                );
            });
            $('#showPdfBtn').on('click', function () {
                let selectedYear = $('#selectYear').val();
                let analysisType = $('input[name="analysis_type"]:checked').val();  // supplier or mill

                let url = "{{ route('admin.supplies.analysis.generatePDF') }}" +
                    `?year=${selectedYear}&type=${analysisType}&preview=1`;

                window.open(url, '_blank');
            });

            $('#createPdfBtn').on('click', function () {
                let selectedYear = $('#selectYear').val();
                let analysisType = $('input[name="analysis_type"]:checked').val();

                let url = "{{ route('admin.supplies.analysis.generatePDF') }}" +
                    `?year=${selectedYear}&type=${analysisType}`;

                window.open(url, '_blank');
            });

        });

    </script>

@endsection
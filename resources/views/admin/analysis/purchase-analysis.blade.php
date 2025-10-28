@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Purchase Analysisssss</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Analysis</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.purchaseAnalysis.index') }}">
                                Purchase Analysis</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <style>
        .chart-box {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
        }

        #PurchaseAnalysisListing {
            border-right: 1px solid #ddd;
        }

        #PurchaseAnalysisListing td,
        #PurchaseAnalysisListing th {
            border-right: 1px solid #ddd;
        }

        #PurchaseAnalysisListing th:last-child,
        #PurchaseAnalysisListing td:last-child {
            border-right: none;
            /* remove border on the last column */
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">
                        Purchase Analysis (Credit vs Cash in M/Ton) for [ {{ date('Y') }} ]
                    </h4>
                    <div class="card-toolbar">
                        <!-- Buttons as before -->
                        <button type="button" class="btn btn-warning btn-label waves-effect waves-light" id="previewPDF">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <button type="button" class="btn btn-primary btn-label waves-effect waves-light" id="createPDF">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filters Row -->
                    {{-- <div class="row g-3 mb-4">
                        <div class="col-md-2">
                            <label for="fromMonth" class="form-label">From Month</label>
                            <select id="fromMonth" name="from_month" class="form-select">
                                <option value="">--Month--</option>
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="fromYear" class="form-label">From Year</label>
                            <select id="fromYear" name="from_year" class="form-select">
                                <option value="">--Year--</option>
                                @for ($i = date('Y'); $i >= 2000; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="toMonth" class="form-label">To Month</label>
                            <select id="toMonth" name="to_month" class="form-select">
                                <option value="">--Month--</option>
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="toYear" class="form-label">To Year</label>
                            <select id="toYear" name="to_year" class="form-select">
                                <option value="">--Year--</option>
                                @for ($i = date('Y'); $i >= 2000; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-info btn-label waves-effect waves-light">
                                <i class="mdi mdi-database-export label-icon align-middle fs-16 me-2"></i> Export Data
                            </button>
                        </div>
                    </div> --}}

                    <div class="row" id="purchaseReportSection">
                        <div class="row" id="custmDiv" style="display: none;">
                            <div class="col-md-12">
                                <h2 class="text-center">VC</h2>
                            </div>
                            <div class="col-md-12">
                                <h4 class="text-center">Purchase Analysis (Credit vs Cash in M/Ton) for [
                                    {{ date('Y') }} ]</h4>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table id="PurchaseAnalysisListing" class="table nowrap dt-responsive align-middle"
                                    style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Purchases</th>
                                            <th>Credit</th>
                                            <th>Cash</th>
                                            <th>Total (M/Ton)</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot class="table-light fw-bold">
                                        <tr>
                                            <td>Total</td>
                                            <td id="total-credit">0.00</td>
                                            <td id="total-cash">0.00</td>
                                            <td id="total-weight">0.00</td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                        <div class="col-lg-5">
                            <select id="yearSelect" class="form-select w-auto">
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                            </select>
                            <div class="card shadow-sm p-3">
                                <div id="purchaseChart" class="chart-box" style="height: 350px;"></div>
                                <div id="purchaseChartYearly" class="chart-box" style="height: 350px; margin-top: 20px;">
                                </div>
                            </div>
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
                                <iframe id="pdfFrame" src="" width="100%" height="700px"
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
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('/assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        function loadPurchaseCharts($year = new Date().getFullYear()) {
            $.ajax({
                url: ADMINURL + '/purchase-analysis/chart-data',
                type: 'GET',
                data: {
                    year: $year
                },
                success: function(response) {
                    let credit = parseFloat(response.summary.credit) || 0;
                    let cash = parseFloat(response.summary.cash) || 0;

                    let monthName = new Date().toLocaleString('default', {
                        month: 'short'
                    });
                    let current = response.monthly?.find(m => m.month === monthName) || {
                        credit: 0,
                        cash: 0
                    };
                    let monthCredit = parseFloat(current.credit) || 0;
                    let monthCash = parseFloat(current.cash) || 0;


                    Highcharts.chart('purchaseChart', {
                        chart: {
                            type: 'pie',
                            options3d: {
                                enabled: true,
                                alpha: 60,
                                beta: 0
                            }
                        },
                        title: {
                            text: `[ ${monthName} ${response.year} ] Purchases`
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                depth: 35,
                                slicedOffset: 20,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name} {point.percentage:.0f}%',
                                }
                            }
                        },
                        series: [{
                            name: 'Purchases',
                            data: [{
                                    name: 'Credit',
                                    y: monthCredit,
                                    sliced: true,
                                    color: '#1f77b4'
                                },
                                {
                                    name: 'Cash',
                                    y: monthCash,
                                    color: '#7d2b25'
                                }
                            ]
                        }]
                    });

                    Highcharts.chart('purchaseChartYearly', {
                        chart: {
                            type: 'pie',
                            options3d: {
                                enabled: true,
                                alpha: 60,
                                beta: 0
                            }
                        },
                        title: {
                            text: `[ Jan–Dec ${response.year} ] Purchases`
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                depth: 35,
                                slicedOffset: 20,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name} {point.percentage:.0f}%',
                                }
                            }
                        },
                        series: [{
                            name: 'Purchases',
                            data: [{
                                    name: 'Credit',
                                    y: credit,
                                    sliced: true,
                                    color: '#1f77b4'
                                },
                                {
                                    name: 'Cash',
                                    y: cash,
                                    color: '#7d2b25'
                                }
                            ]
                        }]
                    });
                },
                error: function(xhr) {
                    console.error("AJAX error:", xhr.responseText);
                }
            });
        }

        $(document).ready(function() {
            loadPurchaseCharts();
        });
        $('#yearSelect').on('change', function() {
            loadPurchaseCharts($(this).val());
        });
    </script>

    <script>
        async function generatePurchasePDF(preview = false) {
            const {
                jsPDF
            } = window.jspdf;
            const element = document.getElementById('purchaseReportSection');

            // Show loading feedback
            $('#custmDiv').show();
            const originalText = preview ? 'Preview PDF' : 'Create PDF';
            const button = preview ? $('#previewPDF') : $('#createPDF');
            button.prop('disabled', true).text('Generating...');

            try {
                // Take screenshot of visible area
                const canvas = await html2canvas(element, {
                    scale: 2, // higher quality
                    useCORS: true,
                    logging: false
                });

                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'pt', 'a4');
                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();

                // Calculate image height to fit aspect ratio
                const imgProps = pdf.getImageProperties(imgData);
                const pdfHeight = (imgProps.height * pageWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pageWidth, pdfHeight);

                if (preview) {
                    // Preview in iframe
                    const pdfBlob = pdf.output('bloburl');
                    $('#pdfFrame').attr('src', pdfBlob);
                    $('#pdfPreviewModal').modal('show');
                    $('#custmDiv').hide();
                } else {
                    $('#custmDiv').hide();
                    // Download directly
                    pdf.save(`VC 202504 - Purchase Analysis (Credit vs Cash) ${new Date().getFullYear()}.pdf`);
                }
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Failed to generate PDF. Please try again.');
            } finally {
                button.prop('disabled', false).text(originalText);
            }
        }

        // Bind events
        $('#previewPDF').on('click', () => generatePurchasePDF(true));
        $('#createPDF').on('click', () => generatePurchasePDF(false));
    </script>
@endsection

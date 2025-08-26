@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Purchase Analysis</h4>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">
                        Purchase Analysis (Credit vs Cash in M/Ton) for [ 2025 ]
                    </h4>
                    <div class="card-toolbar">
                        <!-- Buttons as before -->
                        <button type="button" data-bs-toggle="modal" data-bs-target="#PurchaseAnalysisModal"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <a href="{{ asset('storage/app/public/deductions-pdf/VC_202505_Deduction_List.pdf') }}"
                            class="btn btn-primary btn-label waves-effect waves-light"
                            download="VC_202505_Deduction_List.pdf">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filters Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-2">
                            <label for="fromMonth" class="form-label">From Month</label>
                            <select id="fromMonth" name="from_month" class="form-select">
                                <option value="">--Month--</option>
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}">{{ date("F", mktime(0, 0, 0, $m, 1)) }}</option>
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
                                    <option value="{{ $m }}">{{ date("F", mktime(0, 0, 0, $m, 1)) }}</option>
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
                    </div>

                    <div class="row">
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
                                    <tbody>
                                        <tr>
                                            <td>Jan</td>
                                            <td>190.60</td>
                                            <td>34.21</td>
                                            <td>224.81</td>
                                        </tr>
                                        <tr>
                                            <td>Feb</td>
                                            <td>181.87</td>
                                            <td>32.45</td>
                                            <td>214.32</td>
                                        </tr>
                                        <tr>
                                            <td>Mar</td>
                                            <td>238.28</td>
                                            <td>37.73</td>
                                            <td>276.01</td>
                                        </tr>
                                        <tr>
                                            <td>Apr</td>
                                            <td>408.85</td>
                                            <td>88.11</td>
                                            <td>496.96</td>
                                        </tr>
                                        <tr>
                                            <td>May</td>
                                            <td>0.00</td>
                                            <td>15.16</td>
                                            <td>15.16</td>
                                        </tr>
                                        <tr>
                                            <td>Jun</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Jul</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Aug</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Sep</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Oct</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Nov</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Dec</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-light fw-bold">
                                        <tr>
                                            <td>Total</td>
                                            <td>1,019.60</td>
                                            <td>207.66</td>
                                            <td>1,227.26</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="card shadow-sm p-3">
                                <div id="purchaseChart" style="height: 350px;"></div>
                                <div id="purchaseChartYearly" style="height: 350px; margin-top: 20px;"></div>

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
    <script type="text/javascript" src="{{asset('/assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>

    <script>
        $(document).ready(function () {
            $('#PurchaseAnalysisListing').DataTable({
                paging: true,
                searching: true,
                ordering: true,
            });

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
                    text: '[ Apr 2025 ] Purchases'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
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
                    data: [
                        { name: 'Credit', y: 408.85, sliced: true, color: '#1f77b4' }, // Blue
                        { name: 'Cash', y: 88.11, color: '#7d2b25' }
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
                    text: '[ Jan-Dec 2025 ] Purchases'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
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
                    data: [
                        { name: 'Credit', y: 1019.60, sliced: true, color: '#1f77b4' },
                        { name: 'Cash', y: 207.66 , color: '#7d2b25'}
                    ]
                }]
            });
        });
    </script>

@endsection
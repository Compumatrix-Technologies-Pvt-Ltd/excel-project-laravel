@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Consolidated FFb</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Consolidated FFb</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.YearlyCashCredit.index') }}">Yearly Cash
                                VS Credit</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Cash VS Credit for [ 2025 ]</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="YearlyCashCredit" class="table table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2">Branch</th>
                                    @for($i = 1; $i <= 12; $i++)
                                        <th colspan="3">{{ \Carbon\Carbon::create()->month($i)->format('F') }}</th>
                                    @endfor
                                    <th colspan="3"  style="color: blue;">Grand Total</th>
                                </tr>
                                <tr>
                                    @for($i = 1; $i <= 12; $i++)
                                        <th>Cash</th>
                                        <th>Credit</th>
                                        <th>Total</th>
                                    @endfor
                                    <th style="color: red;">Cash</th>
                                    <th style="color: red;">Credit</th>
                                    <th style="color: red;">Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    @for($i = 1; $i <= 12; $i++)
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    @endfor
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody></tbody>
                        </table>

                    </div>


                    {{-- <div class="col-lg-12 mt-5">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border">
                                    <div class="card-body text-center">
                                        <div id="chart1"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border">
                                    <div class="card-body text-center">
                                        <div id="chart2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border">
                                    <div class="card-body text-center">
                                        <div id="chart3"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border">
                                    <div class="card-body text-center">
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border">
                                    <div class="card-body text-center">
                                        <div id="chart5"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border">
                                    <div class="card-body text-center">
                                        <div id="chart6"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

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


        $(document).ready(function () {
            const selectedYear = 2025;
            const months = Array.from({ length: 12 }, (_, i) => i + 1); 

            let columns = [
                { data: 'branch_name' }
            ];

            months.forEach(month => {
                ['cash', 'credit', 'total'].forEach(type => {
                    columns.push({
                        data: `month_${month}_${type}`,
                        render: function (d) {
                            return parseFloat(d).toFixed(2);
                        }
                    });
                });
            });

            ['grand_cash', 'grand_credit', 'grand_total'].forEach(col => {
                columns.push({
                    data: col,
                    render: function (d) {
                        return parseFloat(d).toFixed(2);
                    }
                });
            });

            $('#YearlyCashCredit').DataTable({
                ajax: {
                    url: ADMINURL + '/yearly-cash-credit/getRecords',
                    data: { year: selectedYear },
                    dataSrc: 'data'
                },
                columns: columns,
                paging: false,
                searching: true,
                ordering: true,
                responsive: false,
                footerCallback: function (row, data, start, end, display) {
                    const api = this.api();

                    for (let i = 1; i < api.columns().count(); i++) {
                        let total = api
                            .column(i, { page: 'all' })
                            .data()
                            .reduce((a, b) => parseFloat(a) + parseFloat(b), 0);

                        $(api.column(i).footer()).html(total.toFixed(2));
                    }
                }
            });
        });


        // document.addEventListener("DOMContentLoaded", function () {
        //     const chartData = [
        //         { name: "Jan Cash vs Credit", series: [200, 800], labels: ['Cash', 'Credit'] },
        //         { name: "Feb Cash vs Credit", series: [190, 810], labels: ['Cash', 'Credit'] },
        //         { name: "Mar Cash vs Credit", series: [160, 840], labels: ['Cash', 'Credit'] },
        //         { name: "Apr Cash vs Credit", series: [170, 830], labels: ['Cash', 'Credit'] },
        //         { name: "Jan–Feb Cash vs Credit", series: [390, 1610], labels: ['Cash', 'Credit'] },
        //         { name: "Jan–Apr Cash vs Credit", series: [720, 3280], labels: ['Cash', 'Credit'] },
        //     ];

        //     chartData.forEach((data, index) => {
        //         var options = {
        //             chart: {
        //                 type: 'pie',
        //                 height: 250
        //             },
        //             series: data.series,
        //             labels: data.labels,
        //             colors: ['#577fc9', '#e87d31'],
        //             legend: {
        //                 position: 'bottom'
        //             },
        //             title: {
        //                 text: data.name,
        //                 align: 'center'
        //             },
        //             dataLabels: {
        //                 enabled: true,
        //                 formatter: function (val, opts) {
        //                     return val.toFixed(0) + "%";
        //                 }
        //             }
        //         };

        //         var chart = new ApexCharts(document.querySelector("#chart" + (index + 1)), options);
        //         chart.render();
        //     });
        // });


    </script>

@endsection
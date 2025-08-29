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
                        <table class="table table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2"> </th>
                                    <th colspan="3">January</th>
                                    <th colspan="3">February</th>
                                    <th colspan="3">March</th>
                                    <th colspan="3">April</th>
                                    <th colspan="3">May</th>
                                    <th colspan="3">June</th>
                                    <th colspan="3" class="bg-light">Grand Total Year '2025</th>
                                </tr>
                                <tr>
                                    <!-- Repeat for each month -->
                                    <th>Cash<br>MT</th>
                                    <th>Credit<br>MT</th>
                                    <th>Total<br>MT</th>

                                    <th>Cash<br>MT</th>
                                    <th>Credit<br>MT</th>
                                    <th>Total<br>MT</th>

                                    <th>Cash<br>MT</th>
                                    <th>Credit<br>MT</th>
                                    <th>Total<br>MT</th>

                                    <th>Cash<br>MT</th>
                                    <th>Credit<br>MT</th>
                                    <th>Total<br>MT</th>

                                    <th>Cash<br>MT</th>
                                    <th>Credit<br>MT</th>
                                    <th>Total<br>MT</th>

                                    <th>Cash<br>MT</th>
                                    <th>Credit<br>MT</th>
                                    <th>Total<br>MT</th>

                                    <th>Cash<br>MT</th>
                                    <th>Credit<br>MT</th>
                                    <th>Total<br>MT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>LKS - SD</th>
                                    <td>87.46</td>
                                    <td>180.23</td>
                                    <td>267.69</td>
                                    <td>100.85</td>
                                    <td>193.21</td>
                                    <td>294.06</td>
                                    <td>84.48</td>
                                    <td>310.41</td>
                                    <td>394.89</td>
                                    <td>60.53</td>
                                    <td>287.30</td>
                                    <td>347.83</td>
                                    <td>80.05</td>
                                    <td>339.66</td>
                                    <td>419.71</td>
                                    <td>69.93</td>
                                    <td>317.16</td>
                                    <td>387.09</td>
                                    <td class="text-primary fw-bold">483.30</td>
                                    <td class="text-danger fw-bold">1,627.97</td>
                                    <td class="fw-bold">2,111.27</td>
                                </tr>
                                <tr>
                                    <th>LKS - SM</th>
                                    <td>35.68</td>
                                    <td>339.78</td>
                                    <td>375.46</td>
                                    <td>34.83</td>
                                    <td>401.37</td>
                                    <td>436.20</td>
                                    <td>78.09</td>
                                    <td>756.01</td>
                                    <td>834.10</td>
                                    <td>105.53</td>
                                    <td>1,169.07</td>
                                    <td>1,274.60</td>
                                    <td>89.90</td>
                                    <td>1,172.86</td>
                                    <td>1,262.76</td>
                                    <td>68.06</td>
                                    <td>1,061.66</td>
                                    <td>1,129.72</td>
                                    <td class="text-primary fw-bold">412.09</td>
                                    <td class="text-danger fw-bold">4,900.75</td>
                                    <td class="fw-bold">5,312.84</td>
                                </tr>
                                <tr>
                                    <th>SP</th>
                                    <td>127.44</td>
                                    <td>456.77</td>
                                    <td>584.21</td>
                                    <td>98.84</td>
                                    <td>369.07</td>
                                    <td>467.91</td>
                                    <td>145.18</td>
                                    <td>486.28</td>
                                    <td>631.46</td>
                                    <td>286.72</td>
                                    <td>848.76</td>
                                    <td>1,135.48</td>
                                    <td>311.96</td>
                                    <td>837.36</td>
                                    <td>1,149.32</td>
                                    <td>279.74</td>
                                    <td>709.20</td>
                                    <td>988.94</td>
                                    <td class="text-primary fw-bold">1,249.88</td>
                                    <td class="text-danger fw-bold">3,707.44</td>
                                    <td class="fw-bold">4,957.32</td>
                                </tr>
                                <tr>
                                    <th>VC</th>
                                    <td>34.21</td>
                                    <td>190.60</td>
                                    <td>224.81</td>
                                    <td>32.45</td>
                                    <td>181.87</td>
                                    <td>214.32</td>
                                    <td>37.73</td>
                                    <td>238.28</td>
                                    <td>276.01</td>
                                    <td>88.11</td>
                                    <td>408.85</td>
                                    <td>496.96</td>
                                    <td>101.50</td>
                                    <td>397.32</td>
                                    <td>498.82</td>
                                    <td>96.96</td>
                                    <td>396.82</td>
                                    <td>493.78</td>
                                    <td class="text-primary fw-bold">390.96</td>
                                    <td class="text-danger fw-bold">1,813.74</td>
                                    <td class="fw-bold">2,204.70</td>
                                </tr>
                                <tr class="fw-bold">
                                    <th>TOTAL</th>
                                    <td>284.79</td>
                                    <td>1,167.38</td>
                                    <td>1,452.17</td>
                                    <td>266.97</td>
                                    <td>1,145.52</td>
                                    <td>1,412.49</td>
                                    <td>345.48</td>
                                    <td>1,790.98</td>
                                    <td>2,136.46</td>
                                    <td>540.89</td>
                                    <td>2,713.98</td>
                                    <td>3,254.87</td>
                                    <td>583.41</td>
                                    <td>2,747.20</td>
                                    <td>3,330.61</td>
                                    <td>514.69</td>
                                    <td>2,484.84</td>
                                    <td>2,999.53</td>
                                    <td class="text-primary">2,536.23</td>
                                    <td class="text-danger">12,049.90</td>
                                    <td>14,586.13</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12 mt-5">
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
        document.addEventListener("DOMContentLoaded", function () {
            const chartData = [
                { name: "Jan Cash vs Credit", series: [200, 800], labels: ['Cash', 'Credit'] },
                { name: "Feb Cash vs Credit", series: [190, 810], labels: ['Cash', 'Credit'] },
                { name: "Mar Cash vs Credit", series: [160, 840], labels: ['Cash', 'Credit'] },
                { name: "Apr Cash vs Credit", series: [170, 830], labels: ['Cash', 'Credit'] },
                { name: "Jan–Feb Cash vs Credit", series: [390, 1610], labels: ['Cash', 'Credit'] },
                { name: "Jan–Apr Cash vs Credit", series: [720, 3280], labels: ['Cash', 'Credit'] },
            ];

            chartData.forEach((data, index) => {
                var options = {
                    chart: {
                        type: 'pie',
                        height: 250
                    },
                    series: data.series,
                    labels: data.labels,
                    colors: ['#577fc9', '#e87d31'],
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        text: data.name,
                        align: 'center'
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val, opts) {
                            return val.toFixed(0) + "%";
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart" + (index + 1)), options);
                chart.render();
            });
        });
    </script>

@endsection
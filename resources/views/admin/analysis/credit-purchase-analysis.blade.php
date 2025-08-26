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
                    <h4 class="card-title mb-0 flex-grow-1">Credit Purchase Analysis by Supplier in M/Ton for [ 2025 ]</h4>
                    <div class="card-toolbar">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#CreditPurchaseAnalysisModal"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <a href="{{ asset('storage/app/public/deductions-pdf/VC_202505_Deduction_List.pdf') }}"
                            class="btn btn-primary btn-label waves-effect waves-light"
                            download="VC_202505_Deduction_List.pdf">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                        </a>
                        <div id="CreditPurchaseAnalysisModal" class="modal fade" tabindex="-1"
                            aria-labelledby="CreditPurchaseAnalysisModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="CreditPurchaseAnalysisModalLabel">View PDF</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="height: 80vh;">
                                        <iframe
                                            src="{{ asset('storage/app/public/deductions-pdf/VC_202505_Deduction_List.pdf') }}"
                                            width="100%" height="100%" style="border: none;"></iframe>
                                        <!-- OR -->
                                        <!-- <embed src="assets/docs/sample.pdf" type="application/pdf" width="100%" height="100%"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="selectYear" class="form-label">From</label>
                            <select id="selectYear" class="form-select">
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
                    <div class="container-fluid mt-4">
                        <div class="table-responsive">
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
                                <tbody>
                                    <tr>
                                        <td>VC-A001 ROSDAH BINTI AHMAD</td>
                                        <td>2.59</td>
                                        <td>3.07</td>
                                        <td>2.84</td>
                                        <td>4.52</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>12.02</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A002 PAKAN BINTI ALIP</td>
                                        <td>0.34</td>
                                        <td>4.25</td>
                                        <td>3.40</td>
                                        <td>5.04</td>
                                        <td>8.04</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>18.03</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A003 RAKIA BINTI ALIP</td>
                                        <td>7.46</td>
                                        <td>6.58</td>
                                        <td>8.13</td>
                                        <td>10.98</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>33.15</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A004 SUHAILI BIN SULAIM</td>
                                        <td>2.90</td>
                                        <td>1.21</td>
                                        <td>4.49</td>
                                        <td>5.12</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>13.72</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A005 SITI HARJAH BINTI</td>
                                        <td>0.00</td>
                                        <td>1.57</td>
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
                                        <td>1.57</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A006 SYAZIAH BINTI MOHD</td>
                                        <td>2.63</td>
                                        <td>1.97</td>
                                        <td>1.32</td>
                                        <td>3.62</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>9.54</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A007 SAIDI BIN DARMA</td>
                                        <td>1.01</td>
                                        <td>1.32</td>
                                        <td>2.94</td>
                                        <td>3.82</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>9.09</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A008 SITI HAYATI BINTI</td>
                                        <td>5.01</td>
                                        <td>2.12</td>
                                        <td>4.11</td>
                                        <td>7.62</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>18.86</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A009 SYAMYZAR BIN MUSA</td>
                                        <td>1.81</td>
                                        <td>2.43</td>
                                        <td>4.72</td>
                                        <td>4.62</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>13.16</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A010 SURIANI BINTI SULAIMAN</td>
                                        <td>1.79</td>
                                        <td>1.76</td>
                                        <td>2.48</td>
                                        <td>4.60</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>19.87</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A011 SALBIAH BINTI SALLEH</td>
                                        <td>4.81</td>
                                        <td>6.31</td>
                                        <td>9.86</td>
                                        <td>11.90</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>32.88</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A012 SALAHUDIN BIN ESA</td>
                                        <td>5.23</td>
                                        <td>6.63</td>
                                        <td>7.84</td>
                                        <td>4.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>23.70</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A013 SITI NURUL SYAHIRA</td>
                                        <td>1.63</td>
                                        <td>3.90</td>
                                        <td>5.56</td>
                                        <td>7.70</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>18.79</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A014 SITI SYAZAYATI</td>
                                        <td>6.36</td>
                                        <td>5.21</td>
                                        <td>6.52</td>
                                        <td>8.88</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>26.40</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A015 TAHANG BIN TOLU</td>
                                        <td>0.62</td>
                                        <td>1.54</td>
                                        <td>2.44</td>
                                        <td>3.98</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>8.56</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A016 TOWMICHEEL BUTA</td>
                                        <td>0.89</td>
                                        <td>0.60</td>
                                        <td>0.00</td>
                                        <td>2.08</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>3.57</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A017 YUZAINI BIN MOHD</td>
                                        <td>2.91</td>
                                        <td>4.17</td>
                                        <td>5.62</td>
                                        <td>11.38</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>24.08</td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-light fw-bold">
                                    <tr>
                                        <td>Total</td>
                                        <td>70</td>
                                        <td>190.60</td>
                                        <td>181.87</td>
                                        <td>238.28</td>
                                        <td>408.85</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>1,019.60</td>
                                    </tr>
                                </tfoot>


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
            $('#CreditPurchaseAnalysisListing').DataTable({
                paging: true,
                searching: true,
                ordering: true,
            });
        });
    </script>

@endsection
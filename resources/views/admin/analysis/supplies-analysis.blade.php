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
                    <h4 class="card-title mb-0 flex-grow-1">FFB Supplies By [ Supplier ] For The Year [ 2025 ] </h4>
                    <div class="card-toolbar">
                        <button type="button" id="PreviewPdf" data-bs-toggle="modal" data-bs-target="#suppliesAnalysis"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <button type="button" id="CreatePdf" data-bs-toggle="modal" data-bs-target="#suppliesAnalysis"
                            class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
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
                                                    <option value="">--Year--</option>
                                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                <div class="col-md-12 mt-3">
                                                    <fieldset class="border rounded-3 p-3">
                                                        <legend class="float-none w-auto px-2 small fw-bold">Analysis Based
                                                            On</legend>
                                                        <div class="form-check form-radio-primary mb-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="licence_expiry" id="" value="" checked>
                                                            <label class="form-check-label"
                                                                for="mpobExpired">Supplier</label>
                                                        </div>
                                                        <div class="form-check form-radio-primary mb-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="licence_expiry" id="" value="">
                                                            <label class="form-check-label" for="mspoExpired">Mill</label>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>

                                                <button type="button" id="showPdfBtn" class="btn btn-success">Show
                                                    PDF</button>

                                                <a id="createPdfBtn"
                                                    href="{{ asset('storage/app/public/supplies-analysis-pdf/HQ_analysis_PDF.pdf') }}"
                                                    download="HQ_analysis_PDF.pdf" class="btn btn-success">
                                                    Create PDF
                                                </a>
                                            </div>
                                        </form>
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
                                <tbody>
                                    <tr>
                                        <td>Emasawit</td>
                                        <td>197.19</td>
                                        <td>187.94</td>
                                        <td>178.56</td>
                                        <td>339.74</td>
                                        <td>500.22</td>
                                        <td>636.60</td>
                                        <td>511.68</td>
                                        <td>78.46</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>2,630.39</td>
                                    </tr>
                                    <tr>
                                        <td>Equistar</td>
                                        <td>163.50</td>
                                        <td>212.78</td>
                                        <td>292.99</td>
                                        <td>266.78</td>
                                        <td>47.92</td>
                                        <td>106.70</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>1,090.67</td>
                                    </tr>
                                    <tr>
                                        <td>Fazley</td>
                                        <td>3.29</td>
                                        <td>0.00</td>
                                        <td>3.81</td>
                                        <td>1.93</td>
                                        <td>2.38</td>
                                        <td>3.21</td>
                                        <td>2.39</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>17.06</td>
                                    </tr>
                                    <tr>
                                        <td>HSKE</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>125.74</td>
                                        <td>301.85</td>
                                        <td>342.86</td>
                                        <td>35.94</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>806.39</td>
                                    </tr>
                                    <tr>
                                        <td>Habajaya</td>
                                        <td>15.20</td>
                                        <td>14.18</td>
                                        <td>14.64</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>44.02</td>
                                    </tr>
                                    <tr>
                                        <td>Harus Hijau</td>
                                        <td>71.54</td>
                                        <td>183.12</td>
                                        <td>228.98</td>
                                        <td>193.52</td>
                                        <td>34.92</td>
                                        <td>140.12</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>852.20</td>
                                    </tr>
                                    <tr>
                                        <td>Koh</td>
                                        <td>746.10</td>
                                        <td>404.62</td>
                                        <td>747.93</td>
                                        <td>1,127.19</td>
                                        <td>689.10</td>
                                        <td>445.58</td>
                                        <td>1,077.59</td>
                                        <td>93.06</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>5,331.17</td>
                                    </tr>
                                    <tr>
                                        <td>Kump.Sawit</td>
                                        <td>0.00</td>
                                        <td>76.64</td>
                                        <td>47.32</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>123.96</td>
                                    </tr>
                                    <tr>
                                        <td>Natural Vista</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>66.64</td>
                                        <td>299.64</td>
                                        <td>19.52</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>385.80</td>
                                    </tr>
                                    <tr>
                                        <td>PL Sawit</td>
                                        <td>109.59</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>91.84</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>201.43</td>
                                    </tr>

                                </tbody>

                                <tfoot class="table-light fw-bold">
                                    <td>31</td>
                                    <td>6,953.86</td>
                                    <td>6,777.03</td>
                                    <td>0.00</td>
                                    <td>9,136.65</td>
                                    <td>10,729.56</td>
                                    <td>11,534.09</td>
                                    <td>10,796.47</td>
                                    <td>9,948.35</td>
                                    <td>635.72</td>
                                    <td>0.00</td>
                                    <td>0.00</td>
                                    <td>0.00</td>
                                    <td>66,511.73</td>
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
            $('#SuppliesAnalysisListing').DataTable({
                paging: true,
                searching: true,
                ordering: true,
            });

            $('#showPdfBtn').on("click", function () {
                let url = "{{ asset('storage/app/public/supplies-analysis-pdf/HQ_analysis_PDF.pdf') }}";
                window.open(url, '_blank');
            });

            $('#PreviewPdf').on("click", function () {
                $('#showPdfBtn').show();
                $('#createPdfBtn').hide();
            });
            $('#CreatePdf').on("click", function () {
                $('#createPdfBtn').show();
                $('#showPdfBtn').hide();
            });
        });
    </script>

@endsection
@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Supplies</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Supplies</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.transactions.index') }}">Supplies
                                Summary</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Supplies Summary</h4>
                    <div class="card-toolbar">
                        <button type="button" id="PreviewPdf" data-bs-toggle="modal" data-bs-target="#suppliesSummary"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <button type="button" id="CreatePdf" data-bs-toggle="modal" data-bs-target="#suppliesSummary"
                            class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                        </button>
                        <div id="suppliesSummary" class="modal fade" tabindex="-1" aria-labelledby="suppliesSummaryLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="suppliesSummaryLabel">Supplies Details Option Form
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="javascript:void(0);" class="row g-3">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <label for="selectMonth" class="form-label">Supplier</label>
                                                    <select id="selectMonth" class="form-select">
                                                        <option value="">Select Supplier</option>
                                                        <option>WJ</option>
                                                        <option>ACH</option>
                                                        <option>Aplas</option>
                                                        <option>Arunamari</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="startDate" class="form-label">Start Date</label>
                                                <input type="date" id="startDate" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="endDate" class="form-label">End Date</label>
                                                <input type="date" id="endDate" class="form-control">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                                        <button type="button" id="showPdfBtn" class="btn btn-success">Show PDF</button>

                                        <a id="createPdfBtn"
                                            href="{{ asset('storage/app/public/supplies-summary-pdf/FFB_Supplies_Summary.pdf') }}"
                                            download="FFB_Supplies_Summary.pdf" class="btn btn-success">
                                            Create PDF
                                        </a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="SuppliesDetails" class="table table-bordered nowrap dt-responsive align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Supplier</th>
                                        <th colspan="8" style="text-align:center;">Palm Oil Mills</th>
                                        <th rowspan="2">Total Weight(MT)</th>
                                    </tr>
                                    <tr>
                                        <th>Atlantica</th>
                                        <th>HCahaya</th>
                                        <th>HCahaya (Bangkud)</th>
                                        <th>KLK Agri </th>
                                        <th>LCH</th>
                                        <th>TEOPP</th>
                                        <th>THP</th>
                                        <th>Mill 8</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Aplas</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>763.70</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>763.70</td>
                                    </tr>
                                    <tr>
                                        <td>B&F Coll.</td>
                                        <td>38.64</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>78.04</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>116.68</td>
                                    </tr>
                                    <tr>
                                        <td>Emasawit</td>
                                        <td>0.00</td>
                                        <td>259.38</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>259.38</td>
                                    </tr>
                                    <tr>
                                        <td>HSKE</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>39.64</td>
                                        <td>0.00</td>
                                        <td>131.78</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>171.42</td>
                                    </tr>
                                    <tr>
                                        <td>Koh</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>57.92</td>
                                        <td>0.00</td>
                                        <td>408.66</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>466.58</td>
                                    </tr>
                                    <tr>
                                        <td>Natural Vista</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>52.04</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>52.04</td>
                                    </tr>
                                    <tr>
                                        <td>Patinas</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>44.62</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>44.62</td>
                                    </tr>
                                    <tr>
                                        <td>Pertama Land</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>44.32</td>
                                        <td>0.00</td>
                                        <td>79.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>123.32</td>
                                    </tr>
                                    <tr>
                                        <td>Ranpek</td>
                                        <td>390.94</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>390.94</td>
                                    </tr>
                                    <tr>
                                        <td>Raymond</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>8.60</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>8.60</td>
                                    </tr>
                                    <tr>
                                        <td>SM</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>400.58</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>400.58</td>
                                    </tr>
                                    <tr>
                                        <td>SP</td>
                                        <td>58.70</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>231.76</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>290.46</td>
                                    </tr>
                                    <tr>
                                        <td>Sahabat PR</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>155.10</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>155.10</td>
                                    </tr>
                                    <tr>
                                        <td>Segama Maju</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>317.74</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>317.74</td>
                                    </tr>
                                    <tr>
                                        <td>Sri Paja</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>34.38</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>34.38</td>
                                    </tr>
                                    <tr>
                                        <td>VC</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>140.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>140.00</td>
                                    </tr>
                                    <tr>
                                        <td>WJ</td>
                                        <td>64.34</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>123.04</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>187.38</td>
                                    </tr>
                                    <tr>
                                        <td>Workon</td>
                                        <td>38.64</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>38.64</td>
                                    </tr>

                                </tbody>

                                <tfoot class="table-light">
                                    <tr class="fw-bold">
                                        <td>18</td>
                                        <td>591.26</td>
                                        <td>259.38</td>
                                        <td>52.04</td>
                                        <td>176.26</td>
                                        <td>1,737.12</td>
                                        <td>672.66</td>
                                        <td>472.84</td>
                                        <td>0.00</td>
                                        <td>3,961.56</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!--end row-->
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
            $('#SuppliesDetails').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
            $('#showPdfBtn').on("click", function () {
                let url = "{{ asset('storage/app/public/supplies-summary-pdf/FFB_Supplies_Summary.pdf') }}";
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
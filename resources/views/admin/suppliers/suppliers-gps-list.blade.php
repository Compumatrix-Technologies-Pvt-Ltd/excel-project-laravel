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
                            <i class="mdi mdi-calendar-clock label-icon align-middle fs-16 me-2"></i> Lic Expiry
                        </button>
                        <button type="button" id="CreatePdf" data-bs-toggle="modal" data-bs-target="#supplierGPSModal"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Expiry PDF
                        </button>

                        <button type="button" data-bs-toggle="modal" data-bs-target="#gpsCoordsModal"
                            class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="mdi mdi-crosshairs-gps label-icon align-middle fs-16 me-2"></i> GPS Coord
                        </button>
                        <a href="{{ asset('storage/app/public/GPS-coord-pdf/VC_202505_FFB_Supp_GPS_Coord_List.pdf') }}"
                            class="btn btn-warning btn-label waves-effect waves-light"
                            download="VC_202505_Deduction_List.pdf">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Coord PDF
                        </a>
                        <div id="gpsCoordsModal" class="modal fade" tabindex="-1" aria-labelledby="gpsCoordsModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="gpsCoordsModalLabel">View PDF</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="height: 80vh;">
                                        <iframe
                                            src="{{ asset('storage/app/public/GPS-coord-pdf/VC_202505_FFB_Supp_GPS_Coord_List.pdf') }}"
                                            width="100%" height="100%" style="border: none;"></iframe>
                                        <!-- OR -->
                                        <!-- <embed src="assets/docs/sample.pdf" type="application/pdf" width="100%" height="100%"> -->
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                                    <label for="expiryDate" class="form-label">Expired On Or Before</label>
                                                    <input type="date" class="form-control" id="expiryDate"
                                                        name="expiry_date">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>

                                                <button type="button" id="showPdfBtn" class="btn btn-success">View
                                                    PDF</button>

                                                <a id="createPdfBtn"
                                                    href="{{ asset('storage/app/public/MPOB-MSOP-pdf/VC_202505_FFB_Supp_(MSPO)_Certification_Expiry_List.pdf') }}"
                                                    download="VC_202505_FFB_Supp_(MSPO)_Certification_Expiry_List.pdf.pdf"
                                                    class="btn btn-success">
                                                    Download PDF
                                                </a>
                                            </div>
                                        </form>
                                        <!-- OR -->
                                        <!-- <embed src="assets/docs/sample.pdf" type="application/pdf" width="100%" height="100%"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
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
                                    <tr>
                                        <td>VC-B-A015</td>
                                        <td>Abas Bin Aris (K/P: 800605-12-5355)</td>
                                        <td>460874501000</td>
                                        <td>04 300 92 083</td>
                                        <td>6.0000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A015</td>
                                        <td>Abas Bin Aris (K/P: 800605-12-5355)</td>
                                        <td>460874501000</td>
                                        <td>04 300 92 083</td>
                                        <td>6.0000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A079</td>
                                        <td>Abd Razak Bin Hamid (K/P: 540314125111)</td>
                                        <td>810005001014</td>
                                        <td>-</td>
                                        <td>2.4726</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A079</td>
                                        <td>Abd Razak Bin Hamid (K/P: 540314125111)</td>
                                        <td>810005001014</td>
                                        <td>-</td>
                                        <td>2.4726</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A057</td>
                                        <td>Abd. Hamid Bin Majid(K/P: 650519-49-5054)</td>
                                        <td>555747010000</td>
                                        <td>-</td>
                                        <td>3.2300</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A057</td>
                                        <td>Abd.Hamid Bin Majid (K/P: 650519-49-5054)</td>
                                        <td>555747010000</td>
                                        <td>-</td>
                                        <td>3.2300</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A046</td>
                                        <td>Abd.Salam Bin Madatha (K/P: 550415-12-5347)</td>
                                        <td>277857101000</td>
                                        <td>04 300 92 082</td>
                                        <td>6.0600</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A046</td>
                                        <td>Abd.Salam Bin Madatha (K/P: 550415-12-5347)</td>
                                        <td>277857101000</td>
                                        <td>-</td>
                                        <td>6.0400</td>
                                        <td>5.558641</td>
                                        <td>117.818182</td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A046</td>
                                        <td>Abdul Azid Bin Madatha(K/P: 520720-12-2635)</td>
                                        <td>286341501000</td>
                                        <td>-</td>
                                        <td>11.8000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A046</td>
                                        <td>Abdul Azid Bin Madatha(K/P: 520720-12-2635)</td>
                                        <td>286341501000</td>
                                        <td>-</td>
                                        <td>11.8000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A076</td>
                                        <td>Abdul Ghani @ Yusuf Bin Maulah (K/P: 620909-12-5385)</td>
                                        <td>596896501000</td>
                                        <td>-</td>
                                        <td>0.9800</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A076</td>
                                        <td>Abdul Ghani@Yusuf Bin Maulah (K/P: 620909-12-5385)</td>
                                        <td>596896501000</td>
                                        <td>-</td>
                                        <td>0.9800</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A028</td>
                                        <td>Abdul Hassan Bin Bariol (K/P: 620121-12-5481)</td>
                                        <td>582101501000</td>
                                        <td>04 900 92 082</td>
                                        <td>1.8360</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A053</td>
                                        <td>Abdul Kadir Bin Ismail (K/P: 710219-12-5315)</td>
                                        <td>553815001000</td>
                                        <td>-</td>
                                        <td>4.0000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A053</td>
                                        <td>Abdul Kadir Bin Ismail (K/P: 710219-12-5315)</td>
                                        <td>553815001000</td>
                                        <td>-</td>
                                        <td>4.0000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A005</td>
                                        <td>Abdul Majid Bin Alfa (K/P: 750601-12-6323)</td>
                                        <td>418741101000</td>
                                        <td>-</td>
                                        <td>12.1400</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A005</td>
                                        <td>Abdul Majid Bin Alfa (K/P: 750601-12-6323)</td>
                                        <td>418741101000</td>
                                        <td>-</td>
                                        <td>12.1400</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A039</td>
                                        <td>Abdul Malik Bin Abdullah (K/P: 690917-12-5579)</td>
                                        <td>417489501000</td>
                                        <td>-</td>
                                        <td>4.0500</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A039</td>
                                        <td>Abdul Malik Bin Abdullah (K/P: 690917-12-5579)</td>
                                        <td>417489501000</td>
                                        <td>-</td>
                                        <td>4.0500</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A028</td>
                                        <td>Abdul Salleh Bin Salleh (K/P: 511008-12-5073)</td>
                                        <td>286263501000</td>
                                        <td>-</td>
                                        <td>10.2800</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A041</td>
                                        <td>Abdul Salleh Bin Masali (K/P: 710102-12-5471)</td>
                                        <td>564002101000</td>
                                        <td>-</td>
                                        <td>4.0000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A041</td>
                                        <td>Abdul Salleh Bin Masali (K/P: 710102-12-5471)</td>
                                        <td>564002101000</td>
                                        <td>-</td>
                                        <td>4.0000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A046</td>
                                        <td>Abdul Samat Bin Mad Taha (K/P: 670324-12-5236)</td>
                                        <td>286326501000</td>
                                        <td>-</td>
                                        <td>6.0700</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A046</td>
                                        <td>Abdul Samat Bin Mad Taha (K/P: 670324-12-5236)</td>
                                        <td>286326501000</td>
                                        <td>-</td>
                                        <td>6.0700</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A020</td>
                                        <td>Abdullah Bin Latuo (K/P: 491231-12-6305)</td>
                                        <td>460324501000</td>
                                        <td>04 300 92 082</td>
                                        <td>4.0400</td>
                                        <td>5.335700</td>
                                        <td>117.492039</td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A020</td>
                                        <td>Abdullah Bin Latuo (K/P: 491231-12-6305)</td>
                                        <td>460324501000</td>
                                        <td>04 300 92 082</td>
                                        <td>4.0400</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A020</td>
                                        <td>Abdullah Bin Latuo (K/P: 491231-12-6305)</td>
                                        <td>460324501000</td>
                                        <td>04 300 92 082</td>
                                        <td>6.0000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-A-A020</td>
                                        <td>Abdullah Bin Latuo (K/P: 491231-12-6305)</td>
                                        <td>460324501000</td>
                                        <td>04 300 92 082</td>
                                        <td>6.0000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>VC-B-A020</td>
                                        <td>Abdullah Bin Latuo (K/P: 491231-12-6305)</td>
                                        <td>460324501000</td>
                                        <td>04 300 92 082</td>
                                        <td>3.3800</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
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
            $('#SuppliergpsListing').DataTable({
                paging: true,
                searching: true,
                ordering: true

            });


            $('#showPdfBtn').on("click", function () {
                let url = "{{ asset('storage/app/public/MPOB-MSOP-pdf/VC_202505_FFB_Supp_(MSPO)_Certification_Expiry_List.pdf') }}";
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
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
                                Details</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Supplies Details</h4>
                    <div class="card-toolbar">
                        <button type="button" id="PreviewPdf" data-bs-toggle="modal" data-bs-target="#suppliesDetails"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <a href="{{ asset('storage/app/public/supplies-details-pdf/FFB_Supplies_Details_List.pdf') }}"
                            class="btn btn-primary btn-label waves-effect waves-light"
                            download="FFB_Supplies_Details_List.pdf">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                        </a>
                        <div id="suppliesDetails" class="modal fade" tabindex="-1" aria-labelledby="suppliesDetailsLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="suppliesDetailsLabel">Supplies Details Option Form
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
                                                <small><strong>Wira Jayamas Sdn Bhd 201101027032 (955167-P)</strong></small>
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

                                        <button type="button" id="showPdfBtn" class="btn btn-success">Show
                                            PDF</button>
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
                                        <th rowspan="2">Vehicle</th>
                                        <th rowspan="2">TRX Date</th>
                                        <th rowspan="2">Ticket No</th>
                                        <th colspan="5" style="text-align:center;">Palm Oil Mills</th>
                                        <th rowspan="2">Total Weight(MT)</th>
                                    </tr>
                                    <tr>
                                        <th>LCH</th>
                                        <th>Mill 2</th>
                                        <th>Mill 3</th>
                                        <th>Mill 4</th>
                                        <th>Mill 5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>WJ</td>
                                        <td>SAA3380K</td>
                                        <td>14-Aug-2025</td>
                                        <td>T047402</td>
                                        <td>15.28</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>15.28</td>
                                    </tr>

                                </tbody>
                                <tfoot class="table-light">
                                    <tr class="fw-bold">
                                        <td>1</td>
                                        <td></td>
                                        <td></td>
                                        <td>- Total -</td>
                                        <td>15.28</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>15.28</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td>1</td>
                                        <td></td>
                                        <td></td>
                                        <td>- G. Total -</td>
                                        <td>15.28</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>15.28</td>
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
                let url = "{{ asset('storage/app/public/supplies-details-pdf/FFB_Supplies_Details_List.pdf') }}";
                window.open(url, '_blank');
            });

        });
    </script>


@endsection
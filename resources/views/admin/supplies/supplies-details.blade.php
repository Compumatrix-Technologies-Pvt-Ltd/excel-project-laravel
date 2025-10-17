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
                                                    <label for="selectSupplier" class="form-label">Supplier</label>
                                                    <select id="selectSupplier" class="form-select">
                                                        <option value="">Select Supplier</option>
                                                        @foreach ($Suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_id }}
                                                            </option>
                                                        @endforeach
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
                                        <button type="button" class="btn btn-danger waves-effect waves-light"
                                            data-bs-dismiss="modal">Close</button>

                                        <button type="button" id="showPdfBtn"
                                            class="btn btn-warning btn-label waves-effect waves-light">
                                            <i class="ri-eye-fill label-icon align-middle fs-16 me-2"></i>Preview
                                            PDF</button>
                                        <button type="button" id="createPdfBtn"
                                            class="btn btn-primary btn-label waves-effect waves-light">
                                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create
                                            PDF</button>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {{-- <div class="row g-3">
                        <div class="col-md-5">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-info btn-label waves-effect waves-light">
                                <i class="mdi mdi-database-export label-icon align-middle fs-16 me-2"></i> Export Data
                            </button>
                        </div>
                    </div> --}}
                    <h6 id="dynamicHeading" style="text-align:center; font-weight:bold;">
                        FFB Supplies Details
                    </h6>
                    <div class="container-fluid mt-4">
                        <div class="row">
                            <table id="SuppliesDetails" class="table table-bordered nowrap dt-responsive align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Supplier</th>
                                        <th rowspan="2">Vehicle</th>
                                        <th rowspan="2">TRX Date</th>
                                        <th rowspan="2">Ticket No</th>

                                        <th colspan="{{ $allMills->count() }}" style="text-align:center">Palm Oil Mills</th>

                                        <th rowspan="2">Total Weight (MT)</th>
                                    </tr>
                                    <tr>
                                        @foreach ($allMills as $mill)
                                            <th>{{ $mill->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot></tfoot>


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
        const allMills = @json($allMills);
    </script>

    <script>
        $(document).ready(function () {
            $('#startDate, #endDate, #selectSupplier').change(function () {
                window.table1.ajax.reload();
                let supplierText = $('#selectSupplier option:selected').text() || 'All Suppliers';
                let startDate = $('#startDate').val();
                let endDate = $('#endDate').val();

                $('#dynamicHeading').html(
                    `FFB Supplies Details For Supplier = [ ${supplierText} ] From [ ${startDate} ] To [ ${endDate} ]`
                );
            });

            $('#showPdfBtn').on('click', function () {
                let supplierId = $('#selectSupplier').val();
                let startDate = $('#startDate').val();
                let endDate = $('#endDate').val();

                let url = "{{ route('admin.supplies.details.generatePDF') }}" +
                    `?supplier_id=${supplierId}&start_date=${startDate}&end_date=${endDate}&preview=1`;

                window.open(url, '_blank');
            });

            $('#createPdfBtn').on('click', function () {
                let supplierId = $('#selectSupplier').val();
                let startDate = $('#startDate').val();
                let endDate = $('#endDate').val();

                let url = "{{ route('admin.supplies.details.generatePDF') }}" +
                    `?supplier_id=${supplierId}&start_date=${startDate}&end_date=${endDate}`;

                window.open(url, '_blank');
            })


        });
    </script>


@endsection
@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Deductions</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Deductions</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.deductions.report.index') }}">Deduction
                                Reports</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Deduction Listing for the month of [05/2025]</h4>
                    <div class="card-toolbar">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#viewDeductionListModal"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <a href="{{ asset('storage/app/public/deductions-pdf/VC_202505_Deduction_List.pdf') }}"
                            class="btn btn-primary btn-label waves-effect waves-light"
                            download="VC_202505_Deduction_List.pdf">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                        </a>
                        <div id="viewDeductionListModal" class="modal fade" tabindex="-1"
                            aria-labelledby="viewDeductionListModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewDeductionListModalLabel">View PDF</h5>
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
                    {{-- <div class="row g-3">
                        <div class="col-md-2">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="selectMonth" class="form-label">Select Month</label>
                            <select id="selectMonth" class="form-select">
                                <option value="">--Month--</option>
                                <option>January</option>
                                <option>February</option>
                                <option>March</option>
                                <option>April</option>
                                <option>May</option>
                                <option>June</option>
                                <option>July</option>
                                <option>August</option>
                                <option>September</option>
                                <option>October</option>
                                <option>November</option>
                                <option>December</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="selectYear" class="form-label">Select Year</label>
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
                    </div> --}}
                    <div class="container-fluid mt-4">
                        <div class="table-responsive">
                            <table id="DeductionReportsListing"
                                class="table table-bordered table-striped nowrap align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Supplier</th>
                                        <th colspan="3">Deductions</th>
                                        <th rowspan="2">Remark</th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Transport</th>
                                        <th>Advance</th>
                                        <th>Others</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align: center;">--- Grand Total ---</th>
                                        <th id="grandTransport"></th>
                                        <th id="grandAdvance"></th>
                                        <th id="grandOthers"></th>
                                        <th></th> 
                                    </tr>
                                </tfoot>
                            </table>
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

    <script
        src="{{ asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js') }}"></script>

    <script src="https://cdn.datatables.net/rowgroup/1.3.1/js/dataTables.rowGroup.min.js"></script>

    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>
@endsection
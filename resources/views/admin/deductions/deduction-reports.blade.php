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
                    <div class="row g-3">
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
                    </div>
                    <div class="container-fluid mt-4">
                        <div class="table-responsive">
                            <table id="DeductionReportsListing"
                                class="table table-bordered table-striped nowrap align-middle" style="width:100%">
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

                                <tbody>
                                    <tr>
                                        <td>14-May-2025</td>
                                        <td>VC-A-A089</td>
                                        <td>Affiz Izwan Bin Hamdi (K/P: 920902-12-5139)</td>
                                        <td></td>
                                        <td>1,500.00</td>
                                        <td></td>
                                        <td>S.ADV 008</td>
                                    </tr>
                                    <tr>
                                        <td>20-May-2025</td>
                                        <td>VC-A-A001</td>
                                        <td>Asharin Bin Suhardi (K/P: 810504-12-5507)</td>
                                        <td></td>
                                        <td>200.00</td>
                                        <td></td>
                                        <td>S.ADV 017</td>
                                    </tr>
                                    <tr>
                                        <td>28-May-2025</td>
                                        <td>VC-A-A044</td>
                                        <td>Azim Bin Batara (K/P: 590703-12-5081)</td>
                                        <td></td>
                                        <td>650.00</td>
                                        <td></td>
                                        <td>S.ADV 035</td>
                                    </tr>
                                    <tr>
                                        <td>27-May-2025</td>
                                        <td>VC-A-A067</td>
                                        <td>Al Fazli Bin Mohd Salleh (K/P: 750529-12-5237)</td>
                                        <td></td>
                                        <td>3,600.00</td>
                                        <td></td>
                                        <td>S.ADV 033</td>
                                    </tr>
                                    <tr>
                                        <td>10-May-2025</td>
                                        <td>VC-A-A081</td>
                                        <td>Aliasa Bin Ismail (K/P: 541005-12-5155)</td>
                                        <td></td>
                                        <td>2,200.00</td>
                                        <td></td>
                                        <td>S.ADV 001</td>
                                    </tr>
                                    <tr>
                                        <td>15-May-2025</td>
                                        <td>VC-A-A092</td>
                                        <td>Mohd Hafiz Bin Zainal (K/P: 800812-12-5333)</td>
                                        <td></td>
                                        <td>1,000.00</td>
                                        <td></td>
                                        <td>S.ADV 011</td>
                                    </tr>
                                    <tr>
                                        <td>18-May-2025</td>
                                        <td>VC-A-A075</td>
                                        <td>Rahim Bin Abdullah (K/P: 720601-07-4477)</td>
                                        <td></td>
                                        <td>1,250.00</td>
                                        <td></td>
                                        <td>S.ADV 014</td>
                                    </tr>
                                    <tr>
                                        <td>19-May-2025</td>
                                        <td>VC-A-A034</td>
                                        <td>Hisham Bin Salleh (K/P: 690213-05-7788)</td>
                                        <td></td>
                                        <td>800.00</td>
                                        <td></td>
                                        <td>S.ADV 016</td>
                                    </tr>
                                    <tr>
                                        <td>21-May-2025</td>
                                        <td>VC-A-A056</td>
                                        <td>Roslan Bin Mat (K/P: 750101-10-8899)</td>
                                        <td></td>
                                        <td>900.00</td>
                                        <td></td>
                                        <td>S.ADV 020</td>
                                    </tr>
                                    <tr>
                                        <td>28-May-2025</td>
                                        <td>VC-A-A098</td>
                                        <td>Rafiq Bin Musa (K/P: 740909-07-2233)</td>
                                        <td></td>
                                        <td>2,450.00</td>
                                        <td></td>
                                        <td>S.ADV 060</td>
                                    </tr>
                                </tbody>

                                <tfoot class="table-light">
                                    <tr class="fw-bold">
                                        <td colspan="3" class="text-center">Grand Total</td>
                                        <td></td>
                                        <td>14,550.00</td> <!-- summed all Advance values -->
                                        <td></td>
                                        <td></td>
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
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#DeductionReportsListing').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: false,
                rowCallback: function (row, data) {
                    if ($(row).hasClass('total-row')) {
                        $(row).addClass('skip-dt'); // styling only
                    }
                },
                createdRow: function (row, data, dataIndex) {
                    if ($(row).hasClass('total-row')) {
                        $.fn.dataTable.ext.errMode = 'none'; // suppress errors
                    }
                }
            });
        });
    </script>

@endsection
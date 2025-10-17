@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Credit Purchase Listing</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Credit Purchases</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.creditPurchase.index') }}">Credit
                                Purchase Listing</a>
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
                    <h4 class="card-title mb-0 flex-grow-1">Credit Purchase Listing for the month of [{{App\Helpers\Helper::getPeriodInFormat()}}]</h4>
                    <div class="card-toolbar">
                        <button type="button" id="PreviewPdf" data-bs-toggle="modal"
                            data-bs-target="#viewCreditPurchaseListModal"
                            class="btn btn-warning btn-label waves-effect waves-light">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <button type="button" id="CreatePdf" data-bs-toggle="modal"
                            data-bs-target="#viewCreditPurchaseListModal"
                            class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                        </button>

                        <div id="viewCreditPurchaseListModal" class="modal fade" tabindex="-1"
                            aria-labelledby="viewCreditPurchaseListModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewCreditPurchaseListModalLabel">View PDF</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="javascript:void(0);" class="row g-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="selectYear" class="form-label">Select Year</label>
                                                <select id="selectYear" class="form-select">
                                                    <option value="">--Year--</option>
                                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-6">
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

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label for="mspo-certification" class="form-label d-block">MSPO
                                                    Certifications</label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check form-check-inline form-radio-primary">
                                                        <input class="form-check-input" type="radio" id="registered"
                                                            value="registered" checked>
                                                        <label class="form-check-label" for="registered">Registered</label>
                                                    </div>
                                                    <div class="form-check form-check-inline form-radio-primary">
                                                        <input class="form-check-input" type="radio" id="non-registered"
                                                            value="non-registered">
                                                        <label class="form-check-label"
                                                            for="non-registered">Non-Registered</label>
                                                    </div>
                                                    <div class="form-check form-check-inline form-radio-primary">
                                                        <input class="form-check-input" type="radio" id="both" value="both">
                                                        <label class="form-check-label" for="RENType">Both</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label for="purchases" class="form-label d-block">Purchases</label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check form-check-inline form-radio-primary">
                                                        <input class="form-check-input" type="radio" id="credit"
                                                            value="credit" checked>
                                                        <label class="form-check-label" for="credit">Credit</label>
                                                    </div>
                                                    <div class="form-check form-check-inline form-radio-primary">
                                                        <input class="form-check-input" type="radio" id="cash" value="cash">
                                                        <label class="form-check-label" for="cash">Cash</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label for="analyse-in" class="form-label d-block">Analyse In</label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check form-check-inline form-radio-primary">
                                                        <input class="form-check-input" type="radio" id="m-ton"
                                                            value="m-ton">
                                                        <label class="form-check-label" for="m-ton">M/Ton</label>
                                                    </div>
                                                    <div class="form-check form-check-inline form-radio-primary">
                                                        <input class="form-check-input" type="radio" id="rm" value="rm">
                                                        <label class="form-check-label" for="rm">RM</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>

                                            <button type="button" id="showPdfBtn" class="btn btn-success">Show PDF</button>

                                            <a id="createPdfBtn"
                                                href="{{ asset('storage/app/public/deductions-pdf/VC_202505_Deduction_List.pdf') }}"
                                                download="VC_202505_Deduction_List.pdf" class="btn btn-success">
                                                Create PDF
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
                            <table id="CreditPurchaseListing" class="table table-bordered table-striped nowrap align-middle"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="2">Supplier</th>
                                        <th rowspan="2">Supplier Name</th>
                                        <th>Weight</th>
                                        <th rowspan="2">Price</th>
                                        <th rowspan="2">Inc. Rate</th>
                                        <th rowspan="2">Subsidy</th>
                                        <th rowspan="2">Amt. Before Ded.</th>
                                        <th colspan="4">Deductions</th>
                                        <th rowspan="2">Net Pay</th>
                                        <th rowspan="2">Debit Bal. C/F</th>
                                    </tr>
                                    <tr>
                                        <th>Inv. No.</th>
                                        <th>Id</th>
                                        <th>(M/Ton)</th>
                                        <th>Transport</th>
                                        <th>Bal. B/F</th>
                                        <th>Advance</th>
                                        <th>Others</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ffbTransactions as $txn)
                                        <tr>
                                            <td>{{ $txn->invoice_no }}</td>
                                            <td>{{ optional($txn->supplier)->supplier_id }}</td>
                                            <td>{{ optional($txn->supplier)->supplier_name ?? 'N/A' }}</td> {{-- assuming relationship supplier() --}}
                                            <td>{{ number_format($txn->weight_mt, 2) }}</td>
                                            <td>{{ number_format($txn->price, 2) }}</td>
                                            <td>{{ number_format($txn->incentive_rate, 2) }}</td>
                                            <td>{{ number_format($txn->subsidy_amt, 2) }}</td>
                                            <td>{{ number_format($txn->amt_before_ded, 2) }}</td>
                                            <td>{{ number_format($txn->transport, 2) }}</td>
                                            <td>{{ number_format($txn->debit_bal_bf, 2) }}</td>
                                            <td>{{ number_format($txn->advance, 2) }}</td>
                                            <td>{{ number_format($txn->others, 2) }}</td>
                                            <td>{{ number_format($txn->net_pay, 2) }}</td>
                                            <td>{{ number_format($txn->debit_bal_cf, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-center"><b>TOTAL</b></td>
                                        <td>{{ number_format($ffbTransactions->sum('weight_mt'), 2) }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ number_format($ffbTransactions->sum('subsidy_amt'), 2) }}</td>
                                        <td>{{ number_format($ffbTransactions->sum('amt_before_ded'), 2) }}</td>
                                        <td>{{ number_format($ffbTransactions->sum('transport'), 2) }}</td>
                                        <td>{{ number_format($ffbTransactions->sum('debit_bal_bf'), 2) }}</td>
                                        <td>{{ number_format($ffbTransactions->sum('advance'), 2) }}</td>
                                        <td>{{ number_format($ffbTransactions->sum('others'), 2) }}</td>
                                        <td>{{ number_format($ffbTransactions->sum('net_pay'), 2) }}</td>
                                        <td>{{ number_format($ffbTransactions->sum('debit_bal_cf'), 2) }}</td>
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
            $('#CreditPurchaseListing').DataTable({
                paging: true,
                searching: true,
                ordering: true,
            });


            $('#showPdfBtn').on("click", function () {
                let url = "{{ asset('storage/app/public/deductions-pdf/VC_202505_Deduction_List.pdf') }}";
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
@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Consolidated FFB</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Consolidated FFB</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.creditPurchase.index') }}">Cash
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
                    <h4 class="card-title mb-0 flex-grow-1">Cash Purchase Analysis by Supplier in M/Ton for <span class="yearDoc">[ {{date('Y')}} ]</span>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="selectBranch" class="form-label">Branches</label>
                            <select id="selectBranch" name="branch_id" class="form-select">
                                <option value="">Select Branch</option>
                                @foreach ($Branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="selectYear" class="form-label">Year</label>
                            <select id="yearSelect" class="form-select">
                                @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button id="downloadPDF" class="btn btn-primary btn-label waves-effect waves-light">
                                <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
                            </button>
                        </div>
                    </div>
                    <div class="container-fluid mt-4">
                        <div class="table-responsive">
                            <table id="consolidatedCashPurchaseAnalysisTable" class="table nowrap dt-responsive align-middle" style="width:100%">
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
                                <tbody id="tableBody">
                                </tbody>
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
        $('#downloadPDF').on('click', function () {
            let branchId = $('#selectBranch').val();
            let year = $('#yearSelect').val() || new Date().getFullYear();
            if (!branchId) {
                alert('Please select a branch first.');
                return;
            }
            let url = `${ADMINURL}/purchase-analysis/consolidated/pdf?branch_id=${branchId}&year=${year}&purchaseType=cash`;
            window.location.href = url;
        });

    </script>

@endsection
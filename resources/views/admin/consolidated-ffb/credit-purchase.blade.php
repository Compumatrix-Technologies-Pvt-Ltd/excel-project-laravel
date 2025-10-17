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
                    <h4 class="card-title mb-0 flex-grow-1">Credit Purchase Analysis by Supplier in M/Ton for [ 2025 ]
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
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-info btn-label waves-effect waves-light">
                                <i class="mdi mdi-database-export label-icon align-middle fs-16 me-2"></i> Export Data
                            </button>
                        </div>
                    </div>
                    <div class="container-fluid mt-4">
                        <div class="table-responsive">
                            <table id="analysisTable" class="table nowrap dt-responsive align-middle" style="width:100%">
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
        const branchData = {
            hq: [
                ["HQ-A-A013 Aplas Sawit Sdn Bhd 201801007441 (1269455-K)", 437.21, 463.23, 708.4, 1221.6, 93.54, 0.45, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4741.00],
                ["HQ-A-A014 Aplas Sawit Sdn Bhd 201801007441 (1269455-K)", 0.00, 29.10, 99.60, 63.09, 102.08, 390.05, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 683.04],
                ["HQ-A-A015 Aplas Sawit Sdn Bhd 201801007441 (1269455-K)", 8.00, 15.00, 12.00, 20.00, 18.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1061.00],
                ["HQ-A-A016 Arunamari Estates Sdn Bhd 200501006007 (683054-D)", 8.10, 15.04, 12.01, 20.4, 18.23, 10.35, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2948.00],
                ["HQ-A-A017 ACH FFB Collecting (KDT/2022/3545)", 8.00, 15.00, 12.00, 20.00, 18.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1728.00],
                ["HQ-A-B010 Borneo Crops Sdn Bhd 197901008441 (52728-T)", 8.32, 15.33, 12.67, 20.89, 18.12, 10.69, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 604.00],
                ["HQ-A-B018 Bumimas Sawit 88 Sdn Bhd 202001020672 (1376992-U)", 1122.00, 762.00, 889.00, 174.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1432.00]
            ],

            sd: [
                ["SD-A-A036 AMJAH BIN BULUNGAN (K/P: 630620-12-5207)", 12.00, 18.00, 14.00, 22.00, 28.00, 20.00, 19.00, 30.00, 27.00, 21.00, 33.00, 48.00, 292.00],
                ["SD-A-A040 AUGUSTINE BIN BANGAR (K/P: 790828-12-5575)", 5.00, 10.00, 8.00, 15.00, 12.00, 9.00, 11.00, 20.00, 19.00, 13.00, 25.00, 35.00, 182.00],
                ["SD-A-A041 ABAS BIN LABA ( NO. K/P: 680805-12-5671)", 5.00, 10.00, 8.00, 15.00, 12.00, 9.00, 11.00, 20.00, 19.00, 13.00, 25.00, 35.00, 182.00],
                ["SD-A-A042 AZURAH BINTI DAHERI (K/P: 950907-12-6322)", 5.00, 10.00, 8.00, 15.00, 12.00, 9.00, 11.00, 20.00, 19.00, 13.00, 25.00, 35.00, 182.00],
                ["SD-A-A043 AGUS BIN ONGKI (K/P: 450202-12-5361)", 5.00, 10.00, 8.00, 15.00, 12.00, 9.00, 11.00, 20.00, 19.00, 13.00, 25.00, 35.00, 182.00],
                ["SD-A-B008 BAHARUDIN BIN BEDULU (K/P: 730830-12-5553)", 5.00, 10.00, 8.00, 15.00, 12.00, 9.00, 11.00, 20.00, 19.00, 13.00, 25.00, 35.00, 182.00],
                ["SD-A-B009 BASO BIN MAPATANG (K/P: 660802-12-5539)", 5.00, 10.00, 8.00, 15.00, 12.00, 9.00, 11.00, 20.00, 19.00, 13.00, 25.00, 35.00, 182.00]
            ],

            sm: [
                ["SM-A-A010 ABUSTANG BIN BADDU (K/P : 500203-12-5243)", 9.00, 14.00, 11.00, 18.00, 16.00, 12.00, 15.00, 24.00, 20.00, 15.00, 28.00, 40.00, 222.00],
                ["SM-A-A011 AG SALLEH BIN MOHAMMAD-ATALAD (K/P : 590204-12-5503)", 9.00, 14.00, 11.00, 18.00, 16.00, 12.00, 15.00, 24.00, 20.00, 15.00, 28.00, 40.00, 222.00],
                ["SM-A-B001 B & F COLLECTION CENTRE SDN BHD (919426V)", 9.00, 14.00, 11.00, 18.00, 16.00, 12.00, 15.00, 24.00, 20.00, 15.00, 28.00, 40.00, 222.00],
                ["SM-A-C001 CHIN JIN KONG (K/P : 560808-12-5267)", 9.00, 14.00, 11.00, 18.00, 16.00, 12.00, 15.00, 24.00, 20.00, 15.00, 28.00, 40.00, 222.00],
                ["SM-A-C002 CHONG JUAN VUN (K/P : 740529-12-5043)", 9.00, 14.00, 11.00, 18.00, 16.00, 12.00, 15.00, 24.00, 20.00, 15.00, 28.00, 40.00, 222.00],
                ["SM-A-C004 CHU LIP KONG TIMBER WORKS (R1881/80)", 9.00, 14.00, 11.00, 18.00, 16.00, 12.00, 15.00, 24.00, 20.00, 15.00, 28.00, 40.00, 222.00]
            ],

            sp: [
                ["SP-A-A005 AYOI@HENRY BIN SALAMAT@SELAMAT K/P:510313125219", 7.00, 13.00, 10.00, 16.00, 14.00, 11.00, 12.00, 22.00, 18.00, 14.00, 27.00, 38.00, 202.00],
                ["SP-A-A025 ALIP@MUHAMAD HARRIS BIN ABDULLAH K/P:630311125377", 7.00, 13.00, 10.00, 16.00, 14.00, 11.00, 12.00, 22.00, 18.00, 14.00, 27.00, 38.00, 202.00],
                ["SP-A-A032 AILEEN NICHOL K/P:711010125730", 7.00, 13.00, 10.00, 16.00, 14.00, 11.00, 12.00, 22.00, 18.00, 14.00, 27.00, 38.00, 202.00],
                ["SP-A-A070 ABDUL GHANI BIN BOTIK K/P:550615125421", 7.00, 13.00, 10.00, 16.00, 14.00, 11.00, 12.00, 22.00, 18.00, 14.00, 27.00, 38.00, 202.00],
                ["SP-A-A099 ABDUL MAJID MUING@MUIN K/890421126283", 7.00, 13.00, 10.00, 16.00, 14.00, 11.00, 12.00, 22.00, 18.00, 14.00, 27.00, 38.00, 202.00],
                ["SP-A-B023 BAINAH MARAYONG K/P:611115125106", 7.00, 13.00, 10.00, 16.00, 14.00, 11.00, 12.00, 22.00, 18.00, 14.00, 27.00, 38.00, 202.00]
            ],

            vc: [
                ["VC-A-A001 ASHARIN BIN SUHARDI (K/P: 810504-12-5507)", 11.00, 17.00, 13.00, 21.00, 19.00, 14.00, 16.00, 26.00, 23.00, 18.00, 31.00, 42.00, 251.00],
                ["VC-A-A017 AISA BINTI SADAYAR (K/P : 580513-12-5444)", 11.00, 17.00, 13.00, 21.00, 19.00, 14.00, 16.00, 26.00, 23.00, 18.00, 31.00, 42.00, 251.00],
                ["VC-A-A024 AJAK BIN SULAIMAN (K/P : 670404-12-5225)", 11.00, 17.00, 13.00, 21.00, 19.00, 14.00, 16.00, 26.00, 23.00, 18.00, 31.00, 42.00, 251.00],
                ["VC-A-A029 AWANG HASIM BIN SALMIN (K/P : 770529-12-5729)", 11.00, 17.00, 13.00, 21.00, 19.00, 14.00, 16.00, 26.00, 23.00, 18.00, 31.00, 42.00, 251.00],
                ["VC-A-A044 AZIM BIN BATARA ( K/P : 590703-12-5081 )", 11.00, 17.00, 13.00, 21.00, 19.00, 14.00, 16.00, 26.00, 23.00, 18.00, 31.00, 42.00, 251.00],
                ["VC-A-A050 ASRIM@ASRIN BIN OMAR MAYA (K/P:630720-12-5837)", 11.00, 17.00, 13.00, 21.00, 19.00, 14.00, 16.00, 26.00, 23.00, 18.00, 31.00, 42.00, 251.00]
            ]

        };


        $("#selectBranch").on("change", function () {
            let branch = $(this).val();
            let $tableBody = $("#tableBody");
            $tableBody.empty();

            if (branch && branchData[branch]) {
                $.each(branchData[branch], function (i, row) {
                    let tr = $("<tr>");
                    $.each(row, function (j, cell) {
                        tr.append($("<td>").text(cell));
                    });
                    $tableBody.append(tr);
                });
            }
        });
    </script>

@endsection
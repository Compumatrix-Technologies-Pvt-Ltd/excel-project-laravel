@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Cash Purchases Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Cash Purchases Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.banks.index') }}">Cash Purchases
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
                <div class="card-header align-items-center d-flex justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">Cash Purchases Listing</h4>
                    <h4 class="card-title mb-0 flex-grow-1 text-danger"><strong>Branch:</strong> VC Majumas SDN BHD</h4>
                    <div class="card-toolbar">
                         <button type="button" data-bs-toggle="modal" data-bs-target="#branchModal" class="btn btn-warning btn-label waves-effect waves-ligh">
                            <i class="mdi mdi-table-eye label-icon align-middle fs-16 me-2"></i> Preview PDF
                        </button>
                        <a href="{{ asset('storage/app/public/cash-purchase-pdf/VC_202505 _Cash_Purchase_Summary.pdf') }}" 
                            class="btn btn-primary btn-label waves-effect waves-light"
                            download="VC_202505 _Cash_Purchase_Summary.pdf">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i>Create PDF
                        </a>


                    </div>
                </div>

                <div class="card-body">
                    <form data-toggle="validator" method="POST" action="" class="d-flex row" novalidate="true">
                        <input type="hidden" name="_token" value="" autocomplete="off">
                        <input type="hidden" name="_method" value="POST">
                        <div class="col-md-2">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" placeholder="Select Start Date" name="start_date"
                                id="start_date" value="">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" placeholder="Select End Date" name="end_date"
                                id="end_date" value="">
                        </div>
                        {{-- <div class="col-md-3">
                            <label class="form-label">Cash Bill No. </label>
                            <select name="status" id="statusFilter" class="form-select">
                                <option value="">Select Bill No.</option>
                                <option value="pending">VCCB2505001</option>
                                <option value="delivered">VCCB2505002</option>
                                <option value="cancel">VCCB2505003</option>
                            </select>
                        </div> --}}
                        <div class="col-md-3">
                            <label class="form-label">Supplier </label>
                            <select name="supplier_id" id="supplierFilter" class="form-select">
                                <option value="">Select Supplier</option>
                                <option value="TVRZPQ==">Aisa Binti Sidayar (K/P: 580513-12-5444) </option>
                                <option value="TVRjPQ==">Asrim @ Asrim Bin Omar Maya (K/P: 630720-12-5837) </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info btn-label waves-effect waves-light mt-4"><i
                                    class="mdi mdi-database-export label-icon align-middle fs-16 me-2"></i> Export
                                Data</button>
                        </div>
                    </form>
                    <div class="container-fluid mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="BranchListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Supp. Id</th>
                                            <th>Supplier Name</th>
                                            <th>Wt. (M/Ton)</th>
                                            <th>Subsidy</th>
                                            <th>Net Pay</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>VC-B-A067</td>
                                            <td>Al Fazli Bin Mohd Salleh (K/P: 750529-12-5237)</td>
                                            <td>2.24</td>
                                            <td>0.00</td>
                                            <td>1,553.20</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-A090</td>
                                            <td>Akang Bin Takin (K/P: 600821-12-5425)</td>
                                            <td>3.80</td>
                                            <td>0.00</td>
                                            <td>2,533.60</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-B005</td>
                                            <td>Buanda Binti Datu Tambuyong (K/P: 581009-12-5204)</td>
                                            <td>1.44</td>
                                            <td>0.00</td>
                                            <td>950.40</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-D002</td>
                                            <td>Dani Bin Salmin (K/P: 750529-12-5819)</td>
                                            <td>5.02</td>
                                            <td>0.00</td>
                                            <td>3,313.20</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-D013</td>
                                            <td>Dibah Binti Sagit (K/P: 540731-12-5200)</td>
                                            <td>1.28</td>
                                            <td>0.00</td>
                                            <td>870.40</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-H019</td>
                                            <td>Hermawati Binti Beddu (K/P: 840725-12-5970)</td>
                                            <td>0.98</td>
                                            <td>0.00</td>
                                            <td>666.40</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-I012</td>
                                            <td>Isni Binti Usop @ Supiah Binti Yussof (K/P: 741116125648)</td>
                                            <td>4.00</td>
                                            <td>0.00</td>
                                            <td>2,651.20</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-J044</td>
                                            <td>Jamin Bin Lokman (K/P: 660513-12-5591)</td>
                                            <td>3.76</td>
                                            <td>0.00</td>
                                            <td>2,481.60</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-M063</td>
                                            <td>Mohd Wan Hafiz Bin Rahman (K/P: 941210-12-5763)</td>
                                            <td>16.30</td>
                                            <td>0.00</td>
                                            <td>11,033.20</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-M103</td>
                                            <td>Mazrinah Binti John (K/P: 910618-12-5810)</td>
                                            <td>1.84</td>
                                            <td>0.00</td>
                                            <td>1,288.00</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-M112</td>
                                            <td>Mayau Bin Paradu (K/P: 620329-12-5173)</td>
                                            <td>1.34</td>
                                            <td>0.00</td>
                                            <td>911.20</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-N044</td>
                                            <td>Nadirah Binti Ghani (K/P: 971108-12-6708)</td>
                                            <td>3.78</td>
                                            <td>0.00</td>
                                            <td>2,531.60</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-R027</td>
                                            <td>Rambong @ Charles Bin Gangon (K/P: 600415-12-5315)</td>
                                            <td>4.56</td>
                                            <td>0.00</td>
                                            <td>3,058.00</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-R057</td>
                                            <td>Reven Bin Sungeh (K/P: 840528-15-5003)</td>
                                            <td>3.82</td>
                                            <td>0.00</td>
                                            <td>2,521.20</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-S005</td>
                                            <td>Suhail Bin Salim (K/P: 751113-12-5481)</td>
                                            <td>23.52</td>
                                            <td>0.00</td>
                                            <td>15,835.20</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-S013</td>
                                            <td>Sudin Bin Haji Aluk (K/P: 520304-12-5371)</td>
                                            <td>12.10</td>
                                            <td>0.00</td>
                                            <td>8,026.40</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-S052</td>
                                            <td>Shahzwan Bin Jakaria (K/P: 880102-49-5621)</td>
                                            <td>0.28</td>
                                            <td>0.00</td>
                                            <td>190.40</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-S068</td>
                                            <td>Saing Bin Damari (K/P: 551031-12-5107)</td>
                                            <td>3.92</td>
                                            <td>0.00</td>
                                            <td>2,613.60</td>
                                        </tr>
                                        <tr>
                                            <td>VC-B-S069</td>
                                            <td>Suriani Binti Ardin (K/P: 780929-12-6040)</td>
                                            <td>1.50</td>
                                            <td>0.00</td>
                                            <td>990.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <th>95.48</th>
                                            <th>0.00</th>
                                            <th>64,018.80</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                       <div id="branchModal" class="modal fade" tabindex="-1" aria-labelledby="bankEditModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-xl"> 
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bankEditModalLabel">View PDF</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="height: 80vh;">
                                        <iframe src="{{ asset('storage/app/public/cash-purchase-pdf/VC_202505 _Cash_Purchase_Summary.pdf') }}" width="100%" height="100%" style="border: none;"></iframe>
                                        <!-- OR -->
                                        <!-- <embed src="assets/docs/sample.pdf" type="application/pdf" width="100%" height="100%"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#BranchListing').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection

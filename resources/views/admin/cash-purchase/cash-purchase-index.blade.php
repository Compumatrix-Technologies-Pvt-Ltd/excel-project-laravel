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
                        <a href="{{ asset('storage/app/public/cash-purchase-pdf/VC_202505_Cash_Purchase_List.pdf') }}" 
                            class="btn btn-primary btn-label waves-effect waves-light"
                            download="VC_202505_Cash_Purchase_List.pdf">
                            <i class="mdi mdi-file-pdf-box label-icon align-middle fs-16 me-2"></i> Create PDF
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
                        <div class="col-md-3">
                            <label class="form-label">Cash Bill No. </label>
                            <select name="status" id="statusFilter" class="form-select">
                                <option value="">Select Bill No.</option>
                                <option value="pending">VCCB2505001</option>
                                <option value="delivered">VCCB2505002</option>
                                <option value="cancel">VCCB2505003</option>
                            </select>
                        </div>
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
                                <table  id="BranchListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10px;">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                                </div>
                                            </th>
                                        <th>Date</th>
                                        <th>Cash Bill No.</th>
                                        <th>Supplier ID</th>
                                        <th>Supplier Name</th>
                                        <th>FFB Ticket</th>
                                        <th>Weight (kg)</th>
                                        <th>Price (RM)</th>
                                        <th>Subsidy (RM)</th>
                                        <th>Net Pay (RM)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>02-May-2025</td>
                                        <td>VCCB2505001</td>
                                        <td>VC-B-M063</td>
                                        <td>Mohd Wan Hafiz Bin Rahman</td>
                                        <td>894163</td>
                                        <td>400</td>
                                        <td>180.00</td>
                                        <td> -40.00</td>
                                        <td>140.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>02-May-2025</td>
                                        <td>VCCB2505002</td>
                                        <td>VC-B-S005</td>
                                        <td>Suhail Bin Salim</td>
                                        <td>894164</td>
                                        <td>1000</td>
                                        <td>400.00</td>
                                        <td>-60.00</td>
                                        <td>340.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>02-May-2025</td>
                                         <td>VCCB2505002</td>                                
                                        <td>VC-B-N044</td>
                                        <td>Nadihrah Binti Ghani</td>
                                        <td>894165</td>
                                        <td>1760</td>
                                        <td>704.00</td>
                                        <td>-60.00</td>
                                        <td>644.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>04-May-2025</td>
                                        <td>VCCB2505002</td>
                                        <td>VC-B-M063</td>
                                        <td>Mohd Wan Hafiz Bin Rahman</td>
                                        <td>894323</td>
                                        <td>2200</td>
                                        <td>1120.00</td>
                                        <td>-56.00</td>
                                        <td>1064.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>04-May-2025</td>
                                        <td>VCCB2505002</td>
                                        <td>VC-B-S005</td>
                                        <td>Suhail Bin Salim</td>
                                        <td>894327</td>
                                        <td>1700</td>
                                        <td>850.00</td>
                                        <td>-52.00</td>
                                        <td>798.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>04-May-2025</td>
                                        <td>VCCB2505002</td>
                                        <td>VC-B-M063</td>
                                        <td>Mohd Wan Hafiz Bin Rahman</td>
                                        <td>894329</td>
                                        <td>1500</td>
                                        <td>750.00</td>
                                        <td>-50.00</td>
                                        <td>700.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>04-May-2025</td>
                                        <td>VCCB2505002</td>
                                        <td>VC-B-M103</td>
                                        <td>Mazrinah Binti John</td>
                                        <td>894331</td>
                                        <td>1600</td>
                                        <td>840.00</td>
                                        <td>-42.00</td>
                                        <td>798.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>04-May-2025</td>
                                        <td>VCCB2505002</td>
                                        <td>VC-B-M063</td>
                                        <td>Mohd Wan Hafiz Bin Rahman</td>
                                        <td>894333</td>
                                        <td>2300</td>
                                        <td>1210.00</td>
                                        <td>-48.00</td>
                                        <td>1162.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>04-May-2025</td>
                                        <td>VCCB2505002</td>
                                        <td>VC-B-S005</td>
                                        <td>Suhail Bin Salim</td>
                                        <td>894339</td>
                                        <td>700</td>
                                        <td>350.00</td>
                                        <td>-28.00</td>
                                        <td>322.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox"
                                                    name="checkAll"></div>
                                        </th>
                                        <td>04-May-2025</td>
                                        <td>VCCB2505002</td>
                                        <td>VC-B-S013</td>
                                        <td>Sudin Bin Haji Aluk</td>
                                        <td>894342</td>
                                        <td>1680</td>
                                        <td>840.00</td>
                                        <td>-42.00</td>
                                        <td>798.00</td>
                                    </tr>
                                </tbody>
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
                                        <iframe src="{{ asset('storage/app/public/cash-purchase-pdf/VC_202505_Cash_Purchase_List.pdf') }}" width="100%" height="100%" style="border: none;"></iframe>
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

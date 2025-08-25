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
                    <h4 class="card-title mb-0 flex-grow-1">Daily Cash Purchases Summary Listing</h4>
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
                                  <table id="BranchListing" class="table nowrap dt-responsive align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Supplier Cash Bill No.</th>
                                            <th>Wt. (M/Ton)</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Daily Wt.</th>
                                            <th>Daily Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>02-May-2025</td>
                                            <td>VCCB2505001 - VCCB2505004</td>
                                            <td>3.14</td>
                                            <td>700.00</td>
                                            <td>2,198.00</td>
                                            <td>3.14</td>
                                            <td>2,198.00</td>
                                        </tr>
                                        <tr>
                                            <td>04-May-2025</td>
                                            <td>VCCB2505005 - VCCB2505014</td>
                                            <td>7.94</td>
                                            <td>700.00</td>
                                            <td>5,558.00</td>
                                            <td>7.94</td>
                                            <td>5,558.00</td>
                                        </tr>
                                        <tr>
                                            <td>05-May-2025</td>
                                            <td>VCCB2505015 - VCCB2505020</td>
                                            <td>4.08</td>
                                            <td>700.00</td>
                                            <td>2,856.00</td>
                                            <td>4.08</td>
                                            <td>2,856.00</td>
                                        </tr>
                                        <tr>
                                            <td>06-May-2025</td>
                                            <td>VCCB2505021 - VCCB2505022</td>
                                            <td>1.44</td>
                                            <td>680.00</td>
                                            <td>979.20</td>
                                            <td>1.44</td>
                                            <td>979.20</td>
                                        </tr>
                                        <tr>
                                            <td>07-May-2025</td>
                                            <td>VCCB2505023 - VCCB2505026</td>
                                            <td>3.92</td>
                                            <td>680.00</td>
                                            <td>2,665.60</td>
                                            <td>3.92</td>
                                            <td>2,665.60</td>
                                        </tr>
                                        <tr>
                                            <td>08-May-2025</td>
                                            <td>VCCB2505027 - VCCB2505029</td>
                                            <td>1.22</td>
                                            <td>680.00</td>
                                            <td>829.60</td>
                                            <td>1.22</td>
                                            <td>829.60</td>
                                        </tr>
                                        <tr>
                                            <td>09-May-2025</td>
                                            <td>VCCB2505030</td>
                                            <td>0.50</td>
                                            <td>680.00</td>
                                            <td>340.00</td>
                                            <td>0.50</td>
                                            <td>340.00</td>
                                        </tr>
                                        <tr>
                                            <td>10-May-2025</td>
                                            <td>VCCB2505031 - VCCB2505033</td>
                                            <td>2.92</td>
                                            <td>680.00</td>
                                            <td>1,985.60</td>
                                            <td>2.92</td>
                                            <td>1,985.60</td>
                                        </tr>
                                        <tr>
                                            <td>11-May-2025</td>
                                            <td>VCCB2505034 - VCCB2505038</td>
                                            <td>4.72</td>
                                            <td>680.00</td>
                                            <td>3,209.60</td>
                                            <td>4.72</td>
                                            <td>3,209.60</td>
                                        </tr>
                                        <tr>
                                            <td>12-May-2025</td>
                                            <td>VCCB2505039 - VCCB2505040</td>
                                            <td>1.58</td>
                                            <td>680.00</td>
                                            <td>1,074.40</td>
                                            <td>1.58</td>
                                            <td>1,074.40</td>
                                        </tr>
                                        <tr>
                                            <td>13-May-2025</td>
                                            <td>VCCB2505041 - VCCB2505045</td>
                                            <td>3.48</td>
                                            <td>680.00</td>
                                            <td>2,366.40</td>
                                            <td>3.48</td>
                                            <td>2,366.40</td>
                                        </tr>
                                        <tr>
                                            <td>14-May-2025</td>
                                            <td>VCCB2505046 - VCCB2505048</td>
                                            <td>2.12</td>
                                            <td>660.00</td>
                                            <td>1,399.20</td>
                                            <td>2.12</td>
                                            <td>1,399.20</td>
                                        </tr>
                                        <tr>
                                            <td>15-May-2025</td>
                                            <td>VCCB2505049 - VCCB2505053</td>
                                            <td>4.28</td>
                                            <td>660.00</td>
                                            <td>2,824.80</td>
                                            <td>4.28</td>
                                            <td>2,824.80</td>
                                        </tr>
                                        <tr>
                                            <td>16-May-2025</td>
                                            <td>VCCB2505054 - VCCB2505059</td>
                                            <td>4.20</td>
                                            <td>660.00</td>
                                            <td>2,772.00</td>
                                            <td>4.20</td>
                                            <td>2,772.00</td>
                                        </tr>
                                        <tr>
                                            <td>17-May-2025</td>
                                            <td>VCCB2505060 - VCCB2505066</td>
                                            <td>3.94</td>
                                            <td>660.00</td>
                                            <td>2,600.40</td>
                                            <td>3.94</td>
                                            <td>2,600.40</td>
                                        </tr>
                                        <tr>
                                            <td>18-May-2025</td>
                                            <td>VCCB2505067 - VCCB2505070</td>
                                            <td>5.18</td>
                                            <td>660.00</td>
                                            <td>3,418.80</td>
                                            <td>5.18</td>
                                            <td>3,418.80</td>
                                        </tr>
                                        <tr>
                                            <td>19-May-2025</td>
                                            <td>VCCB2505071 - VCCB2505078</td>
                                            <td>5.22</td>
                                            <td>660.00</td>
                                            <td>3,445.20</td>
                                            <td>5.22</td>
                                            <td>3,445.20</td>
                                        </tr>
                                        <tr>
                                            <td>20-May-2025</td>
                                            <td>VCCB2505079 - VCCB2505083</td>
                                            <td>3.96</td>
                                            <td>660.00</td>
                                            <td>2,613.60</td>
                                            <td>3.96</td>
                                            <td>2,613.60</td>
                                        </tr>
                                        <tr>
                                            <td>21-May-2025</td>
                                            <td>VCCB2505084 - VCCB2505087</td>
                                            <td>3.42</td>
                                            <td>660.00</td>
                                            <td>2,257.20</td>
                                            <td>3.42</td>
                                            <td>2,257.20</td>
                                        </tr>
                                        <tr>
                                            <td>22-May-2025</td>
                                            <td>VCCB2505088</td>
                                            <td>1.44</td>
                                            <td>660.00</td>
                                            <td>950.40</td>
                                            <td>1.44</td>
                                            <td>950.40</td>
                                        </tr>
                                        <tr>
                                            <td>23-May-2025</td>
                                            <td>VCCB2505095 - VCCB2505095</td>
                                            <td>4.86</td>
                                            <td>660.00</td>
                                            <td>3,207.60</td>
                                            <td>4.86</td>
                                            <td>3,207.60</td>
                                        </tr>
                                        <tr>
                                            <td>24-May-2025</td>
                                            <td>VCCB2505096 - VCCB2505098</td>
                                            <td>1.96</td>
                                            <td>660.00</td>
                                            <td>1,293.60</td>
                                            <td>1.96</td>
                                            <td>1,293.60</td>
                                        </tr>
                                        <tr>
                                            <td>25-May-2025</td>
                                            <td>VCCB2505099 - VCCB2505103</td>
                                            <td>4.26</td>
                                            <td>660.00</td>
                                            <td>2,811.60</td>
                                            <td>4.26</td>
                                            <td>2,811.60</td>
                                        </tr>
                                        <tr>
                                            <td>26-May-2025</td>
                                            <td>VCCB2505104 - VCCB2505105</td>
                                            <td>1.80</td>
                                            <td>660.00</td>
                                            <td>1,188.00</td>
                                            <td>1.80</td>
                                            <td>1,188.00</td>
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

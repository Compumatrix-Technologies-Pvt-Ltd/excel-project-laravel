@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Transaction Management</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Transaction Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.transactions.index') }}">Transaction
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
                    <h4 class="card-title mb-0 flex-grow-1">Transaction Listing</h4>
                    <div class="card-toolbar">
                        <!-- <a href="javascript:void(0)" class="btn btn-primary fw-bold me-2">
                                                                                                                                        <i class="flaticon2-plus"></i> Create Branch
                                                                                                                                    </a> -->
                        <button type="button" class="btn btn-info fw-bold" data-bs-toggle="modal"
                            data-bs-target="#transactionModal">
                            <i class="flaticon2-plus"></i> Create Transaction
                        </button>
                        <div id="transactionModal" class="modal fade" tabindex="-1" aria-labelledby="transactionModalLabel"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transactionModalLabel">Add Transaction</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="TRXDate" class="form-label">TRX Date</label>
                                                    <input type="date" class="form-control" id="TRXDate">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="trxNoInput" class="form-label">TRX No.<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="trxNoInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputSupplier" class="form-label">Suppliers<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputSupplier" class="form-select">
                                                        <option selected>Select Supplier code</option>
                                                        <option>VC-A-F013</option>
                                                        <option>VC-A-M106</option>
                                                        <option>VC-A-R027</option>
                                                        <option>VC-A-S070</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="ticketNoInput" class="form-label">Ticket Number<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ticketNoInput">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="wieghtMtInput" class="form-label">Weight (MT)<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="wieghtMtInput">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success ">Save Changes</button>
                                    </div>
                                    </form>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="BranchListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>Ticket_No</th>
                                        <th>Trx_Date</th>
                                        <th>Supplier_Id</th>
                                        <th>Vehicle</th>
                                        <th>Mill_Id</th>
                                        <th>Weight</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T013121</td>
                                        <td>30-Jun-2025</td>
                                        <td>B&F Coll.</td>
                                        <td>SS268W</td>
                                        <td>LCH</td>
                                        <td>0.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02014127</td>
                                        <td>10-Oct-2024</td>
                                        <td>Segama Maju</td>
                                        <td>QAB8330G</td>
                                        <td>KSBA</td>
                                        <td>17.43</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02033828</td>
                                        <td>10-Jul-2024</td>
                                        <td>PL Sawit</td>
                                        <td>SYJ9683</td>
                                        <td>TEOPP</td>
                                        <td>22.34</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02033838</td>
                                        <td>12-Jul-2024</td>
                                        <td>Sri Paja</td>
                                        <td>SS1871T</td>
                                        <td>TEOPP</td>
                                        <td>16.74</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02033856</td>
                                        <td>12-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>14.56</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02033920</td>
                                        <td>15-Jul-2024</td>
                                        <td>Borneo Crops</td>
                                        <td>SS1871T</td>
                                        <td>TEOPP</td>
                                        <td>16.45</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02033933</td>
                                        <td>17-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>12.93</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02033954</td>
                                        <td>18-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>12.92</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02033960</td>
                                        <td>18-Jul-2024</td>
                                        <td>PL Sawit</td>
                                        <td>SAB8489D</td>
                                        <td>TEOPP</td>
                                        <td>23.95</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02033973</td>
                                        <td>19-Jul-2024</td>
                                        <td>SP</td>
                                        <td>SAB9121J</td>
                                        <td>TEOPP</td>
                                        <td>21.16</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02033982</td>
                                        <td>19-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>14.13</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034014</td>
                                        <td>20-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>15.28</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034023</td>
                                        <td>20-Jul-2024</td>
                                        <td>Sri Paja</td>
                                        <td>SS1871T</td>
                                        <td>TEOPP</td>
                                        <td>16.65</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034031</td>
                                        <td>22-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>14.77</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034041</td>
                                        <td>23-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>13.33</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034061</td>
                                        <td>23-Jul-2024</td>
                                        <td>Harus Hijau</td>
                                        <td>SS1871T</td>
                                        <td>TEOPP</td>
                                        <td>16.70</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034075</td>
                                        <td>24-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>13.19</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034087</td>
                                        <td>25-Jul-2024</td>
                                        <td>Borneo Crops</td>
                                        <td>SS1871T</td>
                                        <td>TEOPP</td>
                                        <td>16.98</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034088</td>
                                        <td>25-Jul-2024</td>
                                        <td>PL Sawit</td>
                                        <td>SS8979U</td>
                                        <td>TEOPP</td>
                                        <td>25.70</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034091</td>
                                        <td>25-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>14.05</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034108</td>
                                        <td>26-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>14.79</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034128</td>
                                        <td>27-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>14.04</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034157</td>
                                        <td>29-Jul-2024</td>
                                        <td>Sri Paja</td>
                                        <td>SS1871T</td>
                                        <td>TEOPP</td>
                                        <td>16.79</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034165</td>
                                        <td>29-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>12.31</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034172</td>
                                        <td>30-Jul-2024</td>
                                        <td>Sri Paja</td>
                                        <td>SS1871T</td>
                                        <td>TEOPP</td>
                                        <td>14.38</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034174</td>
                                        <td>30-Jul-2024</td>
                                        <td>PL Sawit</td>
                                        <td>SS8979U</td>
                                        <td>TEOPP</td>
                                        <td>29.99</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034200</td>
                                        <td>31-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>15.47</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034201</td>
                                        <td>31-Jul-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>5.33</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034208</td>
                                        <td>01-Aug-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>10.78</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034218</td>
                                        <td>02-Aug-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>15.36</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>T02034228</td>
                                        <td>03-Aug-2024</td>
                                        <td>Koh</td>
                                        <td>SA8216V</td>
                                        <td>TEOPP</td>
                                        <td>11.84</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--end row-->

                        <div id="transactionEditModal" class="modal fade" tabindex="-1"
                            aria-labelledby="transactionEditModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transactionEditModalLabel">Edit Transaction</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row gy-4">
                                            <form action="javascript:void(0);" class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="TRXDate" class="form-label">TRX Date</label>
                                                    <input type="" class="form-control" id="TRXDate"
                                                        value="03-Jan-2025">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="trxNoInput" class="form-label">TRX No.<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="trxNoInput"
                                                        value="T25010002">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputSupplier" class="form-label">Suppliers<span
                                                            class="text-danger">*</span></label>
                                                    <select id="inputSupplier" class="form-select">
                                                        <option selected>VC-A-F013</option>
                                                        <option>VC-A-F013</option>
                                                        <option>VC-A-M106</option>
                                                        <option>VC-A-R027</option>
                                                        <option>VC-A-S070</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="ticketNoInput" class="form-label">Ticket Number<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ticketNoInput"
                                                        value="088020">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="wieghtMtInput" class="form-label">Weight (MT)<span
                                                            class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="wieghtMtInput"
                                                        value="1.20">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success ">Save Changes</button>
                                    </div>
                                    </form>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
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

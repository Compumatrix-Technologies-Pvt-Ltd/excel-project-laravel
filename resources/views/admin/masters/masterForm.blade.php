@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Master Module</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Master Module</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.create') }}">Masters Form</a></li>
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
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Masters Form</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid mt-3">
                        <!-- Search & Header Row -->
                        <div class="row align-items-center gy-2">
                            <div class="col-md-8 d-flex flex-wrap align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="byInv" checked>
                                    <label class="form-check-label" for="byInv">By Supp. Inv / Cash Bill</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="byId">
                                    <label class="form-check-label" for="byId">By Supplier Id</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="byName">
                                    <label class="form-check-label" for="byName">By Supplier Name</label>
                                </div>

                                <!-- Nav arrows mimic Excel Previous/Next -->
                                <div class="btn-group ms-2">
                                    <button class="btn btn-outline-secondary btn-sm">&laquo;</button>
                                    <button class="btn btn-outline-secondary btn-sm">&lt; Previous</button>
                                    <button class="btn btn-outline-secondary btn-sm">Next &gt;</button>
                                    <button class="btn btn-outline-secondary btn-sm">&raquo;</button>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex gap-2">
                                <select class="form-select form-select-sm" id="searchSelect">
                                    <option selected>VCCB2505001</option>
                                </select>
                                <button class="btn btn-outline-secondary btn-sm"><i class="ri-refresh-line"></i></button>
                            </div>
                        </div>

                        <!-- Branch/Period row + FFB Master button -->
                        <div class="row mt-3 gy-2">
                            <div class="col-6 col-lg-3">
                                <label class="form-label mb-0 small">Branch Code</label>
                                <input type="text" class="form-control form-control-sm" id="branchCode" value="VC">
                            </div>
                            <div class="col-6 col-lg-3">
                                <label class="form-label mb-0 small">Period</label>
                                <input type="month" class="form-control form-control-sm" id="period">
                            </div>
                            <div class="col-12 col-lg-3">
                                <button class="btn btn-outline-secondary btn-sm mt-4" type="button">FFB Master</button>
                            </div>
                           <div class="col-12 col-lg-3 text-lg-end">
                                <input type="text" class="form-control form-control-sm text-center fw-bold" value="{{Session::has('yearMonth') ? Session::get('yearMonth') : now()->format('ym')}}" data-url="{{ route('set.year.month') }}" id="periodInput" />
                            </div>

                        </div>

                        <!-- Main two-column Excel-like layout -->
                        <div class="row mt-3">
                            <!-- LEFT: Supplier Master block -->
                            <div class="col-lg-7">
                                <div class="card">
                                    <div class="card-header py-2">
                                        <strong>Supplier</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label small">Supplier Id</label>
                                                <input type="text" class="form-control form-control-sm" id="supId"
                                                    value="VC-B-M063">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Supp. Inv. No / CB No.</label>
                                                <input type="text" class="form-control form-control-sm" id="docNo"
                                                    value="VCCB2505001">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label small">Supplier Name</label>
                                                <input type="text" class="form-control form-control-sm" id="supName"
                                                    value="MOHD WAN HAFIZ BIN RAHMAN (K/P: 941210-12-5763)">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label small">Address</label>
                                                <textarea class="form-control form-control-sm" rows="2" id="address">W.D.T 23  PEKAN KOTA KINABATANGAN 90200 KINABATANGAN  SABAH.</textarea>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">MPOB Licence No.</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    value="549749601000">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Expiry Date</label>
                                                <input type="date" class="form-control form-control-sm"
                                                    value="2025-07-31">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">MSPO Cert. No.</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    value="04 300 92 082">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Expiry Date</label>
                                                <input type="date" class="form-control form-control-sm"
                                                    value="2022-01-04">
                                            </div>

                                            <div class="col-4">
                                                <label class="form-label small">Land Size (Ha)</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Latitude (°)</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Longitude (°)</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-4">
                                                <label class="form-label small">Email</label>
                                                <input type="email" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Tel No. 1</label>
                                                <input type="tel" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Tel No. 2</label>
                                                <input type="tel" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Bank Id</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Bank A/C No.</label>
                                                <input type="text" class="form-control form-control-sm">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label small">Supplier Remark</label>
                                                <textarea class="form-control form-control-sm" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT: Calculation stack block (matches Excel right column) -->
                            <div class="col-lg-5 mt-3 mt-lg-0">
                                <div class="card">
                                    <div class="card-header py-2">
                                        <strong>Invoice / Cash Bill</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-7">
                                                <label class="form-label small">Invoice Date</label>
                                                <input type="date" class="form-control form-control-sm"
                                                    value="2025-05-02">
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label small">Weight (M/Ton)</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.20">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Price</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="700.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Incentive Rate</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Subsidy</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Amt. Before Ded.</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="140.00">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Debit Bal B/F</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>

                                            <!-- Deduction lines aligned like Excel -->
                                            <div class="col-12">
                                                <hr class="my-1">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Transport</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Advance</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Others</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Total Deduction</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>

                                            <div class="col-12">
                                                <hr class="my-1">
                                            </div>
                                            <div class="col-7">
                                                <label class="form-label small">Net Pay (RM)</label>
                                                <input type="number" step="0.01"
                                                    class="form-control form-control-sm fw-bold" value="140.00">
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label small">Date Paid</label>
                                                <input type="date" class="form-control form-control-sm"
                                                    value="2025-05-02">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label small">Paid By</label>
                                                <select class="form-select form-select-sm">
                                                    <option>Cash</option>
                                                    <option>Bank</option>
                                                    <option>Cheque</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Debit Bal C/F</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    value="0.00">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label small">Invoice Remark</label>
                                                <textarea class="form-control form-control-sm" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button strip aligned like Excel -->
                                <div class="d-flex flex-wrap gap-2 justify-content-between mt-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#transactionModal">
                                        Add Trx
                                    </button>
                                    <a href="{{ route('admin.transactions.index') }}"
                                        class="btn btn-secondary btn-sm">Edit Trx</a>
                                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary btn-sm">Trx
                                        Details</a>
                                    <a href="{{ route('admin.deductions.index') }}" class="btn btn-secondary btn-sm">Add
                                        Deduction</a>
                                </div>
                                <div class="btn-group">
                                    <a href="" class="btn btn-secondary btn-sm">Reports</a>
                                    <a href="" class="btn btn-secondary btn-sm">Pembelian</a>
                                    <a href="" class="btn btn-secondary btn-sm" disabled>Merge</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="transactionModal" class="modal fade" tabindex="-1" aria-labelledby="transactionModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header pb-1">
                            <h5 class="modal-title" id="transactionModalLabel">Transaction Data Entry Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                          <form class="form" id="updateForm" method="POST" data-toggle="validator" action="{{ route('admin.ffb.transaction.store') }}" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="modal-body pt-0 pb-2">
                                <div class="row mb-2 align-items-center">
                                    <!-- Purchase Option -->
                                    <div class="col-md-2 col-lg-2">
                                        <fieldset class="border rounded p-2 mb-0" style="min-width:170px;">
                                            <legend class="float-none w-auto fs-6 px-2 mb-0">Purchase Option</legend>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="radio" name="purchase_type"
                                                    id="creditPurchase" value="credit" checked>
                                                <label class="form-check-label" for="creditPurchase">Credit
                                                    Purchase</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="purchase_type"
                                                    id="cashPurchase" value="cash">
                                                <label class="form-check-label" for="cashPurchase">Cash Purchase</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <!-- Inv. No, Supplier, Period -->
                                    <div class="col-md-2 col-lg-2">
                                        <label class="form-label mb-0">Inv. No. / Cash Bill:</label>
                                         <input type="text" class="form-control form-control-sm" name="invoice_no" id="invoiceInput" style="width:125px;" readonly>

                                    </div>
                                    <div class="col-md-3 col-lg-3 form-group">
                                        <label class="form-label mb-0">Supplier ID: <span class="text-danger">*</span></label>
                                        <select id="supplierSelect" required data-error="Please select a supplier" name="supplier_id" class="form-select form-select-sm"></select>
                                        <span class="text-danger err_supplier_id"></span>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <label class="form-label mb-0 supplier_name"></label>
                                        <input type="hidden" name="company_id" value="{{Auth::user()->company_id}}">
                                        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}">
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                        <label class="form-label mb-0">Period:</label>
                                        <span class="fw-bold fs-5 align-middle">{{Session::has('yearMonth') ? Session::get('yearMonth') : now()->format('ym')}}</span>
                                    </div>
                                    <!-- Action Buttons -->
                                  
                                </div>

                                <div class="row">
                                    <!-- Left fields (main form fields) -->
                                    <div class="col-lg-4">
                                        <div class="mb-2" id="particularsGroup">
                                        <label class="form-label mb-0">Particulars:</label>
                                            <div class="input-group mb-1">
                                                @php
                                                    $sessionMonth = Session::has('yearMonth') ? Session::get('yearMonth') : now()->format('m/Y');
                                                @endphp
                                                <input type="text" class="form-control form-control-sm" id="part1" value="FFB Supply For" readonly>
                                                <input type="text" class="form-control form-control-sm" id="part2" value="The Month Of {{ $sessionMonth }}" readonly>
                                                <input type="hidden" name="particulars" id="particulars_hidden" value="">
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label mb-0">Weight (MT):</label>
                                            <input type="number" name="weight_mt" step="0.01" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label mb-0">Price (RM):</label>
                                            <input type="number" name="price" step="0.01" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label mb-0">Incentive Rate:</label>
                                            <input type="number" name="incentive_rate" step="0.01" class="form-control form-control-sm incentive_rate">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label mb-0">Subsidy Amt.:</label>
                                            <span class="subsidy_amt" style="display: none"></span>
                                            <input type="hidden" name="subsidy_amt" >
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label mb-0">Amt. Before Ded.:</label>
                                            <span class="amt_before_ded"></span>
                                            <input type="hidden" name="amt_before_ded" >

                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label mb-0">Total Deductions:</label>
                                            <span class="total_deductions"></span>
                                            <input type="hidden" name="total_deductions" >
                                        </div>
                                    </div>

                                    <!-- Deductions (vertical stack) -->
                                    <div class="col-lg-8">
                                        <fieldset class="border rounded p-2 mb-3 h-100">
                                            <legend class="float-none w-auto fs-6 mb-0 px-2">Deductions</legend>
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Debit Bal. B/F:</label>
                                                <input type="number" name="debit_bal_bf" step="0.01"
                                                    class="form-control form-control-sm">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Transport:</label>
                                                <input type="number" name="transport" step="0.01"
                                                    class="form-control form-control-sm transport">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Advance:</label>
                                                <input type="number" name="advance" step="0.01"
                                                    class="form-control form-control-sm advance">
                                            </div>
                                            <div class="mb-2 row g-2 align-items-end">
                                                <div class="col-md-6">
                                                    <label class="form-label mb-1">Others:</label>
                                                    <input type="number" name="others" step="0.01"
                                                        class="form-control form-control-sm others">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label mb-1">Others Desc.:</label>
                                                    <input type="text" name="others_desc" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <!-- Payment -->
                                <fieldset class="border rounded p-2 mb-3">
                                    <legend class="float-none w-auto fs-6 mb-0 px-2">Payment</legend>
                                    <div class="row align-items-end">
                                        @php
                                            if (session()->has('yearMonth')) {
                                                $yearMonth = session()->get('yearMonth'); // e.g. '202509'
                                                // Parse year and month from 'YYYYMM'
                                                $year = substr($yearMonth, 0, 4);  // '2025'
                                                $month = substr($yearMonth, 4, 2); // '09'
                                                $day = now()->format('d');

                                                // Create date with Carbon
                                                $value = \Carbon\Carbon::create($year, $month, $day)->format('Y-m-d');
                                            } else {
                                                $value = now()->format('Y-m-d');
                                            }
                                        @endphp


                                        <div class="col-md-4 col-lg-3 mb-2">
                                            <label class="form-label mb-0">Invoice / Cash Bill Date:</label>
                                            <input type="date" value="{{ $value }}" name="bill_date" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <button class="btn btn-outline-secondary w-100 netPayButton" type="button">Net
                                                Pay</button>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <input type="number" name="net_pay" step="0.01" class="form-control form-control-sm net_pay" placeholder="Net Pay Amount">
                                        </div>
                                        <div class="col-md-3 col-lg-2 mb-2 ms-auto">
                                            <fieldset class="border rounded p-2 h-100" id="payByFieldset">
                                                <legend class="small w-auto m-0 px-2">Pay By</legend>
                                                <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pay_by" id="payCash" value="cash" checked >
                                                <label class="form-check-label" for="payCash">Cash</label>
                                                </div>
                                                <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pay_by" id="payCheque" value="cheque">
                                                <label class="form-check-label" for="payCheque">Cheque</label>
                                                </div>
                                                <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pay_by" id="payBank" value="bank" >
                                                <label class="form-check-label" for="payBank">Bank</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </fieldset>

                                <!-- Remark -->
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label mb-0">Remark:</label>
                                        <input type="text" name="remark" class="form-control form-control">
                                    </div>
                                </div>
                            </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success ">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>

<select id="supplierSelect" class="form-select form-select-sm"></select>

<script>
  // Suppliers passed from backend grouped by type
  const suppliers = {
    credit: @json($suppliers_credit),
    cash: @json($suppliers_cash)
  };

  const supplierSelect = document.getElementById('supplierSelect');
  const purchaseTypeRadios = document.querySelectorAll('input[name="purchase_type"]');

  function populateSuppliers(type) {
    supplierSelect.innerHTML = '<option value="">Select</option>';
    suppliers[type].forEach(s => {
      const opt = document.createElement('option');
      opt.value = s.id;
      opt.textContent = s.supplier_name;
      supplierSelect.appendChild(opt);
    });
  }

  purchaseTypeRadios.forEach(radio => {
    radio.addEventListener('change', () => {
      populateSuppliers(radio.id === 'creditPurchase' ? 'credit' : 'cash');
      updateInvoiceNumber(); // Also update invoice number on purchase type switch
    });
  });

  // Invoice numbers passed from backend as strings
  const invoiceNumbers = {
    credit: "{{ $creditInvoiceNo }}",
    cash: "{{ $cashInvoiceNo }}"
  };

  const creditRadio = document.getElementById('creditPurchase');
  const cashRadio = document.getElementById('cashPurchase');
  const invoiceInput = document.getElementById('invoiceInput');

  function updateInvoiceNumber() {
    if (creditRadio.checked) {
      invoiceInput.value = invoiceNumbers.credit;
    } else if (cashRadio.checked) {
      invoiceInput.value = invoiceNumbers.cash;
    }
  }

  // Initialize both controls on page load
  const initialType = document.querySelector('input[name="purchase_type"]:checked').id === 'creditPurchase' ? 'credit' : 'cash';
  populateSuppliers(initialType);
  updateInvoiceNumber();


  // Particulars
  const part1 = document.getElementById('part1');
  const part2 = document.getElementById('part2');
  const particulars_hidden = document.getElementById('particulars_hidden');
  const sessionMonth = "{{ $sessionMonth }}";

  // Pay By
  const payByFieldset = document.getElementById('payByFieldset');
  const payInputs = payByFieldset.querySelectorAll('.form-check-input');

  function updateFormForPurchaseType() {
    if (creditRadio.checked) {
      // Credit: Particulars
      part1.value = "FFB Supply For";
      part2.value = "The Month Of " + sessionMonth;
      particulars_hidden.value = "The Month Of " + sessionMonth;
      part1.readOnly = true;
      part2.readOnly = true;
      // Disable Pay By section
      payByFieldset.setAttribute('disabled', 'disabled');
      payInputs.forEach(input => input.disabled = true);
    } else if (cashRadio.checked) {
      // Cash: Particulars
      part1.value = "FFB Ticket No.";      
      particulars_hidden.value = "FFB Ticket No.";     
      part2.value = "";
      part1.readOnly = false;
      part2.readOnly = false;
      // Enable Pay By section
      payByFieldset.removeAttribute('disabled');
      payInputs.forEach(input => input.disabled = false);
    }
  }

  creditRadio.addEventListener('change', updateFormForPurchaseType);
  cashRadio.addEventListener('change', updateFormForPurchaseType);

  // Initialize on page load
  updateFormForPurchaseType();
</script>



@endsection

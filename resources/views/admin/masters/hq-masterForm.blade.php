@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Main Module</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Main Module</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.create') }}">Main Form</a></li>
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

                        <!-- Search controls row -->
                        <div class="row align-items-center gy-2">
                            <div class="col-lg-6 d-flex flex-wrap align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input supplierDetails" type="radio" name="supplierDetails"
                                        id="byTicket" value="byTicket" checked>
                                    <label class="form-check-label" for="byTicket">By Ticket No.</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input supplierDetails" type="radio" name="supplierDetails"
                                        id="bySupName" value="bySupName">
                                    <label class="form-check-label" for="bySupName">By Supplier Name</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input supplierDetails" type="radio" name="supplierDetails"
                                        id="bysupId" value="bysupId">
                                    <label class="form-check-label" for="bysupId">By Supplier Id</label>
                                </div>

                                <div class="input-group input-group-sm ms-2" style="max-width: 320px;">
                                    <select class="form-control" id="SuppliersInput">
                                        <option value="">Select Value</option>
                                    </select>
                                    <button class="btn btn-outline-secondary"><i class="ri-arrow-down-s-line"></i></button>
                                </div>

                                <div class="btn-group btn-group-sm ms-2">
                                    <button type="button" id="firstBtn" class="btn btn-outline-secondary">&laquo;</button>
                                    <button type="button" id="prevBtn" class="btn btn-outline-secondary">&lt;
                                        Previous</button>
                                    <button type="button" id="nextBtn" class="btn btn-outline-secondary">Next &gt;</button>
                                    <button type="button" id="lastBtn" class="btn btn-outline-secondary">&raquo;</button>
                                </div>

                            </div>

                            <div class="col-lg-6 d-flex align-items-center justify-content-lg-end gap-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 small text-muted">Branch Code</span>
                                    <span class="badge bg-dark-subtle text-dark-emphasis px-3 py-2">HQ</span>
                                </div>
                                <button class="btn btn-outline-secondary btn-sm"><i class="ri-refresh-line"></i></button>
                            </div>
                        </div>

                        <!-- Main two-column content -->
                        <div class="row mt-3">
                            <!-- Left: ticket snapshot -->
                            <div class="col-xl-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row g-2 align-items-center">
                                            <div class="col-4 text-muted">Ticket No.</div>
                                            <div class="col-8"><strong id="ticketNo"></strong></div>

                                            <div class="col-4 text-muted">Trx. Date</div>
                                            <div class="col-8" id="ticketDate"></div>

                                            <div class="col-4 text-muted">Vehicle</div>
                                            <div class="col-8" id="vehicle_id"></div>

                                            <div class="col-4 text-muted">Mill Id.</div>
                                            <div class="col-8 d-flex gap-3">
                                                <span id="millId"></span>
                                                <span id="millName" class="text-muted"></span>
                                            </div>

                                            <div class="col-4 text-muted">Weight (MT)</div>
                                            <div class="col-8" id="weight"></div>

                                            <div class="col-12 mt-2">
                                                <!-- placeholder image area to mimic Excel truck photo -->
                                                <div class="ratio ratio-16x9 border bg-light-subtle">
                                                    <img id="ticketPhoto"
                                                        src="{{ asset('/assets/admin/images/palm-oil.jpg') }}" alt=""
                                                        class="img-fluid" onerror="this.style.display='none'">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action bar (left side group) -->
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            <a href="{{route('admin.suppliersHq.index')}}"
                                                class="btn btn-secondary btn-sm">Add Supplier</a>
                                            <a href="{{route('admin.suppliersHq.index')}}"
                                                class="btn btn-secondary btn-sm">Edit Supplier</a>
                                            <a href="{{ route('admin.transaction.management') }}"
                                                class="btn btn-secondary btn-sm">Add Trx</a>
                                            <a href="{{ route('admin.transaction.management') }}"
                                                class="btn btn-secondary btn-sm">Edit Trx</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: supplier identity panel -->
                            <div class="col-xl-6 mt-3 mt-xl-0">
                                <div class="card h-100">
                                    <div class="card-header py-2">
                                        <strong id="company_name"></strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-4 text-muted">Supplier Id.</div>
                                            <div class="col-8" id="supplierId"></div>

                                            <div class="col-4 text-muted">Supplier Name</div>
                                            <div class="col-8" id="supplierName"></div>

                                            <div class="col-4 text-muted">Address</div>
                                            <div class="col-8" id="supplierAddress">

                                            </div>

                                            <div class="col-4 text-muted">eMail</div>
                                            <div class="col-8" id="supplierEmail"></div>

                                            <div class="col-4 text-muted">Tel. No. 1</div>
                                            <div class="col-8" id="tel1"></div>

                                            <div class="col-4 text-muted">Tel. No. 2</div>
                                            <div class="col-8" id="tel2"></div>

                                            <div class="col-4 text-muted">Bank Id.</div>
                                            <div class="col-8" id="bankId"></div>

                                            <div class="col-4 text-muted">Bank A/C No.</div>
                                            <div class="col-8" id="bankAccNo"></div>
                                        </div>

                                        <!-- Right side action bar -->
                                        <div class="d-flex flex-wrap gap-2 mt-3 justify-content-start">
                                            <button class="btn btn-secondary btn-sm">Reports</button>
                                            <button class="btn btn-secondary btn-sm">Penjualan</button>
                                            <button class="btn btn-secondary btn-sm">Merge</button>
                                        </div>
                                    </div>
                                </div>
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
    <script>
        $(document).ready(function () {
            let options = [];
            let currentIndex = 0;

            function loadCurrentOption() {
                const selectedType = $('.supplierDetails:checked').val();
                const selectedValue = options[currentIndex];

                $('#SuppliersInput').val(selectedValue);
                fetchDetails(selectedType, selectedValue);
            }

            $('.supplierDetails').change(function () {
                const selectedType = $(this).val();

                $.ajax({
                    url: '{{ route("admin.hqMainForm.getValues") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: selectedType
                    },
                    success: function (response) {
                        options = response;
                        $('#SuppliersInput').empty();

                        options.forEach(function (item, index) {
                            const selected = index === 0 ? 'selected' : '';
                            $('#SuppliersInput').append(`<option ${selected}>${item}</option>`);
                        });

                        currentIndex = 0;

                        if (options.length > 0) {
                            loadCurrentOption();
                        } else {
                            $('#SuppliersInput').append('<option selected>No options found</option>');
                        }
                    }
                });
            });

            $('#SuppliersInput').change(function () {
                currentIndex = $('#SuppliersInput').prop('selectedIndex');
                const selectedType = $('.supplierDetails:checked').val();
                const selectedValue = $(this).val();
                fetchDetails(selectedType, selectedValue);
            });

            $('#prevBtn').click(function () {
                if (currentIndex > 0) {
                    currentIndex--;
                    loadCurrentOption();

                }
            });

            $('#nextBtn').click(function () {
                if (currentIndex < options.length - 1) {
                    currentIndex++;
                    loadCurrentOption();

                }
            });

            $('#firstBtn').click(function () {
                currentIndex = 0;
                loadCurrentOption();

            });

            $('#lastBtn').click(function () {
                currentIndex = options.length - 1;
                loadCurrentOption();

            });

            // Trigger initial load
            $('.supplierDetails:checked').trigger('change');

            function fetchDetails(type, value) {
                $.ajax({
                    url: '{{ route("admin.hqMainForm.getAllDetails") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: type,
                        value: value
                    },
                    success: function (data) {
                        $('#ticketNo').text(data.ticket_no || '-');
                        $('#ticketDate').text(data.trx_date || '-');
                        $('#vehicle_id').text(data.vehicle_id || '-');
                        $('#millId').text(data.mill_id || '-');
                        $('#millName').text(data.mill_name || '-');
                        $('#weight').text(data.weight || '-');
                        $('#ticketPhoto').attr('src', data.ticket_photo || '{{ asset("/assets/admin/images/palm-oil.jpg") }}');

                        $('#company_name').text(data.company_name || '-');
                        $('#supplierId').text(data.supplier_id || '-');
                        $('#supplierName').text(data.supplier_name || '-');
                        $('#supplierAddress').text(data.address || '-');
                        $('#supplierEmail').text(data.email || '-');
                        $('#tel1').text(data.telphone_1 || '-');
                        $('#tel2').text(data.telphone_2 || '-');
                        $('#bankId').text(data.bank_id || '-');
                        $('#bankAccNo').text(data.bank_no || '-');
                    }
                });
            }

        });
    </script>

@endsection
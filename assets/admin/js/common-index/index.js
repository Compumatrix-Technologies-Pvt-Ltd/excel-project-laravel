 $(document).ready(function () {

    $('.CommonListing').DataTable({
        paging: true,
        searching: true,
        ordering: true

    });

      $(document).on('click','#edit-mill-btn',function(){

       $('#editMillModal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        // alert(encrypted_id);
                var action = ADMINURL+'/mill/edit/'+ encrypted_id;

        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $("#millIdInput").val(response.data.mill_id);
                    $('#millNameInput').val(response.data.name);
                    $('#mpobNoInput').val(response.data.mpob_lic_no);                  
                    $('#hidden_id').val(encrypted_id);
                    $('#submitBtn ').removeClass('disabled');
                }else{
                    alert('Something went wrong');
                } 
            }
        });
    });
    
      $(document).on('click','#edit-bank-btn',function(){

       $('#bankEditModal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        // alert(encrypted_id);
                var action = ADMINURL+'/banks/edit/'+ encrypted_id;

        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $("#bankIdInput").val(response.data.bank_id);
                    $('#bankNameInput').val(response.data.name);
                    $('#bicCodeInput').val(response.data.bic_code);       
                    $('input[name="pay_type"][value="' + response.data.pay_type + '"]').prop('checked', true);           
                    $('#hidden_id').val(encrypted_id);
                    $('#submitBtn').removeClass('disabled');
                }else{
                    alert('Something went wrong');
                } 
            }
        });
    });

   var action = ADMINURL + '/suppliers/getRecords';
   $('#SuppliersListing').DataTable({
        scroller: true,
        serverSide: true,
        responsive: false,
        ajax: {
            url: action,
            type: "GET",
            dataSrc: function(json) {
                return json.data; 
            },
            error: function(xhr, error, code) {
                showToast(false, 'Error loading data. Please try again just refresh the page');
            }
        },
        columns: [
            { data: 'checkbox', name: 'checkbox' },
            { data: 'id', name: 'id' },
            { data: 'supplier_id', name: 'supplier_id' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'email', name: 'email' },
            { data: 'telphone_1', name: 'telphone_1' },
            { data: 'view_info', name: 'view_info' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        columnDefs: [
            { "orderable": false, "targets": [1, 2, 3, 4,5,6] },
        ],
        order: [[0, 'DESC']], 
    });

    var action = ADMINURL + '/hq-suppliers/getRecords';
    $('#HqSupplierListing').DataTable({
        scroller: true,
        serverSide: true,
        responsive: false,
        ajax: {
            url: action,
            type: "GET",
            dataSrc: function(json) {
                return json.data; 
            },
            error: function(xhr, error, code) {
                showToast(false, 'Error loading data. Please try again just refresh the page');
            }
        },
        columns: [
            { data: 'checkbox', name: 'checkbox' },
            { data: 'id', name: 'id' },
            { data: 'supplier_id', name: 'supplier_id' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'email', name: 'email' },
            { data: 'telphone_1', name: 'telphone_1' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        columnDefs: [
            { "orderable": false, "targets": [1, 2, 3, 4] },
        ],
        order: [[0, 'DESC']], 
    });


    $(document).on('click', '.view-supplier-btn', function () {
    let supplierId = $(this).data('id');

    $.ajax({
        url: ADMINURL + '/suppliers/' + supplierId, 
        type: 'GET',
        success:function(response){
                if(response.status == 'success'){
            $('#supplierDetailsModal').modal('show');
            $('#address1_value').text(response.data.address1);
            $('#address2_value').text(response.data.address2);
            $('#bank_id_value').text(response.data.bank_id);
            $('#bank_acc_no_value').text(response.data.bank_acc_no);

            $('#supplier_type').text(response.data.supplier_type);
            $('#mpob_lic_no_value').text(response.data.mpob_lic_no);
            $('#mpob_exp_date_value').text(response.data.mpob_exp_date);
            $('#mspo_cert_no_value').text(response.data.mspo_cert_no);
            $('#mspo_exp_date_value').text(response.data.mspo_exp_date);
            $('#tin_value').text(response.data.tin);
            $('#subsidy_rate_value').text(response.data.subsidy_rate);
            $('#land_size_value').text(response.data.land_size);
            $('#latitude_value').text(response.data.latitude);
            $('#longitude_value').text(response.data.longitude);
            $('#remark_value').text(response.data.remark);
           }else{
                    alert('Something went wrong');
                } 
            }
    });
});

            
   var action = ADMINURL + '/deductions/getRecords';
    $('#DeductionListing').DataTable({
        scroller: true,
        serverSide: true,
        responsive: false,
        ajax: {
            url: action,
            type: "GET",
        },
        columns: [
              { 
                data: null, 
                render: function(data, type, row, meta) {
                    return meta.row + 1; 
                },
                searchable: false,
                orderable: false 
            },
            { data: 'date', name: 'date' },
            { data: 'period', name: 'period' },
            { data: 'supplier_id', name: 'supplier_id' },           
            { data: 'type', name: 'type' },
            { data: 'amount', name: 'amount' },
            { data: 'remark', name: 'remark' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        columnDefs: [
            { "orderable": false, "targets": [1, 2, 3, 4] },
        ],
        aaSorting: [
            [0, 'DESC']
        ],
    });


    


    $(document).on('click','#edit-vehicle-btn',function(){
       $('#editVehicleModal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/vehicles/'+ encrypted_id + '/edit/';
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $('#Vehicle_Name').val(response.data.name);
                    $('#hidden_id').val(encrypted_id);
                    $('#submitBtn ').removeClass('disabled');
                }else{
                    alert('Something went wrong');
                } 
            }
        });
    });
    
      $(document).on('click','#edit-user-btn',function(){

       $('#editUserModal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        // alert(encrypted_id);
                var action = ADMINURL+'/users/'+ encrypted_id +'/edit';

        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $("#fullnameInput").val(response.data.name);
                    $('#inputEmail4').val(response.data.email);
                    $('#phoneNumberInput').val(response.data.mobile_number);                                             
                    $('#inputBranch').val(response.data.branch_id);       
                    $('input[name="status"][value="' + response.data.status + '"]').prop('checked', true);           
                    $('#hidden_id').val(encrypted_id);
                    $('#submitBtn').removeClass('disabled');
                }else{
                    alert('Something went wrong');
                } 
            }
        });
    });


  
    var action = ADMINURL + '/cash-purchase/getRecords';

    var CashPurchaseListingtable = $('#CashPurchaseListing').DataTable({
    scroller: true,
    serverSide: true,
    responsive: true,
    processing: true,
    ajax: {
        url: action,
        type: "GET",
        dataSrc: function (json) {
            // ✅ If backend sends totals, you can still use them here (optional)
            if (json.footerTotals) {
                $('#total-weight').html(json.footerTotals.weight_kg);
                $('#total-subsidy').html(json.footerTotals.subsidy_amt);
                $('#total-netpay').html(json.footerTotals.net_pay);
            }
            return json.data;
        },
       
    },
    columns: [
        { data: 'checkbox', orderable: false, searchable: false }, // 0
        { data: 'date' },                                          // 1
        { data: 'invoice_no' },                                    // 2
        { data: 'supplier_id' },                                   // 3
        { data: 'supplier_name' },                                 // 4
        { data: 'ticket_no' },                                     // 5
        { data: 'weight_kg' },                                     // 6
        { data: 'price' },                                         // 7
        { data: 'subsidy_amt' },                                   // 8
        { data: 'net_pay' },                                       // 9
    ],
    order: [[1, 'desc']],

    footerCallback: function (row, data, start, end, display) {
        var api = this.api();
        // Helper function to parse numeric values
        var intVal = function (i) {
            if (typeof i === 'string') {
                    i = i.replace(/,/g, ''); // remove commas
                    return parseFloat(i) || 0;
                }
                return typeof i === 'number' ? i : 0;
            };

            // ✅ Calculate totals (use your actual column indexes)
            var totalWeight = api
                .column(6, { page: 'current' })
                .data()
                .reduce((a, b) => a + intVal(b), 0);

            var totalSubsidy = api
                .column(8, { page: 'current' })
                .data()
                .reduce((a, b) => a + intVal(b), 0);

            var totalNetPay = api
                .column(9, { page: 'current' })
                .data()
                .reduce((a, b) => a + intVal(b), 0);

            // ✅ Update footer cells
            $(api.column(6).footer()).html(totalWeight.toLocaleString(undefined, { minimumFractionDigits: 2 }));
            $(api.column(8).footer()).html(totalSubsidy.toLocaleString(undefined, { minimumFractionDigits: 2 }));
            $(api.column(9).footer()).html(totalNetPay.toLocaleString(undefined, { minimumFractionDigits: 2 }));
        }
    });
    


    var CashPurchaseSummaryTable = $('#CashPurchaseSummaryTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: ADMINURL + '/cash-purchase-summary/getRecords', // 👈 your backend route (Laravel)
        type: 'GET',
        dataSrc: function (json) {
            // Optional: if backend already sends footerTotals
            if (json.footerTotals) {
                updateFooter(json.footerTotals);
            }
            return json.data;
        }
    },
        columns: [
            { data: 'supplier_id', title: 'Supp. Id' },
            { data: 'supplier_name', title: 'Supplier Name' },
            { data: 'weight_mt', title: 'Wt. (M/Ton)', className: 'text-end' },
            { data: 'subsidy', title: 'Subsidy', className: 'text-end' },
            { data: 'net_pay', title: 'Net Pay', className: 'text-end' }
        ],
        order: [[1, 'asc']],
        columnDefs: [
            { "orderable": false, "targets": [1, 2, 3, 4] },
        ],
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // helper to parse numbers
            var parseVal = function (i) {
                if (typeof i === 'string') return parseFloat(i.replace(/,/g, '')) || 0;
                return typeof i === 'number' ? i : 0;
            };

            // total for weight
            var totalWeight = api.column(2, { page: 'current' }).data()
                .reduce((a, b) => a + parseVal(b), 0);
            var totalSubsidy = api.column(3, { page: 'current' }).data()
                .reduce((a, b) => a + parseVal(b), 0);
            var totalNetPay = api.column(4, { page: 'current' }).data()
                .reduce((a, b) => a + parseVal(b), 0);

            // update footer
            $(api.column(2).footer()).html(totalWeight.toLocaleString(undefined, { minimumFractionDigits: 2 }));
            $(api.column(3).footer()).html(totalSubsidy.toLocaleString(undefined, { minimumFractionDigits: 2 }));
            $(api.column(4).footer()).html(totalNetPay.toLocaleString(undefined, { minimumFractionDigits: 2 }));
        }
    });

    // helper to update footer directly if backend sends totals
    function updateFooter(totals) {
        $('#CashPurchaseSummaryTable tfoot th:nth-child(3)').text(parseFloat(totals.weight_mt).toLocaleString(undefined, { minimumFractionDigits: 2 }));
        $('#CashPurchaseSummaryTable tfoot th:nth-child(4)').text(parseFloat(totals.subsidy).toLocaleString(undefined, { minimumFractionDigits: 2 }));
        $('#CashPurchaseSummaryTable tfoot th:nth-child(5)').text(parseFloat(totals.net_pay).toLocaleString(undefined, { minimumFractionDigits: 2 }));
    }




        var action = ADMINURL + '/daily-cash-purchase-summary/getRecords';

        var DailyPurchaseListingTable = $('#DailyPurchaseListingTable').DataTable({
            serverSide: false,
            processing: true,
            responsive: true,
            ajax: {
                url: action,
                type: "GET",
                dataSrc: function (json) {
                    if (json.footerTotals) {
                        $('#daily-total-weight').html(json.footerTotals.total_weight);
                        $('#daily-total-dailytotal').html(json.footerTotals.daily_total);
                    }
                    return json.data;
                }
            },
            columns: [
                { data: 'date' },
                { data: 'invoice_range' },
                { data: 'total_weight' },
                { data: 'avg_price' },
                { data: 'total' },
                { data: 'daily_weight' },
                { data: 'daily_total' },
            ],
            order: [[0, 'asc']],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();

                var intVal = function (i) {
                    return typeof i === 'string'
                        ? parseFloat(i.replace(/,/g, '')) || 0
                        : (typeof i === 'number' ? i : 0);
                };

                var totalWeight = api.column(2, { page: 'current' }).data()
                    .reduce((a, b) => a + intVal(b), 0);

                var dailyTotal = api.column(6, { page: 'current' }).data()
                    .reduce((a, b) => a + intVal(b), 0);

                $('#daily-total-weight').html(totalWeight.toLocaleString(undefined, { minimumFractionDigits: 2 }));
                $('#daily-total-dailytotal').html(dailyTotal.toLocaleString(undefined, { minimumFractionDigits: 2 }));
            }
        });



    var action = ADMINURL + '/transactions/getRecords';
        $('#TransactionListing').DataTable({
            scroller: true,
            serverSide: true,
            responsive: false,
            ajax: {
                url: action,
                type: "GET",
            },
            columns: [
              { 
                data: null, 
                render: function(data, type, row, meta) {
                    return meta.row + 1; 
                },
                searchable: false,
                orderable: false 
            },
                { data: 'trx_no', name: 'trx_no' },
                { data: 'trx_date', name: 'trx_date' },
                { data: 'supplier_id', name: 'supplier_id' },
                { data: 'ticket_no', name: 'ticket_no' },
                { data: 'weight', name: 'weight' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ],

            columnDefs: [
                { "orderable": false, "targets": [1, 2, 3, 4] },
            ],
            aaSorting: [
                [0, 'DESC']
            ],
        });

          $(document).on('click','#edit-transaction-btn',function(){

       $('#transactionEditModal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        // alert(encrypted_id);
                var action = ADMINURL+'/transactions/'+ encrypted_id +'/edit';

        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $("#TRXDateInput").val(response.data.trx_date);
                    $('#trxNoInput').val(response.data.trx_no);
                    $('#SupplierInput').val(response.data.supplier_id);       
                    $('#ticketNoInput').val(response.data.ticket_no);       
                    $('#wieghtMtInput').val(response.data.weight);       
                    $('#hidden_id').val(encrypted_id);
                    $('#submitBtn').removeClass('disabled');
                }else{
                    alert('Something went wrong');
                } 
            }
        });
    });




    var action = ADMINURL + '/transactions/getRecords/hq';
    $('#TransactionListingHq').DataTable({
        scroller: true,
        serverSide: true,
        responsive: false,
        ajax: {
            url: action,
            type: "GET",
        },
        columns: [
            { 
            data: null, 
            render: function(data, type, row, meta) {
                return meta.row + 1; 
            },
            searchable: false,
            orderable: false 
        },
            { data: 'trx_no', name: 'trx_no' },
            { data: 'trx_date', name: 'trx_date' },
            { data: 'supplier_id', name: 'supplier_id' },
            { data: 'ticket_no', name: 'ticket_no' },
            { data: 'weight', name: 'weight' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],

        columnDefs: [
            { "orderable": false, "targets": [1, 2, 3, 4] },
        ],
        aaSorting: [
            [0, 'DESC']
        ],
    });

    var action = ADMINURL + '/sales-invoices/getRecords';
    $('#SalesInvoiceListing').DataTable({
        scroller: true,
        serverSide: true,
        responsive: false,
        ajax: {
            url: action,
            type: "GET",
        },
        columns: [
            { 
            data: null, 
            render: function(data, type, row, meta) {
                return meta.row + 1; 
            },
            searchable: false,
            orderable: false 
        },
            { data: 'bill_date', name: 'bill_date' },
            { data: 'invoice_no', name: 'invoice_no' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'total_deductions', name: 'total_deductions' },
            { data: 'net_pay', name: 'net_pay' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],

        columnDefs: [
            { "orderable": false, "targets": [1, 2, 3, 4] },
        ],
        aaSorting: [
            [0, 'DESC']
        ],
    });

    var selectedValue = '';
    var action = ADMINURL + '/payments/getRecords';
    var PaymentListing = $('#PaymentListing').DataTable({
        scroller: true,
        serverSide: true,
        responsive: false,
        ajax: {
            url: action,
            type: "GET",
            data: function (d) {
                d.payment_method = selectedValue;
            },
            dataSrc: function (json) {
                if (json.footerTotals) {
                    $('#grand-total').html(json.footerTotals.grand_total);
                }
                return json.data;
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'invoice_no', name: 'invoice_no' },
            { data: 'supplier_id', name: 'supplier_id' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'bill_date', name: 'bill_date' },
            { data: 'net_pay', name: 'net_pay', className: "text-end" },
        ],
        order: [[4, 'desc']], // sort by bill_date
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Convert strings to numbers
            var intVal = function (i) {
                return typeof i === 'string'
                    ? parseFloat(i.replace(/,/g, '')) || 0
                    : (typeof i === 'number' ? i : 0);
            };

            // Calculate grand total for current page
            var grandTotal = api
                .column(5, { page: 'current' })
                .data()
                .reduce((a, b) => a + intVal(b), 0);

            $('#grand-total').html(grandTotal.toLocaleString(undefined, { minimumFractionDigits: 2 }));
        }
    });
    $(document).on('change','#paymentMethod',function(){
        selectedValue = $(this).val(); 
        PaymentListing.column(1).search(selectedValue).draw(); 
    });

    var action = ADMINURL + '/scb/getRecords';
    var supplierCashBillListing = $('#supplierCashBillListing').DataTable({
        scroller: true,
        serverSide: true,
        responsive: false,
        ajax: {
            url: action,
            type: "GET",
            data: function (d) {
                d.payment_method = selectedValue;
            },
            dataSrc: function (json) {
                if (json.footerTotals) {
                    $('#grand-total').html(json.footerTotals.grand_total);
                }
                return json.data;
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'date', name: 'date' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'net_weight', name: 'net_weight', className: "text-end" },
            { data: 'price', name: 'price', className: "text-end" },
            { data: 'amount', name: 'amount', className: "text-end" },
            { data: 'actions', name: 'actions', className: "text-end" },
        ],
        order: [[4, 'desc']], // sort by bill_date
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Convert strings to numbers
            var intVal = function (i) {
                return typeof i === 'string'
                    ? parseFloat(i.replace(/,/g, '')) || 0
                    : (typeof i === 'number' ? i : 0);
            };

            // Calculate grand total for current page
            var grandTotal = api
                .column(5, { page: 'current' })
                .data()
                .reduce((a, b) => a + intVal(b), 0);

            $('#grand-total').html(grandTotal.toLocaleString(undefined, { minimumFractionDigits: 2 }));
        }
    });
    /*************** Credit Purchase Analysis ***************/
        var action = ADMINURL + '/credit-purchase-analysis/getRecords';
        var CreditPurchaseAnalysisListing = $('#CreditPurchaseAnalysisListing').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: action,
                type: "GET",
                data: function (d) {
                    d.year = $('#yearSelect').val() || new Date().getFullYear();
                    d.mspo_certification = $('#mspo_certification').val();
                    d.purchases = $('#purchases').val();
                    d.analysis_in = $('#analysis_in').val();
                },
                dataSrc: function (json) {
                    if (json.footerTotals) {
                        const footerCells = $('#CreditPurchaseAnalysisListing tfoot tr td');
                        json.footerTotals.forEach((val, i) => $(footerCells[i]).html(val));
                    }
                    return json.data;
                },
                error: function(xhr, error, code) {
                    showToast(false, 'Error loading data. Please try again just refresh the page');
                }
            },
            columns: [
                {
                    data: null,
                    name: 'supplier_name',
                    render: function (data) {
                        return `${data.sID} ${data.supplier_name}`;

                    }
                },
                { data: 'Jan', name: 'Jan' },
                { data: 'Feb', name: 'Feb' },
                { data: 'Mar', name: 'Mar' },
                { data: 'Apr', name: 'Apr' },
                { data: 'May', name: 'May' },
                { data: 'Jun', name: 'Jun' },
                { data: 'Jul', name: 'Jul' },
                { data: 'Aug', name: 'Aug' },
                { data: 'Sep', name: 'Sep' },
                { data: 'Oct', name: 'Oct' },
                { data: 'Nov', name: 'Nov' },
                { data: 'Dec', name: 'Dec' },
                { data: 'total', name: 'total' },
            ],
            order: [[0, 'asc']],
            columnDefs: [
                { "orderable": false, "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] },
            ],
            pageLength: 10,
            responsive: true,
            searching: true,
        });

        $('#yearSelect').on('change', function () {
        updateTitle();
        CreditPurchaseAnalysisListing.ajax.reload();
    });

    $('#mspo_certification').on('change', function () {
        updateTitle();
        CreditPurchaseAnalysisListing.ajax.reload();
    });

    $('#purchases').on('change', function () {
        updateTitle();
        CreditPurchaseAnalysisListing.ajax.reload();
    });

    $('#analysis_in').on('change', function () {
        let unit = $(this).val();
        let label = unit === 'rm' ? 'Total (RM)' : 'Total (M/Ton)';
        $('#CreditPurchaseAnalysisListing thead th:last').text(label);
        updateTitle();
        CreditPurchaseAnalysisListing.ajax.reload();
    });

    // ✅ Function to dynamically update title text
    function updateTitle() {
        const year = $('#yearSelect').val() || new Date().getFullYear();
        const analysisIn = $('#analysis_in').val() === 'rm' ? 'RM' : 'M/Ton';
        const purchases = $('#purchases').val() || 'credit';
        const mspoCertification = $('#mspo_certification').val() || 'registered';
        const purchaseType = purchases.charAt(0).toUpperCase() + purchases.slice(1);
        const mspoCertificationStr = mspoCertification.charAt(0).toUpperCase() + mspoCertification.slice(1);
        $('.title').text(`${purchaseType} Purchase Analysis by Supplier in ${analysisIn} for [ ${year} ] for ${mspoCertificationStr} MSPO License Supplier`);
    }

    /*************** Credit Purchase Analysis **************/

    
    var action = ADMINURL + '/purchase-analysis/getRecords';
    var PurchaseAnalysisListing = $('#PurchaseAnalysisListing').DataTable({
        scroller: true,
        serverSide: true,
        responsive: true,
        searching: false,
        paging: false, // no need for pagination since you only have 12 rows
        info: false,
        ajax: {
            url: action,
            type: "GET",
            data: function (d) {
                d.year = $('#yearSelect').val();
            },
            dataSrc: function (json) {
                if (json.footerTotals) {
                    // update footer totals
                    $('#total-credit').html(json.footerTotals.total_credit);
                    $('#total-cash').html(json.footerTotals.total_cash);
                    $('#total-weight').html(json.footerTotals.total_weight);
                }
                return json.data;
            }
        },
        columns: [
            { data: 'month', name: 'month' },
            { data: 'credit', name: 'credit', className: 'text-end' },
            { data: 'cash', name: 'cash', className: 'text-end' },
            { data: 'total', name: 'total', className: 'text-end' },
        ],
        columnDefs: [
            { "orderable": false, "targets": [0,1,2, 3] },
        ],
    });
    $(document).on('change','#yearSelect',function(){
        selectedValue = $(this).val(); 
        PurchaseAnalysisListing.column(1).search(selectedValue).draw(); 
    });

    $(document).on('click','#edit-transaction-btn',function(){

       $('#transactionEditModal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        // alert(encrypted_id);
                var action = ADMINURL+'/transactions/'+ encrypted_id +'/edit';

        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $("#TRXDateInput").val(response.data.trx_date);
                    $('#trxNoInput').val(response.data.trx_no);
                    $('#SupplierInput').val(response.data.supplier_id);       
                    $('#ticketNoInput').val(response.data.ticket_no);       
                    $('#wieghtMtInput').val(response.data.weight);       
                    $('#hidden_id').val(encrypted_id);
                    $('#submitBtn').removeClass('disabled');
                }else{
                    alert('Something went wrong');
                } 
            }
        });
    });

    // For generatig TRX number
    $('#transactionModal').on('shown.bs.modal', function () {
            var modal = $(this);
            var generateTrxUrl = modal.data('generate-trx-url');

            function fetchTrxNumber() {
                $.ajax({
                    url: generateTrxUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $('#trxNo').val(response.trx_no);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error generating TRX No:', error);
                    }
                });
            }

            fetchTrxNumber();

            $('#TRXDate').off('change').on('change', function () {
                fetchTrxNumber();
            });
        });

        // For generating ticket number
       $(document).on('shown.bs.modal', '[data-generate-ticket-url]', function () {
    var modal = $(this);
    var generateTicketUrl = modal.data('generate-ticket-url');

    $.ajax({
        url: generateTicketUrl,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response); // check in DevTools console
            modal.find('.auto-ticket-number').val(response.ticket_no);
        },
        error: function () {
            console.warn('Failed to generate Ticket Number');
        }
    });
});



        
        // ************** Deduction Repors ********************

        var action = ADMINURL + '/deduction-reports/getRcords';

        $('#DeductionReportsListing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: action,
                    type: "GET",
                    dataSrc: function (json) {
                        $('#grandTransport').html('<strong>' + json.grandTotals.transport + '</strong>');
                        $('#grandAdvance').html('<strong>' + json.grandTotals.advance + '</strong>');
                        $('#grandOthers').html('<strong>' + json.grandTotals.others + '</strong>');

                        return json.data;
                    }
                },
                columns: [
                    { data: 'date' },
                    { data: 'supplier_id' },
                    { data: 'supplier_name' },
                    { data: 'transport' },
                    { data: 'advance' },
                    { data: 'others' },
                    { data: 'remark' },
                ],
                order: [[1, 'asc'], [0, 'asc']],
            });

     // ************** End Deduction Repors ********************

 
      
       // ************** Supplies Details Listing ********************

        var actionUrl = ADMINURL + '/supplies-details/getRecords';

       window.table1 = $('#SuppliesDetails').DataTable({
            processing: true,
            serverSide: true,
            searching: false, 
            info: false,
            ajax: {
                url: actionUrl,
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#startDate').val();
                    d.end_date = $('#endDate').val();
                    d.supplier_id = $('#selectSupplier').val();
                }
            },
            columns: [
                { data: 'supplier_id' },
                { data: 'vehicle' },
                { data: 'date' },
                { data: 'ticket_no' },
                ...allMills.map(mill => ({
                    data: 'mill_' + mill.id,
                    orderable: false,
                    searchable: false
                })),
                { data: 'total_weight' }
            ],
            drawCallback: function (settings) {
                const grandTotals = settings.json.grandTotals;

                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();
                const supplierId = $('#selectSupplier').val();

                if ((startDate || endDate || supplierId) && grandTotals) {
                    let footerHtml = `
                        <tr>
                            <th colspan="4" style="text-align:right">Grand Total:</th>
                            ${allMills.map(mill => `<th>${grandTotals['mill_' + mill.id]}</th>`).join('')}
                            <th>${grandTotals.total_weight}</th>
                        </tr>`;
                    $('#SuppliesDetails tfoot').html(footerHtml);
                } else {
                    $('#SuppliesDetails tfoot').html('');
                }
                if (!startDate && !endDate && !supplierId) {
                $('#SuppliesDetails tbody').html('');
            }
            }
        });

     // ************** End Supplies Details Listing ********************


       // ************** Supplies Summary Listing ********************

        var actionUrl1 = ADMINURL + '/supplies-summary/getRecords';


        window.table = $('#SuppliesSummary').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: actionUrl1,
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#startDate').val();
                    d.end_date = $('#endDate').val();
                    d.supplier_id = $('#selectSupplier').val();
                }
            },
            columns: [
                { data: 'supplier_id' },
                ...allMills.map(mill => ({
                    data: 'mill_' + mill.id,
                    orderable: false,
                    searchable: false
                })),
                { data: 'total_weight' }
            ],
            drawCallback: function (settings) {
                const grandTotals = settings.json.grandTotals;
                if (grandTotals) {
                    let footerHtml = `
                        <tr>
                            <th>Totals</th>
                            ${allMills.map(mill => `<th>${grandTotals['mill_' + mill.id]}</th>`).join('')}
                            <th>${grandTotals.total_weight}</th>
                        </tr>`;
                    $('#SuppliesSummary tfoot').html(footerHtml);
                }
            }
        });

     // ************** End Supplies Summary Listing ********************


   




});
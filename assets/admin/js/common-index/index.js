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
        },
        columns: [
            { data: 'supplier_id', name: 'supplier_id' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'email', name: 'email' },
            { data: 'telphone_1', name: 'telphone_1' },
            { data: 'view_info', name: 'view_info' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],

        columnDefs: [
            { "orderable": false, "targets": [1, 2, 3, 4] },
        ],
        aaSorting: [
            [0, 'DESC']
        ],
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
    

});
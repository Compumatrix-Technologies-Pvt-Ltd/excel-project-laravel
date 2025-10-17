function deleteCollection(element) {
    var $this = $(element);
    var action = $this.attr('data-href');
    var type = $this.attr('data-type');
    if (action != '') 
    {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            customClass: { confirmButton: "btn btn-primary w-xs me-2 mt-2", cancelButton: "btn btn-danger w-xs mt-2" },
            confirmButtonText: "Yes, delete it!",
            buttonsStyling: !1,
            showCloseButton: !0,
        }).then(function(result) {
            if (result.value) 
            {
                axios.delete(action, { params:{ type: type} })
                .then(function(response) {
                    if (response.data.status === 'success') {
                        setTimeout(function () {
                            if( response.data.url == 'N/A'){
                                window.location.reload();
                            }else{
                                response.data.url ? (window.location.href = response.data.url) : datatableReload();
                            }
                        }, 1000);
                        Swal.fire({ title: "Deleted!", text: response.data.msg, icon: "success", customClass: { confirmButton: "btn btn-primary w-xs mt-2" }, buttonsStyling: !1 });
                    }
                    if (response.data.status === 'error') {
                        Swal.fire("Cancelled",response.data.msg,"error")
                    }
                })
                .catch(function(error) {
                    // swal("Error",error.response.data.msg,'error');
                });
                
            } else if (result.dismiss === "cancel") {
                Swal.fire("Cancelled",'Cancelled',"error")
            }
        });
    }
}

function CancelCollection(element) {

    var $this = $(element);
    var action = $this.attr('data-href');
    if (action != '') 
    {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            customClass: { confirmButton: "btn btn-primary w-xs me-2 mt-2", cancelButton: "btn btn-danger w-xs mt-2" },
            confirmButtonText: "Yes, cancel it!",
            buttonsStyling: !1,
            showCloseButton: !0,
        }).then(function(result) {
            if (result.value) 
            {
                axios.put(action)
                .then(function(response) {
                    if (response.data.status === 'success') {
                        Swal.fire({
                            title: "Success!",
                            text: response.data.msg,
                            icon: "success",
                            customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                            buttonsStyling: false
                        });

                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: response.data.msg,
                            icon: "error",
                            customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                            buttonsStyling: false
                        });
                    }
                })
                .catch(function(error) {
                    $switchElement.prop('checked', !initialChecked);
                    Swal.fire("Error", error.response.data.msg, "error");
                });
                
            } else if (result.dismiss === "cancel") {
                Swal.fire("Cancelled",'Cancelled',"error")
            }
        });
    }
}


/***************************** Common Activation Deactivation Function ************************************/
function activateCollection(encrypted_id, parameter) {
    var action = ADMINURL + '/' + parameter + '/activate/' + encrypted_id;
    var strText = "";
    var $switchElement = $(`input[data-id="${encrypted_id}"]`); // Use jQuery to select the switch element
    if ($switchElement.length === 0) {
        console.error('Switch element not found for data-id:', encrypted_id);
        return;
    }
    var initialChecked = $switchElement.prop('checked'); // Capture the initial state
    if (parameter === 'users') {
        strText = 'Do you want to unblock this user?';
    } else {
        strText = 'You want to activate?';
    }
    if (action !== '') {
        Swal.fire({
            title: "Are you sure?",
            text: strText,
            icon: "warning",
            showCancelButton: true,
            customClass: { confirmButton: "btn btn-primary w-xs me-2 mt-2", cancelButton: "btn btn-danger w-xs mt-2" },
            confirmButtonText: "Yes",
            buttonsStyling: false,
            showCloseButton: true,
        }).then(function(result) {
            if (result.isConfirmed) {
                axios.put(action)
                    .then(function(response) {
                        if (response.data.status === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: response.data.msg,
                                icon: "success",
                                customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                                buttonsStyling: false
                            });
                            
                            changeSwitchFunction(encrypted_id, 'deactivateCollection', parameter);
                        } else {
                            $switchElement.prop('checked', !initialChecked);
                            Swal.fire({
                                title: "Error!",
                                text: response.data.msg,
                                icon: "error",
                                customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                                buttonsStyling: false
                            });
                        }
                    })
                    .catch(function(error) {
                        $switchElement.prop('checked', !initialChecked);
                        Swal.fire("Error", error.response.data.msg, "error");
                    });
            } else {
                $switchElement.prop('checked', !initialChecked); // Revert to initial state on cancel
            }
        });
    }
}
function approvalCollection(encrypted_id, parameter) {
    var action = ADMINURL + '/' + parameter + '/activate/' + encrypted_id;
    var strText = "";
    var $switchElement = $(`input[data-id="${encrypted_id}"]`); // Use jQuery to select the switch element
    if ($switchElement.length === 0) {
        console.error('Switch element not found for data-id:', encrypted_id);
        return;
    }
    var initialChecked = $switchElement.prop('checked'); // Capture the initial state
    strText = 'You want to approve this owner?';
    if (action !== '') {
        Swal.fire({
            title: "Are you sure?",
            text: strText,
            icon: "warning",
            showCancelButton: true,
            customClass: { confirmButton: "btn btn-primary w-xs me-2 mt-2", cancelButton: "btn btn-danger w-xs mt-2" },
            confirmButtonText: "Yes",
            buttonsStyling: false,
            showCloseButton: true,
        }).then(function(result) {
            if (result.isConfirmed) {
                Swal.fire({
                    text: "Please wait",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false, // Hides the OK button
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
                axios.put(action)
                    .then(function(response) {
                        Swal.close(); // Hide Loader
                        if (response.data.status === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: response.data.msg,
                                icon: "success",
                                customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                                buttonsStyling: false
                            });
                            window.location.reload();
                            changeSwitchFunction(encrypted_id, 'deactivateCollection', parameter);
                        } else {
                            $switchElement.prop('checked', !initialChecked);
                            Swal.fire({
                                title: "Error!",
                                text: response.data.msg,
                                icon: "error",
                                customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                                buttonsStyling: false
                            });
                        }
                    })
                    .catch(function(error) {
                        $switchElement.prop('checked', !initialChecked);
                        Swal.fire("Error", error.response.data.msg, "error");
                    });
            } else {
                $switchElement.prop('checked', !initialChecked); // Revert to initial state on cancel
            }
        });
    }
}


function deactivateCollection(encrypted_id, parameter) {
    var strText = "";
    var action = ADMINURL + '/' + parameter + '/deactivate/' + encrypted_id;
    var $switchElement = $(`input[data-id="${encrypted_id}"]`); // Use jQuery to select the switch element
    if ($switchElement.length === 0) {
        console.error('Switch element not found for data-id:', encrypted_id);
        return;
    }
    var initialChecked = $switchElement.prop('checked'); // Capture the initial state
    if (parameter === 'users') {
        strText = 'Do you want to block this user?';
    } else {
        strText = 'You want to deactivate?';
    }
    if (action !== '') {
        Swal.fire({
            title: "Are you sure?",
            text: strText,
            icon: "warning",
            showCancelButton: true,
            customClass: { confirmButton: "btn btn-primary w-xs me-2 mt-2", cancelButton: "btn btn-danger w-xs mt-2" },
            confirmButtonText: "Yes",
            buttonsStyling: false,
            showCloseButton: true,
        }).then(function(result) {
            if (result.isConfirmed) {
                axios.put(action)
                    .then(function(response) {
                        if (response.data.status === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: response.data.msg,
                                icon: "success",
                                customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                                buttonsStyling: false
                            });
                            changeSwitchFunction(encrypted_id, 'activateCollection', parameter);
                        } else {
                            $switchElement.prop('checked', !initialChecked);
                            Swal.fire({
                                title: "Error!",
                                text: response.data.msg,
                                icon: "error",
                                customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                                buttonsStyling: false
                            });
                        }
                    })
                    .catch(function(error) {
                        $switchElement.prop('checked', !initialChecked);
                        Swal.fire("Error", error.response.data.msg, "error");
                    });
            } else {
                $switchElement.prop('checked', !initialChecked); // Revert to initial state on cancel
            }
        });
    }
}

    function changeSwitchFunction(encrypted_id, newFunctionName, parameter) {
        var switchElement = $(`input[data-id="${encrypted_id}"]`);
        if (switchElement.length === 0) {
            console.error('Switch element not found for data-id:', encrypted_id);
            return;
        }
        switchElement.attr('onchange', `return ${newFunctionName}('${encrypted_id}', '${parameter}')`);
    }



    

    
    $(document).on('click','.edit-role-btn',function(){
        $('#EditRoleModal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/roles/'+encrypted_id+'/edit';
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            beforeSend: function () {
                $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
            },
            success:function(response){
                $.LoadingOverlay("hide");
                if(response.status == 'success'){
                    $('#nameInput1').val(response.data.name);
                    $('#hidden_id').val(encrypted_id);
                    setTimeout(function () {
                        $(document).find('.submitBtn2').removeClass('disabled');
                    }, 1000);
                }else{
                    alert('Something went wrong');
                } 
            },
            error: function (xhr, status, error) {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('click','.edit-branch-btn',function(){
        $('#editBranchModal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/branch/'+encrypted_id+'/edit';
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            beforeSend: function () {
                $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
            },
            success:function(response){
                $.LoadingOverlay("hide");
                if(response.status == 'success'){
                    $('#branchName1').val(response.data.name);
                    $('#branchCode1').val(response.data.code);
                    $('#branchPhone1').val(response.data.phone);
                    $('#branchAddress1').val(response.data.address);
                    $("textarea#branchAddress1").val(response.data.address);
                    $('#hidden_id').val(encrypted_id);
                    setTimeout(function () {
                        $(document).find('.submitBtn2').removeClass('disabled');
                    }, 1000);
                }else{
                    alert('Something went wrong');
                } 
            },
            error: function (xhr, status, error) {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    
    
    $(document).on('click','.edit-user',function(){
        $('#modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/admin-users/'+encrypted_id+'/edit';
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            beforeSend: function () {
                $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
            },
            success:function(response){
                $.LoadingOverlay("hide");
                if(response.status == 'success'){
                    $('#nameInput1').val(response.data.name);
                    $('#srtitleInput1').val(response.data.sr_title);
                    $('#emailInput1').val(response.data.email);
                    $('#mobilenumberInput1').val(response.data.mobile_number);
                    $('#hidden_id').val(encrypted_id);
                    setSelectedOption("department", response.data.roles[0].id);
                    $('#submitBtn').removeClass('disabled');
                }else{
                    alert('Something went wrong');
                } 
            },
            error: function (xhr, status, error) {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
   
    function doubleBase64Encode(value) {
        return btoa(btoa(value));
    }
    function setSelectedOption(selectName, value) {
        const selectElement = $(`select[name="${selectName}"]`);
        const encodedValue = doubleBase64Encode(value);
        
        if (selectElement.find(`option[value="${encodedValue}"]`).length > 0) {
            selectElement.val(encodedValue).trigger('change');
        }
    }
    function setSelectedOption2(selectName, value) {
        const selectElement = $(`select[name="${selectName}"]`);        
        if (selectElement.find(`option[value="${value}"]`).length > 0) {
            selectElement.val(value).trigger('change');
        }
    }
    function datatableReload(){
        $('#UserListing').DataTable().ajax.reload();
        location.reload();
    }
    $('.numericInput').on('input', function(event) {
        let inputValue = $(this).val();
        let numericValue = inputValue.replace(/\D/g, '');
        $(this).val(numericValue);
    });

    $(document).on('click', '.netPayButton', function() {
        let weight_mt = $('input[name="weight_mt"]').val();
        let price = $('input[name="price"]').val();
        let incentive_rate = $('input[name="incentive_rate"]').val();

        let transport = $('input[name="transport"]').val();
        let advance = $('input[name="advance"]').val();
        let others = $('input[name="others"]').val();

        let subsidy_amt = $('.subsidy_amt').text();
        if (subsidy_amt) {
            let new_subsidy_amt = subsidy_amt / 100;
            update_subsidy_amt = parseFloat(weight_mt) * parseFloat(new_subsidy_amt);
            final_subsidy_amt = parseFloat(price) * parseFloat(new_subsidy_amt);
            $('.subsidy_amt').text(final_subsidy_amt.toFixed(2)).css('display', 'inline-block');
            $('input[name="subsidy_amt"]').val(final_subsidy_amt.toFixed(2));
        }


        let total = (parseFloat(weight_mt) * parseFloat(price)) || 0;
        let total_deductions = (parseFloat(transport) + parseFloat(advance) + parseFloat(others)) || 0;

        // Update the amount before deductions input field
        $('.amt_before_ded').text(total.toFixed(2));
        $('input[name="amt_before_ded"]').val(total.toFixed(2));

        // Update the total deductions input field
        $('.total_deductions').text(total_deductions.toFixed(2));
        $('input[name="total_deductions"]').val(total_deductions.toFixed(2));

        // Add incentive if applicable
        if (incentive_rate && parseFloat(incentive_rate) > 0) {
            let incentive = (parseFloat(weight_mt) * parseFloat(incentive_rate)) || 0;
            total += incentive;
            $('.incentive_amt').text(incentive.toFixed(2)).css('display', 'inline-block');
            $('input[name="incentive_amt"]').val(incentive.toFixed(2));
        } else {
            $('.incentive_amt').text('0.00').css('display', 'inline-block');
            $('input[name="incentive_amt"]').val('0.00');
        }
        total -= parseFloat(transport) || 0;
        total -= parseFloat(advance) || 0;
        total -= parseFloat(others) || 0;

        // Update the net pay input field
        $('.net_pay').val(total.toFixed(2));
    });

    $(document).on('change','.supplierSelect2',function(){
        var supplier_id = $(this).val();
        var purchase_type = $('input[name="purchase_type"]').val();
        var action = ADMINURL+'/get-supplier-details/'+supplier_id + '/' + purchase_type;
        if(supplier_id){
            $.ajax({
                type: "GET",
                url: action,
                dataType:"json",
                beforeSend: function () {
                    $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
                },
                success:function(response){
                    $.LoadingOverlay("hide");
                    if(response.status == 'success'){
                        $('.supplier_name').text(response.data.supplier_name);
                        if(response.data.subsidy_rate) {
                            let subsidyRate = Number(response.data.subsidy_rate); // convert string to number
                            $('.subsidy_amt').text(subsidyRate.toFixed(2));
                            $('input[name="subsidy_amt"]').val(subsidyRate.toFixed(2));
                        } else {
                            $('.subsidy_amt').text('0.00');
                            $('input[name="subsidy_amt"]').val('0.00');
                        }

                        if(response.deductions) {
                            let transport = response.deductions.transport || 0;
                            let advance = response.deductions.advance || 0;
                            let others = response.deductions.others || 0;
                            $('input[name="transport"]').val(transport.toFixed(2));
                            $('input[name="advance"]').val(advance.toFixed(2));
                            $('input[name="others"]').val(others.toFixed(2));
                        } else {
                            $('input[name="transport"]').val('0.00');
                            $('input[name="advance"]').val('0.00');
                            $('input[name="others"]').val('0.00');
                        }
                      
                      
                    }else{
                        alert('Something went wrong');
                    } 
                },
                error: function (xhr, status, error) {
                    $.LoadingOverlay("hide");
                    alert('Server Error: Something went wrong. Please try again.');
                }
            });
        }else{
            $('input[name="supplier_name"]').val('');
            $('input[name="supplier_address"]').val('');
            $('input[name="supplier_gst"]').val('');
        }
    });


    // $(document).on('change','.supplierSelect',function(){
        
    // });
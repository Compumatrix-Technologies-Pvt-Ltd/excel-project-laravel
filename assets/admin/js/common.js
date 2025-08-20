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
function deleteCompanyData(element) {
        var $this = $(element);
        var action = $this.attr('data-href');
        if (action != '') 
        {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this item?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                cancelButtonColor: '#d33',
            }).then(function(result) {
                if (result.value) 
                {
                    axios.delete(action)
                    .then(function(response) {
                        if (response.data.status === 'success') {
                            Swal.fire("Deleted!",response.data.msg,"success");
                            window.location.reload();
                        }
                        if (response.data.status === 'error') {
                            Swal.fire("Cancelled",response.data.msg,"error");
                        }
                    })
                    .catch(function(error) {
                        // swal("Error",error.response.data.msg,'error');
                    });
                    
                } else if (result.dismiss === "cancel") {
                    Swal.fire("Cancelled",response.data.msg,"error")
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
function unassignedCollection(encrypted_id) {
    var action = ADMINURL + '/unassigned-driver/' + encrypted_id;
    strText = 'You want to unassigned this driver?';
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
    $(document).on('change','#maincategoryidselect',function(){
        var encrypted_id = $(this).val();
        var action = ADMINURL+'/get-subcategory/'+encrypted_id;
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
                    $('#subcategoryselect').html('').append(response.data);
                    $('#subcategoryselect1').html('').append(response.data);
                    if ($('#hidden_sub_category_id').val()) {
                        setSelectedOption("sub_category_id", $('#hidden_sub_category_id').val());
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
    })

    $(document).on('change', '.variantselect', function () {
        var encrypted_id = $(this).val();
        var row = $(this).closest('.variant-container'); 
        var variantValueSelect = row.find('.variantvalueselect'); 
    
        var action = ADMINURL + '/get-variant-value/' + encrypted_id;
        $.ajax({
            type: "GET",
            url: action,
            dataType: "json",
            beforeSend: function () {
                $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
            },
            success: function (response) {
                $.LoadingOverlay("hide");
                variantValueSelect.html(''); // Clear previous
    
                if (response.status == 'success' && response.data.trim() !== '') {
                    variantValueSelect.append(); 
                    variantValueSelect.append(response.data);
                } else {
                    variantValueSelect.append(); 
                }
    
                variantValueSelect.trigger('change'); // Refresh select2
            },
            error: function (xhr, status, error) {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    
    
    $(document).on('change', '.orderProduct', function () {
        var encrypted_id = $(this).val();    
        var row = $(this).closest('.productRow'); // Get the current row
        var variantSelect = row.find('.productordervariant'); // Get the variant dropdown
        variantSelect.attr('data-product-id',encrypted_id);
        if (encrypted_id) {
            var action = ADMINURL + '/get-product-variants/' + encrypted_id;
    
            $.ajax({
                type: "GET",
                url: action,
                dataType: "json",
                beforeSend: function () {
                    $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
                },
                success: function (response) {
                    $.LoadingOverlay("hide");
                    if (response.status == 'success') {
                        variantSelect.html('<option value="">Select Variant</option>'); // Reset variants
                        variantSelect.append(response.data);
                    } else {
                        alert('Something went wrong');
                    }
                },
                error: function (xhr, status, error) {
                    $.LoadingOverlay("hide"); 
                    alert('Server Error: Something went wrong. Please try again.');
                }
            });
        } else {
            variantSelect.html('<option value="">Select Variant</option>'); // Reset if no product is selected
        }
    });
    // $(document).on('change', '.clientidselect', function () {
    //     var encrypted_id = $(this).val();    
    //     var targetContainer = $(document).find('#custClass');
    //     if (encrypted_id) {
    //         var action = ADMINURL + '/get-company-pre-set-order-list/' + encrypted_id;
    
    //         $.ajax({
    //             type: "GET",
    //             url: action,
    //             dataType: "json",
    //             beforeSend: function () {
    //                 $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
    //             },
    //             success: function (response) {
    //                 $.LoadingOverlay("hide");
    //                 if (response.status === 'success') {
    //                     $(document).find('#productContainer').empty();
    //                     $(document).find('textarea#addressmapinput').val(response.c_address);
    //                     $(document).find('.OrderPresetContainer').remove();
    //                     $(document).find('.clientSelectClass').remove();
    //                     $(document).find('.PresentOrderList').remove();
    //                     targetContainer.after(response.data);
    //                     if (response.only_new_order) {
    //                         setTimeout(function () {
    //                             $.ajax({
    //                                 type: "GET",
    //                                 url: ADMINURL + '/get-new-product-html',
    //                                 dataType: "json",
    //                                 beforeSend: function () {
    //                                     $.LoadingOverlay("show", {
    //                                         background: "rgba(75, 73, 172, 0)",
    //                                         maxSize: 40,
    //                                         imageColor: "#5236ff"
    //                                     });
    //                                 },
    //                                 success: function (response) {
    //                                     $.LoadingOverlay("hide");
    //                                     if (response.status == 'success') {
    //                                         $(document).find('#productContainer').append(response.data);
    //                                     } else {
    //                                         alert('Could not retrieve stock.');
    //                                     }
    //                                 },
    //                                 error: function (xhr, status, error) {
    //                                     $.LoadingOverlay("hide"); 
    //                                     alert('Server Error: Something went wrong. Please try again.');
    //                                 }
    //                             });
    //                         }, 1000);   
    //                     }
    //                 } else {
    //                     alert('Something went wrong');
    //                 }
    //             },
    //             error: function (xhr, status, error) {
    //                 $.LoadingOverlay("hide"); 
    //                 alert('Server Error: Something went wrong. Please try again.'); 
    //             }
    //         });
    //     }
    // });
        $(document).ready(function() {
            $(document).on('change', '.clientidselect', function () {
                var encrypted_id = $(this).val();

                if ($.fn.DataTable.isDataTable('#data-table')) {
                    $('#data-table').DataTable().destroy();
                }

                if (encrypted_id) {
                    $('#data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: ADMINURL + '/get-company-pre-set-order-list/' + encrypted_id,
                            type: 'GET',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function () {
                                $.LoadingOverlay("show", {
                                    background: "rgba(75, 73, 172, 0)",
                                    maxSize: 40,
                                    imageColor: "#5236ff"
                                });
                            },
                            complete: function () {
                                $.LoadingOverlay("hide");
                                $(document).find('.custCard').show();
                            },
                            error: function (error) {
                                console.error('AJAX Error:', error);
                            }
                        },
                        columns: [
                            { data: 'checkbox' , orderable: false, searchable: false},
                            { data: 'id' },
                            { data: 'product_image', orderable: false, searchable: false },
                            { data: 'product_name' },
                            { data: 'category' },
                            { data: 'sub-category' },
                            { data: 'sub-subcategory' },
                            { data: 'product_type' },
                            { data: 'view_info', orderable: false, searchable: false }
                        ]
                    });
                }
            });
        });

    $(document).on('change', '.Orderget', function () {
        var radioValue = $(this).val();
        var $productContainer = $('#productContainer');    
        if (radioValue === 'preset') {
            var firstRow = $('#productContainer .productRow').first();
            firstRow.find('select').val('');
            firstRow.find('input[type="text"], input[type="number"], input[type="hidden"]').val('');
            firstRow.find('.orderStatus').hide().text('');
            firstRow.find('.stock-error').hide().text('');
            $('#productContainer').find('.productRow').remove();
            var encrypted_id = $('#hid_client_id').val();
            
            if (encrypted_id) {
                var action = ADMINURL + '/get-pre-set-order-list/' + encrypted_id;
                $.ajax({
                    type: "GET",
                    url: action,
                    dataType: "json",
                    beforeSend: function () {
                        $.LoadingOverlay("show", {
                            background: "rgba(75, 73, 172, 0)",
                            maxSize: 40,
                            imageColor: "#5236ff"
                        });
                    },
                    success: function (response) {
                        $.LoadingOverlay("hide");
                        if (response.status === 'success') {
                            $(document).find('.clientSelectClass').after(response.data);
                        }
                    },
                    error: function (xhr, status, error) {
                        $.LoadingOverlay("hide"); 
                        alert('Server Error: Something went wrong. Please try again.');
                    }
                });
            }
        } else {
           // alert();
            $(document).find('.PresentOrderList').remove();
            $('#remarkinput').val('');
            $('#productContainer').find('.productRow').remove();
            let length = $('#productContainer').find('.productRow').length;
            if(length == 0){
                setTimeout(function () {
                    $.ajax({
                        type: "GET",
                        url: ADMINURL + '/get-new-product-html',
                        dataType: "json",
                        beforeSend: function () {
                            $.LoadingOverlay("show", {
                                background: "rgba(75, 73, 172, 0)",
                                maxSize: 40,
                                imageColor: "#5236ff"
                            });
                        },
                        success: function (response) {
                            $.LoadingOverlay("hide");
                            if (response.status == 'success') {
                                $(document).find('#productContainer').append(response.data);
                            } else {
                                alert('Could not retrieve stock.');
                            }
                        },
                        error: function (xhr, status, error) {
                            $.LoadingOverlay("hide"); 
                            alert('Server Error: Something went wrong. Please try again.');
                        }
                    });
                }, 1000);   
            }
        }
    });
    function updateProductOptions() {
        let selectedProducts = [];
    
        // Get all selected product IDs
        $('select[name^="products["]').each(function () {
            const val = $(this).val();
            if (val) selectedProducts.push(val);
        });
    
        // Loop through each dropdown and update options
        $('select[name^="products["]').each(function () {
            const currentVal = $(this).val();
            $(this).find('option').each(function () {
                if (selectedProducts.includes($(this).val()) && $(this).val() !== currentVal) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    }
    
    // Trigger on change of product dropdown
    $(document).on('change', 'select[name^="products["]', function () {
        //updateProductOptions();
    });
    
    
    $(document).on('change','.orderDetails ',function(){
        var encrypted_id = $(this).val();
        var $productContainer = $('#productContainer');
        if (encrypted_id) {
            var action = ADMINURL + '/get-pre-set-order-details/' + encrypted_id;
            $.ajax({
                type: "GET",
                url: action,
                dataType: "json",
                beforeSend: function () {
                    $.LoadingOverlay("show", {
                        background: "rgba(75, 73, 172, 0)",
                        maxSize: 40,
                        imageColor: "#5236ff"
                    });
                },
                success: function (response) {
                    $.LoadingOverlay("hide");
                    if (response.status === 'success') {
                        $productContainer.empty();
                        $productContainer.append(response.data);
                        $('#remarkinput').val(response.order.remark);
                        $("textarea#addressmapinput").val(response.order.address_map);
                    } else {
                        alert('Something went wrong');
                    }
                },
                error: function (xhr, status, error) {
                    $.LoadingOverlay("hide"); 
                    alert('Server Error: Something went wrong. Please try again.');
                }
            });
        }
    });
    
    
    // Fetch Variant Values when Variant is selected
    $(document).on('change', '.productordervariant', function () {
        var encrypted_variant_id = $(this).val();
        var product_id = $(this).attr('data-product-id');
        var row = $(this).closest('.productRow'); // Get the current row
        var variantValueSelect = row.find(".productordervariantValue"); // Get the variant value dropdown
        if (encrypted_variant_id) {
            var action = ADMINURL + '/get-variant-values/' + encrypted_variant_id + '/' + product_id;

            $.ajax({
                type: "GET",
                url: action,
                dataType: "json",
                beforeSend: function () {
                    $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
                },
                success: function (response) {
                    $.LoadingOverlay("hide");
                    if (response.status == 'success') {
                        variantValueSelect.html('<option value="">Select Variant Value</option>'); // Reset options
                        variantValueSelect.append(response.data);

                    } else {
                        alert('Something went wrong');
                    }
                },
                error: function (xhr, status, error) {
                    $.LoadingOverlay("hide"); 
                    alert('Server Error: Something went wrong. Please try again.');
                }
            });
        } else {
            variantValueSelect.html('<option value="">Select Variant Value</option>'); // Reset if no variant is selected
        }
    });
    $(document).on('change', '.productordervariantValue', function () {
    var row = $(this).closest('.productRow');
    var variant_value_id = $(this).val();
    var product_id = row.find('.orderProduct').val();

    if (variant_value_id && product_id) {
        var action = ADMINURL + '/get-variant-stock/' + variant_value_id + '/' + product_id;

        $.ajax({
            type: "GET",
            url: action,
            dataType: "json",
            success: function (response) {
                if (response.status == 'success') {
                    var qtyInput = row.find('.quantity');
                    qtyInput.attr('data-stock', response.stock);
                } else {
                    alert('Could not retrieve stock.');
                }
            },
            error: function (xhr, status, error) {
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    }
});
// $(document).on('change', '.productDropdown', function () {
//     let productId = $(this).val();
//     let $row = $(this).closest('.productRow'); 
//    // let currentIndex = $row.data('index');
//     const nameAttr = $(this).attr('name'); 
//     const match = nameAttr.match(/products\[(\d+)\]\[product_id\]/);
//     if (match) {
//         const currentIndex = parseInt(match[1]); // result: 1
//     }
//     if (productId) {
//         $.ajax({
//             url: ADMINURL + "/get-product-type/" + productId,
//             type: "GET",
//             success: function (response) {
//                 if (response.status == true) {
//                     $row.find('.productImage')
//                     .attr('data-image', response.image)
//                     .find('img').attr('src', response.image).show();
//                     $row.find('.productTypeField').val(response.name);
//                     $row.find('.productIdHidden').val(btoa(btoa(productId)));
//                     $row.find('.quantityInput').attr('data-product-id', productId);
//                     $row.find('.quantityInput').val('');
//                     $row.find('.stock-error').hide().text('');
//                     $row.find('.orderStatus').hide().text('');
//                     $row.find(".productVariantRow").html(response.data);
//                     $row.find(".productVariantRow .product-variant").each(function (variantIndex) {
//                         $(this).find("[data-name='variant_name']").attr('name', 'products[' + currentIndex + '][variants][' + variantIndex + '][variant_name]');
//                         $(this).find("[data-name='variant_id']").attr('name', 'products[' + currentIndex + '][variants][' + variantIndex + '][variant_id]');
//                         $(this).find("[data-name='variant_value_id']").attr('name', 'products[' + currentIndex + '][variants][' + variantIndex + '][variant_value_id]');
//                     });

//                 } else {
//                     $row.find('.productImage').hide();
//                     $row.find('.productTypeField').val('Type not found');
//                     $row.find('.productIdHidden').val('');
//                     $row.find('.quantityInput').removeAttr('data-product-id');
//                 }
//             },
//             error: function () {
//                 $row.find('.productTypeField').val('Error fetching type');
//                 $row.find('.productIdHidden').val('');
//             }
//         });
//     } else {
//         $row.find('.productTypeField').val('');
//         $row.find('.productIdHidden').val('');
//     }
// });
$(document).on('change', '.productDropdown', function () {
    let productId = $(this).val();
    
    let $row = $(this).closest('.productRow'); 
    const nameAttr = $(this).attr('name'); 
    let currentIndex = null;

    const match = nameAttr.match(/products\[(\d+)\]\[product_id\]/);
    if (match) {
        currentIndex = parseInt(match[1]); // result: 1
    }

    if (productId) {
        $.ajax({
            url: ADMINURL + "/get-product-type/" + productId,
            type: "GET",
            success: function (response) {
                $(document).find('.submitBtn').removeClass('disabled');
                if (response.status == true) {
                    $row.find('.productImage')
                        .attr('data-image', response.image)
                        .find('img').attr('src', response.image).show();

                    $row.find('.productTypeField').val(response.name);
                    $row.find('.productIdHidden').val(btoa(btoa(productId)));
                    $row.find(".productPackagingRow").remove();
                    $row.find(".productVariantRow").empty().html(response.data);


                    $row.find(".productVariantRow .product-packaging").each(function (variantIndex) {
                        $(this).find("[data-name='packaging_relation_id']")
                            .attr('name', `products[${currentIndex}][packaging_relation_id][${variantIndex}]`);
                        $(this).find("[data-name='packaging_value']")
                            .attr('name', `products[${currentIndex}][packaging_value][${variantIndex}]`);
                    });
                    

                    $row.find(".productVariantRow .product-variant").each(function (variantIndex) {
                        $(this).find("[data-name='variant_name']")
                            .attr('name', `products[${currentIndex}][variants][${variantIndex}][variant_name]`);
                        $(this).find("[data-name='variant_id']")
                            .attr('name', `products[${currentIndex}][variants][${variantIndex}][variant_id]`);
                        $(this).find("[data-name='variant_value_id[]']")
                            .attr('name', `products[${currentIndex}][variants][${variantIndex}][variant_value_id][]`);
                    });
                    $(".variationsValues").select2({
                        placeholder: "Select Variant Value",
                        allowClear: true
                    });
                } else {
                    $row.find('.productImage').hide();
                    $row.find('.productIdHidden').val('');
                    $row.find('.quantityInput').removeAttr('data-product-id');
                }
            },
            error: function () {
                $row.find('.productIdHidden').val('');
            }
        });
    } else {
        $row.find('.productIdHidden').val('');
    }
});
$(document).on('change', '.MainCatDropdown', function () {
    let maincatId = $(this).val();
    let $row = $(this).closest('.categoryRow'); 
    if (maincatId) {
        $.ajax({
            url: ADMINURL + "/get-sub-category/" + maincatId,
            type: "GET",
            beforeSend: function () {
                $.LoadingOverlay("show", {
                    background: "rgba(75, 73, 172, 0)",
                    maxSize: 40,
                    imageColor: "#5236ff"
                });
            },
            success: function (response) {
                $.LoadingOverlay("hide");
                if (response.status == 'success') {
                    $row.find(".SubCatDropdown").html('').append(response.data);
                } 
            },
            error: function () {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    } 
});
$(document).on('change', '.SubCatDropdown', function () {
    let subcatId = $(this).val();
    let $row = $(this).closest('.categoryRow'); 
    if (subcatId) {
        $.ajax({
            url: ADMINURL + "/get-sub-sub-category/" + subcatId,
            type: "GET",
            beforeSend: function () {
                $.LoadingOverlay("show", {
                    background: "rgba(75, 73, 172, 0)",
                    maxSize: 40,
                    imageColor: "#5236ff"
                });
            },
            success: function (response) {
                $.LoadingOverlay("hide");
                if (response.status == 'success') {
                    $row.find(".subSubCategory").html('').append(response.data);
                } 
            },
            error: function () {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    } 
});
$(document).on('change', '.subSubCategory', function () {
    let subcatId = $(this).val();
    let $row = $(this).closest('.productRow'); 
    if (subcatId) {
        $.ajax({
            url: ADMINURL + "/get-products/" + subcatId,
            type: "GET",
            beforeSend: function () {
                $.LoadingOverlay("show", {
                    background: "rgba(75, 73, 172, 0)",
                    maxSize: 40,
                    imageColor: "#5236ff"
                });
            },
            success: function (response) {
                $.LoadingOverlay("hide");
                if (response.status == 'success') {
                    $row.find(".productDropdown").html('').append(response.data);
                    $row.find(".productVariantRow").html('');
                    //updateProductOptions();

                } 
            },
            error: function () {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');

            }
        });
    } 
});


    $(document).on('click', '.view-variant-info', function () {
        $('#kt_modal_view-variant-info_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL + '/view-variant/' + encrypted_id;

        $.ajax({
            type: "GET",
            url: action,
            dataType: "json",
            beforeSend: function () {
                $.LoadingOverlay("show", {
                    background: "rgba(75, 73, 172, 0)",
                    maxSize: 40,
                    imageColor: "#5236ff"
                });
            },
            success: function (response) {
                $.LoadingOverlay("hide");
                if (response.status === 'success') {
                    $('#variant-info-table-body').html(response.data);
                }
            },
            error: function () {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
      $(document).on('click', '.edit-PackagingType', function () {
        $('#kt_modal_edit_variant_info_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL + '/view-order-packaging-info/' + encrypted_id;

        $.ajax({
            type: "GET",
            url: action,
            dataType: "json",
            beforeSend: function () {
                $.LoadingOverlay("show", {
                    background: "rgba(75, 73, 172, 0)",
                    maxSize: 40,
                    imageColor: "#5236ff"
                });
            },
            success: function (response) {
                $.LoadingOverlay("hide");
                if (response.status === 'success') {
                    $('.custRow').html('').append(response.data);
                }
            },
            error: function () {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });

    $('#kt_modal_view-variant-info_modal').on('hidden.bs.modal', function () {
        $('#variant-info-table-body').html('');
    });


    
        
    $(document).on('click','.edit-department',function(){
        $('#kt_modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/departments/'+encrypted_id+'/edit';
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
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
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('click','.edit-product',function(){
        $('#kt_modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/products/'+encrypted_id+'/edit';
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
                    $('.fileContainer').html('<img src="'+response.data.image +'" style="width: 120px; height: 80px;border-radius:15px">');
                    $(document).find('#imageInput1').removeAttr('required');
                    $('#hidden_id').val(encrypted_id);
                    setSelectedOption("main_category_id", response.data.main_category_id);
                    $('#hidden_sub_category_id').val(response.data.sub_category_id);
                    $('#maincategoryidselect1').trigger('change');


                    $('.existing-variant-wrapper').html('');

                    response.data.product_variants.forEach(function (variant, index) {
                        var existingVariantHtml = `
                            <div class="row variant-container">
                                <div class="col-md-4">
                                    <div class="mb-3 form-group">
                                        <label class="form-label">Select Variant <span class="text-danger">*</span></label>
                                        <select name="existing_variant[]" class="form-select existing-variantselect">
                                            <option value="">Select Variant</option>
                                            ${response.variantOptions} 
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="col-md-4">
                                    <div class="mb-3 form-group">
                                        <label class="form-label">Value<span class="text-danger">*</span></label>
                                        <select name="existing_variant_value[]" class="form-select existing-variantvalueselect">
                                            <option value="">Select Variant Value</option>
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="col-md-3">
                                    <div class="mb-3 form-group">
                                        <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                        <input type="text" name="existing_qty[]" value="${variant.qty}" class="form-control">
                                    </div>
                                </div>
                    
                                <div class="col-md-1">
                                    <div class="mt-4 form-group">
                                        <button type="button" class="btn btn-danger remove-existing-variant"><i class="mdi mdi-minus"></i></button>
                                    </div>
                                </div>
                            </div>`;
                    
                        $('.existing-variant-wrapper').append(existingVariantHtml);
                    
                        // Find the last added variant select
                        var lastVariantSelect = $('.existing-variant-wrapper').find('.existing-variantselect:last');
                        lastVariantSelect.val(btoa(btoa(variant.variant.id))); // Double base64 encoding
                    
                        // Trigger change event to load variant values via AJAX
                        lastVariantSelect.trigger('change');
                    
                        // Wait for AJAX to populate variant values, then set the correct value
                        setTimeout(() => {
                            var lastVariantValueSelect = $('.existing-variant-wrapper').find('.existing-variantvalueselect:last');
                            lastVariantValueSelect.val(btoa(btoa(variant.variant_value.id)));
                        }, 1000); // Wait longer to ensure AJAX completion
                    });
                    

                    setTimeout(function () {
                        $(document).find('.submitBtn2').removeClass('disabled');
                    }, 1000);
                }else{
                    alert('Something went wrong');
                } 
            },
            error: function (xhr, status, error) {
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('click','.edit-main-category',function(){
        $('#kt_modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/main-category/'+encrypted_id+'/edit';
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
    $(document).on('click','.view-notice-info',function(){
        $('#kt_modal_view_notice_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/user-noticeboard/'+encrypted_id+'/edit';
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
                    $("#NoticeDescription").html(response.data.notice_desc);
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

    
    
    $(document).on('click','.edit-sub-category',function(){
        $('#kt_modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/sub-category/'+encrypted_id+'/edit';
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
                    $('#sortOrderInput1').val(response.data.sort_order);
                    $('#hidden_id').val(encrypted_id);
                    setSelectedOption("cat_id", response.data.cat_id);
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

    $(document).on('click','.edit-sub-subcategory',function(){
        $('#kt_modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/sub-subcategory/'+encrypted_id+'/edit';
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
                    $('#subCatSelect1').html('').append(response.html);
                    $('#hidden_id').val(encrypted_id);
                    setSelectedOption2("main_cat_id", response.data.main_cat_id);
                    
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
    $(document).on('click','.edit-noticeboard',function(){
        $('#kt_modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/user-noticeboard/'+encrypted_id+'/edit';
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
                    $("textarea#exampleInputPassword1").val(response.data.notice_desc);
                    $('#hidden_id').val(encrypted_id);
                    setSelectedOption("role_id", response.data.role_id);

                    $('#userSelect1').empty();
                    $('#userSelect1').append('<option value="">Select User</option>');
                    $('#userSelect1').append(response.html);
                    $('#userSelect1').trigger('change');

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
    $(document).on('click','.edit-product-type',function(){
        $('#kt_modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/product-types/'+encrypted_id+'/edit';
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
                    setSelectedOption("cat_id", response.data.cat_id);
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
    $(document).on('click','.view-c-info',function(){
        $('#kt_modal_info_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL+'/client-companies/'+encrypted_id+'/edit';
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
                    $('#ContactPersonNameInput2').val(response.data.contact_person_name);
                    $('#ContactPersonNumberInput2').val(response.data.contact_person_number);
                    $("textarea#AddressInput2").val(response.data.c_address);
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
    $(document).on('click','.custProdClass',function(){
        $('#kt_modal_view_snapshot_modal').modal('show');
        var encrypted_id = $(this).attr("data-client-id");
        var action = ADMINURL+'/client-companies/'+encrypted_id+'/info';
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
                  
                    const $carousel = $('.signboard-carousel');
                    $carousel.empty();                   
                    const lightboxGroup = 'signboard-' + Date.now();


                    response.data.SignboardImages.forEach(function(image) {
                        $carousel.append(`
                            <a class="item" href="${image.company_url}" data-lightbox="${lightboxGroup}" title="SignBoard">
                                <img src="${image.company_url}" width="300" height="150" alt="SignBoard Image" />
                            </a>
                        `);
                    });

                    reinitializeOwlCarousel($carousel);
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
    let remarkTableInitialized = false;

$(document).on('click', '.company-info', function () {
    const encrypted_id = $(this).attr("data-id");
    $('#client_id').val(encrypted_id);
    $('#kt_modal_info_modal').modal('show');

    const action = `${ADMINURL}/client-companies/${encrypted_id}/info`;

    $.ajax({
        type: "GET",
        url: action,
        dataType: "json",
        beforeSend: function () {
            $.LoadingOverlay("show", {
                background: "rgba(75, 73, 172, 0)",
                maxSize: 40,
                imageColor: "#5236ff"
            });
        },
        success: function (response) {
            $.LoadingOverlay("hide");
            if (response.status === 'success') {
                const data = response.data.Data;
                const snapshots = response.data.SnapshotImages;
                const daysOff = response.data.delivery_day_off;

                $('#hidden_id').val(encrypted_id);
                $('#c_nameInput1').val(data.c_name);
                $('#csignboardnameInput1').val(data.c_signboard_name);
                $('#ContactPersonNameInput1').val(data.contact_person_name);
                $('#ContactPersonNumberInput1').val(data.contact_person_number);
                $('#AddressInput1').val(data.c_address);
                $('#remark_textarea1').val(data.remark_textarea);
                setSelectedOption("user_id", data.user_id);
                renderDaysOffList(daysOff);

                // Load Snapshots
                const $carousel = $('.snapshot-carousel');
                $carousel.empty();                
                const lightboxGroup = 'snapshot-' + Date.now();

                snapshots.forEach(image => {
                    $carousel.append(`
                        <a class="item" href="${image.snapshot_url}" data-lightbox="${lightboxGroup}" title="Snapshot">
                            <img src="${image.snapshot_url}" width="300" height="150" alt="Snapshot Image" />
                        </a>
                    `);
                });
                reinitializeOwlCarousel($carousel);

                // Reinitialize the DataTable for ExistingProductTable
                if ($.fn.DataTable.isDataTable('#ExistingProductTable')) {
                    $('#ExistingProductTable').DataTable().destroy();
                }

                $('#ExistingProductTable').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: ADMINURL + '/get-client-potential-product-listing/getExistingRecord',
                        data: function (d) {
                            d.client_id = encrypted_id;
                        },
                        dataSrc: 'data'
                    },
                    columns: [
                        { data: "id" },
                        { data: "product_image" },
                        { data: "product_name" },
                        { data: "category" },
                        { data: "sub-category" },
                        { data: "sub-subcategory" },
                        { data: "product_type" },
                        { data: "view_info" },
                    ],
                    order: [[0, 'DESC']]
                });

                setTimeout(() => {
                    $('.submitBtn2').removeClass('disabled');
                }, 1000);
            } else {
                alert('Something went wrong');
            }
        },
        error: function () {
            $.LoadingOverlay("hide");
            alert('Server Error: Something went wrong. Please try again.');
        }
    });
});

// Only bind the tab2 event handler once
$(document).off('click', '[data-bs-target="#tab2"]').on('click', '[data-bs-target="#tab2"]', function () {
    if (!remarkTableInitialized) {
        const client_id = $('#client_id').val();

        $('#NewProductsTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: ADMINURL + '/get-client-potential-product-listing/getNewRecord',
                data: function (d) {
                    d.client_id = client_id;
                },
                dataSrc: 'data'
            },
            columns: [
                { data: "id" },
                { data: "product_name" },
                { data: "remark" },
                { data: "created_at" },
            ],
            order: [[0, 'DESC']]
        });

        remarkTableInitialized = true;
    }
});


    function reinitializeOwlCarousel($carousel) {
    if ($carousel.hasClass('owl-loaded')) {
        $carousel.trigger('destroy.owl.carousel');
        $carousel.removeClass('owl-loaded owl-hidden');
        $carousel.find('.owl-stage-outer').children().unwrap();
    }

    $carousel.owlCarousel({
            stagePadding: 50,
            loop: false,
            margin: 10,
            nav: true, 
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    }

   function renderDaysOffList(daysOff) {
    const $list = $('#daysOffList');
    $list.empty(); 

    if (Array.isArray(daysOff) && daysOff.length > 0) {
        daysOff.forEach(function(item) {
            const formattedWeek = 'Week ' + item.week;
            const formattedDay = item.day.charAt(0).toUpperCase() + item.day.slice(1);
            $list.append(`<li class="list-group-item">${formattedWeek}: ${formattedDay}</li>`);
        });
    } else {
        $list.append('<li class="list-group-item text-muted">No days off available.</li>');
    }
}



    $(document).on('click', '.edit-product-variant', function () {
        $('#kt_modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var action = ADMINURL + '/product-variations/' + encrypted_id + '/edit';
    
        $.ajax({
            type: "GET",
            url: action,
            dataType: "json",
            beforeSend: function () {
                $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
            },
            success: function (response) {
                $.LoadingOverlay("hide");
                if (response.status == 'success') {
                    $('#vnameInput12').val(response.data.v_name);
                    $('#hidden_id').val(encrypted_id);
                    $('.variantValuesedit').html('');
                    if (response.data.values.length > 0) {
                        response.data.values.forEach(function (value, index) {
                            $('.variantValuesedit').append(`
                                <div class="input-group mb-2">
                                    <input type="hidden" name="values[${index}][id]" value="${value.id}">
                                    <input type="text" name="values[${index}][v_value]" class="form-control" placeholder="Enter value" value="${value.v_value}" />
                                    <button type="button" class="btn btn-danger removeValue">X</button>
                                </div>
                            `);
                        });
                    } else {
                        $('.variantValuesedit').append(`
                            <div class="input-group mb-2">
                                <input type="text" name="values[0][v_value]" class="form-control" placeholder="Enter value" />
                                <button type="button" class="btn btn-danger removeValue">X</button>
                            </div>
                        `);
                    }
                    setTimeout(function () {
                        $(document).find('.submitBtn2').removeClass('disabled');
                    }, 1000);
                } else {
                    alert('Something went wrong');
                }
            },
            error: function (xhr, status, error) {
                $.LoadingOverlay("hide");
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('click', '.sign-in-btn', function () {
        const $btn = $(this);
        const userId = $btn.data('user-id');
        const clientId = $btn.data('client-id');
    
        Swal.fire({
            title: "Are you sure?",
            text: "You want to sign in",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-primary w-xs me-2 mt-2",
                cancelButton: "btn btn-danger w-xs mt-2"
            },
            confirmButtonText: "Yes",
            buttonsStyling: false,
            showCloseButton: true,
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: ADMINURL + '/client-visit-sign-in',
                    data: {
                        user_id: userId,
                        client_id: clientId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: response.msg,
                                icon: "success",
                                customClass: { confirmButton: "btn btn-primary w-xs mt-2" },
                                buttonsStyling: false
                            }).then(() => {
                                location.reload(); // Or switch the button states here without reload
                            });
                        }
                    },
                    error: function (error) {
                        Swal.fire("Error", error.responseJSON?.msg || "Something went wrong!", "error");
                    }
                });
            }
        });
    });
    
    $(document).on('click', '.sign-out-btn', function () {
        $('#kt_modal_remark_view_modal').modal('show');
        var visitId = $(this).data('visit-id');
        $('#visit_id').val(visitId);

    });
    $(document).on('click', '.upload-snapshot', function () {
        var orderId = $(this).attr('data-order-id');
        $('#order_ID').val(orderId);
        $('#kt_modal_upload_modal').modal('show');
        $('#kt_modal_upload_modal').find('#deliverysnapshotfile').removeAttr('capture', 'environment');

    });
    
    $(document).on('click', '.take-snapshot', function () {
        var orderId = $(this).attr('data-order-id');
        $('#order_ID').val(orderId);
        $('#kt_modal_upload_modal').modal('show');
        $('#kt_modal_upload_modal').find('#deliverysnapshotfile').attr('capture', 'environment');
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
    $(document).on('click','.view-remark',function(){
        $('#kt_modal_view_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var type = $(this).attr("type");
        var action = ADMINURL+'/products-order/get-info/'+encrypted_id;
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $('textarea#ExecutiveRemark').html(response.data.remark);
                    $('textarea#DriverRemark').html(response.data.driver_remark);
                    if(response.data.admin_remark != null){
                        $('textarea#admin_remark').html(response.data.admin_remark);
                        $('textarea#admin_remark').attr('disabled',true);
                        $('.adminremarkBtn').attr('disabled',true);
                    }else{
                        $('textarea#admin_remark').html('');
                        $('textarea#admin_remark').attr('disabled',false);
                        $('.adminremarkBtn').attr('disabled',false);

                    }
                    
                    $('#hidden_order_id').val(encrypted_id);
                }else{
                    alert('Something went wrong');
                } 
            },
            error: function (xhr, status, error) {
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('click','.invalid-link',function(){
        $('#kt_modal_view_address_modal').modal('show');
        $('textarea#delivery_address').html('');
        var encrypted_id = $(this).attr("data-id");
        var type = $(this).attr("type");
        var action = ADMINURL+'/products-order/get-info/'+encrypted_id;
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
                    $('textarea#delivery_address').html('').html(response.data.address_map);
                }else{
                    alert('Something went wrong');
                } 
            },
            error: function (xhr, status, error) {
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('click','.view-driver-remark',function(){
        $('#kt_modal_view_driver_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        var type = $(this).attr("type");
        var action = ADMINURL+'/products-order/get-info/'+encrypted_id;
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $('textarea#ExecutiveRemark').html(response.data.remark);
                    if(response.data.driver_remark != null){
                        $('textarea#driver_remark').html(response.data.driver_remark);
                        $('textarea#driver_remark').attr('disabled',true);
                        $('.driverRemarkBtn').remove();
                    }
                    $('#hidden_order_id').val(encrypted_id);
                }else{
                    alert('Something went wrong');
                } 
            },
            error: function (xhr, status, error) {
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('click','.view-visit-info',function(){
        $('#kt_modal_view_modal').modal('show');
        var userID = $(this).attr("data-user-id");
        var datClientID = $(this).attr("data-client-id");
        var action = ADMINURL+'/view-visit-info/'+userID + '/' + datClientID;
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $('#VisitInfoTable tbody').html(response.data);
                } else {
                    $('#VisitInfoTable tbody').html('<tr><td colspan="5" class="text-center">No records found.</td></tr>');
                } 
            },
            error: function (xhr, status, error) {
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('click','.btn-company-info',function(){
        var userID = $(this).attr("data-user-id");
        var datClientID = $(this).attr("data-client-id");
        $('#kt_modal_C_view_modal').modal('show');
        var action = ADMINURL+'/view-visit-info/'+userID + '/' + datClientID;
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if(response.status == 'success'){
                    $('#VisitInfoTable tbody').html(response.data);
                } else {
                    $('#VisitInfoTable tbody').html('<tr><td colspan="5" class="text-center">No records found.</td></tr>');
                } 
            },
            error: function (xhr, status, error) {
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('change','.roleSelect',function(){
        var encrypted_id = $(this).val();
        var action = ADMINURL+'/noticeboard/get-role-users/'+encrypted_id;
        $.ajax({
            type: "GET",
            url: action,
            dataType:"json",
            success:function(response){
                if (response.status === 'success') {
                    $('.userSelect1').empty();
                    $('.userSelect1').append('<option value="">Select User</option>');
                    $('.userSelect1').append(response.data);
                    $('.userSelect1').trigger('change');
                } else {
                    alert('Failed to fetch users.');
                }
            },
            error: function (xhr, status, error) {
                alert('Server Error: Something went wrong. Please try again.');
            }
        });
    });
    $(document).on('click','.assign-driver',function(){
        $('#kt_modal_edit_modal').modal('show');
        var encrypted_id = $(this).attr("data-id");
        $('#hidden_id').val(encrypted_id);
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
        $('#PropertyListing').DataTable().ajax.reload();
        $('#FacilityListing').DataTable().ajax.reload();
        $('#NoticeboardListing').DataTable().ajax.reload();
        $('#MOUsersListing').DataTable().ajax.reload();
        $('#NoticeboardDeatilsListing').DataTable().draw(false)
        location.reload();
    }
    $('.numericInput').on('input', function(event) {
        let inputValue = $(this).val();
        let numericValue = inputValue.replace(/\D/g, '');
        $(this).val(numericValue);
    });

    $(document).ready(function () {
        $(document).on('keyup', '.quantityInput', function () {
            const input = $(this);
            const enteredQty = parseInt(input.val());
            var productId = input.attr('data-product-id');
            const errorSpan = input.siblings('.stock-error');
            const orderStatus = input.siblings('.orderStatus');
    
            if (!enteredQty || enteredQty <= 0) {
                errorSpan.text('Please enter a valid quantity').show();
                orderStatus.hide();
                return;
            }
            console.log('product:', productId);

            if (!productId) {
                errorSpan.text('Please select product').show();
                orderStatus.hide();
                input.val('');
                return;
            }
    
            $.ajax({
                url: ADMINURL + '/check-stock/' + productId,
                type: 'GET',
                success: function (response) {
                    const availableQty = parseInt(response.available_qty);
    
                    if (enteredQty > availableQty) {
                        errorSpan.text(`Out of stock: Only ${availableQty} quantity.`).show();
                        orderStatus.hide();
                    } else {
                        errorSpan.hide();
                        orderStatus.text(`Available: Proceed with ${enteredQty} quantity.`).show();
                    }
                },
                error: function () {
                    errorSpan.text('Error checking stock.').show();
                    orderStatus.hide();
                }
            });
        });
    });
    
    
    
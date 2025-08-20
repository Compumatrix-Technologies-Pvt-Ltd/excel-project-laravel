function showToast(e, t) {
    Swal.fire({
        toast: !0,
        icon: e ? "success" : "error",
        title: t,
        animation: !1,
        position: "top-right",
        showConfirmButton: !1,
        timer: 3e3,
        timerProgressBar: !0,
        customClass: "small-toast",
        didOpen(e) {
            e.addEventListener("mouseenter", Swal.stopTimer), e.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}
$("#AddForm")
    .validator()
    .on("submit", function (e) {
        if (!e.isDefaultPrevented()) {
            $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
            let t = $(this),
                o = t.attr("action"),
                r = new FormData(t[0]);
            return (
                axios
                    .post(o, r)
                    .then(function (e) {
                        let o = e.data;
                        if (o.status == "success") {
                            $.LoadingOverlay("hide");
                            t[0].reset();
                            showToast(true, o.msg);
                            setTimeout(function () {
                                if (o.url) {
                                    window.location.href = o.url;
                                } else {
                                    window.location.reload();
                                }
                            }, 2000);
                        } else if (o.status == "error") {
                            $.LoadingOverlay("hide");
                            showToast(false, o.msg);
                        } {
                            let r = o.errors;
                            console.log(r);
                            $.each(r, function (e, t) {
                                $(".err_" + e)
                                    .closest(".form-group")
                                    .addClass("has-error has-danger"),
                                    $(".err_" + e)
                                        .text(t[0])
                                        .closest("span")
                                        .show();
                            });
                        }
                    })
                    .catch(function (e) {
                        if (($.LoadingOverlay("hide"), e.response && e.response.data && e.response.data.errors)) {
                            let t = e.response.data.errors;
                            console.log('in catch');
                            console.log(t);

                            $.each(t, function (e, t) {
                                showToast(false, t[0]);

                                $(".err_" + e)
                                    .closest(".form-group")
                                    .addClass("has-error has-danger"),
                                    $(".err_" + e)
                                        .text(t[0])
                                        .closest("span")
                                        .show();
                               
                            });
                        }
                    }),
                !1
            );
        }
    })
    $("#custForm")
    .validator()
    .on("submit", function (e) {
        if (!e.isDefaultPrevented()) {
            $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
            let t = $(this),
                o = t.attr("action"),
                r = new FormData(t[0]);
            return (
                axios
                    .post(o, r)
                    .then(function (e) {
                        let o = e.data;
                        if (o.status == "success") {
                            $.LoadingOverlay("hide");
                            t[0].reset();
                            showToast(true, o.msg);
                            $('#kt_modal_edit_variant_info_modal').modal('hide');
                            setTimeout(function () {
                                var encrypted_id = o.client_id;
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
                                            { data: 'checkbox', orderable: false, searchable: false },
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
                            }, 2000);
                        } else if (o.status == "error") {
                            $.LoadingOverlay("hide");
                            showToast(false, o.msg);
                        } {
                            let r = o.errors;
                            console.log(r);
                            $.each(r, function (e, t) {
                                $(".err_" + e)
                                    .closest(".form-group")
                                    .addClass("has-error has-danger"),
                                    $(".err_" + e)
                                        .text(t[0])
                                        .closest("span")
                                        .show();
                            });
                        }
                    })
                    .catch(function (e) {
                        if (($.LoadingOverlay("hide"), e.response && e.response.data && e.response.data.errors)) {
                            let t = e.response.data.errors;
                            console.log('in catch');
                            console.log(t);

                            $.each(t, function (e, t) {
                                showToast(false, t[0]);

                                $(".err_" + e)
                                    .closest(".form-group")
                                    .addClass("has-error has-danger"),
                                    $(".err_" + e)
                                        .text(t[0])
                                        .closest("span")
                                        .show();
                               
                            });
                        }
                    }),
                !1
            );
        }
    }),
    $("#updateForm")
        .validator()
        .on("submit", function (e) {
            if (!e.isDefaultPrevented()) {
                $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
                let t = $(this),
                    o = t.attr("action"),
                    r = new FormData(t[0]);
                return (
                    axios
                        .post(o, r)
                        .then(function (e) {
                            let o = e.data;
                            if (o.status == "success") {
                                $.LoadingOverlay("hide");
                                t[0].reset();
                                showToast(true, o.msg);
                                setTimeout(function () {
                                    if (o.url) {
                                        window.location.href = o.url;
                                    } else {
                                        window.location.reload();
                                    }
                                }, 2000);
                            } else if (o.status == "error") {
                                $.LoadingOverlay("hide");
                                showToast(false, o.msg);
                            }{
                                let r = o.errors;
                                $.each(r, function (e, t) {
                                    $(".err_" + e)
                                        .closest(".form-group")
                                        .addClass("has-error has-danger"),
                                        $(".err_" + e)
                                            .text(t[0])
                                            .closest("span")
                                            .show();
                                });
                            }
                        })
                        .catch(function (e) {
                            $.LoadingOverlay("hide");
                            let t = e.response.data.errors;
                            $.each(t, function (e, t) {
                                showToast(false, t[0]);

                                $(".err_" + e)
                                    .closest(".form-group")
                                    .addClass("has-error has-danger"),
                                    $(".err_" + e)
                                        .text(t[0])
                                        .closest("span")
                                        .show();
                            });
                        }),
                    !1
                );
            }
        }),
        $(".commonForm")
        .validator()
        .on("submit", function (e) {
            if (!e.isDefaultPrevented()) {
                $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
                let t = $(this),
                    o = t.attr("action"),
                    r = new FormData(t[0]);
                return (
                    axios
                        .post(o, r)
                        .then(function (e) {
                            let o = e.data;
                            if (o.status == "success") {
                                $.LoadingOverlay("hide");
                                t[0].reset();
                                showToast(true, o.msg);
                                setTimeout(function () {
                                    if (o.url) {
                                        window.location.href = o.url;
                                    } else {
                                        window.location.reload();
                                    }
                                }, 2000);
                            } else if (o.status == "error") {
                                $.LoadingOverlay("hide");
                                showToast(false, o.msg);
                            }{
                                let r = o.errors;
                                $.each(r, function (e, t) {
                                    $(".err_" + e)
                                        .closest(".form-group")
                                        .addClass("has-error has-danger"),
                                        $(".err_" + e)
                                            .text(t[0])
                                            .closest("span")
                                            .show();
                                });
                            }
                        })
                        .catch(function (e) {
                            $.LoadingOverlay("hide");
                            let t = e.response.data.errors;
                            $.each(t, function (e, t) {
                                showToast(false, t[0]);

                                $(".err_" + e)
                                    .closest(".form-group")
                                    .addClass("has-error has-danger"),
                                    $(".err_" + e)
                                        .text(t[0])
                                        .closest("span")
                                        .show();
                            });
                        }),
                    !1
                );
            }
        }),
        $("#AddProductForm").on("submit", function (e) {
            e.preventDefault();
            let isValid = true;
            $(".err_product_id").text("").hide();
            $(".form-group").removeClass("has-error has-danger");
            $(".productRow").each(function (index, row) {
                const $row = $(row);
                if (!$row.is(":visible")) {
                    return;
                }

                const product = $row.find(".productDropdown").val();
               // const quantity = $row.find(".quantityInput").val();
            
                if (!product) {
                    isValid = false;
                    $row.find(".err_product_id").text("Please select a product").show();
                    $row.find(".productDropdown").closest(".form-group").addClass("has-error has-danger");
                }
            
                // if (!quantity || quantity <= 0) {
                //     isValid = false;
                //     $row.find(".err_quantity").text("Enter a valid quantity").show();
                //     $row.find(".quantityInput").closest(".form-group").addClass("has-error has-danger");
                // }
            });
            if ($(".productRow").length < 1) {
                isValid = false;
                showToast(false, "Please add at least one product.");
            }
        
            if (!isValid) {
                return false;
            }
            $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
            let form = $(this);
            let url = form.attr("action");
            let formData = new FormData(this);
        
            axios.post(url, formData).then(response => {
                const res = response.data;
                $.LoadingOverlay("hide");
        
                if (res.status === "success") {
                    form[0].reset();
                    showToast(true, res.msg);
                    setTimeout(() => {
                        res.url ? window.location.href = res.url : window.location.reload();
                    }, 2000);
                } else {
                    showToast(false, res.msg);
                }
            }).catch(error => {
                $.LoadingOverlay("hide");
                if (error.response?.data?.errors) {
                    const errors = error.response.data.errors;
                    $.each(errors, (key, messages) => {
                        $(".err_" + key).text(messages[0]).show();
                        $(".err_" + key).closest(".form-group").addClass("has-error has-danger");
                    });
                }
            });
        }),
        
    $("#updateForm2")
        .validator()
        .on("submit", function (e) {
            if (!e.isDefaultPrevented()) {
                $.LoadingOverlay("show", { background: "rgba(75, 73, 172, 0)", maxSize: 40, imageColor: "#5236ff" });
                let t = $(this),
                    o = t.attr("action"),
                    r = new FormData(t[0]);
                return (
                    r.append("content", CKEDITOR.instances.content.getData()),
                    axios
                        .post(o, r)
                        .then(function (e) {
                            let o = e.data;
                            if (o.status == "success") {
                                $.LoadingOverlay("hide");
                                t[0].reset();
                                showToast(true, o.msg);
                                setTimeout(function () {
                                    if (o.url) {
                                        window.location.href = o.url;
                                    } else {
                                        window.location.reload();
                                    }
                                }, 2000);
                            } else if (o.status == "error") {
                                $.LoadingOverlay("hide");
                                showToast(false, o.msg);
                            } {
                                showToast(!1, o.msg), $.LoadingOverlay("hide");
                                let r = o.errors;
                                $.each(r, function (e, t) {
                                    $(".err_" + e)
                                        .closest(".form-group")
                                        .addClass("has-error has-danger"),
                                        $(".err_" + e)
                                            .text(t[0])
                                            .closest("span")
                                            .show();
                                });
                            }
                        })
                        .catch(function (e) {
                            $.LoadingOverlay("hide");
                            let t = e.response.data.errors;
                            $.each(t, function (e, t) {
                                $(".err_" + e)
                                    .closest(".form-group")
                                    .addClass("has-error has-danger"),
                                    $(".err_" + e)
                                        .text(t[0])
                                        .closest("span")
                                        .show();
                            });
                        }),
                    !1
                );
            }
        }),
    $(".numericInput").on("input", function (e) {
        let t = $(this).val().replace(/\D/g, "");
        $(this).val(t);
    }),
    
    $( '.numberOnly' ).keypress( function ( e ) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if ( unicode != 8 ) { 
    
            if ( unicode < 48 || unicode > 57 ){ //if not a number
                return false //disable key press
            }
        }
      });
      $(document).ready(function () {
        // Clear product error on change
        $(document).on('change', '.productDropdown', function () {
            let $row = $(this).closest('.productRow');
            if ($(this).val()) {
                $row.find('.err_product_id').text('').hide();
                $(this).closest('.form-group').removeClass('has-error has-danger');
            }
        });
    
        // Clear quantity error on input
        $(document).on('input', '.quantityInput', function () {
            let $row = $(this).closest('.productRow');
            if ($(this).val() && $(this).val() > 0) {
                $row.find('.err_quantity').text('').hide();
                $(this).closest('.form-group').removeClass('has-error has-danger');
            }
        });
    });
    

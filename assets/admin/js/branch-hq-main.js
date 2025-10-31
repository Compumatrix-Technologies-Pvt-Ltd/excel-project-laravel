$(document).ready(function () {

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let options = [];
    let currentIndex = 0;

    fetchDetails("byIn", null); // initial fetch with null to clear fields
    function loadCurrentOption() {
        const selectedType = $(".supplierDetails:checked").val();
        const selectedValue = options[currentIndex];
        // Set the select dropdown's value to selectedValue.id (to select that option)
        $("#SuppliersInput").val(selectedValue.id);
        // For display or passing, use selectedValue.id or other property directly, not re-assign `selectedValue`
        fetchDetails(selectedType, selectedValue.id);
    }

    $(".supplierDetails").change(function () {

        const selectedType = $(this).val();

        $.ajax({
            url: ADMINURL +'/branch-main/getValues',
            type: "POST",
            data: {
                type: selectedType,
            },
            success: function (response) {
                options = response;
                $("#SuppliersInput").empty();

                options.forEach(function (item, index) {
                    const selected = index === 0 ? "selected" : "";
                    $("#SuppliersInput").append(
                        `<option value="${item.id}" ${selected}>${item.label}</option>`
                    );
                });

                currentIndex = 0;

                if (options.length > 0) {
                    loadCurrentOption();
                } else {
                    $("#SuppliersInput").append(
                        "<option selected>No options found</option>"
                    );
                }
            },
            error: function (xhr, status, error) {
                if (status === 'error') {
                    showToast(false, 'Server Error (' + xhr.status + '). Please refresh the page.');
                } else {
                    alert('Server Error (' + xhr.status + '): ' + xhr.responseText);
                }
            }

        });
    });

    $("#SuppliersInput").change(function () {
        currentIndex = $("#SuppliersInput").prop("selectedIndex");
        const selectedType = $(".supplierDetails:checked").val();
        const selectedValue = $(this).val();
        fetchDetails(selectedType, selectedValue);
    });

    $("#prevBtn").click(function () {
        if (currentIndex > 0) {
            currentIndex--;
            loadCurrentOption();
        }
    });

    $("#nextBtn").click(function () {
        if (currentIndex < options.length - 1) {
            currentIndex++;
            loadCurrentOption();
        }
    });

    $("#firstBtn").click(function () {
        currentIndex = 0;
        loadCurrentOption();
    });

    $("#lastBtn").click(function () {
        currentIndex = options.length - 1;
        loadCurrentOption();
    });

    //  initial load
    $(".supplierDetails:checked").trigger("change");

    function fetchDetails(type, value) {
        var action =
            ADMINURL + "/get-supplier-details-main/" + value + "/" + type; 
        if (value) {
            $.ajax({
                type: "GET",
                url: action,
                dataType: "json",
                beforeSend: function () {
                    $.LoadingOverlay("show", {
                        background: "rgba(75, 73, 172, 0)",
                        maxSize: 40,
                        imageColor: "#5236ff",
                    });
                },
                success: function (response) {
                    $.LoadingOverlay("hide");
                    if (response.status == "success") {
                        $("#docNo").val(response.data.supplier_name);
                        $("#supName").val(response.data.supplier_name);
                        $("textarea#address").val(response.data.address1);
                        $("textarea#address2").val(response.data.address2);
                        $("#mpobLicenceNo").val(response.data.mpob_lic_no);
                        $("#mpobExpiryDate").val(response.data.mpob_exp_date);
                        $("#mspoCertNo").val(response.data.mspo_cert_no);
                        $("#mspoExpiryDate").val(response.data.mspo_exp_date);
                        $("#landSize").val(response.data.land_size);
                        $("#latitude").val(response.data.latitude);
                        $("#longitude").val(response.data.longitude);
                        $("#email").val(response.data.email);
                        $("#telNo1").val(response.data.telphone_1);
                        $("#telNo2").val(response.data.telphone_2);
                        $("#bankId").val(response.data.bank_details ? response.data.bank_details.name : '');
                        $("#bankAccountNo").val(response.data.bank_acc_no);
                        $("textarea#supplierRemark").val(response.data.remark);
                        $("#supId").val(response.data.supplier_id);


                        // Assuming `response.FFBTransaction` contains your data object
                        const FFBdata = response.FFBTransaction;

                        if (FFBdata) {

                            $("#EditTransactionBtn").attr(FFBdata.id ? 'data-fbb-id' : '', FFBdata.id);


                            $("#fbb_bill_date").val(FFBdata.bill_date);
                            $("#fbb_weight_mt").val(FFBdata.weight_mt);
                            $("#fbb_price").val(FFBdata.price);
                            $("#fbb_incentive_rate").val(
                                FFBdata.incentive_rate
                            );
                            $("#fbb_subsidy_amt").val(FFBdata.subsidy_amt);
                            $("#fbb_amt_before_ded").val(
                                FFBdata.amt_before_ded
                            );
                            $("#fbb_debit_bal_bf").val(FFBdata.debit_bal_bf);
                            $("#fbb_debit_bal_cf").val(FFBdata.debit_bal_cf);
                            $("#fbb_transport").val(FFBdata.transport);
                            $("#fbb_advance").val(FFBdata.advance);
                            $("#fbb_others").val(FFBdata.others);
                            $("#fbb_total_deductions").val(
                                FFBdata.total_deductions
                            );
                            $("#fbb_net_pay").val(FFBdata.net_pay);
                            $("#fbb_date_paid").val(FFBdata.bill_date || "");
                            $("#fbb_pay_by").val(
                                FFBdata.pay_by
                                    ? FFBdata.pay_by.toLowerCase()
                                    : "cash"
                            );
                            $("#fbb_invoice_remark").val(FFBdata.remark);
                        } else {
                            // Blank all fields if FFBTransaction is null
                            $("#fbb_bill_date").val("");
                            $("#fbb_weight_mt").val("");
                            $("#fbb_price").val("");
                            $("#fbb_incentive_rate").val("");
                            $("#fbb_subsidy_amt").val("");
                            $("#fbb_amt_before_ded").val("");
                            $("#fbb_debit_bal_bf").val("");
                            $("#fbb_debit_bal_cf").val("");
                            $("#fbb_transport").val("");
                            $("#fbb_advance").val("");
                            $("#fbb_others").val("");
                            $("#fbb_total_deductions").val("");
                            $("#fbb_net_pay").val("");
                            $("#fbb_date_paid").val("");
                            $("#fbb_pay_by").val("");
                            $("#fbb_invoice_remark").val("");
                        }
                    } else {
                        alert("Something went wrong");
                    }
                },
                error: function (xhr, status, error) {
                    $.LoadingOverlay("hide");
                    alert(
                        "Server Error: Something went wrong. Please try again."
                    );
                },
            });
        } else {
            $('input[name="supplier_name"]').val("");
            $('input[name="supplier_address"]').val("");
            $('input[name="supplier_gst"]').val("");
        }
    }

   $(document).on("click", "#EditTransactionBtn", function () {
    var fbbId = $(this).data("fbb-id");
    if (!fbbId) return;

    $.ajax({
        url: `${ADMINURL}/branch-main/get-ffb-transaction/${fbbId}`,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $.LoadingOverlay("show", {
                background: "rgba(75,73,172,0.1)",
                maxSize: 40,
                imageColor: "#5236ff",
            });
        },
        success: function (response) {
            $.LoadingOverlay("hide");
            if (response.status === "success") {
                const supplier = response.data;
                const tx = response.FFBTransaction;

                $("#EditTransactionModal").modal("show");

                // Supplier info
                $("#EditTransactionModal .supplier_name")
                    .text(`${supplier.supplier_name} (K/P: ${supplier.mpob_lic_no ?? '-'})`);

                // Transaction fields
                $("#EditTransactionModal #invoiceInput").val(tx.invoice_no);
                    if (tx.purchase_type === "credit") {
                        $("#EditTransactionModal #creditPurchase").prop("checked", true);
                    } else if (tx.purchase_type === "cash") {
                        $("#EditTransactionModal#cashPurchase").prop("checked", true);
                    }
                $("#EditTransactionModal [name='weight_mt']").val(tx.weight_mt);
                $("#EditTransactionModal [name='price']").val(tx.price);
                $("#EditTransactionModal [name='incentive_rate']").val(tx.incentive_rate);
                $("#EditTransactionModal [name='subsidy_amt']").val(tx.subsidy_amt);
                $("#EditTransactionModal [name='amt_before_ded']").val(tx.amt_before_ded);
                $("#EditTransactionModal [name='transport']").val(tx.transport);
                $("#EditTransactionModal [name='advance']").val(tx.advance);
                $("#EditTransactionModal [name='others']").val(tx.others);
                $("#EditTransactionModal [name='others_desc']").val(tx.others_desc);
                $("#EditTransactionModal [name='total_deductions']").val(tx.total_deductions);
                $("#EditTransactionModal [name='bill_date']").val(tx.bill_date);
                $("#EditTransactionModal [name='net_pay']").val(tx.net_pay);
                $("#EditTransactionModal [name='remark']").val(tx.remark ?? "");

                // Payment type
                $(`#EditTransactionModal input[name='pay_by'][value='${tx.pay_by}']`).prop("checked", true);

                // Supplier dropdown (if Select2)
                if ($("#supplierSelect").hasClass("select2-hidden-accessible")) {
                    $("#supplierSelect").val(tx.supplier_id).trigger("change.select2");
                } else {
                    $("#supplierSelect").val(tx.supplier_id);
                }

            } else {
                showToast(false, "Failed to fetch transaction details.");
            }
        },
        error: function (xhr, status, error) {
            $.LoadingOverlay("hide");
            showToast(false, `Server Error (${xhr.status}): ${xhr.responseText}`);
        }
    });
});

});

$(document).ready(function () {
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
            url: '{{ route("admin.branch.main.getValues") }}',
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
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
                        $("#bankId").val(response.data.bank_id);
                        $("#bankAccountNo").val(response.data.bank_acc_no);
                        $("textarea#supplierRemark").val(response.data.remark);
                        $("#supId").val(response.data.supplier_id);

                        // Assuming `response.FFBTransaction` contains your data object
                        const FFBdata = response.FFBTransaction;

                        if (FFBdata) {
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
                            $("#fbb_date_paid").val(FFBdata.date_paid || "");
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
});

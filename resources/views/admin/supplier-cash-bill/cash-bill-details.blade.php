<div id="cashBillDetailsContainer">
                            <div class="row mt-2">
                                <div class="col-12">
                                    <table class="table table-sm table-bordered align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:60%;">Particulars</th>
                                                <th style="width:15%;" class="text-center">Net Weight (M/Ton)</th>
                                                <th style="width:15%;" class="text-center">Price/MT (RM)</th>
                                                <th style="width:10%;" class="text-end">Amount (RM)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cbBody">
                                            <!-- Ticket line -->
                                            <tr>
                                                <td>{{ $invoice->particulars }}</td>
                                                <td class="text-center" id="netWeight">{{ number_format($invoice->weight_mt, 2) }}</td>
                                                <td class="text-center" id="priceMt">{{ number_format($invoice->price, 2) }}</td>
                                                <td class="text-end" id="amount">{{ number_format($invoice->weight_mt * $invoice->price, 2) }}</td>
                                            </tr>

                                            <!-- Subsidy line -->
                                            <tr>
                                                <td></td> <!-- empty first column -->
                                                <td class="text-end pe-3 fw-semibold">Subsidy:</td> <!-- label here, right aligned -->
                                                <td class="text-center">—</td>
                                                <td class="text-end" id="subsidy">{{ number_format($invoice->subsidy_amt, 2) }}</td>
                                            </tr>

                                            <!-- Total payable -->
                                            <tr class="table-active">
                                                <td></td> <!-- empty first column -->
                                                <td class="text-end fw-bold">Total Amount Payable:</td> <!-- label here -->
                                                <td class="text-center">RM</td>
                                                <td class="text-end fw-bold" id="totalPay">{{ number_format(($invoice->weight_mt * $invoice->price) - $invoice->subsidy_amt, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Amount in words -->
                            <div class="row">
                                <div class="col-12 small fst-italic py-2 border-bottom">
                                    Ringgit Malaysia <span id="amtWords">{{ App\Helpers\Helper::convertNumberToWords(($invoice->weight_mt * $invoice->price) - $invoice->subsidy_amt) }} Only</span>
                                </div>
                            </div>

                            <!-- Remark -->
                            <div class="row mt-2">
                                <div class="col-12">
                                    <label class="small text-muted">Remark:</label>
                                    <textarea class="form-control form-control-sm" rows="2" id="remark">{{ $invoice->remark }}</textarea>
                                </div>
                            </div>
                        </div>
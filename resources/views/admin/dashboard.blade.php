@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Dashboard </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row mb-3 pb-1">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-16 mb-1">Welcome Back, {{ auth()->user()->name }}!</h4>
                </div>

            </div>
        </div>
    </div>

    @if (Auth::user()->role == 'super-admin')
        {{-- <div class="alert alert-info" role="alert">
            You have admin access.
        </div> --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="card crm-widget">
                    <div class="card-body p-0">
                        <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">

                            <!-- Total Tenants -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Total Tenants (Companies)
                                        <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i
                                                class="ri-space-ship-line display-6 text-muted cfs-22"></i></div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-tenants"
                                                    data-target="197">0</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Subscriptions (count) -->
                            <div class="col">
                                <div class="mt-3 mt-md-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Active Subscriptions
                                        <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i
                                                class="ri-exchange-dollar-line display-6 text-muted cfs-22"></i></div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-active-subs"
                                                    data-target="489">0</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Failed Payments (rate %) -->
                            <div class="col">
                                <div class="mt-3 mt-md-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Failed Payments (This Month)
                                        <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i class="ri-pulse-line display-6 text-muted cfs-22"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-failed-rate"
                                                    data-target="32.89">0</span>%</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Users -->
                            <div class="col">
                                <div class="mt-3 mt-lg-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Total Users (HQ + Branch)
                                        <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i class="ri-team-line display-6 text-muted cfs-22"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-users"
                                                    data-target="1597">0</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Most Used Plan -->
                            <div class="col">
                                <div class="mt-3 mt-lg-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Most Used Plan
                                        <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i
                                                class="ri-service-line display-6 text-muted cfs-22"></i></div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22">
                                                <span id="kpi-top-plan-name">Pro</span> ·
                                                <span class="counter-value" id="kpi-top-plan-users"
                                                    data-target="2659">0</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end row -->

                        <!-- Add a second row for critical SaaS KPIs -->
                        <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0 border-top">
                            <!-- MRR -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">MRR (This Month)
                                        <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i
                                                class="ri-funds-box-line display-6 text-muted cfs-22"></i></div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22">RM <span class="counter-value" id="kpi-mrr"
                                                    data-target="98450">0</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ARR -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">ARR Run‑Rate
                                        <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i
                                                class="ri-bar-chart-2-line display-6 text-muted cfs-22"></i></div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22">RM <span class="counter-value" id="kpi-arr"
                                                    data-target="1181400">0</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Trial → Paid -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Trial → Paid (30d)
                                        <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i
                                                class="ri-user-follow-line display-6 text-muted cfs-22"></i></div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-trial-cv"
                                                    data-target="22.5">0</span>%</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- NRR -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">NRR (Last 3 mo)
                                        <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i
                                                class="ri-line-chart-line display-6 text-muted cfs-22"></i></div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-nrr"
                                                    data-target="104.2">0</span>%</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Past-due -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Past‑Due Subscriptions
                                        <i class="ri-alert-line text-danger fs-18 float-end align-middle"></i>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0"><i
                                                class="ri-error-warning-line display-6 text-muted cfs-22"></i></div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-pastdue"
                                                    data-target="17">0</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end second row -->

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">MRR Waterfall (stacked components + total line)</h4>
                    </div>
                    <div class="card-body">
                        <div id="mrr_waterfall" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">ARR Run‑Rate (line)</h4>
                    </div>
                    <div class="card-body">
                        <div id="arr_line" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Tenants by Status (stacked bars)</h4>
                    </div>
                    <div class="card-body">
                        <div id="tenants_status" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Churn Trends (logo % and revenue %)</h4>
                    </div>
                    <div class="card-body">
                        <div id="churn_lines" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Plan Mix by MRR</h4>
                    </div>
                    <div class="card-body">
                        <div id="plan_mix" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Upgrade Candidates Heatmap (cap utilization)</h4>
                    </div>
                    <div class="card-body">
                        <div id="upgrade_heatmap" data-colors='["--vz-success"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->role == 'hq')
        <div class="row">
            <div class="col-xl-12">
                <div class="card crm-widget">
                    <div class="card-body p-0">
                        <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                            <!-- Today's Tickets -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Today's Tickets</h5>
                                    <div class="d-flex align-items-center">
                                        <i class="ri-ticket-line display-6 text-muted cfs-22"></i>
                                        <div class="ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-today-tickets"
                                                    data-target="0">0</span></h2>
                                            <div class="text-muted">MT: <span id="kpi-today-mt">0.000</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- This Month MT -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">This Month MT</h5>
                                    <div class="d-flex align-items-center">
                                        <i class="ri-bar-chart-line display-6 text-muted cfs-22"></i>
                                        <div class="ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-month-mt"
                                                    data-target="0">0</span></h2>
                                            <div class="text-muted">Tickets: <span id="kpi-month-tickets">0</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Credit Invoices Issued -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Credit Invoices Issued</h5>
                                    <div class="d-flex align-items-center">
                                        <i class="ri-file-paper-2-line display-6 text-muted cfs-22"></i>
                                        <div class="ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-inv-count"
                                                    data-target="0">0</span></h2>
                                            <div class="text-muted">RM <span id="kpi-inv-amount">0</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Cash Purchases -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Cash Purchases</h5>
                                    <div class="d-flex align-items-center">
                                        <i class="ri-cash-line display-6 text-muted cfs-22"></i>
                                        <div class="ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" id="kpi-cash-count"
                                                    data-target="0">0</span></h2>
                                            <div class="text-muted">RM <span id="kpi-cash-amount">0</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Receivables -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Receivables (7d / Overdue)</h5>
                                    <div class="d-flex align-items-center">
                                        <i class="ri-inbox-unarchive-line display-6 text-muted cfs-22"></i>
                                        <div class="ms-3">
                                            <h2 class="mb-0 cfs-22">RM <span class="counter-value" id="kpi-due7"
                                                    data-target="0">0</span></h2>
                                            <div class="text-muted">Overdue: RM <span id="kpi-overdue">0</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Tickets MT by Day (current month)</h4>
                    </div>
                    <div class="card-body">
                        <div id="hq_tickets_by_day" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Supplier Top 10 by MT (month-to-date)</h4>
                    </div>
                    <div class="card-body">
                        <div id="hq_top_suppliers" data-colors='["--vz-success"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Mill Mix (share of MT)</h4>
                    </div>
                    <div class="card-body">
                        <div id="hq_mill_mix" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Credit vs Cash Purchases (amount by month)</h4>
                    </div>
                    <div class="card-body">
                        <div id="hq_credit_cash" data-colors='["--vz-success"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Deductions by Type (month-to-date)</h4>
                    </div>
                    <div class="card-body">
                        <div id="hq_deductions" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Average Price per MT (last 6 months)</h4>
                    </div>
                    <div class="card-body">
                        <div id="hq_price_per_mt" data-colors='["--vz-success"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->role == 'branch-user')
        <div class="row">
            <div class="col-xl-12">
                <div class="card crm-widget">
                    <div class="card-body p-0">
                        <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Today's Tickets</h5>
                                    <div class="d-flex align-items-center"><i
                                            class="ri-ticket-2-line display-6 text-muted cfs-22"></i>
                                        <h2 class="mb-0 ms-3 cfs-22"><span class="counter-value" id="kpi-tickets-today"
                                                data-target="42">0</span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Today's Weight (MT)</h5>
                                    <div class="d-flex align-items-center"><i
                                            class="ri-scales-3-line display-6 text-muted cfs-22"></i>
                                        <h2 class="mb-0 ms-3 cfs-22"><span class="counter-value" id="kpi-weight-today"
                                                data-target="126.48">0</span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Cash Bills Today</h5>
                                    <div class="d-flex align-items-center"><i
                                            class="ri-bill-line display-6 text-muted cfs-22"></i>
                                        <h2 class="mb-0 ms-3 cfs-22"><span class="counter-value" id="kpi-cashbills-today"
                                                data-target="9">0</span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Cash Paid Today (RM)</h5>
                                    <div class="d-flex align-items-center"><i
                                            class="ri-exchange-dollar-line display-6 text-muted cfs-22"></i>
                                        <h2 class="mb-0 ms-3 cfs-22">RM <span class="counter-value"
                                                id="kpi-cashpaid-today" data-target="18450">0</span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Open Period</h5>
                                    <div class="d-flex align-items-center"><i
                                            class="ri-calendar-2-line display-6 text-muted cfs-22"></i>
                                        <h2 class="mb-0 ms-3 cfs-22"><span id="kpi-period">2025‑08</span> · <span
                                                id="kpi-period-status" class="text-success">Open</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Tickets by Day (last 14 days)</h4>
                    </div>
                    <div class="card-body">
                        <div id="br_tickets_14d" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Supplier Mix (top 10 by MT, month-to-date)</h4>
                    </div>
                    <div class="card-body">
                        <div id="br_supplier_top10" data-colors='["--vz-success"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Cash Purchases — Daily Totals (current month)</h4>
                    </div>
                    <div class="card-body">
                        <div id="br_cash_daily" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Deductions Breakdown (month-to-date)</h4>
                    </div>
                    <div class="card-body">
                        <div id="br_deductions_donut" data-colors='["--vz-success"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Today’s Activity Timeline (tickets & cash bills)</h4>
                    </div>
                    <div class="card-body">
                        <div id="br_today_activity" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Ticket Quality — Avg MT per Ticket by Supplier (top 5)</h4>
                    </div>
                    <div class="card-body">
                        <div id="br_avg_mt_ticket" data-colors='["--vz-success"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <!-- apexcharts -->
    <script src="{{ asset('/assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/pages/apexcharts-column.init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>
@endsection

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
                                        <div class="flex-shrink-0"><i class="ri-service-line display-6 text-muted cfs-22"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22">
                                                <span id="kpi-top-plan-name">Pro</span> ·
                                                <span class="counter-value" id="kpi-top-plan-users" data-target="2659">0</span>
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
                                        <div class="flex-shrink-0"><i class="ri-funds-box-line display-6 text-muted cfs-22"></i>
                                        </div>
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
                        <div id="plan_mix" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]' class="apex-charts"
                            dir="ltr"></div>
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
    @if (auth()->user()->hasRole('hq'))
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
                                                    data-target="{{ $todaysTickets }}"></span></h2>
                                            <div class="text-muted">MT: <span id="kpi-today-mt">{{ $totalTodayMT }}</span></div>
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
                                                    data-target="{{ $totalWeightThisMonth }}"></span></h2>
                                            <div class="text-muted">Tickets: <span
                                                    id="kpi-month-tickets">{{ $todaysTicketsThisMonth }}</span></div>
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
                                                    data-target="{{ $totalCreditTransactions }}"></span></h2>
                                            <div class="text-muted">RM <span id="kpi-inv-amount">{{$totalCreditRM }}</span>
                                            </div>
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
                                                    data-target="{{ $totalCashTransactions }}"></span></h2>
                                            <div class="text-muted">RM <span id="kpi-cash-amount">{{ $totalCashRM }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Receivables -->
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Total Mills</h5>
                                    <div class="d-flex align-items-center">
                                        <i class="ri-building-line display-6 text-muted cfs-22"></i>
                                        <div class="ms-3">
                                            <h2 class="mb-0 cfs-22"> <span class="counter-value" id="kpi-due7"
                                                    data-target="{{ $totalMills }}"></span></h2>
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
                        <div id="hq_mill_mix" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]' class="apex-charts"
                            dir="ltr"></div>
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
                        <div id="hq_deductions" class="apex-charts" dir="ltr"></div>
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
    @if (auth()->user()->hasRole('branch'))
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
                                                data-target="{{ $todaysTickets }}"></span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Today's Weight (MT)</h5>
                                    <div class="d-flex align-items-center"><i
                                            class="ri-scales-3-line display-6 text-muted cfs-22"></i>
                                        <h2 class="mb-0 ms-3 cfs-22"><span class="counter-value" id="kpi-weight-today"
                                                data-target="{{ $totalTodayMT }}"></span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Cash Bills Today</h5>
                                    <div class="d-flex align-items-center"><i
                                            class="ri-bill-line display-6 text-muted cfs-22"></i>
                                        <h2 class="mb-0 ms-3 cfs-22"><span class="counter-value" id="kpi-cashbills-today"
                                                data-target="{{ $totalCashTransactions }}"></span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Cash Paid Today (RM)</h5>
                                    <div class="d-flex align-items-center"><i
                                            class="ri-exchange-dollar-line display-6 text-muted cfs-22"></i>
                                        <h2 class="mb-0 ms-3 cfs-22">RM <span class="counter-value" id="kpi-cashpaid-today"
                                                data-target="{{ $totalCashRM }}"></span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Open Period</h5>
                                    <div class="d-flex align-items-center"><i
                                            class="ri-calendar-2-line display-6 text-muted cfs-22"></i>
                                        <h2 class="mb-0 ms-3 cfs-22"><span
                                                id="kpi-period">{{ Session::get('yearMonth') }}</span> · <span
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

        {{-- <div class="row">
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
        </div> --}}
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
    @if(auth()->user()->hasRole('hq'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ticketsByDayData = @json($ticketsByDay);

                if (!ticketsByDayData || !ticketsByDayData.length) {
                    console.warn('No tickets data available for HQ this month.');
                    return;
                }

                const options = {
                    chart: { type: 'bar', height: 350, toolbar: { show: false } },
                    series: [{
                        name: 'Tickets (MT)',
                        data: ticketsByDayData.map(t => parseFloat(t.total_mt))
                    }],
                    xaxis: {
                        categories: ticketsByDayData.map(t => `Day ${t.day}`),
                        title: { text: 'Day of Month' }
                    },
                    yaxis: {
                        title: { text: 'Weight (MT)' },
                        labels: { formatter: v => v.toFixed(2) }
                    },
                    colors: ['#3B82F6'],
                    dataLabels: { enabled: false },
                    grid: { borderColor: '#eee' },
                    tooltip: { y: { formatter: v => v.toFixed(3) + ' MT' } }
                };

                const chart = new ApexCharts(document.querySelector('#hq_tickets_by_day'), options);
                chart.render();

            });

            document.addEventListener("DOMContentLoaded", function () {
                const suppliers = @json($supplierNames);
                const mt = @json($supplierMT);

                var options = {
                    chart: {
                        type: 'bar',
                        height: 380,
                        toolbar: { show: false }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            barHeight: '55%',
                            borderRadius: 5
                        }
                    },
                    colors: ['#22C55E'],
                    series: [{
                        name: 'MT',
                        data: mt
                    }],
                    xaxis: {
                        categories: suppliers,
                        labels: {
                            formatter: val => val.toFixed(2)
                        },
                        title: {
                            text: 'Total MT',
                            style: { fontSize: '14px', fontWeight: 600 }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: val => val.toFixed(2) + ' MT',
                        style: { fontSize: '12px' }
                    },
                    tooltip: {
                        y: {
                            formatter: val => val.toFixed(3) + ' MT'
                        }
                    }
                };

                new ApexCharts(document.querySelector("#hq_top_suppliers"), options).render();
            });
            document.addEventListener("DOMContentLoaded", function () {
                const millNames = @json($millNames);
                const millWeights = @json($millWeights);

                var options = {
                    chart: {
                        type: 'donut',
                        height: 300
                    },
                    series: millWeights,
                    labels: millNames,
                    colors: ['#3B82F6', '#A78BFA', '#22C55E', '#F59E0B', '#EF4444', '#14B8A6'],
                    dataLabels: {
                        enabled: true,
                        formatter: (val, opts) => {
                            const total = opts.w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            const value = opts.w.config.series[opts.seriesIndex];
                            const percent = ((value / total) * 100).toFixed(1);
                            return `${value.toFixed(1)} MT (${percent}%)`;
                        }
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center'
                    },
                    tooltip: {
                        y: {
                            formatter: val => `${val.toFixed(2)} MT`
                        }
                    }
                };

                new ApexCharts(document.querySelector("#hq_mill_mix"), options).render();
            });

            document.addEventListener("DOMContentLoaded", function () {
                const months = @json($months);
                const creditData = @json($credit);
                const cashData = @json($cash);

                var options = {
                    chart: {
                        type: 'bar',
                        height: 300,
                        toolbar: { show: false }
                    },
                    series: [
                        { name: 'Credit (Invoices)', data: creditData },
                        { name: 'Cash Purchases', data: cashData }
                    ],
                    colors: ['#111827', '#10B981'],
                    xaxis: {
                        categories: months,
                        title: { text: 'Month', style: { fontSize: '14px', fontWeight: 600 } }
                    },
                    yaxis: {
                        labels: { formatter: v => 'RM ' + v.toLocaleString() },
                        title: { text: 'Total Amount (RM)', style: { fontSize: '14px', fontWeight: 600 } }
                    },
                    dataLabels: { enabled: false },
                    tooltip: {
                        y: { formatter: v => 'RM ' + v.toLocaleString() }
                    },
                    legend: { position: 'top' },
                    plotOptions: {
                        bar: { columnWidth: '40%' }
                    },
                    grid: { borderColor: '#f1f1f1', strokeDashArray: 4 }
                };

                new ApexCharts(document.querySelector("#hq_credit_cash"), options).render();
            });

            document.addEventListener("DOMContentLoaded", function () {
                new ApexCharts(document.querySelector("#hq_deductions"), {
                    chart: { type: "bar", height: 280, toolbar: { show: false } },
                    series: [{
                        name: "Amount (RM)",
                        data: @json($data)
                    }],
                    xaxis: {
                        categories: @json($categories),
                        title: { text: "Deduction Type" }
                    },
                    yaxis: {
                        title: { text: "Amount (RM)" },
                        labels: { formatter: val => "RM " + val.toLocaleString() }
                    },
                    colors: ["#EF4444"],
                    dataLabels: {
                        enabled: true,
                        formatter: val => "RM " + val.toLocaleString()
                    },
                    grid: { borderColor: "#eee" }
                }).render();
            });

            document.addEventListener("DOMContentLoaded", function () {
                new ApexCharts(document.querySelector("#hq_price_per_mt"), {
                    chart: { type: "line", height: 300, toolbar: { show: false } },
                    series: [{
                        name: "RM per MT",
                        data: @json($priceData)
                    }],
                    xaxis: { categories: @json($priceMonths) },
                    colors: ["#2563EB"],
                    stroke: { width: 3, curve: "smooth" },
                    dataLabels: { enabled: false },
                    tooltip: {
                        y: { formatter: v => "RM " + v.toFixed(2) + "/MT" }
                    }
                }).render();
            });

        </script>
    @endif

    @if (auth()->user()->hasRole('branch'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var options = {
                    chart: {
                        type: 'bar',
                        height: 300,
                        toolbar: { show: false }
                    },
                    series: [{
                        name: 'Tickets',
                        data: @json($ticketData)
                    }],
                    xaxis: {
                        categories: @json($ticketDates)
                    },
                    colors: ['#3B82F6'],
                    dataLabels: { enabled: false },
                    grid: { borderColor: '#eee' }
                };

                new ApexCharts(document.querySelector('#br_tickets_14d'), options).render();
            });

            document.addEventListener("DOMContentLoaded", function () {
                var options = {
                    chart: { type: 'bar', height: 340, toolbar: { show: false } },
                    plotOptions: { bar: { columnWidth: '45%' } },
                    series: [{
                        name: 'MT',
                        data: @json($br_supplierMT ?? [])
                    }],
                    xaxis: {
                        categories: @json($br_supplierNames ?? []),
                        labels: { rotate: -25 }
                    },
                    colors: ['#6366F1'],
                    dataLabels: { enabled: false },
                    tooltip: { y: { formatter: v => v.toFixed(2) + ' MT' } }
                };

                new ApexCharts(document.querySelector('#br_supplier_top10'), options).render();
            });

            document.addEventListener("DOMContentLoaded", function () {
                var options = {
                    chart: { type: 'area', height: 300, toolbar: { show: false } },
                    series: [{
                        name: 'Cash Paid (RM)',
                        data: @json($br_cashAmounts ?? [])
                    }],
                    xaxis: {
                        categories: @json($br_cashDays ?? []),
                        title: { text: 'Day of Month' }
                    },
                    colors: ['#22C55E'],
                    stroke: { width: 2, curve: 'smooth' },
                    fill: { opacity: 0.35 },
                    tooltip: {
                        y: { formatter: v => 'RM ' + v.toLocaleString() }
                    },
                    dataLabels: { enabled: false },
                    grid: { borderColor: '#eee' }
                };

                new ApexCharts(document.querySelector('#br_cash_daily'), options).render();
            });

            document.addEventListener("DOMContentLoaded", function () {
                const dedLabels = @json($deductionLabels ?? []);
                const dedValues = @json($deductionValues ?? []);

                if (dedLabels.length && dedValues.length) {
                    var options = {
                        chart: {
                            type: 'donut',
                            height: 300,
                        },
                        series: dedValues,
                        labels: dedLabels,
                        colors: ['#F59E0B', '#3B82F6', '#EF4444'],
                        dataLabels: {
                            enabled: true,
                            formatter: val => val.toFixed(1) + '%'
                        },
                        tooltip: {
                            y: {
                                formatter: val => 'RM ' + Number(val).toLocaleString()
                            }
                        },
                        legend: {
                            position: 'bottom'
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '60%'
                                }
                            }
                        }
                    };

                    new ApexCharts(document.querySelector("#br_deductions_donut"), options).render();
                } else {
                    console.warn("No deduction data available for donut chart.");
                }
            });

        </script>
    @endif
@endsection
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('/assets/admin/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('/assets/admin/images/old/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('/assets/admin/images/users/avatar-1.jpg') }}" alt="" height="22"
                    style="border-radius: 10px;">
            </span>
            <span class="logo-lg" style="color: white;font-size: 17px;">
                <img src="{{ asset('/assets/admin/images/old/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="{{ asset('/assets/admin/images/users/avatar-1.jpg') }}"
                    alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">{{ ucfirst(Auth::user()->name) }}</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i
                            class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span
                            class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome {{ ucfirst(Auth::user()->name) }}!</h6>
            <a class="dropdown-item" href="{{ route('admin.editProfile') }}"><span
                    class="badge bg-success-subtle text-success mt-1 float-end">New</span><i
                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Settings</span></a>
            <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                    data-key="t-logout">Logout</span></a>
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">


                @if (Auth::user()->role == 'super-admin')
                    <li class="menu-title"><span data-key="t-menu" class="text-light">Super Admin Modules</span></li>
                    <li class="text-light">
                        <hr>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/plans/users') ? 'active' : '' }}"
                            href="{{ route('admin.plans.users') }}">
                            <i class="ri-user-2-fill"></i> <span data-key="t-widgets">Clients</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/plans') ? 'active' : '' }}"
                            href="{{ route('admin.plans') }}">
                            <i class="mdi mdi-clipboard-list-outline"></i> <span data-key="t-widgets">Plans</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.subscription.and.billing') }}">
                            <i class=" bx bx-dollar-circle"></i> <span data-key="t-widgets">Subscriptions & Billing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.usages.and.feature.flags') }}">
                            <i class=" bx bxs-bar-chart-alt-2"></i> <span data-key="t-widgets">Usage & Feature Flags</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {{ (request()->is('admin/emails-sms-edit/1', 'admin/emails-sms', 'admin/cms-pages', 'admin/cms-pages-edit/1')) ? ' collapsed active' : ''  }}"
                            href="#CMSPages" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="CMSPages">
                            <i class="mdi mdi-content-save-edit" aria-hidden="true"></i>
                            <span data-key="t-widgets">Global Masters & CMS</span>
                        </a>
                        <div class="collapse menu-dropdown {{ (request()->is('admin/emails-sms-edit/1', 'admin/emails-sms', 'admin/cms-pages', 'admin/cms-pages-edit/1')) ? 'show' : ''  }}"
                            id="CMSPages">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.emails.and.sms') }}"
                                        class="nav-link {{ (request()->is('admin/emails-sms', 'admin/emails-sms-edit/1')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">Email/SMS Templates</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.cms.pages') }}"
                                        class="nav-link {{ (request()->is('admin/cms-pages', 'admin/cms-pages-edit/1')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">CMS Pages</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ (request()->is('admin/roles', 'admin/audit-logs', 'admin/impersonation-console', 'admin/security-settings')) ? ' collapsed active' : ''  }}"
                            href="#SecurityAudit" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="SecurityAudit">
                            <i class="mdi mdi-security" aria-hidden="true"></i>
                            <span data-key="t-widgets">Security & Audit</span>
                        </a>
                        <div class="collapse menu-dropdown {{ (request()->is('admin/roles', 'admin/audit-logs', 'admin/impersonation-console', 'admin/security-settings')) ? 'show' : ''  }}"
                            id="SecurityAudit">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="nav-link {{ (request()->is('admin/roles')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">Admin Users & Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.audit.logs.index') }}"
                                        class="nav-link {{ (request()->is('admin/audit-logs')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">Audit Logs</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.impersonation.console.index') }}"
                                        class="nav-link {{ (request()->is('admin/impersonation-console')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">Impersonation Console</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.security.settings.index') }}"
                                        class="nav-link {{ (request()->is('admin/security-settings')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">Security Settings</a>
                                </li>
                            </ul>
                        </div>
                    </li>




                @endif

                @if (Auth::user()->role == 'hq')
                    <li class="menu-title"><span data-key="t-menu" class="text-light">HQ Modules</span></li>
                    <li class="text-light">
                        <hr>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span>
                        </a>
                    </li>
                    <!-- Consolidated FFB -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ (request()->is('admin/yearly-cash-credit', 'admin/credit/purchase', 'admin/cash/purchase', 'admin/purchase-salse')) ? ' collapsed active' : ''  }}"
                            href="#ConsolidatedFFB" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="ConsolidatedFFB">
                            <i class="mdi mdi-file-chart-outline me-2" aria-hidden="true"></i>
                            <span data-key="t-widgets">Consolidated FFB</span>

                        </a>
                        <div class="collapse menu-dropdown {{ (request()->is('admin/yearly-cash-credit', 'admin/credit/purchase', 'admin/cash/purchase', 'admin/purchase-salse')) ? 'show' : ''  }}"
                            id="ConsolidatedFFB">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.YearlyCashCredit.index') }}"
                                        class="nav-link {{ (request()->is('admin/yearly-cash-credit')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">Yearly Cash VS Credit</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.credit.purchase.index') }}"
                                        class="nav-link {{ (request()->is('admin/credit/purchase')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">Credit Prchase
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.cash.purchase.index') }}"
                                        class="nav-link {{ (request()->is('admin/cash/purchase')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">Cash Purchase</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.purchaseSalse.index') }}"
                                        class="nav-link {{ (request()->is('admin/purchase-salse')) ? 'active' : ''  }}"
                                        data-key="t-horizontal">Purchase & Salse</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <!-- Branch Management -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/branches') ? 'active' : '' }}"
                            href="{{ route('admin.branches.index') }}">
                            <i class="mdi mdi-source-fork"></i> <span data-key="t-widgets">Branch Management</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/suppliers', 'admin/suppliers/create', 'admin/suppliers-gps-list') ? ' collapsed active' : '' }}"
                            href="#SupplierManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="SupplierManagement">
                            <i class="mdi mdi-store"></i>
                            <span data-key="t-base-ui">Suppliers</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->is('admin/suppliers', 'admin/suppliers-hq', 'admin/suppliers/create', 'admin/suppliers-gps-list') ? 'show' : '' }}"
                            id="SupplierManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.suppliers.create') }}"
                                        class="nav-link {{ request()->is('admin/suppliers/create') ? 'active' : '' }}"
                                        data-key="t-horizontal">Create Suppliers</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.suppliers.index') }}"
                                        class="nav-link {{ request()->is('admin/suppliers') ? 'active' : '' }}"
                                        data-key="t-horizontal">Manage Suppliers</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.suppliersGps.index') }}"
                                        class="nav-link {{ request()->is('admin/suppliers-gps-list') ? 'active' : '' }}"
                                        data-key="t-horizontal">Suppliers GPS Listing</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->is('admin/suppliers-hq') ? 'active' : '' }}"
                                href="{{ route('admin.suppliersHq.index') }}">
                                <i class="mdi mdi mdi-store"></i> <span data-key="t-widgets">Suppliers</span>
                            </a>
                        </li> -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/mill-management') ? 'active' : '' }}"
                            href="{{ route('admin.mill.management') }}">
                            <i class="mdi mdi-factory"></i> <span data-key="t-widgets">Mill Management</span>
                        </a>
                    </li>

                    <!-- Transaction Management -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/transaction-management') ? 'active' : '' }}"
                            href="{{ route('admin.transaction.management') }}">
                            <i class="mdi mdi-cash-sync"></i> <span data-key="t-widgets">Transaction</span>
                        </a>
                    </li>

                    <!-- Main -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/hq-main') ? 'active' : '' }}"
                            href="{{ route('admin.hqMainForm.index') }}">
                            <i class="mdi mdi-form-select"></i> <span data-key="t-widgets">Main</span>
                        </a>
                    </li>

                    <!-- User Management -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/users', 'admin/users/*') ? ' collapsed active' : '' }}"
                            href="#UserManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="UserManagement">
                            <i class="mdi mdi-account-group"></i> <span data-key="t-base-ui">User
                                Management</span>

                        </a>
                        <div class="collapse menu-dropdown {{ request()->is('admin/users', 'admin/users/*') ? 'show' : '' }}"
                            id="UserManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.create') }}"
                                        class="nav-link {{ request()->is('admin/users', 'admin/users/create', 'admin/users/*') ? 'active' : '' }}"
                                        data-key="t-horizontal">Create Users</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}"
                                        data-key="t-horizontal">Manage Users</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/suppliers', 'admin/suppliers/create', 'admin/suppliers-gps-list') ? ' collapsed active' : '' }}"
                            href="#SuppliesManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="SuppliesManagement">
                            <i class="mdi mdi-store"></i>

                            <span data-key="t-base-ui">Supplies</span>

                        </a>
                        <div class="collapse menu-dropdown {{ request()->is('admin/supplies-details', 'admin/supplies-summary') ? 'show' : '' }}"
                            id="SuppliesManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.supplies.details.index') }}"
                                        class="nav-link {{ request()->is('admin/supplies-details') ? 'active' : '' }}"
                                        data-key="t-horizontal">Supplies Details</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.supplies.summary.index') }}"
                                        class="nav-link {{ request()->is('admin/supplies-summary') ? 'active' : '' }}"
                                        data-key="t-horizontal">Supplies Summary</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Analysis Management -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/supplies-analysis') ? 'active' : '' }}"
                            href="{{ route('admin.supplies.analysis.index') }}">
                            <i class="mdi mdi-magnify me-2"></i> <span data-key="t-widgets">Analysis</span>
                        </a>
                    </li>

                @endif

                @if (Auth::user()->role == 'branch-user')
                    <li class="menu-title"><span data-key="t-menu" class="text-light">Branch Modules</span></li>
                    <li class="text-light">
                        <hr>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/branches') ? 'active' : '' }}"
                            href="{{ route('admin.mainForm.index') }}">
                            <i class="mdi mdi-source-fork"></i> <span data-key="t-widgets">Master Module</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/suppliers', 'admin/suppliers/create', 'admin/suppliers-gps-list') ? ' collapsed active' : '' }}"
                            href="#SupplierManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="SupplierManagement">
                            <i class="mdi mdi-store"></i>
                            <span data-key="t-base-ui">Suppliers</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->is('admin/suppliers', 'admin/suppliers-hq', 'admin/suppliers/create', 'admin/suppliers-gps-list') ? 'show' : '' }}"
                            id="SupplierManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.suppliers.create') }}"
                                        class="nav-link {{ request()->is('admin/suppliers/create') ? 'active' : '' }}"
                                        data-key="t-horizontal">Create Suppliers</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.suppliers.index') }}"
                                        class="nav-link {{ request()->is('admin/suppliers') ? 'active' : '' }}"
                                        data-key="t-horizontal">Manage Suppliers</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.suppliersGps.index') }}"
                                        class="nav-link {{ request()->is('admin/suppliers-gps-list') ? 'active' : '' }}"
                                        data-key="t-horizontal">Suppliers GPS Listing</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Daily Credit Transactions -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/transactions') ? 'active' : '' }}"
                            href="{{ route('admin.transactions.index') }}">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span data-key="t-base-ui">DailyCrTrx</span>
                        </a>
                    </li>

                    <!-- Deductions -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/deductions', 'admin/deductions/*', 'admin/deduction-reports', 'admin/deduction-reports/*') ? ' collapsed active' : '' }}"
                            href="#Deductions" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="Deductions">
                            <i class="mdi mdi-bank-minus me-2"></i> <span data-key="t-widgets">Deductions</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->is('admin/deductions', 'admin/deduction-reports') ? 'show' : '' }}"
                            id="Deductions">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.deductions.index') }}"
                                        class="nav-link {{ request()->is('admin/deductions') ? 'active' : '' }}"
                                        data-key="t-horizontal">Deduction Listing</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.deductions.report.index') }}"
                                        class="nav-link {{ request()->is('admin/deduction-reports') ? 'active' : '' }}"
                                        data-key="t-horizontal">Deduction Reports</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <!-- Sales Invoice -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/sales-invoice') ? 'active' : '' }}"
                            href="{{ route('admin.sales.invoice') }}">
                            <i class="ri-bill-line"></i> <span data-key="t-widgets">Sales Invoice</span>
                        </a>
                    </li>

                    <!-- Credit Purchases -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/credit-purchases') ? 'active' : '' }}"
                            href="{{ route('admin.creditPurchase.index') }}">
                            <i class="mdi mdi-credit-card-outline"></i> <span data-key="t-widgets">Credit Purchases</span>
                        </a>
                    </li>

                    <!-- Bank Management -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/banks') ? 'active' : '' }}"
                            href="{{ route('admin.banks.index') }}">
                            <i class="mdi mdi-bank"></i> <span data-key="t-widgets">Bank Management</span>
                        </a>
                    </li>

                    <!-- Payments -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/payments') ? 'active' : '' }}"
                            href="{{ route('admin.payments.index') }}">
                            <i class=" bx bx-money-withdraw"></i> <span data-key="t-widgets">Payments Listing</span>
                        </a>
                    </li>

                    <!-- Cash Purchases -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/cash-purchase-list', 'admin/cash-purchase-summary', 'admin/daily-cash-purchase-summary') ? ' collapsed active' : '' }}"
                            href="#CashPurchasesManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="CashPurchasesManagement">
                            <i class="mdi mdi mdi-bank-plus"></i>
                            <span data-key="t-base-ui">Cash Purchases</span>

                        </a>
                        <div class="collapse menu-dropdown {{ request()->is('admin/cash-purchase-list', 'admin/cash-purchase-summary', 'admin/daily-cash-purchase-summary') ? 'show' : '' }}"
                            id="CashPurchasesManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.cash.purchase.list') }}"
                                        class="nav-link {{ request()->is('admin/cash-purchase-list') ? 'active' : '' }}"
                                        data-key="t-horizontal">Purchase Listing</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.cash.purchase.summary') }}"
                                        class="nav-link {{ request()->is('admin/cash-purchase-summary') ? 'active' : '' }}"
                                        data-key="t-horizontal">Purchase Summary</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.daily.cash.purchase.summary') }}"
                                        class="nav-link {{ request()->is('admin/daily-cash-purchase-summary') ? 'active' : '' }}"
                                        data-key="t-horizontal">Daily Purchase Summary</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Suplier Cash Bill -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/supplier-cash-bill') ? 'active' : '' }}"
                            href="{{ route('admin.supplier.cash.bill') }}">
                            <i class=" las la-file-invoice-dollar"></i> <span data-key="t-widgets">SCB</span>
                        </a>
                    </li>

                    <!-- Analysis Management -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('admin/purchase-analysis', 'admin/credit-purchase-analysis', 'admin/supplies-analysis') ? ' collapsed active' : '' }}"
                            href="#AnalysisManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="AnalysisManagement">
                            <i class="mdi mdi-magnify me-2" aria-hidden="true"></i>
                            <span data-key="t-widgets">Analysis</span>

                        </a>
                        <div class="collapse menu-dropdown {{ request()->is('admin/purchase-analysis', 'admin/credit-purchase-analysis', 'admin/supplies-analysis') ? 'show' : '' }}"
                            id="AnalysisManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.purchaseAnalysis.index') }}"
                                        class="nav-link {{ request()->is('admin/purchase-analysis') ? 'active' : '' }}"
                                        data-key="t-horizontal">Purchase Analysis</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.creditPurchaseAnalysis.index') }}"
                                        class="nav-link {{ request()->is('admin/ccredit-purchase-analysis') ? 'active' : '' }}"
                                        data-key="t-horizontal">Credit Purchase Analysis</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif


            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
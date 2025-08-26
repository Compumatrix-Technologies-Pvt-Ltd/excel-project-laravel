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
                <img class="rounded header-profile-user" src="{{asset('/assets/admin/images/users/avatar-1.jpg') }}"
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
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/user-noticeboard') ? 'active' : '' }}" href="">
                        <i class="mdi mdi-bell-ring-outline"></i> <span data-key="t-widgets">Noticeboard</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('admin/users', 'admin/users/*')) ? ' collapsed active' : ''  }}"
                        href="#UserManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="UserManagement">
                        <i class="mdi mdi-account-group"></i> <span data-key="t-base-ui">User
                            Management</span>

                    </a>
                    <div class="collapse menu-dropdown {{ (request()->is('admin/users', 'admin/users/*')) ? 'show' : ''  }}"
                        id="UserManagement">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.create') }}"
                                    class="nav-link {{ (request()->is('admin/users', 'admin/users/create', 'admin/users/*')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">Create Users</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="nav-link {{ (request()->is('admin/users')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">Manage Users</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href=""
                                    class="nav-link {{ (request()->is('admin/assign-branches')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">Branch Assignment</a>
                            </li> -->

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/branches') ? 'active' : '' }}"
                        href="{{ route('admin.branches.index') }}">
                        <i class="mdi mdi-source-fork"></i> <span data-key="t-widgets">Branch Management</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('admin/suppliers', 'admin/suppliers/*')) ? ' collapsed active' : ''  }}"
                        href="#SupplierManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="SupplierManagement">
                        <i class="mdi mdi-store"></i>

                        <span data-key="t-base-ui">Supplier
                            Management</span>

                    </a>
                    <div class="collapse menu-dropdown {{ (request()->is('admin/suppliers', 'admin/suppliers/*')) ? 'show' : ''  }}"
                        id="SupplierManagement">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.suppliers.create') }}"
                                    class="nav-link {{ (request()->is('admin/suppliers', 'admin/suppliers/create', 'admin/suppliers/*')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">Create Suppliers</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.suppliers.index') }}"
                                    class="nav-link {{ (request()->is('admin/suppliers')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">Manage Suppliers</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('admin/transactions', 'admin/transactions/*','admin/hq-transactions')) ? ' collapsed active' : ''  }}"
                        href="#TransactionManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="TransactionManagement">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span data-key="t-base-ui">Transactions</span>

                    </a>
                    <div class="collapse menu-dropdown {{ (request()->is('admin/transactions', 'admin/transactions/*','admin/hq-transactions')) ? 'show' : ''  }}"
                        id="TransactionManagement">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.transactions.index') }}"
                                    class="nav-link {{ (request()->is('admin/transactions', 'admin/create-transactions', 'admin/transactions/*')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">Daily Transactions</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hq.transactions.index') }}"
                                    class="nav-link {{ (request()->is('admin/hq-transactions')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">HQ - Transactions</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/banks') ? 'active' : '' }}"
                        href="{{ route('admin.banks.index') }}">
                        <i class="mdi mdi-bank"></i> <span data-key="t-widgets">Bank Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/banks') ? 'active' : '' }}"
                        href="{{ route('admin.deductions.index') }}">
                        <i class="mdi mdi-bank"></i> <span data-key="t-widgets">Deductions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/payments') ? 'active' : '' }}"
                        href="{{ route('admin.payments.index') }}">
                        <i class=" bx bx-money-withdraw"></i> <span data-key="t-widgets">Payments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/mill-management') ? 'active' : '' }}"
                        href="{{ route('admin.mill.management') }}">
                        <i class=" bx bx-money-withdraw"></i> <span data-key="t-widgets">Mill Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('admin/cash-purchase-list', 'admin/cash-purchase-summary','admin/daily-cash-purchase-summary')) ? ' collapsed active' : ''  }}"
                        href="#CashPurchasesManagement" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="CashPurchasesManagement">
                        <i class="mdi mdi mdi-bank-plus"></i>
                        <span data-key="t-base-ui">Cash Purchases</span>

                    </a>
                    <div class="collapse menu-dropdown {{ (request()->is('admin/cash-purchase-list', 'admin/cash-purchase-summary','admin/daily-cash-purchase-summary')) ? 'show' : ''  }}"
                        id="CashPurchasesManagement">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.cash.purchase.list') }}"
                                    class="nav-link {{ (request()->is('admin/cash-purchase-list')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">Purchase Listing</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.cash.purchase.summary') }}"
                                    class="nav-link {{ (request()->is('admin/cash-purchase-summary')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">Purchase Summary</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.daily.cash.purchase.summary') }}"
                                    class="nav-link {{ (request()->is('admin/daily-cash-purchase-summary')) ? 'active' : ''  }}"
                                    data-key="t-horizontal">Daily Purchase Summary</a>
                            </li>

                        </ul>
                    </div>
                </li>
                

            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
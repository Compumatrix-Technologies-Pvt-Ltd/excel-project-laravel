<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Landing | Excel Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ asset('/assets/admin/images/favicon.ico') }}">
    <link href="{{ asset('/assets/admin/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/assets/admin/js/layout.js') }}"></script>
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/admin/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>


<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing navbar-light fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{route('/')}}">
                    <img src="{{ asset('/assets/admin/images/old/logo-dark.png') }}" class="card-logo card-logo-dark"
                        alt="logo dark" height="17">
                    <img src="{{ asset('/assets/admin/images/old/logo-light.png') }}" class="card-logo card-logo-light"
                        alt="logo light" height="17">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link active" href="#hero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#plans">Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#faq">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                    <div class="">
                        <a href="{{route('admin.login')}}" class="btn btn-soft-primary"><i
                                class="ri-user-3-line align-bottom me-1"></i> Login &amp; Register</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->

        <!-- start hero section -->
        <section class="section nft-hero" id="hero">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-10">
                        <div class="text-center">
                            <h3 class="display-6 fw-medium mb-4 lh-base text-white">Streamline FFB Purchases, Invoicing,
                                and Supplier Payments</h3>
                            <p class="lead text-white-50 lh-base mb-4 pb-2">A secure, multi-tenant SaaS for estates,
                                mills, and dealers—replace spreadsheets with real-time transactions, deductions,
                                invoices, and bank-ready payment exports.</p>

                            <div class="hstack gap-2 justify-content-center">
                                <a href="" class="btn btn-primary">Start Free Trial <i
                                        class="ri-arrow-right-line align-middle ms-1"></i></a>
                                <a href="" class="btn btn-danger">Book a Demo <i
                                        class="ri-arrow-right-line align-middle ms-1"></i></a>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end hero section -->

        <!-- start wallet -->
        <section class="section bg-light" id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h2 class="mb-3 fw-bold lh-base">About us</h2>
                            <p class="text-muted">A non-fungible token is a non-interchangeable unit of data stored on a
                                blockchain, a form of digital ledger, that can be sold and traded.</p>
                        </div>
                    </div><!-- end col -->
                </div>
                <div class="row align-items-center gy-4">
                    <div class="col-lg-6 col-sm-7 mx-auto">
                        <div>
                            <img src="{{ asset('/assets/admin/images/invoice-billing-information-form-graphic-concept.jpg') }}"
                                alt="" class="img-fluid mx-auto">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-muted">

                            <h3 class="mb-3 fs-20">Huge collection of widgets</h3>
                            <p class="mb-4 fs-16">Vc Majumas Sdn. Bhd. is a company based in Malaysia, with its head
                                office in Sandakan. The enterprise operates in the Farm Product Raw Material Merchant
                                Wholesalers industry. The company was established on March 18, 2013. Its total assets
                                decreased by 24.65% over the same period. The net profit margin of Vc Majumas Sdn. Bhd.
                                decreased by 0.62% in 2023.</p>
                            <div class="row text-center gy-4">
                                <div class="col-lg-3 col-6">
                                    <div>
                                        <h4 class="mb-2"><span class="counter-value" data-target="100">0</span>+</h4>
                                        <p class="text-muted">Projects Completed</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div>
                                        <h4 class="mb-2"><span class="counter-value" data-target="24">0</span></h4>
                                        <p class="text-muted">Win Awards</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div>
                                        <h4 class="mb-2"><span class="counter-value" data-target="20.3">0</span>k</h4>
                                        <p class="text-muted">Satisfied Clients
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
    </div>
    <!-- end container -->
    </section>
    <!-- end wallet -->

    <section class="section " id="features" style="background-color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h2 class="mb-3 fw-semibold lh-base">Features Overview</h2>
                        <p class="text-muted">The process of creating an NFT may cost less than a dollar, but the
                            process of selling it can cost up to a thousand dollars. For example, Allen Gannett, a
                            software developer.</p>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-lg-3">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <img src="{{ asset('/assets/admin/images/nft/supplier.png') }}" alt="" class="avatar-sm">
                            <h5 class="mt-4">Supplier Management</h5>
                            <p class="text-muted fs-14">Licensing (MPOB/MSPO), banking details, subsidy rates, land
                                size, and contact info.</p>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <img src="{{ asset('/assets/admin/images/nft/money.png') }}" alt="" class="avatar-sm">
                            <h5 class="mt-4">Daily Transactions</h5>
                            <p class="text-muted fs-14">Ticket No., date, supplier, weight (MT), branch—import or enter
                                manually.</p>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <img src="{{ asset('/assets/admin/images/nft/credit.png') }}" alt="" class="avatar-sm">
                            <h5 class="mt-4">Credit & Cash Purchases</h5>
                            <p class="text-muted fs-14">Price/MT, incentives, subsidies, debit/credit balances, and net
                                pay.</p>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <img src="{{ asset('/assets/admin/images/nft/deductions.png') }}" alt="" class="avatar-sm">
                            <h5 class="mt-4">Deductions</h5>
                            <p class="text-muted fs-14">Transport, advances, and others—applied with remarks and
                                approval controls.</p>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
            <div class="row">
                <div class="col-lg-3">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <img src="{{ asset('/assets/admin/images/nft/documents.png') }}" alt="" class="avatar-sm">
                            <h5 class="mt-4">Documents & Exports</h5>
                            <p class="text-muted fs-14">Supplier invoices, cash bills, payment vouchers, deduction
                                lists, credit/cash summaries, and “Via Bank” files.</p>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <img src="{{ asset('/assets/admin/images/nft/analytics.png') }}" alt="" class="avatar-sm">
                            <h5 class="mt-4">Analytics</h5>
                            <p class="text-muted fs-14">Credit vs cash comparisons, supplier summaries, branch period
                                dashboards.</p>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <img src="{{ asset('/assets/admin/images/nft/security.png') }}" alt="" class="avatar-sm">
                            <h5 class="mt-4">Security</h5>
                            <p class="text-muted fs-14">Tenant isolation, role-based access (Super Admin, HQ, Branch),
                                activity logs.</p>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <img src="{{ asset('/assets/admin/images/nft/sell.png') }}" alt="" class="avatar-sm">
                            <h5 class="mt-4">SaaS Billing</h5>
                            <p class="text-muted fs-14">Subscription plans with user/branch limits, monthly/annual
                                billing, trial options.</p>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!-- end container -->
    </section><!-- end features -->


    <!-- start plan -->
    <section class="section" id="plans">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h3 class="mb-3 fw-semibold">Choose the plan that's right for you</h3>
                        <p class="text-muted mb-4">Simple pricing. No hidden fees. Advanced features for you business.
                        </p>

                        <div class="d-flex justify-content-center align-items-center">
                            <div>
                                <h5 class="fs-14 mb-0">Month</h5>
                            </div>
                            <div class="form-check form-switch fs-20 ms-3 " onclick="check() ">
                                <input class="form-check-input" type="checkbox" id="plan-switch">
                                <label class="form-check-label" for="plan-switch"></label>
                            </div>
                            <div>
                                <h5 class="fs-14 mb-0">Annual <span class="badge bg-success-subtle text-success">Save
                                        20%</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="card plan-box mb-0">
                        <div class="card-body p-4 m-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1 fw-semibold">Plan A</h5>
                                    <p class="text-muted mb-0">For Startup</p>
                                </div>
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                        <i class="ri-book-mark-line fs-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4 text-center">
                                <h1 class="month"><sup><small>RM</small></sup><span
                                        class="ff-secondary fw-bold">19</span> <span
                                        class="fs-13 text-muted">/Month</span></h1>
                                <h1 class="annual"><sup><small>RM</small></sup><span
                                        class="ff-secondary fw-bold">171</span> <span
                                        class="fs-13 text-muted">/Year</span></h1>
                            </div>

                            <div>
                                <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>1</b> HQ user + <b>1</b> Branch user
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                Unlimited suppliers, standard reports, PDF export
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                Email support
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-danger me-1">
                                                <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>24/7</b> Support
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-danger me-1">
                                                <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>Unlimited</b> Storage
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-danger me-1">
                                                <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                Domain
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-4">
                                    <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-4">
                    <div class="card plan-box mb-0 ribbon-box right">
                        <div class="card-body p-4 m-2">
                            <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1 fw-semibold">Pro Business</h5>
                                    <p class="text-muted mb-0">Professional plans</p>
                                </div>
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                        <i class="ri-medal-fill fs-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4 text-center">
                                <h1 class="month"><sup><small>RM</small></sup><span
                                        class="ff-secondary fw-bold">29</span> <span
                                        class="fs-13 text-muted">/Month</span></h1>
                                <h1 class="annual"><sup><small>RM</small></sup><span
                                        class="ff-secondary fw-bold">261</span> <span
                                        class="fs-13 text-muted">/Year</span></h1>
                            </div>

                            <div>
                                <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>2</b> HQ users + <b>2</b> Branch users
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                Everything in A, plus advanced analytics and API access
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>24/7</b> Support
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>24/7</b> Support
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-danger me-1">
                                                <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>Unlimited</b> Storage
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-danger me-1">
                                                <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                Domain
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-4">
                                    <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-4">
                    <div class="card plan-box mb-0">
                        <div class="card-body p-4 m-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1 fw-semibold">Platinum Plan</h5>
                                    <p class="text-muted mb-0">Enterprise Businesses</p>
                                </div>
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                        <i class="ri-stack-fill fs-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4 text-center">
                                <h1 class="month"><sup><small>RM</small></sup><span
                                        class="ff-secondary fw-bold">39</span> <span
                                        class="fs-13 text-muted">/Month</span></h1>
                                <h1 class="annual"><sup><small>RM</small></sup><span
                                        class="ff-secondary fw-bold">351</span> <span
                                        class="fs-13 text-muted">/Year</span></h1>
                            </div>

                            <div>
                                <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>2</b> HQ users + <b>2</b> Branch users
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                Everything in A, plus advanced analytics and API access
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>Unlimited</b> FTP Login
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>24/7</b> Support
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <b>Unlimited</b> Storage
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 text-success me-1">
                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                Domain
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-4">
                                    <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!-- end container -->
    </section>
    <!-- end plan -->

    <!-- start faqs -->
    <section class="section " id="faq" style="background-color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h3 class="mb-3 fw-semibold">Frequently Asked Questions</h3>
                        <p class="text-muted mb-4 ff-secondary">If you can not find answer to your question in our FAQ,
                            you can always contact us or email us. We will answer you shortly!</p>

                        <div class="hstack gap-2 justify-content-center">
                            <button type="button" class="btn btn-primary btn-label rounded-pill"><i
                                    class="ri-mail-line label-icon align-middle rounded-pill fs-16 me-2"></i> Email
                                Us</button>
                            <button type="button" class="btn btn-info btn-label rounded-pill"><i
                                    class="ri-twitter-line label-icon align-middle rounded-pill fs-16 me-2"></i> Send Us
                                Tweet</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row g-lg-5 g-4">
                <div class="col-lg-12">

                    <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                        id="genques-accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="genques-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#genques-collapseOne" aria-expanded="true"
                                    aria-controls="genques-collapseOne">
                                    Can we import our current Excel data?
                                </button>
                            </h2>
                            <div id="genques-collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="genques-headingOne" data-bs-parent="#genques-accordion">
                                <div class="accordion-body ff-secondary">
                                    Yes. We provide guided import for suppliers, daily transactions, purchases, and
                                    deductions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="genques-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#genques-collapseTwo" aria-expanded="false"
                                    aria-controls="genques-collapseTwo">
                                    Does the system support bank transfer exports ?
                                </button>
                            </h2>
                            <div id="genques-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="genques-headingTwo" data-bs-parent="#genques-accordion">
                                <div class="accordion-body ff-secondary">
                                    Yes. Generate “Via Bank” lists and payment vouchers.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="genques-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#genques-collapseThree" aria-expanded="false"
                                    aria-controls="genques-collapseThree">
                                    Can we customize invoice numbers?
                                </button>
                            </h2>
                            <div id="genques-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="genques-headingThree" data-bs-parent="#genques-accordion">
                                <div class="accordion-body ff-secondary">
                                    Yes. You can customize invoice numbers by enabling the appropriate settings in the
                                    theme options.
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end accordion-->

                </div>

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end faqs -->

    <!-- start contact -->
    <section class="section bg-light" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h3 class="mb-3 fw-semibold">Get In Touch</h3>
                        <p class="text-muted mb-4 ff-secondary">We thrive when coming up with innovative ideas but also
                            understand that a smart concept should be supported with faucibus sapien odio measurable
                            results.</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row gy-4">
                <div class="col-lg-4">
                    <div>
                        <div class="mt-4">
                            <h5 class="fs-13 text-muted text-uppercase">Headquarters</h5>
                            <div class="ff-secondary fw-semibold">Lot 80-2F, Block 6, Prima Square Sandakan; Sabah;
                                Postal Code: 90000</div>
                        </div>
                        <div class="mt-4">
                            <h5 class="fs-13 text-muted text-uppercase">Office Address 2:</h5>
                            <div class="ff-secondary fw-semibold">2467 Swick Hill Street <br />New Orleans, LA</div>
                        </div>
                        <div class="mt-4">
                            <h5 class="fs-13 text-muted text-uppercase">Working Hours:</h5>
                            <div class="ff-secondary fw-semibold">9:00am to 6:00pm</div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-8">
                    <div>
                        <form id="AddForm" action="{{ route('contacts.store') }}" method="post" class="form"
                            autocomplete="off" role="form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="name" class="form-label fs-13">Name</label>
                                        <input name="name" id="name" type="text" class="form-control"
                                            placeholder="Your name*">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="email" class="form-label fs-13">Email</label>
                                        <input name="email" id="email" type="email" class="form-control"
                                            placeholder="Your email*">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="subject" class="form-label fs-13">Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject"
                                            placeholder="Your Subject.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="comments" class="form-label fs-13">Message</label>
                                        <textarea name="message" id="message" rows="3" class="form-control"
                                            placeholder="Your message..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-end">
                                    <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary"
                                        value="Send Message">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end contact -->

    <!-- Start footer -->
    <footer class="custom-footer bg-dark py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div>
                        <div>
                            <img src="{{ asset('/assets/admin/images/old/logo-light.png') }}" alt="logo light"
                                height="17">
                        </div>
                        <div class="mt-4 fs-13">
                            <p>Premium Multipurpose Admin & Dashboard Template</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 ms-lg-auto">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5 class="text-white mb-0">Pages</h5>
                            <div class="text-muted mt-3">
                                <ul class="list-unstyled ff-secondary footer-list">
                                    <li><a href="{{route('privacy.policy')}}">Privacy Policy</a></li>
                                    <li><a href=" {{route('terms.conditions')}}">Terms & conditions</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Add this column to occupy the empty space -->
                        <div class="col-sm-8 mt-4 justify-content-sm-end">
                            <div class="store-badges scale-85 d-flex gap-3 ">
                                <a href="https://apps.apple.com/app/idXXXXXXXXX" class="store-btn store-apple"
                                    aria-label="Download on the App Store">
                                    <span class="store-icon"><i class="ri-apple-fill"></i></span>
                                    <span class="store-text">App Store</span>
                                </a>
                                <a href="https://play.google.com/store/apps/details?id=com.yourapp"
                                    class="store-btn store-google" aria-label="Get it on Google Play">
                                    <span class="store-icon"><i class="ri-android-fill"></i></span>
                                    <span class="store-text">Play Store</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row text-center text-sm-start align-items-center">
                <div class="col-sm-6">
                    <div>
                        <p class="copy-rights mb-0">
                            <script> document.write(new Date().getFullYear()) </script>Compumatrix Technologies Pvt Ltd
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end mt-3 mt-sm-0">
                        <ul class="list-inline mb-0 footer-social-link">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-facebook-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-github-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-linkedin-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-google-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-dribbble-line"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->


    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->
    </div>
    <script src="{{ asset('/assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/libs/node-waves/waves.min.js') }}"></script>
    <script src=" {{ asset('/assets/admin/libs/feather-icons/feather.min.js') }}"></script>
    < script src="{{ asset('/assets/admin/js/pages/plugins/lord-icon-2.1.0.js') }}">
    </script>
        <script src="{{ asset('/assets/admin/js/plugins.js') }}"></script>
        <script src=" {{ asset('/assets/admin/libs/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/js/pages/nft-landing.init.js') }}"></script>
        <script>
            function check() {
                var n = document.getElementById("plan-switch"),
                    e = document.getElementsByClassName("month"),
                    t = document.getElementsByClassName("annual"),
                    o = 0;
                Array.from(e).forEach(function (e) {
                    1 == n.checked ? (t[o].style.display = "block", e.style.display = "none") : 0 == n.checked && (t[o].style.display = "none", e.style.display = "block"), o++
                })
            }
            check();
        </script>
</body>

</html>

@section('scripts')
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>

@endsection
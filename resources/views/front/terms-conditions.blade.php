<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Landing | Velzon - Admin & Dashboard Template</title>
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
                    <img src="{{ asset('/assets/admin/images/logo-dark.png') }}" class="card-logo card-logo-dark"
                        alt="logo dark" height="17">
                    <img src="{{ asset('/assets/admin/images/new-logo.png') }}" class="card-logo card-logo-light"
                        alt="logo light" height="17 ">
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
                        <a href="{{route('admin.login')}}" class="btn btn-soft-primary"><i class="ri-user-3-line align-bottom me-1"></i> Login &amp; Register</a>
                    </div>
                </div>


            </div>
        </nav>
        <div class="bg-overlay bg-overlay-pattern"></div>
        <section class="section nft-hero" id="hero">
                    <div class="bg-overlay"></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-10">
                                <div class="text-center">
                                    <h1 class="display-4 fw-medium mb-4 lh-base text-white">Terms And Conditions</h1>
                                    <p class="mb-0 text-muted">Last update: 16 Sept, 2022</p>
                                  
                                </div>
                            </div><!--end col-->
                        </div><!-- end row -->
                    </div><!-- end container -->
        </section><!-- end hero section -->
        <!-- Begin page -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                    <div class="card-body p-4">
                        <div class="d-flex">
                            
                            <div class="flex-grow-1">
                                <h5>Privacy Policy for velzon</h5>
                                <p class="text-muted">At Website Name, accessible at Website.com, one of our main
                                    priorities is the privacy of our visitors. This Privacy Policy document contains
                                    types of information that is collected and recorded by Website Name and how we use
                                    it.</p>
                                <p class="text-muted">If you have additional questions or require more information
                                    about our Privacy Policy, do not hesitate to contact us through email at
                                    Email@Website.com</p>
                                <p class="text-muted">This privacy policy applies only to our online activities and is
                                    valid for visitors to our website with regards to the information that they shared
                                    and/or collect in Website Name. This policy is not applicable to any information
                                    collected offline or via channels other than this website.</p>
                                <p class="text-muted">How we use your information:</p>
                                <ul class="text-muted">
                                    <li>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the
                                            majority have suffered alteration in some form, by injected humour, or
                                            randomised words which don't look even slightly believable.</p>
                                    </li>
                                    <li>
                                        <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there
                                            isn't anything embarrassing hidden in the middle of text. All the Lorem
                                            Ipsum generators on the Internet tend to repeat predefined chunks as
                                            necessary, making this the first true generator on the Internet.</p>
                                    </li>
                                    <li>
                                        <p>On the other hand, we denounce with righteous indignation and dislike men who
                                            are so beguiled and demoralized by the charms of pleasure of the moment.</p>
                                    </li>
                                    <li>
                                        <p>It uses a dictionary of over 200 Latin words, combined with a handful of
                                            model sentence structures, to generate Lorem Ipsum which looks reasonable.
                                            The generated Lorem Ipsum is therefore always free from repetition, injected
                                            humour, or non-characteristic words etc.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-check-circle text-success icon-dual-success icon-xs">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <div class="flex-grow-1">
                                <h5>How we use your information</h5>
                                <p class="text-muted">If you contact us directly, we may receive additional information
                                    about you such as your name, email address, phone number, the contents of the
                                    message and/or attachments you may send us, and any other information you may choose
                                    to provide.</p>
                                <p class="text-muted">Communicate with you, either directly or through one of our
                                    partners, including for customer service, to provide you with updates and other
                                    information relating to the website, and for marketing and promotional purposes.</p>
                                <p class="text-muted">When you register for an Account, we may ask for your contact
                                    information, including items such as name, company name, address, email address, and
                                    telephone number.</p>
                                <p class="text-muted">We use the information we collect in various ways, including to:
                                </p>
                                <ul class="text-muted vstack gap-2">
                                    <li>
                                        Provide, operate, and maintain our website
                                    </li>
                                    <li>
                                        Improve, personalize, and expand our website
                                    </li>
                                    <li>
                                        Understand and analyze how you use our website
                                    </li>
                                    <li>
                                        Develop new products, services, features, and functionality
                                    </li>
                                    <li>
                                        Send you emails
                                    </li>
                                    <li>
                                        Find and prevent fraud
                                    </li>
                                </ul>
                                <p class="text-muted">Like any other website, Website Name uses ‘cookies'. These
                                    cookies are used to store information including visitors' preferences, and the pages
                                    on the website that the visitor accessed or visited. The information is used to
                                    optimize the users' experience by customizing our web page content based on
                                    visitors' browser type and/or other information.</p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-check-circle text-success icon-dual-success icon-xs">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted">Some of advertisers on our site may use cookies and web beacons.
                                    Our advertising partners are listed below. Each of our advertising partners has
                                    their own Privacy Policy for their policies on user data. For easier access, we
                                    hyperlinked to their Privacy Policies below.</p>
                                <p class="text-muted"><b>Website Name's Privacy Policy does not apply to other
                                        advertisers or websites. Thus, we are advising you to consult the respective
                                        Privacy Policies of these third-party ad servers for more detailed information.
                                        It may include their practices and instructions about how to opt-out of certain
                                        options. You may find a complete list of these Privacy Policies and their links
                                        here: Privacy Policy Links.</b></p>
                            </div>
                        </div>


                        <div class="text-end">
                            <a href="#!" class="btn btn-danger">I'm Understand</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div>
                            <div>
                                <img src="{{ asset('/assets/admin/images/new-logo.png') }}" alt="logo light" height="17">
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
                                        <li><a href="{{route('terms.conditions')}}">Terms & conditions</a></li>
                                    </ul>
                                </div>
                            </div>
                        <!-- Add this column to occupy the empty space -->
                            <div class="col-sm-8 mt-4 justify-content-sm-end">
                                <div class="store-badges scale-85 d-flex gap-3 ">
                                    <a href="https://apps.apple.com/app/idXXXXXXXXX" class="store-btn store-apple" aria-label="Download on the App Store">
                                    <span class="store-icon"><i class="ri-apple-fill"></i></span>
                                    <span class="store-text">App Store</span>
                                    </a>
                                    <a href="https://play.google.com/store/apps/details?id=com.yourapp" class="store-btn store-google" aria-label="Get it on Google Play">
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
        <script src="{{ asset('/assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ asset('/assets/admin/js/plugins.js') }}"></script>
        <script src="{{ asset('/assets/admin/libs/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/js/pages/nft-landing.init.js') }}"></script>
        <script>
            function check() {
                var n = document.getElementById("plan-switch"),
                    e = document.getElementsByClassName("month"),
                    t = document.getElementsByClassName("annual"),
                    o = 0;
                Array.from(e).forEach(function(e) {
                    1 == n.checked ? (t[o].style.display = "block", e.style.display = "none") : 0 == n.checked && (t[o]
                        .style.display = "none", e.style.display = "block"), o++
                })
            }
            check();
        </script>
</body>

</html>

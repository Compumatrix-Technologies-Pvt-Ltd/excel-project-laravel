@section('title')
    {{ $moduleAction }}
@endsection
@include('layouts.admin.header')
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="{{route('/')}}" class="d-block">
                                                <img src="{{ asset('/assets/admin/images/old/logo-light.png') }}" alt=""
                                                    height="17">
                                            </a>
                                        </div>
                                        <div class="mt-auto">
                                            <div class="mb-3">
                                                <i class="ri-double-quotes-l display-4 text-success"></i>
                                            </div>

                                            <div id="qoutescarouselIndicators" class="carousel slide"
                                                data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                        data-bs-slide-to="0" class="active" aria-current="true"
                                                        aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>
                                                <div class="carousel-inner text-center text-white pb-5">
                                                    <div class="carousel-item active">
                                                        <p class="fs-15 fst-italic">" Great! Clean code, clean design,
                                                            easy for customization. Thanks very much! "</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" The theme is really great with an
                                                            amazing customer support."</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" Great! Clean code, clean design,
                                                            easy for customization. Thanks very much! "</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end carousel -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Create Account</h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <form action="#" class="form-steps" autocomplete="off">
                                            <div class="text-center pt-3 pb-4 mb-1 d-flex justify-content-center">
                                                <img src="{{ asset('/assets/admin/images/old/logo-dark.png') }}"
                                                    class="card-logo card-logo-dark" alt="logo dark" height="17">
                                                <img src="{{ asset('/assets/admin/images/old/logo-light.png') }}"
                                                    class="card-logo card-logo-light" alt="logo light" height="17">
                                            </div>

                                            <div class="step-arrow-nav mb-4">
                                                <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link done" id="steparrow-gen-info-tab"
                                                            data-bs-toggle="pill" data-bs-target="#steparrow-gen-info"
                                                            type="button" role="tab" aria-controls="steparrow-gen-info"
                                                            aria-selected="true">User Info</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active"
                                                            id="steparrow-description-info-tab" data-bs-toggle="pill"
                                                            data-bs-target="#steparrow-description-info" type="button"
                                                            role="tab" aria-controls="steparrow-description-info"
                                                            aria-selected="false">Company Profile</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="steparrow-payment-info-tab"
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#steparrow-payment-info" type="button"
                                                            role="tab" aria-controls="steparrow-payment-info"
                                                            aria-selected="false">Payment</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="pills-experience-tab"
                                                            data-bs-toggle="pill" data-bs-target="#pills-experience"
                                                            type="button" role="tab" aria-controls="pills-experience"
                                                            aria-selected="false">Finish</button>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="tab-content">
                                                <!-- User Info -->
                                                <div class="tab-pane fade" id="steparrow-gen-info" role="tabpanel"
                                                    aria-labelledby="steparrow-gen-info-tab">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="steparrow-gen-info-username-input">User
                                                                    Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="steparrow-gen-info-username-input"
                                                                    placeholder="Enter user name" required>
                                                                <div class="invalid-feedback">Please enter a user name
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="steparrow-gen-info-email-input">Email</label>
                                                                <input type="email" class="form-control"
                                                                    id="steparrow-gen-info-email-input"
                                                                    placeholder="Enter email" required>
                                                                <div class="invalid-feedback">Please enter an email
                                                                    address</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="steparrow-gen-info-password-input">Password</label>
                                                        <input type="password" class="form-control"
                                                            id="steparrow-gen-info-password-input"
                                                            placeholder="Enter password" required>
                                                        <div class="invalid-feedback">Please enter a password</div>
                                                    </div>
                                                    <div>
                                                        <label class="form-label"
                                                            for="steparrow-gen-info-confirm-password-input">Confirm
                                                            Password</label>
                                                        <input type="password" class="form-control"
                                                            id="steparrow-gen-info-confirm-password-input"
                                                            placeholder="Enter confirm password" required>
                                                        <div class="invalid-feedback">Please enter a confirm password
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-start gap-3 mt-4">
                                                        <button type="button"
                                                            class="btn btn-success btn-label right ms-auto nexttab"
                                                            data-nexttab="steparrow-description-info-tab">
                                                            <i
                                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                            Go to more info
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- end User Info -->

                                                <!-- Company Profile -->
                                                <div class="tab-pane fade show active" id="steparrow-description-info"
                                                    role="tabpanel" aria-labelledby="steparrow-description-info-tab">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Company Name</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter company name" required>
                                                                <div class="invalid-feedback">Please enter a company
                                                                    name</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Registration No</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter registration no" required>
                                                                <div class="invalid-feedback">Please enter a
                                                                    registration no</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Registered Address</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter registered address" required>
                                                                <div class="invalid-feedback">Please enter a registered
                                                                    address</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tax ID</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter tax ID" required>
                                                                <div class="invalid-feedback">Please enter a tax ID
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Logo</label>
                                                        <input class="form-control" type="file" id="formFile" />
                                                    </div>
                                                    <div>
                                                        <label class="form-label"
                                                            for="des-info-description-input">Description</label>
                                                        <textarea class="form-control" placeholder="Enter Description"
                                                            id="des-info-description-input" rows="3"
                                                            required></textarea>
                                                        <div class="invalid-feedback">Please enter a description</div>
                                                    </div>
                                                    <div class="d-flex align-items-start gap-3 mt-4">
                                                        <button type="button" class="btn btn-light btn-label previestab"
                                                            data-previous="steparrow-gen-info-tab">
                                                            <i
                                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                            Back to General
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-success btn-label right ms-auto nexttab"
                                                            data-nexttab="steparrow-payment-info-tab">
                                                            <i
                                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                            Go to Payment
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- end Company Profile -->

                                                <!-- Payment -->
                                                <div class="tab-pane fade" id="steparrow-payment-info" role="tabpanel"
                                                    aria-labelledby="steparrow-payment-info-tab">
                                                    <div>
                                                        <h5>Payment</h5>
                                                        <p class="text-muted">Fill all information below</p>
                                                    </div>
                                                    <div class="my-3">
                                                        <div class="form-check form-check-inline">
                                                            <input id="credit" name="paymentMethod" type="radio"
                                                                class="form-check-input" checked required>
                                                            <label class="form-check-label" for="credit">Credit
                                                                card</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input id="debit" name="paymentMethod" type="radio"
                                                                class="form-check-input" required>
                                                            <label class="form-check-label" for="debit">Debit
                                                                card</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input id="paypal" name="paymentMethod" type="radio"
                                                                class="form-check-input" required>
                                                            <label class="form-check-label" for="paypal">PayPal</label>
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-12">
                                                            <label for="cc-name" class="form-label">Name on card</label>
                                                            <input type="text" class="form-control" id="cc-name"
                                                                required>
                                                            <small class="text-muted">Full name as displayed on
                                                                card</small>
                                                            <div class="invalid-feedback">Name on card is required</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="cc-number" class="form-label">Credit card
                                                                number</label>
                                                            <input type="text" class="form-control" id="cc-number"
                                                                required>
                                                            <div class="invalid-feedback">Credit card number is required
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="cc-expiration"
                                                                class="form-label">Expiration</label>
                                                            <input type="text" class="form-control" id="cc-expiration"
                                                                required>
                                                            <div class="invalid-feedback">Expiration date required</div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="cc-cvv" class="form-label">CVV</label>
                                                            <input type="text" class="form-control" id="cc-cvv"
                                                                required>
                                                            <div class="invalid-feedback">Security code required</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-start gap-3 mt-4">
                                                        <button type="button" class="btn btn-light btn-label previestab"
                                                            data-previous="steparrow-description-info-tab">
                                                            <i
                                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                            Back to Company Profile
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-success btn-label right ms-auto nexttab"
                                                            data-nexttab="pills-experience-tab">
                                                            <i
                                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- end Payment -->

                                                <!-- Finish -->
                                                <div class="tab-pane fade" id="pills-experience" role="tabpanel">
                                                    <div class="text-center">
                                                        <div class="avatar-md mt-5 mb-4 mx-auto">
                                                            <div
                                                                class="avatar-title bg-light text-success display-4 rounded-circle">
                                                                <i class="ri-checkbox-circle-fill"></i>
                                                            </div>
                                                        </div>
                                                        <h5>Well Done !</h5>
                                                        <p class="text-muted">You have Successfully Signed Up</p>
                                                    </div>
                                                </div>
                                                <!-- end Finish -->
                                            </div>
                                            <!-- end tab-content -->
                                        </form>
                                    </div>

                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">{{ config('constants.FOOTER_COPYRIGHT') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>

@section('login-script')
    <script src="{{ asset('/assets/admin//js/pages/password-addon.init.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/auth/login.js') }}"></script>
@endsection
@include('layouts.admin.js-files')
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
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div class="mb-4">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-muted text-center mx-lg-3">
                                        <h4 class="">Verify Your Email</h4>
                                        <p>Please enter the 4 digit code sent to <span
                                                class="fw-semibold">{{ $user->email }}</span></p>
                                    </div>
                                    <div class="mt-4">
                                        <form autocomplete="off" id="AddForm" role="form" method="post"
                                            action="{{ route('verify.otp', ['id' => base64_encode(base64_encode($user->id))]) }}">
                                            @csrf
                                            <div class="row">
                                                <!-- Digit 1 Input -->
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit1-input" class="visually-hidden">Digit
                                                            1</label>
                                                        <input type="text" name="otp[]"
                                                            class="form-control form-control-lg bg-light border-light text-center"
                                                            onkeyup="moveToNext(1, event)" maxlength="1"
                                                            id="digit1-input" required>
                                                    </div>
                                                </div>

                                                <!-- Digit 2 Input -->
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit2-input" class="visually-hidden">Digit
                                                            2</label>
                                                        <input type="text" name="otp[]"
                                                            class="form-control form-control-lg bg-light border-light text-center"
                                                            onkeyup="moveToNext(2, event)" maxlength="1"
                                                            id="digit2-input" required>
                                                    </div>
                                                </div>

                                                <!-- Digit 3 Input -->
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit3-input" class="visually-hidden">Digit
                                                            3</label>
                                                        <input type="text" name="otp[]"
                                                            class="form-control form-control-lg bg-light border-light text-center"
                                                            onkeyup="moveToNext(3, event)" maxlength="1"
                                                            id="digit3-input" required>
                                                    </div>
                                                </div>

                                                <!-- Digit 4 Input -->
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit4-input" class="visually-hidden">Digit
                                                            4</label>
                                                        <input type="text" name="otp[]"
                                                            class="form-control form-control-lg bg-light border-light text-center"
                                                            onkeyup="moveToNext(4, event)" maxlength="1"
                                                            id="digit4-input" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-success w-100">Confirm</button>
                                            </div>
                                        </form>
                                    </div>


                                    <div class="mt-5 text-center form-groups">
                                        <p class="mb-0">Didn't receive a code?
                                        <form class="commonForm"
                                            action="{{ route('resend.otp', ['id' => base64_encode(base64_encode($user->id))]) }}"
                                            method="POST" novalidate="novalidate">
                                            @csrf
                                            <button type="submit"
                                                class="fw-semibold text-primary text-decoration-underline btn btn-link p-0">Resend</button>
                                        </form>
                                        </p>
                                    </div>


                                </div>
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
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>

    <script>
        function moveToNext(current, event) {
            if (event.keyCode === 8 || event.keyCode === 46) {
                if (current > 1) {
                    document.getElementById('digit' + (current - 1) + '-input').focus();
                }
            } else if (event.keyCode >= 48 && event.keyCode <= 57) {
                if (current < 4) {
                    document.getElementById('digit' + (current + 1) + '-input').focus();
                }
            }
        }

    </script>
@endsection
@include('layouts.admin.js-files')
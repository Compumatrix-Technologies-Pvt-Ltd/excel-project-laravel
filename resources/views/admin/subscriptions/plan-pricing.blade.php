@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Subscription Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Subscription Management</a></li>
                        <li class="breadcrumb-item active"><a href="">Pricing</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">



        {{--<div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card pricing-box">
                            <div class="card-body p-4 m-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fw-semibold">Basic Plan</h5>
                                        <p class="text-muted mb-0">For Startup</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                            <i class="ri-book-mark-line fs-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <h2><sup><small>$</small></sup>19 <span class="fs-13 text-muted">/Month</span></h2>
                                </div>
                                <hr class="my-4 text-muted">
                                <div>
                                    <ul class="list-unstyled text-muted vstack gap-3">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Upto <b>3</b> Projects
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Upto <b>299</b> Customers
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Scalable Bandwidth
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>5</b> FTP Login
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
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-success w-100 waves-effect waves-light">Sign up free</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card pricing-box ribbon-box right">
                            <div class="card-body p-4 m-2">
                                <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fw-semibold">Pro Business</h5>
                                            <p class="text-muted mb-0">Professional plans</p>
                                        </div>
                                        <div class="avatar-sm">
                                            <div class="avatar-title bg-light rounded-circle text-primary">
                                                <i class="ri-medal-line fs-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-4">
                                        <h2><sup><small>$</small></sup> 29<span class="fs-13 text-muted">/Month</span></h2>
                                    </div>
                                </div>
                                <hr class="my-4 text-muted">
                                <div>
                                    <ul class="list-unstyled vstack gap-3 text-muted">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Upto <b>15</b> Projects
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> Customers
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Scalable Bandwidth
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>12</b> FTP Login
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
                                        <a href="javascript:void(0);"
                                            class="btn btn-success w-100 waves-effect waves-light">Get started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card pricing-box">
                            <div class="card-body p-4 m-2">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fw-semibold">Platinum Plan</h5>
                                            <p class="text-muted mb-0">Enterprise Businesses</p>
                                        </div>
                                        <div class="avatar-sm">
                                            <div class="avatar-title bg-light rounded-circle text-primary">
                                                <i class="ri-stack-line fs-20"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-4">
                                        <h2><sup><small>$</small></sup> 39<span class="fs-13 text-muted">/Month</span></h2>
                                    </div>
                                </div>
                                <hr class="my-4 text-muted">
                                <div>
                                    <ul class="list-unstyled vstack gap-3 text-muted">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> Projects
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> Customers
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Scalable Bandwidth
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
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-success w-100 waves-effect waves-light">Get started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end col-->
        </div> --}}
        <!--end row-->

        <section class="section" id="plans">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-semibold">Choose the plan that's right for you</h3>
                            <p class="text-muted mb-4">Simple pricing. No hidden fees. Advanced features for your business.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="row">
                            @foreach ($plans as $plan)
                                <div class="col-lg-4">
                                    <div class="card pricing-box">
                                        <div class="card-body p-4 m-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1 fw-semibold">{{ $plan->plan_name }}</h5>
                                                    <p class="text-muted mb-0">{{ $plan->plan_sub_title }}</p>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="{{ $plan->icon ?? 'ri-book-mark-line' }} fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2>
                                                    <sup><small>RM</small></sup>
                                                    {{ number_format($plan->plan_price, 2) }}
                                                    <span class="fs-13 text-muted">/{{ ucfirst($plan->plan_duration) }}</span>
                                                </h2>
                                            </div>

                                            <hr class="my-4 text-muted">

                                            <div>
                                                <ul class="list-unstyled vstack gap-3 text-muted">
                                                    @foreach ($plan->features as $feature)
                                                        <li>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 text-success me-1">
                                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                                </div>
                                                                <div class="flex-grow-1">{{ $feature->features }}</div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <div class="mt-4">
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-soft-success w-100 waves-effect waves-light purchase-plan"
                                                        data-plan-id="{{ $plan->id }}">
                                                        Get Started
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--end row-->
                    </div>
                    <!--end col-->
                </div>
            </div>
        </section>



    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).on('click', '.purchase-plan', function () {
            let planId = $(this).data('plan-id');

            Swal.fire({
                title: "Do you want to purchase this plan?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, purchase it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.subscriptions.store') }}",
                        type: "POST",
                        data: {
                            plan_id: planId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    location.reload(); // optional: reload page or redirect
                                });
                            } else {
                                Swal.fire("Oops!", response.message, "error");
                            }
                        },
                        error: function (xhr) {
                            Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                        }
                    });
                }
            });
        });
    </script>
@endsection
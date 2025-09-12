@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Settings </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Prodile </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ asset('/assets/admin/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{ asset('/assets/admin/images/avatar.png') }}"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow"
                                alt="user-profile-image">

                        </div>
                        <h5 class="fs-16 mb-1">{{ ucfirst(Auth::user()->name) }}</h5>
                        <p class="text-muted mb-0">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i> Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#companyDetails" role="tab">
                                <i class="fas fa-home"></i> Company Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i> Change Password
                            </a>
                        </li>
                        @if (Auth::user()->role == 'mo')
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#moprofile" role="tab">
                                    <i class="far fa-user"></i> MO Profile
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{ route('admin.profile.update', [base64_encode(base64_encode($profile->id))]) }}"
                                method="PUT" autocomplete="off" id="updateForm" data-toggle="validator">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label"> Name</label>
                                            <input type="text" class="form-control" id="firstnameInput" name="name"
                                                required data-error="Please enter name." placeholder="Enter your name"
                                                value="{{ $profile->name }}">
                                            <input type="hidden" name="h_user_id"
                                                value="{{ base64_encode(base64_encode($profile->id)) }}">
                                            <span class="help-block with-errors">
                                                <ul class="list-unstyled">
                                                    <li class="err_name"></li>
                                                </ul>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <div class="mb-3">
                                            <label for="phonenumberInput" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phonenumberInput"
                                                name="mobile_number" placeholder="Enter your phone number" required
                                                data-error="Please enter phone number."
                                                value="{{ $profile->mobile_number }}" maxlength="16">
                                            <span class="help-block with-errors">
                                                <ul class="list-unstyled">
                                                    <li class="err_mobile_number"></li>
                                                </ul>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="emailInput"
                                                placeholder="Enter your email" value="{{ $profile->email }}"
                                                data-error="Please enter email."
                                                pattern='([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}'
                                                data-pattern-error="Email format is invalid." autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Updates</button>
                                            <button type="button" class="btn btn-soft-success">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="companyDetails" role="tabpanel">
                            <form
                                action="{{ route('admin.company.update', [base64_encode(base64_encode($profile->id))]) }}"
                                method="PUT" autocomplete="off" class="commonForm" data-toggle="validator">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <div class="mb-3">
                                            <label for="companyNameInput" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" id="companyNameInput"
                                                name="name" placeholder="Enter company name"
                                                value="{{ $profile->company->name ?? '' }}" required>
                                            <div class="invalid-feedback">Please enter a company name</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <div class="mb-3">
                                            <label for="companyCodeInput" class="form-label">Company Code</label>
                                            <input type="text" class="form-control" id="companyCodeInput"
                                                name="code" placeholder="Enter company code"
                                                value="{{ $profile->company->code ?? '' }}" required>
                                            <div class="invalid-feedback">Please enter a company code</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <div class="mb-3">
                                            <label for="registrationNoInput" class="form-label">Registration No</label>
                                            <input type="text" class="form-control" id="registrationNoInput"
                                                name="registration_no" placeholder="Enter registration no"
                                                value="{{ $profile->company->registration_no ?? '' }}" required>
                                            <div class="invalid-feedback">Please enter a registration no</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-group">
                                        <div class="mb-3">
                                            <label for="registeredAddressInput" class="form-label">Registered
                                                Address</label>
                                            <input type="text" class="form-control" id="registeredAddressInput"
                                                name="address" placeholder="Enter registered address"
                                                value="{{ $profile->company->address ?? '' }}" required>
                                            <div class="invalid-feedback">Please enter a registered address</div>
                                        </div>
                                    </div>

                                   
                                    <div class="col-lg-12 form-group">
                                        <div class="mb-3">
                                            <label for="logoInput" class="form-label">Logo</label>
                                            <input class="form-control" type="file" id="logoInput" name="logo" accept="image/*" />
                                            @if (!empty($profile->company->logo))
                                                <img src="{{ asset('storage/app/company-logos/' . $profile->company->logo) }}"
                                                    alt="Company Logo" class="img-thumbnail mt-2"
                                                    style="max-height:100px;">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="descriptionInput" class="form-label">Description</label>
                                            <textarea class="form-control" id="descriptionInput" name="description" placeholder="Enter Description"
                                                rows="3" required>{{ $profile->company->description ?? '' }}</textarea>
                                            <div class="invalid-feedback">Please enter a description</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Updates</button>
                                            <button type="button" class="btn btn-soft-success">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form
                                action="{{ route('admin.storeUpdatePassword', [base64_encode(base64_encode($profile->id))]) }}"
                                id="AddForm" method="PUT" data-toggle="validator" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="row g-2">
                                    <div class="col-lg-4 form-group">
                                        <div>
                                            <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                            <input type="password" name="current_password" class="form-control" required
                                                id="oldpasswordInput" placeholder="Enter current password"
                                                data-error="Please enter current password.">
                                            <input type="hidden" name="h_id" id=""
                                                value="{{ base64_encode(base64_encode($profile->id)) }}">
                                            <span class="help-block with-errors">
                                                <ul class="list-unstyled">
                                                    <li class="err_current_password"></li>
                                                </ul>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                            <input type="password" name="new_password" class="form-control"
                                                id="newpasswordInput" placeholder="Enter new password" required
                                                data-error="Please enter new password.">
                                            <span class="help-block with-errors">
                                                <ul class="list-unstyled">
                                                    <li class="err_new_password"></li>
                                                </ul>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                            <input type="password" name="confirm_password" class="form-control"
                                                id="confirmpasswordInput" placeholder="Confirm password" required
                                                data-error="Please enter confirm password.">
                                            <span class="help-block with-errors">
                                                <ul class="list-unstyled">
                                                    <li class="err_confirm_password"></li>
                                                </ul>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Change Password</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if (Auth::user()->role == 'mo')
                            <div class="tab-pane" id="moprofile" role="tabpanel">
                                <form action="{{ route('update.mo-profile', [base64_encode(base64_encode($Data->id))]) }}"
                                    method="post" autocomplete="off" class="commonForm" data-toggle="validator"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-lg-6 form-group">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">Company Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" maxlength="150" class="form-control"
                                                    id="firstnameInput" name="c_name" required
                                                    data-error="Please enter company name."
                                                    placeholder="Enter your company name" value="{{ $Data->c_name }}">
                                                <span class="help-block with-errors">
                                                    <ul class="list-unstyled">
                                                        <li class="err_c_name"></li>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <div class="mb-3">
                                                <label for="CompanyRegistrationNumberInput" class="form-label">Company
                                                    Registration Number</label>
                                                <input type="text" class="form-control"
                                                    id="CompanyRegistrationNumberInput" name="c_register_no"
                                                    placeholder="Enter your registration number" required
                                                    data-error="Please enter registration number."
                                                    value="{{ $Data->c_register_no }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Phone Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control numberOnly" maxlength="11"
                                                    id="phonenumberInput" name="c_contact_no"
                                                    placeholder="Enter your phone number" required
                                                    data-error="Please enter phone number."
                                                    value="{{ $Data->c_contact_no }}">
                                                <span class="help-block with-errors">
                                                    <ul class="list-unstyled">
                                                        <li class="err_c_contact_no"></li>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label"> Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="c_email"
                                                    id="emailInput" placeholder="Enter your email" maxlength="150"
                                                    value="{{ $Data->c_email }}" data-error="Please enter email."
                                                    pattern='([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}'
                                                    data-pattern-error="Email format is invalid." autocomplete="off"
                                                    required>
                                            </div>
                                            <span class="help-block with-errors">
                                                <ul class="list-unstyled">
                                                    <li class="err_c_email"></li>
                                                </ul>
                                            </span>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="addressInput" class="form-label"> Address <span
                                                        class="text-danger">*</span></label>
                                                <textarea required data-error="Please enter address" placeholder="Enter your address" name="c_address"
                                                    id="addressInput" cols="4" class="form-control" rows="5">{{ $Data->c_address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6 form-group">
                                            <div class="mb-3">
                                                <label for="companyLogoinput" class="form-label">Company Logo <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" name="c_logo" class="form-control"
                                                    accept="image/jpeg, image/png, image/jpg"
                                                    @if (!isset($Data->c_logo) && $Data->c_logo == '') {{ 'required' }} @endif
                                                    data-error="Please select image." id="companyLogoinput">
                                                <input type="hidden" name="old_c_logo" value="{{ $Data->c_logo }}">
                                                @if (isset($Data->c_logo) && !empty($Data->c_logo) && Storage::exists('logo-images/' . $Data->c_logo))
                                                    <div>
                                                        <img src= "{{ url('storage/app/logo-images/' . $Data->c_logo) }}"
                                                            style="width: 100px;height: 100px;border-radius: 50%;border: 2px solid #3699ff;" />
                                                    </div>
                                                @endif
                                                <span class="help-block with-errors">
                                                    <ul class="list-unstyled">
                                                        <li class="err_company_logo"></li>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-soft-success">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
@endsection

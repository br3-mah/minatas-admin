<div class="page-content">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Borrowers</h4>

                <div class="page-title-right">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('borrowers') }}">Borrowers</a></li>
                        <li class="breadcrumb-item active">Edit Borrower</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="container-fluid">
        <div class="pb-5 card">
            <form method="POST" action="{{ route('update-user') }}"  class="needs-validation" validate enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-validation">
                                        <div class="row">
                                            <div class="col-md-12 row">
                                                <!-- Primary Photo -->
                                                <div class="col-4">
                                                    <div class="p-3 border-2 border-dashed rounded-md shadow-xs border-slate-200/60 dark:border-darkmode-400">
                                                        <div id="primary-image-preview-container"></div>
                                                        <div class="relative mx-auto cursor-pointer">
                                                            <button type="button" class="btn btn-square btn-primary" onclick="document.getElementById('primary_image').click();">+ Primary Photo</button>
                                                            <input type="file" id="primary_image" name="primary_image_path" class="top-0 left-0 w-full h-full" onchange="previewImages(event, 'primary-image-preview-container')" style="display: none;">
                                                        </div>
                                                        <small>
                                                            @if ($errors->has('primary_image_path'))
                                                                <span class="text-left text-danger">{{ $errors->first('primary_image_path') }}</span>
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>

                                                <!-- Secondary Photo -->
                                                <div class="col-4">
                                                    <div class="p-3 border-2 border-dashed rounded-md shadow-xs border-slate-200/60 dark:border-darkmode-400">
                                                        <div id="secondary-image-preview-container"></div>
                                                        <div class="relative mx-auto cursor-pointer">
                                                            <button type="button" class="btn btn-square btn-primary" onclick="document.getElementById('secondary_image').click();">+ Secondary Photo</button>
                                                            <input type="file" id="secondary_image" name="secondary_image_path" class="top-0 left-0 w-full h-full" onchange="previewImages(event, 'secondary-image-preview-container')" style="display: none;">
                                                        </div>
                                                        <small>
                                                            @if ($errors->has('secondary_image_path'))
                                                                <span class="text-left text-danger">{{ $errors->first('secondary_image_path') }}</span>
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>

                                                <!-- Tertiary Photo -->
                                                <div class="col-4">
                                                    <div class="p-3 border-2 border-dashed rounded-md shadow-xs border-slate-200/60 dark:border-darkmode-400">
                                                        <div id="tertiary-image-preview-container"></div>
                                                        <div class="relative mx-auto cursor-pointer">
                                                            <button type="button" class="btn btn-square btn-primary" onclick="document.getElementById('tertiary_image').click();">+ Tertiary Photo</button>
                                                            <input type="file" id="tertiary_image" name="tertiary_image_path" class="top-0 left-0 w-full h-full" onchange="previewImages(event, 'tertiary-image-preview-container')" style="display: none;">
                                                        </div>
                                                        <small>
                                                            @if ($errors->has('tertiary_image_path'))
                                                                <span class="text-left text-danger">{{ $errors->first('tertiary_image_path') }}</span>
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                                <script>
                                                    function previewImages(event, previewContainerId) {
                                                        let files = event.target.files;
                                                        let previewContainer = document.getElementById(previewContainerId);
                                                        previewContainer.innerHTML = ''; // Clear existing previews

                                                        for (let i = 0; i < files.length; i++) {
                                                            let file = files[i];
                                                            let reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                let imageElement = document.createElement('div');
                                                                imageElement.className = 'col-12 mb-3';
                                                                imageElement.innerHTML = `
                                                                    <div class="image-fit position-relative" style="background-image: url('${e.target.result}'); background-size: cover; background-position: center; height: 150px; border-radius: 5px;">
                                                                    </div>
                                                                `;
                                                                previewContainer.appendChild(imageElement);
                                                            };

                                                            reader.readAsDataURL(file);
                                                        }
                                                    }
                                                </script>
                                            </div>
                                            <div class="mt-4 col-xl-6 col-xxl-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom01">Firstname
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">

                                                        <input type="text" class="form-control" value="{{ $user->fname }}" id="validationCustom01" name="fname"  placeholder="Enter a firstname.." required>
                                                        <div class="invalid-feedback">
                                                            Please enter a name.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom01">Surname
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" value="{{ $user->lname }}" id="validationCustom01" name="lname"  placeholder="Enter a surname.." required>
                                                        <div class="invalid-feedback">
                                                            Please enter a surname.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom02">Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" value="{{ $user->email }}" name="email" id="validationCustom02"  placeholder="Your valid email.." required>
                                                        <div class="invalid-feedback">
                                                            Please enter an Email.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom08">Phone (ZM)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" value="{{ $user->phone }}" name="phone" id="customerphone"  required>
                                                        <div class="invalid-feedback">
                                                            Please enter a phone no.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom02">Date of Birth <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <input type="text" id="customerDob" class="form-control" value="{{ $user->dob }}" name="dob" id="validationCustom02"  placeholder="{{ $user->dob }}">
                                                        <div class="invalid-feedback">
                                                            Please enter an Email.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 col-xl-6">
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom05">Gender
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <select name="gender" class="default-select wide form-control" id="validationCustom05">
                                                            <option value="">--select--</option>
                                                            <option {{ $user->nokgender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                                            <option {{ $user->nokgender == 'Male' ? 'selected' : '' }} value="Female">Female</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a one.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom06">Basic Pay
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="basic_pay" value="{{ $user->basic_pay }}" class="form-control" id="validationCustom06" placeholder="21.60" required>
                                                        <div class="invalid-feedback">
                                                            Please enter a Basic Pay.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom06">Net Pay
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="net_pay" value="{{ $user->net_pay }}" class="form-control" id="validationCustom06" placeholder="21.60" required>
                                                        <div class="invalid-feedback">
                                                            Please enter a Basic Pay.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom07">NRC
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" value="{{ $user->nrc_no }}" name="nrc_no" id="validationCustom07"  placeholder="999999/99/9" required>
                                                        <div class="invalid-feedback">
                                                            Please enter an NRC.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom05">User Role
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <select name="assigned_role" class="default-select wide form-control" id="validationCustom05">
                                                            <option data-display="Select">Please select</option>
                                                            @foreach($roles as $role)
                                                                <option value="{{ $role->id }}" {{ $current_role_name == $role->name ? 'selected' : '' }}>{{ ucwords($role->name) }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a one.
                                                        </div>
                                                    </div>

                                                </div>
                                                <input type="hidden" value="{{$user->id}}" name="user_edit_id" class="default-select wide form-control" placeholder="Borrower" id="validationCustom05">

                                                <div class="mb-3">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom04">Address<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-12">
                                                        <textarea name="address" class="form-control" value="{{ $user->address }}" id="validationCustom04"  rows="5" placeholder="Where does the person stay?" required>
                                                            {{ $user->address }}
                                                        </textarea>
                                                        <div class="invalid-feedback">
                                                            Please enter an Address.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h4 class="text-warning">Occupational Information</h4>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 required fs-6 fw-semibold">Employer</label>
                                                        <input type="text" class="form-control" value="{{ $user->employer }}" name="employer"/>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 fs-6 fw-semibold">Job Title</label>
                                                        <input type="text" class="form-control" value="{{ $user->occupation }}" name="occupation"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 required fs-6 fw-semibold">Employer Address</label>
                                                        <input type="email" class="form-control" value="{{ $user->empaddress }}" name="empaddress" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 fs-6 fw-semibold">Employer Phone Number</label>
                                                        <input id="empphone" class="form-control" value="{{ $user->empphone }}" name="empphone">
                                                    </div>
                                                </div><br>
                                                <h4 class="text-warning">Next of Kin Information</h4>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 required fs-6 fw-semibold">First Name</label>
                                                        <input type="text" class="form-control" name="nokfname" value="{{ $user->nokfname }}"/>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 required fs-6 fw-semibold">Last Name</label>
                                                        <input type="text" class="form-control" value="{{ $user->noklname }}" name="noklname"/>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Date of Birth -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 required fs-6 fw-semibold">Date of Birth</label>
                                                        <input type="text" class="form-control" id="nokDob" value="{{ $user->nokdob }}" name="nokdob" placeholder="{{ $user->nokdob }}" />
                                                    </div>
                                                    <!-- Phone Number -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 required fs-6 fw-semibold">Phone Number</label>
                                                        <input type="text" class="form-control" id="phone" name="nokphone" value="{{ $user->nokphone }}" placeholder="Enter 10-digit phone number" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 required fs-6 fw-semibold">Email Address</label>
                                                        <input type="email" class="form-control" name="nokemail" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="mb-2 fs-6 fw-semibold">Gender</label>
                                                        <select name="nokgender" class="form-control" >
                                                            <option value="">--choose--</option>
                                                            <option {{ $user->nokgender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                                            <option {{ $user->nokgender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

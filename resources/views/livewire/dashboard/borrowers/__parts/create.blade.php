<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl"> <!-- Add modal-xl for extra width -->
        <div class="modal-content">
            <div class="p-3 modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('create-user') }}"  enctype="multipart/form-data" class="tablelist-form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
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
                        <br>
                        <h4 class="text-warning">Basic Information</h4>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 required fs-6 fw-semibold">Firstname</label>
                                <input type="text" class="form-control" name="fname" required/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 required fs-6 fw-semibold">Lastname</label>
                                <input type="text" class="form-control" name="lname" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 required fs-6 fw-semibold">Email</label>
                                <input type="email" class="form-control" name="email" required/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 fs-6 fw-semibold">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">--choose--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 fs-6 fw-semibold">National ID Type</label>
                                <select name="id_type" class="form-control" required>
                                    <option value="">--choose--</option>
                                    <option value="NRC">NRC</option>
                                    <option value="Passport">Passport</option>
                                    <option value="Driver's License">Driver's License</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 fs-6 fw-semibold">ID Number</label>
                                <input type="number" class="form-control" name="nrc_no" id="nrc_no" required/>
                                <small id="id-number-error" class="text-danger d-none">ID Number is already taken.</small>

                            </div>

                            <script>
                                document.getElementById('nrc_no').addEventListener('input', function() {
                                    const nrc_no = this.value;

                                    if (nrc_no.length > 0) {
                                        fetch(`{{ route('check.id_number') }}?nrc_no=${nrc_no}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                const idNumberError = document.getElementById('id-number-error');
                                                if (data.exists) {
                                                    idNumberError.classList.remove('d-none');
                                                } else {
                                                    idNumberError.classList.add('d-none');
                                                }
                                            });
                                    }
                                });
                            </script>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 required fs-6 fw-semibold">Address Line</label>
                                <input type="text" class="form-control" name="address" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 required fs-6 fw-semibold">Phone</label>
                                <input type="text" class="form-control" name="phone" id="customerphone" required/>
                                <small id="phone-error" class="text-danger d-none">Phone number is already taken.</small>

                            </div>

                            <script>
                                document.getElementById('customerphone').addEventListener('input', function() {
                                    const phone = this.value;

                                    if (phone.length > 0) {
                                        fetch(`{{ route('check.phone') }}?phone=${phone}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                const phoneError = document.getElementById('phone-error');
                                                if (data.exists) {
                                                    phoneError.classList.remove('d-none');
                                                } else {
                                                    phoneError.classList.add('d-none');
                                                }
                                            });
                                    }
                                });
                            </script>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 required fs-6 fw-semibold">Date of Birth</label>
                                <input type="text" class="form-control" id="customerDob" name="dob"/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="mb-2 required fs-6 fw-semibold">Role</label>
                                <select type="hidden" class="form-control" name="assigned_role" >
                                    @foreach($roles as $role)
                                    <option selected value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <br>
                            <h4 class="text-warning">Occupational Information</h4>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="mb-2 required fs-6 fw-semibold">Employer</label>
                                    <input type="text" class="form-control" name="employer"/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="mb-2 fs-6 fw-semibold">Job Title</label>
                                    <input type="text" class="form-control" name="occupation"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="mb-2 required fs-6 fw-semibold">Employer Address</label>
                                    <input type="email" class="form-control" name="empaddress" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="mb-2 fs-6 fw-semibold">Employer Phone Number</label>
                                    <input type="text" id="empphone" name="empphone" class="form-control">
                                </div>
                            </div><br>
                            <h4 class="text-warning">Next of Kin Information</h4>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="mb-2 required fs-6 fw-semibold">First Name</label>
                                    <input type="text" class="form-control" name="nokfname"/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="mb-2 required fs-6 fw-semibold">Last Name</label>
                                    <input type="text" class="form-control" name="noklname"/>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Date of Birth -->
                                <div class="mb-3 col-md-6">
                                    <label class="mb-2 required fs-6 fw-semibold">Date of Birth</label>
                                    <input type="text" class="form-control" id="nokDob" name="nokdob" placeholder="MM/DD/YYYY" />
                                </div>
                                <!-- Phone Number -->
                                <div class="mb-3 col-md-6">
                                    <label class="mb-2 required fs-6 fw-semibold">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="nokphone" placeholder="Enter 10-digit phone number" />
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
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="gap-2 hstack justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Add Borrower</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

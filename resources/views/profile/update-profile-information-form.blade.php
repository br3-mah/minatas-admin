<div style="width: 100%" class="w-full">
    <div>
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <div class="">
                    <div  class="col-xxl-12">
                        <div class="d-flex align-items-center">
                            <img
                                id="previewImage"
                                class="me-3 rounded-circle me-0 me-sm-3"
                                @if(auth()->user()->profile_photo_path)
                                    src="{{ '../public/'.Storage::url(auth()->user()->profile_photo_path) }}"
                                @else
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmw0mqGxMV3LaBmRd2LTjBWq8PMMm2ZnoiopUzXmaMlw&s"
                                @endif
                                width="90"
                                height="90"
                                alt=""
                            />
                            <div class="media-body">
                                <h4 class="mb-0">{{ auth()->user()->fname.' '.auth()->user()->lname}}</h4>
                                <p class="mb-0">Max file size is 20mb</p>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-xs btn-primary text-white" id="openModalBtn">Change Profile Picture</button>
                </div>
            </div>
        </div>
        <br>
        <div class="mt-4">
            <h4 class="card-title">Personal Information</h4>
        </div>
        <div class="col-xxl-12">
            <div class="">
                <div class="">
                    <form action="{{ route('update-profile') }}" method="POST" class="row g-4">
                        @csrf
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">First Name</label>
                            <input
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->fname }}"
                            name="fname"
                            value="{{ auth()->user()->fname }}"
                            />
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Last Name</label>
                            <input
                            name="lname"
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->lname }}"
                            value="{{ auth()->user()->lname }}"
                            />
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Email</label>
                            <input
                            readonly
                            name="email"
                            type="email"
                            class="form-control"
                            placeholder="{{ auth()->user()->email}}"
                            value="{{ auth()->user()->email}}"
                            />
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Phone Number</label>
                            <input
                            name="phone"
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->phone}}"
                            value="{{ auth()->user()->phone}}"
                            />
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Present Address</label>
                            <input
                            name="address"
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->address }}"
                            value="{{ auth()->user()->address }}"
                            />
                        </div>

                        <div class="col-12">
                            <button type="submit"  class="btn btn-xs btn-primary text-white">
                            Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Updating...') }}
        </x-jet-action-message>
        <br>
        <x-jet-button wire:loading.attr="disabled" type="submit"  class="btn  btn-square btn-primary" wire:target="photo">
            {{ __('Save Changes') }}
        </x-jet-button>
    </x-slot> --}}
    <div id="myModal" class="modal col-6">
        <!-- Modal Content -->
        <div class="modal-content" style="padding: 4%">
            <!-- Modal Header -->
            <span style="float: right" class="modal-close" onclick="closeModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </span>
            <form id="imageForm" action="{{ route('update-prof-pic') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <h5>New Profile Picture</h5>
                    <div class="file-input-container">
                        <label for="imageInput" class="file-input-label">Choose a picture</label>
                        <input type="file" name="photo" id="imageInput" accept="image/*" onchange="previewImage()" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="preview-container" class="text-center">
                        <img id="preview-image" alt="Preview Image" class="img-fluid">
                    </div>
                </div>

                <div class="col-xxl-12">
                    <button type="submit" onclick="submitForm()" class="btn btn-xs  btn-bg waves-effect">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById('myModal');
        var btn = document.getElementById('openModalBtn');
        var profileForm = document.getElementById('profileForm');
        var fileSizeError = document.getElementById('fileSizeError');

        btn.onclick = function () {
            modal.style.display = 'block';
        };

        function closeModal() {
            modal.style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target === modal) {
                closeModal();
            }
        };

        function previewImage() {
            var previewContainer = document.getElementById('preview-container');
            var previewImage = document.getElementById('preview-image');
            var imageInput = document.getElementById('imageInput');

            // Check if a file is selected
            if (imageInput.files && imageInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
                }

                reader.readAsDataURL(imageInput.files[0]);
            } else {
                // No file selected, hide the preview
                previewImage.src = '';
                previewContainer.style.display = 'none';
            }
        }
    </script>


</div>

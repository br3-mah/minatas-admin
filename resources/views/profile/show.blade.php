<x-dash-layout>
<div>
  @php
  $meta = App\Models\User::meta();
  if (isset($_GET['view'])) {
      // Retrieve the value of the 'view' parameter
      $param = $_GET['view'];

      // Use the $view variable as needed
      $view = htmlspecialchars($param);
  }
  @endphp
    <div class="page-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xxl-12 col-xl-12">
              <div class="page-title" style="display: flex; gap:3%">

              <div class="">
                <div class="col-xxl-12 col-xl-12 col-lg-12 px-4">
                  @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif

                  @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                </div>
                <div id="updateProfile" class="">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @include('profile.update-profile-information-form')
                        @endif
                    </div>
                  </div>
                </div>
                <div id="twoFactor" class="">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                      @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                          @livewire('profile.update-password-form')
                      @endif
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.logout-other-browser-sessions-form')
                        @endif
                    </div>
                  </div>
                </div>
                <div id="browserSession" class="">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-password-form')
                        @endif
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.logout-other-browser-sessions-form')
                        @endif
                    </div>
                  </div>
                </div>

                <div id="docUploads" class="">
                  <div class="row">
                    @include('profile.kyc-update')
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
    </div>
    <script>

          document.getElementById('twoFactor').style.display = "none";
          document.getElementById('browserSession').style.display = "none";
          var view = '{{$view}}';
          switch (view) {
            case 'profile':
              profileTab();
              break;
            case 'kyc':
              docUplaodsTab()
              break;
            case 'privacy-security':

              securityTab();
              break;
            case 'issue':
              activityTab();
              break;

            default:
              profileTab();
              break;
          }

          function profileTab() {
            document.getElementById('updateProfile').style.display = "block";
            document.getElementById('twoFactor').style.display = "none";
            document.getElementById('browserSession').style.display = "none";
            document.getElementById('docUploads').style.display = "none";
          }
          function activityTab() {
            document.getElementById('updateProfile').style.display = "none";
            document.getElementById('twoFactor').style.display = "none";
            document.getElementById('browserSession').style.display = "block";
            document.getElementById('docUploads').style.display = "none";
          }
          function securityTab() {
            document.getElementById('updateProfile').style.display = "none";
            document.getElementById('twoFactor').style.display = "block";
            document.getElementById('browserSession').style.display = "none";
            document.getElementById('docUploads').style.display = "none";
          }
          function docUplaodsTab() {
            document.getElementById('updateProfile').style.display = "none";
            document.getElementById('twoFactor').style.display = "none";
            document.getElementById('browserSession').style.display = "none";
            document.getElementById('docUploads').style.display = "block";
          }
      </script>
      <script src="{{ asset('public/assets/jquery/jquery.min.js')}}"></script>
      <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</div>
</x-dash-layout>

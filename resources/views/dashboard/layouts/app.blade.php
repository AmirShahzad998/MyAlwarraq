<!DOCTYPE html>
<!-- beautify ignore:start -->
<html lang="en">
  <head>

    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    @php
        $setting = App\Models\Setting::first();
    @endphp
    {{-- <title>{{$setting->app_name}}</title> --}}

    <meta name="description" content="" />

    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="{{$setting->app_favicon}}" /> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.min.css') }}">
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    @yield('css')
    <style>

        .select2-container--default .select2-selection--multiple{
          height: 40px !important;
          padding-top: 5px !important;
          padding-left:5px !important;
        }

        .select2-container--default .select2-selection--single{
          height: 40px !important;
          padding-top: 5px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow{
          margin-top:5px !important;
        }


    </style>
  </head>

  <body>

    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        {{-- @include('dashboard.layouts.sidebar') --}}
        <div class="layout-page">
          @include('dashboard.layouts.header')
          <div class="content-wrapper">
            <div class="container-fluid">
              @include('dashboard.layouts.errors')
              @include('dashboard.layouts.status')
              @yield('content')
            </div>
          <div class="content-backdrop fade"></div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
      </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}
    @yield('script')
    @stack('script')
    @yield('modal')
    <script>
        window.addEventListener('alert', event => {
            if(event.detail.type == "success"){
              toastr.success(event.detail.message, event.detail.title, {
                  positionClass: "toast-bottom-right",
                  timeOut: 5e3,
                  closeButton: !0,
                  debug: !1,
                  newestOnTop: !0,
                  progressBar: !0,
                  preventDuplicates: !0,
                  onclick: null,
                  showDuration: "300",
                  hideDuration: "1000",
                  extendedTimeOut: "1000",
                  showEasing: "swing",
                  hideEasing: "linear",
                  showMethod: "fadeIn",
                  hideMethod: "fadeOut",
                  tapToDismiss: !1
              });

            }
            else{
              toastr.error(event.detail.message, event.detail.title, {
                  positionClass: "toast-bottom-right",
                  timeOut: 5e3,
                  closeButton: !0,
                  debug: !1,
                  newestOnTop: !0,
                  progressBar: !0,
                  preventDuplicates: !0,
                  onclick: null,
                  showDuration: "300",
                  hideDuration: "1000",
                  extendedTimeOut: "1000",
                  showEasing: "swing",
                  hideEasing: "linear",
                  showMethod: "fadeIn",
                  hideMethod: "fadeOut",
                  tapToDismiss: !1
              });
            }

        });
    </script>
  </body>
</html>

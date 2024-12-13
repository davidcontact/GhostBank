<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    {{-- SEO --}}
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    {{-- bootstrap Style --}}
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- // font awesome -->
    <script
    src="https://kit.fontawesome.com/09f9a27c79.js"
    crossorigin="anonymous"></script>

    
    

    {{-- css style --}}
    @stack('home-style')
    <style>
        .MainPage{
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }
        .bg-dark {
            background-color: #775104 !important;
        }
        .item-logo{
            color: white !important;
        }
        .item-logo::first-letter{
            color: #ffcc99 !important;
            
        }
        .authStyle{
            border-radius: 10px;
            padding: 4px 18px;
        }
        .nav-item{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* .nav-link:hover{
            transition: all ease 0.3s !important;
            color: white !important;
            text-decoration: underline !important;
            text-underline-offset: 0.3rem !important;
        }
        .nav-link:active{
            scale: 0.9;
            transition: all ease 0.3s !important;
        } */
        .navbar-toggler{
            border: 2px solid white;
        }
        .navbar-toggler:focus {
            box-shadow: none !important;
        }
        .navbar-toggler:active {
            scale: 0.9;
            box-shadow: 0 0 0 1px !important;
        }
    </style>
</head>
<body>
    

    {{-- Header --}}
    @include('components.header')

    <div class="MainPage">
        {{-- Content --}}
        @yield('content')
    </div>

    {{-- Footer --}}
    @include('components.footer')

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   

    

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    {{-- javascript --}}
    @yield('script')

    {{-- Toastr Notification Script (Make sure toastr is loaded before calling it) --}}
    @if(Session::has('message'))
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                var messageType = "{{ Session::get('message_type') }}";
                var message = "{{ Session::get('message') }}";

                if (typeof toastr !== 'undefined') {
                    if (messageType === 'error') {
                        toastr.error(message);
                    } else {
                        toastr.success(message);
                    }
                }
            });
        </script>
    @endif                                                  

</body>
</html>
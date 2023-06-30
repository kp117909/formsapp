<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
        />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <title>{{__("Form App")}}</title>
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @guest
                    <li class="breadcrumb-item">
                        <a href="{{route('auth.index')}}" class="btn btn-outline-light me-2">{{__("Admin Panel")}}</a>
                    </li>
                    @endguest
                    <li class="breadcrumb-item">
                        <a href="{{route('guest.forms')}}" class="btn btn-outline-light me-2" >{{__("Surveys")}}</a>
                    </li>
                    @auth
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index')}}" class="btn btn-outline-light me-2">{{__("Admin Panel")}}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('response.index')}}" class="btn btn-outline-light me-2">{{__(" Completed Surveys")}}</a>
                    </li>
                    <li class ="breadcrumb-item">
                        <a href="{{ route('auth.logout') }}" class="btn btn-outline-light me-2">{{__("Logout")}}</a>
                    </li>
                    @endauth
                </ol>
            </nav>
        </div>
    </nav>

    <div class = "container">
        @yield('content')
    </div>
    </body>

    <footer class="bg-white text-center text-lg-start mt-4">
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</html>

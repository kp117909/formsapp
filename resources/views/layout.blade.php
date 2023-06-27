<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
        />
        <!-- Google Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
        />
        <!-- MDB -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"
            rel="stylesheet"
        />
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
                    <li class="breadcrumb-item">
                        <a href="#" class="btn btn-outline-light me-2" >{{__("Forms")}}</a>
                    </li>
                    @endguest
                    @auth
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

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Inclusão do Bootstrap via Vite--}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    
    {{-- LINKS CSS --}}
    <link href="{{ asset('css/styles_sbadmin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylesmrc_admin.css') }}" rel="stylesheet">

    <title>SEMU - ALUGUEL MP</title>
    <style>
        body{
            background-image: url('{{ asset("images/background_06.png")}}');
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            background-size: cover; 
            background-size: 100% 100%;
        }

        .card-header{
            background: url('{{ asset("images/logo_semu.png") }}') no-repeat center center;
            background-color: #8d0376;
            height: 160px;
        }
    </style>
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center" style="margin-top: 15%">

                        @yield('content')

                    </div>
                </div>
            </main>
        </div>

        {{-- footer --}}
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; ATI {{ date('Y')}}</div>
                        <div>
                            {{--
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                            --}}
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- SCRIPTS
    <script src="{{ asset('js/jquery371.js') }}"></script>--}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts_sbadmin.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>

</body>
</html>

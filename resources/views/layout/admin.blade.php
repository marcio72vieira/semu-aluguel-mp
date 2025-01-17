<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- LINKS CSS --}}
    <link href="{{ asset('css/styles_sbadmin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylesmrc_admin.css') }}" rel="stylesheet">

    {{-- Inlcuindo o css e js do SELECT2 via CDN Obs: o jquery, deve ficar antes do JS do select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Incluindo o SweeterAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
    <link href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" rel="stylesheet"></link>

    {{-- até aqui tudo ok pagina referrência: https://datatables.net/examples/styling/bootstrap5.html--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"></link>
    <link href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css" rel="stylesheet"></link>


    <title>SEMU - ALUGUEL MP</title>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">SEMU - ALUGUEL MP</a>

        <!-- Sidebar Toggle-->
        <button class="order-1 btn btn-link btn-sm order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar Search-->
        <form class="my-2 d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-md-0"></form>

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{ Auth::user()->nome }}</strong> &nbsp;&nbsp; <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    {{-- <li><a class="dropdown-item" href="#!">Perfil</a></li> --}}
                    {{-- <li><a class="dropdown-item" href="#!">Atividades</a></li> --}}
                    {{-- <li><hr class="dropdown-divider" /></li> --}}
                    <li><a class="dropdown-item" href="{{ route('login.logout') }}">Sair</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Operação</div>

                        {{-- Garante a visualização/acesso apenas de quem é Administrador ou Servidor --}}
                        @can("onlyAdmSrv")
                            <a class="nav-link" href="{{ route('dashboard.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge-high"></i></div>
                                Dashboard
                            </a>
                        @endcan

                        {{-- Garante a visualização/acesso apenas de quem é Administrador e Assistente Social. Se o acesso for garantido a todos, elimine esta regra  --}}
                        @can("onlyAdmAss")
                            <a class="nav-link" href="{{ route('requerente.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-child-dress"></i></div>
                                Requerentes
                            </a>
                        @endcan

                        {{-- Garante a visualização/acesso apenas de quem é Administrador ou Servidor --}}
                        @can("onlyAdmSrv")
                                <a class="nav-link" href="{{ route('checklist.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check"></i></div>
                                    Check List
                                </a>
                                <a class="nav-link" href="{{ route('processo.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file-powerpoint"></i></div>
                                    Processos
                                </a>
                        @endcan


                        {{-- Garante o acesso apenas de quem é Administrador --}}
                        @can("onlyAdm")
                            <div class="sb-sidenav-menu-heading">Administração</div>
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Usuários
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gears"></i></div>
                                Configurações
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('regional.index') }}">Regionais</a>
                                    <a class="nav-link" href="{{ route('municipio.index') }}">Municípios</a>
                                    <a class="nav-link" href="{{ route('tipounidade.index') }}">Tipos de Unidades</a>
                                    <a class="nav-link" href="{{ route('unidadeatendimento.index')}}">Unidades</a>
                                    <a class="nav-link" href="{{ route('tipodocumento.index')}}">Tipos de Documentos</a>
                                    {{-- <a class="nav-link" href="{{ url('index-datatables') }}">DataTable</a> --}}
                                </nav>
                            </div>
                        @endcan

                        {{--
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                        --}}

                        <a class="nav-link" href="{{ route('login.logout') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                            Sair
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Perfil: {{ (Auth::user()->perfil == "adm" ? "ADMINISTRADOR" : (Auth::user()->perfil == "srv" ? "ANALISTA" : "OPERADOR")) }}</div>
                </div>
            </nav>
        </div>

        {{-- CONTEÚDO --}}
        <div id="layoutSidenav_content" style ="background-image: url('{{ asset("images/background_06_opct10.png")}}'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-size: 100% 100%;">
            <main>

                 @yield('content')

            </main>

            {{-- RODAPÉ --}}
            <footer class="py-4 mt-auto bg-light">
                <div class="px-4 container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; ATI {{ date('Y') }}</div>
                        {{-- <div>
                            <a href="#">Política de privacidade</a>
                            &middot;
                            <a href="#">Termos &amp; Condições</a>
                        </div> --}}
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

    {{-- charts--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script> --}}


    <!--Plugin jQuery para máscaras de campos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <!-- Scripts Customizados, criados por mim mesmo ou para configuração de outras bibliotecas e plugins -->
    <script src="{{ asset('js/scriptsmrc.js') }}"></script>

    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>

    {{-- Scripts a serem colocados de maneira individual em cada página --}}
    @yield('scripts')

</body>
</html>

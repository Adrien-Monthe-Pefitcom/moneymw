<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>My Money Maker</title>
        <link rel="stylesheet" href="css\app.css">
        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="icon" type="image/jpg" sizes="192x192" href="{{ URL::asset('complement/assets/img/logo.jpg') }}">
        <script src="public\js\newapp.js"></script>
        <link href="complement/assets/css/dashstyles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark row" style="box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); height: 10vh;">
            <div class="pageTitle col-md-4" style="text-align: left;">
                <img src="{{ URL::asset('complement/assets/img/logo.png') }}" width="120rem">
                <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars" style="color: black;"></i></button>
            </div>
            <div class="pageTitle col-md-4"> </div>
            <div class="col-md-3">

                <!-- Navbar-->
                <div class="row">
                    <div class="col-md-3" style="text-align: right;">

                        <ul class="navbar-nav ml-auto ml-md-0" style="color: black">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell" aria-hidden="true" style="color: black"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" >
                                    <a class="dropdown-item" href="#">notif1</a>
                                    <a class="dropdown-item" href="#">notif2</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">notif3</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <ul class="navbar-nav ml-auto ml-md-0" style="color: black">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope" aria-hidden="true" style="color: black"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" >
                                    <a class="dropdown-item" href="#">notif1</a>
                                    <a class="dropdown-item" href="#">notif2</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">notif3</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="navbar-nav ml-auto ml-md-0" style="color: black">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw" style="color: black"></i><span style="color: #efaa1e;">{{Auth::user()->name}}</span></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" >
                                    <a class="dropdown-item" href="#">Settings</a>
                                    <a class="dropdown-item" href="#">Activity Log</a>
                                    <a class="dropdown-item" href="/change_password" role="button" >Change Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('user-logout')}}">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" >
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black"></i></div>
                                Mon Compte
                            </a>
                            @if(Auth::user()->role === "admin")
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-lock" aria-hidden="true" style="color: black"></i></div>
                                Administration
                                <div class="sb-sidenav-collapse-arrow"><i style="color: black" class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="admin" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/validate">Valider inscription</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/gestionclient">Gerer clients</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('point-de-vente')}}">Point de Vente</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('newbusiness')}}">Compte Marchand</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('register-comm')}}">Creer un commercial</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('register-superviseur')}}">Creer un superviseur</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/import_excel">Enregistrer des Clients</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('register-client')}}">Creer un client</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit')}}">Crediter un compte</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit-marchant')}}">Crediter un compte marchant</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit-comm')}}">Crediter un compte commercial</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit-supp')}}">Crediter un compte superviseur</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit-ptvente')}}">Crediter un compte point de vente</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('liste-commerciaux')}}">Liste des commerciaux</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('liste-superviseurs')}}">Liste des superviseurs</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('liste-point-ventes')}}">Liste des points de vente</a>
                                </nav>
                                <!--<nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/visa">Gerer les tarifs</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/visa">Gerer les monaies</a>
                                </nav>-->
                            </div>
                            @endif

                            @if(Auth::user()->role === "superadmin")
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-lock" aria-hidden="true" style="color: black"></i></div>
                                Administration
                                <div class="sb-sidenav-collapse-arrow"><i style="color: black" class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="admin" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/validate">Valider inscription</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/gestionclient">Gerer clients</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('point-de-vente')}}">Point de Vente</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('newbusiness')}}">Compte Marchand</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('register-comm')}}">Creer un commercial</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('register-superviseur')}}">Creer un superviseur</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('register-client')}}">Creer un client</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('register-admin')}}">Creer un admin</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/import_excel">Enregistrer des Clients</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit')}}">Crediter un compte</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit-marchant')}}">Crediter un compte marchant</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit-comm')}}">Crediter un compte commercial</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit-supp')}}">Crediter un compte superviseur</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit-ptvente')}}">Crediter un compte point de vente</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('liste-commerciaux')}}">Liste des commerciaux</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('liste-superviseurs')}}">Liste des superviseurs</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('liste-point-ventes')}}">Liste des points de vente</a>
                                </nav>
                                <!--<nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/visa">Gerer les tarifs</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/visa">Gerer les monaies</a>
                                </nav>-->
                            </div>
                            @endif

                                <a class="nav-link" href="{{route('user-statut')}}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black"></i></div>
                                    Profil
                                </a>
                                <div class="sb-sidenav-menu-heading">Interface</div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open" style="color: black"></i></div>
                                    Paiement
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: black"></i></div>
                                </a>
                                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                        <a class="nav-link collapsed" href="/transactions" >
                                            Historique
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="/newop" >
                                            Nouvelle Operation
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('qrcode')}}" >
                                            QR Code
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="/facture" >
                                            Abonnements et Factures
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="/tarifs" >
                                            Grille Tarifaire
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>

                                        <!--<div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="login.html">Login</a>
                                                <a class="nav-link" href="register.html">Register</a>
                                                <a class="nav-link" href="password.html">Forgot Password</a>
                                            </nav>
                                        </div>
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                            Error
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: black"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="401.html">401 Page</a>
                                                <a class="nav-link" href="404.html">404 Page</a>
                                                <a class="nav-link" href="500.html">500 Page</a>
                                            </nav>
                                        </div>-->
                                    </nav>
                                </div>


                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cards" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: black"></i></div>
                                Mes cartes
                                <div class="sb-sidenav-collapse-arrow"><i style="color: black" class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="cards" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/visa">Visa</a>
                                </nav>
                            </div>
                            @if(Auth::user()->type_compte === "Point de Vente")

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ptvente" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: black"></i></div>
                                Point de vente
                                <div class="sb-sidenav-collapse-arrow"><i style="color: black" class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="ptvente" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('dashboard-ptvente')}}">Dashboard Point de vente</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit')}}">Crediter compte</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('credit')}}">Debiter compte</a>
                                </nav>
                            </div>
                            @endif
                            <div class="sb-sidenav-menu-heading">Addons</div>

                            @if(Auth::user()->role === "commercial")
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="false" aria-controls="collapsePages">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open" style="color: black"></i></div>
                                    Commercial
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: black"></i></div>
                                </a>
                                <div class="collapse" id="collapsePages1" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages1">
                                     <a class="nav-link collapsed" href="{{route('dashboard-comm')}}" >
                                            Dashboard Commercial
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('register-by-comm')}}" >
                                            Creer un compte Client
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('marchant-by-comm')}}" >
                                            Creer un compte Marchant
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('liste-comptes')}}" >
                                            Liste des comptes crees
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('credit')}}" >
                                            Crediter un compte
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>

                                    </nav>
                                </div>
                            @endif

                            @if(Auth::user()->role === "superviseur")
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="false" aria-controls="collapsePages">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open" style="color: black"></i></div>
                                    Superviseur
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: black"></i></div>
                                </a>
                                <div class="collapse" id="collapsePages1" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages1">
                                        <a class="nav-link collapsed" href="{{route('dashboard-supp')}}" >
                                            Dashboard Superviseur
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('register-by-superviseur')}}" >
                                            Creer un compte Client
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('marchant-by-superviseur')}}" >
                                            Creer un compte Marchant
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('register-comm-by-supp')}}" >
                                            Creer un compte Commercial
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('info-ptvente-by-superviseur')}}" >
                                            Creer un point de vente
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('liste-comptes-sup')}}" >
                                            Liste des comptes crees
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('credit')}}" >
                                            Crediter un compte
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('credit')}}" >
                                            Crediter un compte marchant
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('credit-comm')}}" >
                                            Crediter un compte commercial
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('credit-supp')}}" >
                                            Crediter un compte superviseur
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>
                                        <a class="nav-link collapsed" href="{{route('credit-ptvente')}}" >
                                            Crediter un compte point de vente
                                            <div class="sb-sidenav-collapse-arrow"></div>
                                        </a>

                                    </nav>
                                </div>
                            @endif

                            <a class="nav-link" href="/lead">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area" style="color: black"></i></div>
                                Partager Mon Lien
                            </a>
                            <a class="nav-link" href="/contacts">
                                <div class="sb-nav-link-icon"><i class="fa fa-address-card" aria-hidden="true" style="color: black"></i></div>
                                Contacts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fa fa-rss" aria-hidden="true" style="color: black"></i></div>
                                Actualité Money Maker
                            </a>
                            <a class="nav-link" href="/settings">
                                <div class="sb-nav-link-icon"><i class="fa fa-wrench" aria-hidden="true" style="color: black"></i></div>
                                    Compte et Paramètres
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" style="margin-top: 2rem">

            @yield('content')


                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <a target="_blank" title="PERFITCOM"  href="https://www.perfitcom.com">PERFITCOM</a> 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/complement/assets/js/dashscripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>

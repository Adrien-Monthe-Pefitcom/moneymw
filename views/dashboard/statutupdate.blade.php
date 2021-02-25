<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link rel="stylesheet" href="css\app.css">
        <script src="public\js\newapp.js"></script>
        <link href="complement/assets/css/dashstyles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); height: 10vh;">
        <div class="pageTitle">
                <img src="{{ URL::asset('complement/assets/img/logo.png') }}" width="120rem">
            </div>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars" style="color: black;"></i></button>
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0" style="color: black">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw" style="color: black"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" >
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" >
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="{{route('user-statut')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black"></i></div>
                                Profil
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: black"></i></div>
                                Mon Porte Monaie
                                <div class="sb-sidenav-collapse-arrow"><i style="color: black" class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Mon solde</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Mes contacts</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open" style="color: black"></i></div>
                                    Transactions
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
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#paid" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: black"></i></div>
                                Paiements
                                <div class="sb-sidenav-collapse-arrow"><i style="color: black" class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="paid" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Mon solde</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Mes contacts</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cards" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: black"></i></div>
                                Mes cartes
                                <div class="sb-sidenav-collapse-arrow"><i style="color: black" class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="cards" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Visa</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">compte OM</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">compte MOMO</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area" style="color: black"></i></div>
                                Leads
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table" style="color: black"></i></div>
                                Messages
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table" style="color: black"></i></div>
                                Contacts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table" style="color: black"></i></div>
                                Actualité Money Maker
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Mise a jour du statut de L'utilisateur</h1>
        
        <!-- App Capsule -->
            <div id="appCapsule">
            <form style="width:98%" id="statut-us-form" action="{{route('post-update-statut')}}" method="POST" enctype="multipart/form-data" name="formes"> @csrf
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-outline-primary waves-effect md-trigger" style="float: right" id="btn-login">Enregistrer&nbsp;<i class="fas fa-spinner fa-spin" style="display:none" class="spinner" id="spinner-login"></i></button>
                    <input type="hidden" value="{{ $id->id }}" name="id"/>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="exampleFormControlInput1"> Nom  de l'utilisateur</label>
                        <input required type="text" class="form-control "  name="titre" id="titre" placeholder="nom utilisateur" value="{{ $id->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlInput1"> Identifiant Unique</label>
                        <input type="text" class="form-control " name="identifiantunique" id="identifiantunique"  value="{{ $id->identifiant_unique }}">
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlInput1 "> Date naissance</label>
                        <input type="text" class="form-control" name="datenaissance" id="datenaiss"  value="{{ $id->date_naissance }}">
                    </div>

                </div>
            </div>
            <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlInput1 ">Statut</label>
                        <select class="form-control" name="statut" id="statut">
                            <option value="En Attente"> En Attente </option>
                            <option value="Approuve"> Approuve </option>
                            <option value="Rejete"> Rejete </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlInput1 ">Numero Cni</label>
                        <input required type="text" class="form-control" name="numcni" id="numcni"  value="{{ $id->num_cni }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlInput1 ">Numero Passeport</label>
                        <input required type="text" class="form-control" name="numpasseport" id="numpasseport"  value="{{ $id->num_passeport }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputFile">Photo de l'utilisateur</label>
                    </div>
                    <img id="previewImg" alt="Logo" style="display:block" width='720px' height='600px' src="{{ $id->photo }}">
                        <br/>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-outline-primary waves-effect md-trigger" style="float: right" id="btn-logins">Enregistrer&nbsp;<i class="fas fa-spinner fa-spin" style="display:none" class="spinner" id="spinner-logins"></i></button>

                </div>
            </div>


        </form>
             </div>
            </div>
        </div>
    </section>



   <style>
     @import url('https://fonts.googleapis.com/css?family=Roboto');

body{
   font-family: 'Roboto', sans-serif;
}
* {
   margin: 0;
   padding: 0;
}
i {
   margin-right: 10px;
}

#sig-canvas {
                   border: 2px dotted #CCCCCC;
                   border-radius: 15px;
                   cursor: crosshair;
                   }
/*------------------------*/
input:focus,
button:focus,
.form-control:focus{
   outline: none;
   box-shadow: none;
}
.form-control:disabled, .form-control[readonly]{
   background-color: #fff;
}
/*----------step-wizard------------*/
.d-flex{
   display: flex;
}
.justify-content-center{
   justify-content: center;
}
.align-items-center{
   align-items: center;
}

/*---------signup-step-------------*/
.bg-color{
   background-color: #333;
}
.signup-step-container{
   padding: 150px 0px;
   padding-bottom: 60px;
}




   .wizard .nav-tabs {
       position: relative;
       margin-bottom: 0;
       border-bottom-color: transparent;
   }

   .wizard > div.wizard-inner {
           position: relative;
   margin-bottom: 50px;
   text-align: center;
   }

.connecting-line {
   height: 2px;
   background: #e0e0e0;
   position: absolute;
   width: 75%;
   margin: 0 auto;
   left: 0;
   right: 0;
   top: 15px;
   z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
   color: #555555;
   cursor: default;
   border: 0;
   border-bottom-color: transparent;
}

span.round-tab {
   width: 30px;
   height: 30px;
   line-height: 30px;
   display: inline-block;
   border-radius: 50%;
   background: #fff;
   z-index: 2;
   position: absolute;
   left: 0;
   text-align: center;
   font-size: 16px;
   color: #0e214b;
   font-weight: 500;
   border: 1px solid #ddd;
}
span.round-tab i{
   color:#efaa1e;
}
.wizard li.active span.round-tab {
       background: #efaa1e;
   color: #fff;
   border-color: #efaa1e;
}
.wizard li.active span.round-tab i{
   color: #5bc0de;
}
.wizard .nav-tabs > li.active > a i{
   color: #0db02b;
}

.wizard .nav-tabs > li {
   width: 25%;
}

.wizard li:after {
   content: " ";
   position: absolute;
   left: 46%;
   opacity: 0;
   margin: 0 auto;
   bottom: 0px;
   border: 5px solid transparent;
   border-bottom-color: red;
   transition: 0.1s ease-in-out;
}



.wizard .nav-tabs > li a {
   width: 30px;
   height: 30px;
   margin: 20px auto;
   border-radius: 100%;
   padding: 0;
   background-color: transparent;
   position: relative;
   top: 0;
}
.wizard .nav-tabs > li a i{
   position: absolute;
   top: -15px;
   font-style: normal;
   font-weight: 400;
   white-space: nowrap;
   left: 50%;
   transform: translate(-50%, -50%);
   font-size: 12px;
   font-weight: 700;
   color: #000;
}

   .wizard .nav-tabs > li a:hover {
       background: transparent;
   }

.wizard .tab-pane {
   position: relative;
   padding-top: 20px;
}


.wizard h3 {
   margin-top: 0;
}
.prev-step,
.next-step{
   font-size: 13px;
   padding: 8px 24px;
   border: none;
   border-radius: 4px;
   margin-top: 30px;
}
.next-step{
   background-color: #efaa1e;
}
.skip-btn{
   background-color: #747c7c ;
}
.step-head{
   font-size: 20px;
   text-align: center;
   font-weight: 500;
   margin-bottom: 20px;
}
.term-check{
   font-size: 14px;
   font-weight: 400;
}
.custom-file {
   position: relative;
   display: inline-block;
   width: 100%;
   height: 40px;
   margin-bottom: 0;
}
.custom-file-input {
   position: relative;
   z-index: 2;
   width: 100%;
   height: 40px;
   margin: 0;
   opacity: 0;
}
.custom-file-label {
   position: absolute;
   top: 0;
   right: 0;
   left: 0;
   z-index: 1;
   height: 40px;
   padding: .375rem .75rem;
   font-weight: 400;
   line-height: 2;
   color: #495057;
   background-color: #fff;
   border: 1px solid #ced4da;
   border-radius: .25rem;
}
.custom-file-label::after {
   position: absolute;
   top: 0;
   right: 0;
   bottom: 0;
   z-index: 3;
   display: block;
   height: 38px;
   padding: .375rem .75rem;
   line-height: 2;
   color: #495057;
   content: "Télécharger";
   background-color: #e9ecef;
   border-left: inherit;
   border-radius: 0 .25rem .25rem 0;
}
.footer-link{
   margin-top: 30px;
}
.all-info-container{

}
.list-content{
   margin-bottom: 10px;
}
.list-content a{
   padding: 10px 15px;
   width: 100%;
   display: inline-block;
   background-color: #f5f5f5;
   position: relative;
   color: #565656;
   font-weight: 400;
   border-radius: 4px;
}
.list-content a[aria-expanded="true"] i{
   transform: rotate(180deg);
}
.list-content a i{
   text-align: right;
   position: absolute;
   top: 15px;
   right: 10px;
   transition: 0.5s;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
   background-color: #fdfdfd;
}
.list-box{
   padding: 10px;
}
.signup-logo-header .logo_area{
   width: 200px;
}
.signup-logo-header .nav > li{
   padding: 0;
}
.signup-logo-header .header-flex{
   display: flex;
   justify-content: center;
   align-items: center;
}
.list-inline li{
   display: inline-block;
}
.pull-right{
   float: right;
}
/*-----------custom-checkbox-----------*/
/*----------Custom-Checkbox---------*/
input[type="checkbox"]{
   position: relative;
   display: inline-block;
   margin-right: 5px;
}
input[type="checkbox"]::before,
input[type="checkbox"]::after {
   position: absolute;
   content: "";
   display: inline-block;   
}
input[type="checkbox"]::before{
   height: 16px;
   width: 16px;
   border: 1px solid #999;
   left: 0px;
   top: 0px;
   background-color: #fff;
   border-radius: 2px;
}
input[type="checkbox"]::after{
   height: 5px;
   width: 9px;
   left: 4px;
   top: 4px;
}
input[type="checkbox"]:checked::after{
   content: "";
   border-left: 1px solid #fff;
   border-bottom: 1px solid #fff;
   transform: rotate(-45deg);
}
input[type="checkbox"]:checked::before{
   background-color: #efaa1e ;
   border-color: #18ba60;
}






@media (max-width: 767px){
   .sign-content h3{
       font-size: 40px;
   }
   .wizard .nav-tabs > li a i{
       display: none;
   }
   .signup-logo-header .navbar-toggle{
       margin: 0;
       margin-top: 8px;
   }
   .signup-logo-header .logo_area{
       margin-top: 0;
   }
   .signup-logo-header .header-flex{
       display: block;
   }
}

   </style>

   <script>
       // ------------step-wizard-------------
$(document).ready(function () {
   $('.nav-tabs > li a[title]').tooltip();
   
   //Wizard
   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

       var target = $(e.target);
   
       if (target.parent().hasClass('disabled')) {
           return false;
       }
   });

   $(".next-step").click(function (e) {

       var active = $('.wizard .nav-tabs li.active');
       active.next().removeClass('disabled');
       nextTab(active);


   });
   $(".prev-step").click(function (e) {

       var active = $('.wizard .nav-tabs li.active');
       prevTab(active);

   });
});

function nextTab(elem) {
   $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
   $(elem).prev().find('a[data-toggle="tab"]').click();
}


$('.nav-tabs').on('click', 'li', function() {
   $('.nav-tabs li.active').removeClass('active');
   $(this).addClass('active');
});

$(function () {
   var $src1 = $('#name'),
       $dst1 = $('#name2'),
       $src2 = $('#tel'),
       $dst2 = $('#tel2'),
       $src3 = $('#email'),
       $dst3 = $('#email2'),
       $src4 = $('#password'),
       $dst4 = $('#password2'),
       $src5 = $('#country_id'),
       $dst5 = $('#country_id2'),
       $src6 = $('#town'),
       $dst6 = $('#town2'),
       $src7 = $('#country'),
       $dst7 = $('#country2'),
       $src8 = $('#profession'),
       $dst8 = $('#profession2'),
       $src9 = $('#dob'),
       $dst9 = $('#dob2'),
       $src10 = $('#passport_number'),
       $dst10 = $('#passport_number2'),
       $src11 = $('#cni_number'),
       $dst11 = $('#cni_number2'),
       $src12 = $('#passport'),
       $dst12 = $('#passport2'),
       $src13 = $('#cni'),
       $dst13 = $('#cni2'),
       $src14 = $('#bank_name'),
       $dst14 = $('#bank_name2'),
       $src15 = $('#referee'),
       $dst15 = $('#referee2'),
       $src16 = $('#bank_acc'),
       $dst16 = $('#bank_acc2');
   $src1.on('input', function () {
       $dst1.val($src1.val());
   });
   $src2.on('input', function () {
       $dst2.val($src2.val());
   });
   $src3.on('input', function () {
       $dst3.val($src3.val());
   });
   $src4.on('input', function () {
       $dst4.val($src4.val());
   });
   $src5.on('input', function () {
       $dst5.val($src5.val());
   });
   $src6.on('input', function () {
       $dst6.val($src6.val());
   });
   $src7.on('input', function () {
       $dst7.val($src7.children("option:selected").val());
   });
   $src8.on('input', function () {
       $dst8.val($src8.val());
   });
   $src9.on('input', function () {
       $dst9.val($src9.val());
   });
   $src10.on('input', function () {
       $dst10.val($src10.val());
   });
   $src11.on('input', function () {
       $dst11.val($src11.val());
   });
   $src12.on('input', function () {
       $dst12.val($src12.val());
   });
   $src13.on('input', function () {
       $dst13.val($src13.val());
   });
   $src14.on('input', function () {
       $dst14.val($src14.val());
   });
   $src15.on('input', function () {
       $dst15.val($src15.val());
   });
   $src16.on('input', function () {
       $dst16.val($src16.val());
   });

});
                   (function() {
 window.requestAnimFrame = (function(callback) {
   return window.requestAnimationFrame ||
     window.webkitRequestAnimationFrame ||
     window.mozRequestAnimationFrame ||
     window.oRequestAnimationFrame ||
     window.msRequestAnimaitonFrame ||
     function(callback) {
       window.setTimeout(callback, 1000 / 60);
     };
 })();



 var canvas = document.getElementById("sig-canvas");
 var ctx = canvas.getContext("2d");
 ctx.strokeStyle = "#222222";
 ctx.lineWidth = 4;

 var drawing = false;
 var mousePos = {
   x: 0,
   y: 0
 };
 var lastPos = mousePos;

 canvas.addEventListener("mousedown", function(e) {
   drawing = true;
   lastPos = getMousePos(canvas, e);
 }, false);

 canvas.addEventListener("mouseup", function(e) {
   drawing = false;
 }, false);

 canvas.addEventListener("mousemove", function(e) {
   mousePos = getMousePos(canvas, e);
 }, false);

 // Add touch event support for mobile
 canvas.addEventListener("touchstart", function(e) {

 }, false);

 canvas.addEventListener("touchmove", function(e) {
   var touch = e.touches[0];
   var me = new MouseEvent("mousemove", {
     clientX: touch.clientX,
     clientY: touch.clientY
   });
   canvas.dispatchEvent(me);
 }, false);

 canvas.addEventListener("touchstart", function(e) {
   mousePos = getTouchPos(canvas, e);
   var touch = e.touches[0];
   var me = new MouseEvent("mousedown", {
     clientX: touch.clientX,
     clientY: touch.clientY
   });
   canvas.dispatchEvent(me);
 }, false);

 canvas.addEventListener("touchend", function(e) {
   var me = new MouseEvent("mouseup", {});
   canvas.dispatchEvent(me);
 }, false);

 function getMousePos(canvasDom, mouseEvent) {
   var rect = canvasDom.getBoundingClientRect();
   return {
     x: mouseEvent.clientX - rect.left,
     y: mouseEvent.clientY - rect.top
   }
 }

 function getTouchPos(canvasDom, touchEvent) {
   var rect = canvasDom.getBoundingClientRect();
   return {
     x: touchEvent.touches[0].clientX - rect.left,
     y: touchEvent.touches[0].clientY - rect.top
   }
 }

 function renderCanvas() {
   if (drawing) {
     ctx.moveTo(lastPos.x, lastPos.y);
     ctx.lineTo(mousePos.x, mousePos.y);
     ctx.stroke();
     lastPos = mousePos;
   }
 }

 // Prevent scrolling when touching the canvas
 document.body.addEventListener("touchstart", function(e) {
   if (e.target == canvas) {
     e.preventDefault();
   }
 }, false);
 document.body.addEventListener("touchend", function(e) {
   if (e.target == canvas) {
     e.preventDefault();
   }
 }, false);
 document.body.addEventListener("touchmove", function(e) {
   if (e.target == canvas) {
     e.preventDefault();
   }
 }, false);

 (function drawLoop() {
   requestAnimFrame(drawLoop);
   renderCanvas();
 })();

 function clearCanvas() {
   canvas.width = canvas.width;
 }

 //Set up the UI
var sigText = document.getElementById("sig-dataUrl");
 var sigImage = document.getElementById("sig-image");
 var clearBtn = document.getElementById("sig-clearBtn");
 var submitBtn = document.getElementById("sig-submitBtn");
 clearBtn.addEventListener("click", function(e) {
   clearCanvas();
  //sigText.innerHTML = "Data URL for your signature will go here!";
sigImage.setAttribute("src", "");
}, false);
 submitBtn.addEventListener("click", function(e) {
  var dataUrl = canvas.toDataURL();
sigText.innerHTML = dataUrl;
   sigImage.setAttribute("src", dataUrl);
}, false);

})();

</script>
                        
</main>


<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
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
       
    </body>
</html>

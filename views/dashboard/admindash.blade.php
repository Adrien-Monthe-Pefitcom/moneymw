<!-- Data Table Css -->
<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.html">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">

@extends('layouts.dash')
    @section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Statut de L'utilisateur</h1>
        
        <!-- App Capsule -->
                    <div id="appCapsule">
                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-block">
                                    <div class="table-responsive dt-responsive">
                                        <table id="complex-header"
                                            class="table table-striped table-bordered nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr style="background: #efaa1e; color: white; text-align: center">
                                                    <th colspan="3">INFORMATIONS DU COMPTE</th>
                                                    <th>STATUT DU COMPTE</th>
                                                    <th>ACTIONS</th>
                                                </tr>
                                                <tr>
                                                    <th>PHONE</th>
                                                    <th>EMAIL</th>
                                                    <th>DATE CREATION</th>
                                                    <th>STATUT</th>
                                                    <th>ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at}}</td>
                                                    <td>{{ $user->statut}}</td>

                                                    <td>
                                                       <button type="button" class="default-btn prev-step"><a href="{{route('statut-update', ['id' => $user->id])}}">Verifier</a></button>
                                                        
                                                        
                                                    </td>
                                                    
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                    <th>PHONE</th>
                                                    <th>EMAIL</th>
                                                    <th>DATE CREATION</th>
                                                    <th>STATUT</th>
                                                    <th>ACTIONS</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                     </div>
                    </div>
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


<!-- data-table js -->
    <script src="{{ URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/data-table/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/data-table/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/data-table/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/data-table/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
</script>
                        
</main>


@endsection
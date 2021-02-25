@extends('layouts.dash')
    @section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Grille Tarifaire Money Maker</h1>
    </div>


    <div id="appCapsule" style="width: 60rem; margin: auto">
  
   
  <form role="form"  class="login-box">
         <div class="tab-pane" role="tabpanel" id="step4">
             <div class="all-info-container">
                 <div class="list-content">
                     <a href="#listone" data-toggle="collapse" aria-expanded="false" aria-controls="listone">Pour le Cameroun<i class="fa fa-chevron-down"></i></a>
                     <div class="collapse" id="listone">
                         <div class="list-box">
                            <div class="row">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 60rem; text-align: center; margin: auto;">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Montant (FCFA)</th>
                                                <th rowspan="2">Depot d'argent en espèce</th>
                                                <th rowspan="2">Retrait</th>
                                                <th rowspan="2" style="width: 8rem;">Tranfert (d'un compte Money Maker à un autre)</th>
                                                <th colspan="2"> Paiement en ligne</th>
                                            </tr>
                                            <tr>
                                                <th style="width: 8rem;">Interne (achat d'un pack à WE Finances par Money Maker)</th>
                                                <th style="width: 8rem;">Externe (achat en ligne)</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td>0 - 10 000</td>
                                                <td rowspan="14"><SPAN style="writing-mode: vertical-lr; transform: rotate(180deg);">GRATUIT</SPAN></td>
                                                <td>1.2%</td>
                                                <td rowspan="14"><SPAN style="writing-mode: vertical-lr; transform: rotate(180deg);">0.3%</SPAN></td>
                                                <td rowspan="14"><SPAN style="writing-mode: vertical-lr; transform: rotate(180deg);">0.3%</SPAN></td>
                                                <td rowspan="14"><SPAN style="writing-mode: vertical-lr; transform: rotate(180deg);">2%</SPAN></td>
                                            </tr>
                                            <tr>
                                                <td>10 001 - 20 000</td>
                                                <td>1.5%</td>                                                
                                            </tr>
                                            <tr>
                                                <td>20 001 - 35 000</td>
                                                <td>1.8%</td>
                                            </tr>
                                            <tr>
                                                <td>35 001 - 50 000</td>
                                                <td>800</td>
                                            </tr>
                                            <tr>
                                                <td>50 001 - 100 000</td>
                                                <td>1 200</td>
                                            </tr>
                                            <tr>
                                                <td>100 001 - 200 000</td>
                                                <td>1 700</td>
                                            </tr>
                                            <tr>
                                                <td>200 001 - 300 000</td>
                                                <td>2 100</td>
                                            </tr>
                                            <tr>
                                                <td>300 001 - 400 000</td>
                                                <td>2 700</td>
                                            </tr>
                                            <tr>
                                                <td>400 001 - 500 000</td>
                                                <td>3 100</td>
                                            </tr>
                                            <tr>
                                                <td>500 001 - 600 000</td>
                                                <td>3 300</td>
                                            </tr>
                                            <tr>
                                                <td>600 001 - 700 000</td>
                                                <td>3 900</td>
                                            </tr>
                                            <tr>
                                                <td>700 001 - 800 000</td>
                                                <td>4 300</td>
                                            </tr>
                                            <tr>
                                                <td>800 001 - 900 000</td>
                                                <td>4 400</td>
                                            </tr>
                                            <tr>
                                                <td>900 001 - 1 000 0000</td>
                                                <td>4 900</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                            </div>
                     </div>
                 </div>
  </form>
  <p></p>
  <form role="form" action="" class="login-box">
         <div class="tab-pane" role="tabpanel" id="step4">
             <div class="all-info-container">
                 <div class="list-content">
                     <a href="#listtwo" data-toggle="collapse" aria-expanded="false" aria-controls="listtwo">Pour l'Afrique<i class="fa fa-chevron-down"></i></a>
                     <div class="collapse" id="listtwo">
                         <div class="list-box">
                             <div class="row">
                                 
                                <table class="table table-bordered" id="dataTable" cellspacing="0" style=" text-align: center; margin: auto; width: 60rem;">
                                        <thead>
                                            <tr>
                                                <th style="width: 12rem;">Montant (FCFA)</th>
                                                <th style="width: 12rem;">Afrique de l'Ouest (Côte d'Ivoire; Mali; Niger; Sénégal; Togo)</th>  
                                                <th style="width: 12rem;">Afrique Centrale (Congo Brazaville; RCA; RDC; Tchad)</th>  
                                                <th style="width: 12rem;">Benin</th>  
                                                <th style="width: 12rem;">Guinée Equatoriale</th>                                                                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td>1 - 10 000</td>
                                                <td>800</td>
                                                <td>700</td>
                                                <td>1500</td>
                                                <td>700</td>
                                            </tr>
                                            <tr>
                                                <td>10 001 - 20 000</td>
                                                <td>900</td>
                                                <td>800</td>
                                                <td>1 800</td>
                                                <td>800</td>
                                            </tr>
                                            <tr>
                                                <td>20 001 - 35 000</td>
                                                <td>1 100</td>
                                                <td>900</td>
                                                <td>2 000</td>
                                                <td>900</td>
                                            </tr>
                                            <tr>
                                                <td>35 001 - 50 000</td>
                                                <td>1 800</td>
                                                <td>1 000</td>
                                                <td>3 000</td>
                                                <td>1 000</td>
                                            </tr>
                                            <tr>
                                                <td>50  001 - 100 000</td>
                                                <td>2 600</td>
                                                <td>2 000</td>
                                                <td>4 000</td>
                                                <td>2 000</td>
                                            </tr>
                                            <tr>
                                                <td>100 001 - 200 000</td>
                                                <td>4 500</td>
                                                <td>3 500</td>
                                                <td>10 000</td>
                                                <td>3 500</td>
                                            </tr>
                                            <tr>
                                                <td>200 001 - 300 000</td>
                                                <td>7 500</td>
                                                <td>4 500</td>
                                                <td>15 000</td>
                                                <td>4 500</td>
                                            </tr>
                                            <tr>
                                                <td>300 001 - 400 000</td>
                                                <td>9 500</td>
                                                <td>6 500</td>
                                                <td>25 000</td>
                                                <td>6 500</td>
                                            </tr>
                                            <tr>
                                                <td>400 001 - 500 000</td>
                                                <td>11 500</td>
                                                <td>7 500</td>
                                                <td>30 000</td>
                                                <td>7 500</td>
                                            </tr>
                                            <tr>
                                                <td>500 001 - 600 000</td>
                                                <td>15 000</td>
                                                <td>9 000</td>
                                                <td>50 000</td>
                                                <td>9 000</td>
                                            </tr>
                                            <tr>
                                                <td>600 001 - 700 000</td>
                                                <td>19 500</td>
                                                <td>10 500</td>
                                                <td>52 000</td>
                                                <td>10 500</td>
                                            </tr>
                                            <tr>
                                                <td>700 001 - 800 000</td>
                                                <td>20 500</td>
                                                <td>11 800</td>
                                                <td>55 000</td>
                                                <td>11 800</td>
                                            </tr>
                                            <tr>
                                                <td>800 001 - 900 000</td>
                                                <td>25 000</td>
                                                <td>13 500</td>
                                                <td>60 000</td>
                                                <td>13 500</td>
                                            </tr>
                                            <tr>
                                                <td>900 001 - 1 000 000</td>
                                                <td>28 000</td>
                                                <td>15 500</td>
                                                <td>75 000</td>
                                                <td>15 500</td>
                                            </tr>
                                                                               
                                            
                                        </tbody>
                                    </table>

                                 
                             
                         </div>
                     </div>
                 </div>
  </form>
  <p></p>
  <form role="form"  class="login-box">
         <div class="tab-pane" role="tabpanel" id="step4">
             <div class="all-info-container">
                 <div class="list-content">
                     <a href="#listthree" data-toggle="collapse" aria-expanded="false" aria-controls="listthree">A l'international<i class="fa fa-chevron-down"></i></a>
                     <div class="collapse" id="listthree">
                         <div class="list-box">
                             <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style=" text-align: center; margin: auto;">
                                        <thead>
                                            <tr>
                                                <th>Montant (FCFA)</th>
                                                <th>FRRANCE/BELGIQUE</th>                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td>0 - 14 999</td>
                                                <td>600</td>
                                            </tr>
                                            <tr>
                                                <td>15 000 - 59 999</td>
                                                <td>1 000</td>                                                
                                            </tr>
                                            <tr>
                                                <td>60 000 - 239 999</td>
                                                <td>1 300</td>
                                            </tr>
                                            <tr>
                                                <td>240 000 - 499 999</td>
                                                <td>2.5%</td>
                                            </tr>
                                            <tr>
                                                <td>500 000 - 1 000 000</td>
                                                <td>18 000</td>
                                            </tr>                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style=" text-align: center; margin: auto;">
                                        <thead>
                                            <tr>
                                                <th>Montant (FCFA)</th>
                                                <th>US/CANADA</th>                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td>0 - 14 999</td>
                                                <td>600</td>
                                            </tr>
                                            <tr>
                                                <td>15 000 - 59 999</td>
                                                <td>1 000</td>                                                
                                            </tr>
                                            <tr>
                                                <td>60 000 - 239 999</td>
                                                <td>1 500</td>
                                            </tr>
                                            <tr>
                                                <td>240 000 - 499 999</td>
                                                <td>2.2%</td>
                                            </tr>
                                            <tr>
                                                <td>500 000 - 1 000 000</td>
                                                <td>2.5%</td>
                                            </tr>                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12" style="margin-top: 3rem;">
                                    <table class="table table-bordered" id="dataTable" cellspacing="0" style=" text-align: center; margin: auto; width: 30rem;">
                                        <thead>
                                            <tr>
                                                <th>Montant (FCFA)</th>
                                                <th>INTERNATIONAL</th>                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td>0 - 60 000</td>
                                                <td>3 000</td>
                                            </tr>
                                            <tr>
                                                <td>60 001 - 120 000</td>
                                                <td>4 500</td>
                                            </tr>
                                            <tr>
                                                <td>120 001 - 190 000</td>
                                                <td>7 500</td>
                                            </tr>
                                            <tr>
                                                <td>190 001 - 250 000</td>
                                                <td>9 000</td>
                                            </tr>
                                            <tr>
                                                <td>250 001 - 300 000</td>
                                                <td>11 500</td>
                                            </tr>
                                            <tr>
                                                <td>300 001 - 395 000</td>
                                                <td>14 000</td>                                                
                                            </tr>
                                            <tr>
                                                <td>395 001 - 600 000</td>
                                                <td>15 000</td>
                                            </tr>
                                            <tr>
                                                <td>600 001 - 900 000</td>
                                                <td>20 000</td>
                                            </tr>
                                            <tr>
                                                <td>900 001 - 1 000 000</td>
                                                <td>24 000</td>
                                            </tr>                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                         </div>
                     </div>
                 </div>
  </form>
             
</div>

</main>



<style>
    tr:hover{
        background: #efaa1e;
        transition: 0.5s;
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






@endsection
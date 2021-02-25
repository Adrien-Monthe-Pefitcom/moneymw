@extends('layouts.dash')

@section('content')



<input  hidden name="balance" id="balance_1" value="{{Auth::user()->solde}}" >

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



@if (Session::has('success'))

<script type="text/javascript">

    swal({

        title:'Success!',

        text:"{{Session::get('success')}}",

        timer:5000,

        type:'success'

    }).then((value) => {

        //location.reload();

    }).catch(swal.noop);

</script>

@endif







@if(Session::has('fail'))

<script type="text/javascript">

    swal({

        title:'Oops!',

        text:"{{Session::get('fail')}}",

        type:'error',

        timer:5000

    }).then((value) => {

        //location.reload();

    }).catch(swal.noop);

</script>

@endif



<main>



    <div class="container-fluid">

        <h1 class="mt-4">Modifier Mot De passe</h1>

        <!-- App Capsule -->

        <div id="appCapsule">

            <div class="tab-pane" role="tabpanel" id="Part1">

                <h4 class="text-center"></h4>

                <div class="all-info-container">



                    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->

                    <form role="form" action="/new_pass" class="login-box">



                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Mot de passe Actuel</label>

                                    <input class="form-control" type="password" placeholder="Entrer Votre Mot de passe Actuel"  id="mdpa" name="mdpa">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Nouveau Mot de passe</label> <i class="far fa-eye" id="togglePassword" onclick="togglePasswordFieldClicked()"></i>

                                    <input class="form-control" type="password" placeholder="Entrer Votre Nouveau Mot de passe"  id="nmdp" name="nmdp">


                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Confirmer Mot de passe</label>

                                    <input class="form-control" type="password" placeholder="Confirmer Mot de passe"  id="cmdp" name="cmdp">



                                </div>

                            </div>

                        </div>

                        <div class="container">

                            <ul class="list-inline pull-right">

                                <li><input type="reset" id="" value="Annuler" class="btn" style="background: #424145; color: white "></li>

                                <li><input type="submit" value="Soummettre" class="btn" style="background:  #efaa1e; color: white"></li>

                            </ul>

                        </div>



                    </form>

                    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->



                </div>

            </div>

        </div>



    </div>



</main>







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



    .wizard .nav-tiabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {

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

        border-bottom-color: #ff0000;

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

        content: "TÃ©lÃ©charger";

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

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

            var target = $(e.target);

            if (target.parent().hasClass('disabled')) {

                return false;

            }

        });

    });

    //----------------------------------------------------------------------------------------

    $('.nav-tabs').on('click', 'li', function() {

        $('.nav-tabs li.active').removeClass('active');

        $(this).addClass('active');

    });

    //---------------------------------------------------------------------------------------

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

    })();

    //----------------------------------------------------------------------------------------

    $('#input_1').on('keyup', function(){

        if (this.value.length > 7) this.value = this.value.slice(0, 7);

        if (this.value < 10001) {

            $('#output_1').val($(this).val()*1.012);

        } else if (this.value < 20001) {

            $('#output_1').val($(this).val()*1.015);

            //alert($('#password').value);

        } else if (this.value < 35001) {

            $('#output_1').val($(this).val()*1.018);

        }else if (this.value < 50001) {

            $('#output_1').val(Number($(this).val())+800);

        } else if (this.value < 100001) {

            $('#output_1').val(Number($(this).val())+1200);

        } else if (this.value < 200001) {

            $('#output_1').val(Number($(this).val())+1500);

        } else if (this.value < 300001) {

            $('#output_1').val(Number($(this).val())+1700);

        } else if (this.value < 400001) {

            $('#output_1').val(Number($(this).val())+2100);

        } else if (this.value < 500001) {

            $('#output_1').val(Number($(this).val())+2700);

        } else if (this.value < 600001) {

            $('#output_1').val(Number($(this).val())+3300);

        } else if (this.value < 700001) {

            $('#output_1').val(Number($(this).val())+3900);

        } else if (this.value < 800001) {

            $('#output_1').val(Number($(this).val())+4300);

        } else if (this.value < 900001) {

            $('#output_1').val(Number($(this).val())+4400);

        } else {

            $('#output_1').val(Number($(this).val())+4900)

        }

    });

    //----------------------------------------------------------------------------------------



    //---------------------------------------------------------------------------------------

    $('#map').on('keyup', function(){



        $('#frais').val($(this).val()*0.03);



        if ($('#currency_destination').val() == 1) {

            $('#tmap').val($(this).val()*1.03*650);

        }

        else {

            if ($('#currency_destination').val() == 2) {

                $('#tmap').val($(this).val()*1.3*541);

            }

            else if ($('#currency_destination').val() == 4){

                $('#tmap').val($(this).val()*1.03*1);

            } else {

                $('#tmap').val($(this).val()*1.03*1);

            }

        }

        if ($('#tmap').val()>Number($('#balance_1'))){

            alert('yo')

        }

    });

    //----------------------------------------------------------------------------------------

    $('#currency_destination').on('change', function(){

        if($('#map').val()){



            $('#frais').val($('#map').val()*0.03);



            if ($('#currency_destination').val() == 1) {

                $('#tmap').val($('#map').val()*1.03*650);

            }

            else {

                if ($('#currency_destination').val() == 2) {

                    $('#tmap').val($('#map').val()*1.3*541);

                }

                else if ($('#currency_destination').val() == 4){

                    $('#tmap').val($('#map').val()*1.03*1);

                } else {

                    $('#tmap').val($('#map').val()*1.03*1);

                }

            }

        }

    });

    //------------------------------------------------------------------------------------------

    function limitText(field, maxChar){

        var ref = $(field),

            val = ref.val();

        if ( val.length >= maxChar ){

            ref.val(function() {

                console.log(val.substr(0, maxChar))

                return val.substr(0, maxChar);

            });

        }

    }



</script>

<script>
    function togglePasswordFieldClicked() {

        //  alert('hh');
        var passwordField = document.getElementById('nmdp');
        var value = passwordField.value;

        if(passwordField.type == 'password') {
            passwordField.type = 'text';
        }
        else {
            passwordField.type = 'password';
        }

        passwordField.value = value;

    }
</script>









@endsection


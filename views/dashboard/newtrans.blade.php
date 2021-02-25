@extends('layouts.dash')
@section('content')

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
        <h1 class="mt-4">Nouvelle Transaction</h1>
        <!-- App Capsule -->
        <div id="appCapsule">
            <div class="tab-pane" role="tabpanel" id="Part1">
                <h4 class="text-center">Renseignez tous les champs</h4>
                <div class="all-info-container">
                    <div class="list-content">
                        <a href="#listone" data-toggle="collapse" aria-expanded="false" aria-controls="listone">Depot par Mobile<i class="fa fa-chevron-down"></i></a>
                        <div class="collapse" id="listone">
                            <div class="list-box">
                                <form  action="add_transaction" method='get'>
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Compte Ã  DÃ©biter</label>
                                                <select class="form-control" id="mode" name="mode">
                                                    <option value='1'>MTN Mobile Money</option>
                                                    <option value='2'>Orange Money</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Numero de Telephone*</label>
                                                <input class="form-control" onkeyup="test()" type="number" id="tel1" name="tel1" placeholder="2376xxxxxxxx" placeholder="{{Auth::user()->phone}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Montant du depot *</label>
                                                <input class="form-control" type="number" id="amount1" name="amount1" placeholder="">
                                                <span id = "message" style="color:red"> </span>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mot de Passe *  <i class="fa fa-eye" id="togglePassword" onclick="togglePasswordFieldClicked()"></i></label>
                                                <input class="form-control" type="password" id="password1" name="password1" placeholder="" required>
                                                <span class="error_form" id="password_error_message"></span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="container">
                                        <ul class="list-inline pull-right">
                                            <li><input type="reset" id="" value="Annuler" class="btn" style="background: #424145; color: white "></li>
                                            <li><input type="submit" id="Submit-deposit-1" value="Soumettre" class="btn" style="background:  #efaa1e; color: white"></li>
                                        </ul>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- --------------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <div class="list-content">
                        <a href="#listzero" data-toggle="collapse" aria-expanded="false" aria-controls="listzero">Depot par Carte<i class="fa fa-chevron-down"></i></a>
                        <div class="collapse" id="listzero">
                            <div class="list-box">
                                <form  action="/add_transaction_card" method='get'>
                                    <div class="row">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Montant du depot *</label>
                                                <input class="form-control" type="number" id="amount2" name="amount1" placeholder="" required="true">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mot de Passe * <i class="fa fa-eye" id="togglePassword" onclick="togglePasswordFieldClicked2()"></i></label>
                                                <input class="form-control" type="password" id="password2" name="password1" placeholder="" required="true">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Numero de carte *</label>
                                                <input class="form-control" type="number" id="card_number" number="card_number" placeholder="" required="true">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Expiry Date</label>
                                                <input class="form-control" type="date" name="expiry_date" placeholder="" required="true">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>CVV</label>
                                                <input class="form-control" type="password" id="cvv" placeholder="" required="true">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6"><input type="submit" id="" value="Payer par Carte" class="btn form-control" style=" height: 3.4em !important; background:  black; color: white"></div>
                                        <script
                                            src="https://www.paypal.com/sdk/js?client-id=AUkon5KzDYqgEZMPmFaJe8BJyAFm0quehPYA_zOMtFQ9XqRJVR0JHwKroSxlKQ4EDC4xs1HexNd3Itxu&disable-funding=credit,card"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
                                        </script>

                                        <div class="col-md-6" id="paypal-button-container"></div>

                                        <script>
                                            paypal.Buttons().render('#paypal-button-container');
                                        </script>
                                    </div>



                                    <div class="container">
                                        <ul class="list-inline pull-right">
                                            <li><input type="reset" data-toggle="collapse" id="" value="Annuler" class="btn" style="background: #424145; color: white "></li>
                                        </ul>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                    <div class="tab-pane" role="tabpanel" id="step4">
                        <div class="all-info-container">
                            <div class="list-content">
                                <a href="#listtwo" data-toggle="collapse" aria-expanded="false" aria-controls="listtwo">Retrait <i class="fa fa-chevron-down"></i></a>
                                <div class="collapse" id="listtwo">
                                    <div class="list-box">
                                        <form role="form" action="/add_transaction_withdrawal" method='get'>
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Votre numÃ©ro Mobile Mobile</label>
                                                        <input class="form-control" type="number" name="tel1" placeholder="{{Auth::user()->phone}}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Montant Ã  retirer (XAF) *</label>
                                                        <input class="form-control" type="number" name="amount2" max="1000000" onkeyup="fee(this.value)" maxlength="10" id="input_1" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Total Ã  payer *</label>
                                                        <input class="form-control" type="number" step="0.01" name="amount1" id="output_1" placeholder="" disable="disable">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Mot de Passe * <i class="fa fa-eye" id="togglePassword" onclick="togglePasswordFieldClicked3()"></i></label>
                                                        <input class="form-control" type="password" id="password3" name="password" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <ul class="list-inline pull-right">
                                                    <li><input type="reset" id="" value="Annuler" class="btn" style="background: #424145; color: white "></li>
                                                    <li><input type="submit" id="Submit1" value="Soumettre" class="btn" style="background:  #efaa1e; color: white"></li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
                            <form role="form" action="/add_transaction_money_maker" class="login-box">
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="all-info-container">
                                        <div class="list-content">
                                            <a href="#listthree" data-toggle="collapse" aria-expanded="false" aria-controls="listthree">Envoyer de l'argent <i class="fa fa-chevron-down"></i></a>
                                            <div class="collapse" id="listthree">
                                                <div class="list-box">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>No Compte Du Destinataire</label>
                                                                <input class="form-control" type="text" placeholder="12345678910"  id="compte_dest" name="compte_dest">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Pays De Destination</label>
                                                                <select name="country_dest" class="form-control">
                                                                    @foreach($countries as $row)
                                                                    <option value={{$row['id']}}>{{$row['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Devises</label>
                                                                <select class="form-control" id="currency_destination" name="currency_dest">
                                                                    @foreach($currencies as $row)
                                                                    <option value={{$row['id']}}>{{$row['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Montant Ã  Transferer</label>
                                                                <input class="form-control" type="number" name="amount_trans"  placeholder="300000" id="map">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Frais de Transfert</label>
                                                                <input class="form-control" type="number" placeholder="recipient number" name="trans_fees" id="frais" disable>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Total Ã  payer FCFA</label>
                                                                <input class="form-control" type="number" name="total_trans" placeholder="" id="tmap" disable="true" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Mot de Passe * <i class="fa fa-eye" id="togglePassword" onclick="togglePasswordFieldClicked4()"></i></label>
                                                                <input class="form-control" type="password" id="password4" name="password" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Raison du transfert</label>
                                                                <textarea class="form-control"  name="des" placeholder="" id="bank_acc2" required > </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </form>
                            <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
                            <form role="form" action="/urecap" class="login-box">
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="all-info-container">
                                        <div class="list-content">
                                            <a href="#listto" data-toggle="collapse" aria-expanded="false" aria-controls="listto">Payer un produit/service <i class="fa fa-chevron-down"></i></a>
                                            <div class="collapse" id="listto">
                                                <div class="list-box">
                                                    <div class="row">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </form>

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

        $('#frais').val($(this).val()*0.003);

        if ($('#currency_destination').val() == 2) {
            $('#tmap').val($(this).val()*1.003*650);
        }
        else {
            if ($('#currency_destination').val() == 3) {
                $('#tmap').val($(this).val()*1.003*541);
            }
            else if ($('#currency_destination').val() == 4){
                $('#tmap').val($(this).val()*1.003*1);
            } else {
                $('#tmap').val($(this).val()*1.003*1);
            }
        }
        if ($('#tmap').val()>Number($('#balance_1'))){
            alert('yo')
        }
    });
    //----------------------------------------------------------------------------------------
    $('#currency_destination').on('change', function(){
        if($('#map').val()){

            $('#frais').val($('#map').val()*0.003);

            if ($('#currency_destination').val() == 2) {
                $('#tmap').val($('#map').val()*1.003*650);
            }
            else {
                if ($('#currency_destination').val() == 3) {
                    $('#tmap').val($('#map').val()*1.003*541);
                }
                else if ($('#currency_destination').val() == 4){
                    $('#tmap').val($('#map').val()*1.003*1);
                } else {
                    $('#tmap').val($('#map').val()*1.003*1);
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
    //-----------------------------------------------------------------------------------------

</script>

<script>
    function togglePasswordFieldClicked() {

        //  alert('hh');
        var passwordField = document.getElementById('password1');
        var value = passwordField.value;

        if(passwordField.type == 'password') {
            passwordField.type = 'text';
        }
        else {
            passwordField.type = 'password';
        }

        passwordField.value = value;

    }
    function togglePasswordFieldClicked2() {

        //  alert('hh');
        var passwordField = document.getElementById('password2');
        var value = passwordField.value;

        if(passwordField.type == 'password') {
            passwordField.type = 'text';
        }
        else {
            passwordField.type = 'password';
        }

        passwordField.value = value;

    }
    function togglePasswordFieldClicked3() {

        //  alert('hh');
        var passwordField = document.getElementById('password3');
        var value = passwordField.value;

        if(passwordField.type == 'password') {
            passwordField.type = 'text';
        }
        else {
            passwordField.type = 'password';
        }

        passwordField.value = value;

    }
    function togglePasswordFieldClicked4() {

        //  alert('hh');
        var passwordField = document.getElementById('password4');
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

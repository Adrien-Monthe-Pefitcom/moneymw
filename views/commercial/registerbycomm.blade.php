<!-- notify js Fremwork -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.brighttheme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.buttons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.history.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.mobile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/pages/pnotify/notify.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <style>
    .error_form {
        font-size: 15px;
        font-family: Arial;
        color: #FF0052;
    }
    </style>

   @extends('layouts.layout1')
   @section('content')

 <!-- App Capsule -->
 <div id="appCapsule">
   <div class="section mt-2 text-center">
     <h1>Très bien!</h1>
     <h4>Renseignez toutes les informations requises</h4>
     <h4 style="color: #efaa1e;">Veuillez valider votre signature et accepter les conditions d'utilisations pour la soumission du formulaire</h4>
   </div>
   
   @if(Session::has('message'))

    <div class="section mt-2 text-center">
        <button type="button" class="close"
            data-dismiss="alert" aria-label="Close">
            <i
                class="icofont icofont-close-line-circled"></i>
        </button>
        <p style="color:red; font-size: 2rem;"><strong>{{ Session::get('message') }}</p>
    </div>

    @endif
   
   <section class="signup-step-container">
       <div class="container">
           <div class="row d-flex justify-content-center">
               <div class="col-md-8">
                   <div class="wizard">
                       <div class="wizard-inner">
                           <div class="connecting-line"></div>
                           <ul class="nav nav-tabs" role="tablist">
                               <li role="presentation" class="active">
                                   <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Step 1</i></a>
                               </li>
                               <li role="presentation" class="disabled">
                                   <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Step 2</i></a>
                               </li>
                               <li role="presentation" class="disabled">
                                   <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Step 3</i></a>
                               </li>
                               <li role="presentation" class="disabled">
                                   <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Step 4</i></a>
                               </li>
                           </ul>
                       </div>
       
                       <form role="form" action="{{route('process-register-by-comm')}}" method="POST" id="msform" enctype="multipart/form-data" class="login-box">
                        @csrf
                           <div class="tab-content" id="main_form">
                               <div class="tab-pane active" role="tabpanel" id="step1">
                                   <h4 class="text-center">Vos informations de base</h4>
                                   <div class="row">
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label>Nom et Prenom*</label> 
                                               <input class="form-control" type="text" id ="name" name="name" placeholder=""> 
                                               <span class="error_form" id="name_error_message"></span> 
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label>Numero de telephone *</label> 
                                               <input class="form-control" type="tel" id ="tel" name="tel" placeholder=""> 
                                               <span class="error_form" id="phone_error_message"></span>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label>Adresse email *</label> 
                                               <input class="form-control" type="email" id="email" name="email" placeholder=""> 
                                               <span class="error_form" id="email_error_message"></span> 
                                           </div>
                                       </div>
                                       
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label>Mot de passe *(8caracteres) <i class="far fa-eye" id="togglePassword" onclick="togglePasswordFieldClicked()"></i> </label> 
                                               <input class="form-control" type="password" id="password" maxlength="8" minlength="8" name="password" placeholder="Exemple: Qweasd_1">
                                               
                                               <span class="error_form" id="password_error_message"></span>
                                               <label>(8 caracteres)Au moins une lettre majuscule, un chiffre, un caractere special et des minuscules</label>
                                           </div>
                                       </div>
                                       
                                       
                                   </div>
                                   <ul class="list-inline pull-right">
                                       <li><button type="button" class="default-btn" id="next1" style=" font-size: 13px; padding: 8px 24px; border: none; border-radius: 4px; margin-top: 30px; background-color: #efaa1e">Continue to next step</button></li>
                                   </ul>
                               </div>
                               <div class="tab-pane" role="tabpanel" id="step2">
                                   <h4 class="text-center">Informations complementaires 1</h4>
                                   <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Identifiant unique*(zone CEMAC)</label> 
                                           <input class="form-control" type="text" id="country_id" name="country_id" placeholder="" required> 
                                       </div>
                                   </div>
                                   
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Ville *</label> 
                                           <input class="form-control" type="text" id="town" name="town" placeholder=""> 
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Pays *</label> 
                                           <select name="country" class="country form-control" id="country">
                                               <option value="Cameroon" selected="selected">Cameroon</option>
                                               <option value="Afrique du Sud">Afrique du Sud</option>
                                               <option value="Algerie">Algerie</option>
                                               <option value="Tunisie">Tunisie</option>
                                               <option value="Nigeria">Nigeria</option>
                                               <option value="Mali">Mali</option>
                                               <option value="Togo">Togo</option>
                                               <option value="Burkina Faso">Burkina Faso</option>
                                               <option value="Canada">Canada</option>
                                               <option value="Usa">Usa</option>
                                               <option value="Cote d'ivoire">Cote d'ivoire</option>
                                               <option value="Maroc">Maroc</option>
                                               <option value="Ouganda">Ouganda</option>
                                               <option value="Afrique du sud">Afrique du sud</option>
                                               <option value="Italie">Italie</option>
                                               <option value="Allemagne">Allemagne</option>
                                               <option value="Portugal">Portugal</option>
                                               <option value="Belgique">Belgique</option>
                                               <option value="Ethiopie">Ethiopie</option>
                                               <option value="Mozambique">Mozambique</option>
                                           </select>
                                       </div>
                                   </div>
                                   
                                   
                                   
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Profession*</label> 
                                           <input class="form-control" type="text" id="profession" name="profession" placeholder=""> 
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                       <label>Type de compte *</label> 
                                           <select name="type_compte" class="type_compte form-control" id="type_compte">
                                               <option value="Compte Personnel" selected="selected">Compte Personnel</option>
                                               <option value="Compte Marchand">Compte Marchand</option>
                                           </select> 
                                       </div>
                                   </div>
                                  </div>

                                   
                                   
                                   <ul class="list-inline pull-right">
                                       <li><button type="button" class="default-btn prev-step">Back</button></li>
                                       <li><button type="button" class="default-btn" id="next2" style=" font-size: 13px; padding: 8px 24px; border: none; border-radius: 4px; margin-top: 30px; background-color: #efaa1e">Continue</button></li>
                                   </ul>

                               </div>

                               <div class="tab-pane" role="tabpanel" id="step3">
                                   <h4 class="text-center">Informations complementaire 2</h4>
                                    <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Date de naissance*</label> 
                                           <input class="form-control" type="date" id="dob" name="dob" max="2003-12-31" /> 
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Sexe*</label> 
                                           <select class="sexe form-control" name="sexe" id="sexe">
                                               <option value="Masculin">Masculin</option>
                                               <option value="Feminin">Feminin</option>
                                           </select> 
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Numero de compte Bancaire</label> 
                                           <input class="form-control" type="text" name="bank_acc" id="bank_acc" placeholder="" minlength="5"> 
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Nom de la banque</label> 
                                           <input class="form-control" type="text" name="bank_name" id="bank_name" placeholder="" minlength="2"> 
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Numero de passport/Cni*</label> 
                                           <input class="form-control" type="text" name="num_piece" id="num_piece" placeholder="" minlength="5"> 
                                       </div>
                                   </div>
                                                                     
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Scans Passeport/ Cni * (CNI Recto)</label> 
                                           <div class="custom-file">
                                             <input type="file" class=""  name="scan_piece_recto" style="width:359px" id="scan_piece_recto" accept="image/png, image/jpeg, image/jpg">
                                             <!-- <label class="custom-file-label" for="customFile">Select file</label> -->
                                             <br />
                                             <span class="error_form" id="scan_piece_recto_error_message"></span>
                                           </div>
                                       </div>                                        
                                   </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Scans Cni * (CNI Verso)</label> 
                                           <div class="custom-file">
                                             <input type="file" class="" name="scan_piece_verso" id="scan_piece_verso"  style="width:359px" accept="image/png, image/jpeg, image/jpg">
                                             <!-- <label class="custom-file-label" for="customFile">Select file</label> -->
                                             <br />
                                             <span class="error_form" id="scan_piece_verso_error_message"></span>
                                           </div>
                                       </div>                                        
                                   </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Votre photo 4x4 *</label> 
                                           <div class="custom-file">
                                             <input type="file"  class="" name="photo" id="photo" style="width:359px"  accept="image/png, image/jpeg, image/jpg">
                                            <!--  <label class="custom-file-label" for="customFile">Select file</label> -->
                                            <br />
                                            <span class="error_form" id="photo_error_message"></span>
                                           </div>
                                       </div>                                        
                                   </div>                                  
                                   </div>
                                      
                                   <ul class="list-inline pull-right">
                                       <li><button type="button" class="default-btn prev-step">Back</button></li>
                                       <li><button type="button" class="default-btn" id="next3" style=" font-size: 13px; padding: 8px 24px; border: none; border-radius: 4px; margin-top: 30px; background-color: #efaa1e">Continue</button></li>
                                   </ul>
                               </div>                              
                               
<!-- -----------------------------------------------Verification des Données ---------------------------------------------------------------- -->
                               <div class="tab-pane" role="tabpanel" id="step4">
                                   <h4 class="text-center">Verifiez vos informations</h4>
                                   <div class="all-info-container">
                                       <div class="list-content">
                                           <a href="#listone" data-toggle="collapse" aria-expanded="false" aria-controls="listone">Vos informations de base <i class="fa fa-chevron-down"></i></a>
                                           <div class="collapse" id="listone">
                                               <div class="list-box">
                                                   <div class="row">
                                                       
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>First and Last Name *</label> 
                                                               <input class="form-control" type="text"id="name2" name="name2" placeholder="" disabled="disabled"> 
                                                           </div>
                                                       </div>
                                                       
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Phone Number *</label> 
                                                               <input class="form-control" type="text" id="tel2" name="tel" placeholder="" disabled="disabled"> 
                                                           </div>
                                                       </div>

                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Email *</label> 
                                                               <input class="form-control" type="email" id="email2" placeholder="" disabled="disabled"> 
                                                           </div>
                                                       </div>

                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Mot de Passe *</label> 
                                                               <input class="form-control" type="password" id="password2" placeholder="" disabled="true"> 
                                                           </div>
                                                       </div>
                                                       
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="list-content">
                                           <a href="#listtwo" data-toggle="collapse" aria-expanded="false" aria-controls="listtwo">Informations complementaires 1 <i class="fa fa-chevron-down"></i></a>
                                           <div class="collapse" id="listtwo">
                                               <div class="list-box">
                                                   <div class="row">
                                                       
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Identifiant Unique du pays</label> 
                                                               <input class="form-control" type="text" id="country_id2" placeholder="" disabled="true"> 
                                                           </div>
                                                       </div>
                                                       
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>ville</label> 
                                                               <input class="form-control" type="text" name="town2" id="town2" placeholder="" disabled="true"> 
                                                           </div>
                                                       </div>
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Pays</label> 
                                                               <input class="form-control" type="text" id="country2" disabled="true">
                                                           </div>
                                                       </div>
                                                       
                                                       
                                                       
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Profession</label> 
                                                               <input class="form-control" type="text" name="profession2" id="profession2" placeholder="" disabled="true"> 
                                                           </div>
                                                       </div>
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Type de Compte</label> 
                                                               <input class="form-control" type="text" name="type_compte2" id="type_compte2" placeholder="" disabled="true"> 
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="list-content">
                                           <a href="#listthree" data-toggle="collapse" aria-expanded="false" aria-controls="listthree">Information Complementaire 2 <i class="fa fa-chevron-down"></i></a>
                                           <div class="collapse" id="listthree">
                                               <div class="list-box">
                                                   <div class="row">
                                                       
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Date de Naissance</label> 
                                                               <input class="form-control" type="date" placeholder="" id="dob2" disabled="true"> 
                                                           </div>
                                                       </div>
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Sexe</label> 
                                                                <input class="form-control" type="text" id="sexe2" disabled="true">
                                                            </div>
                                                        </div>

                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Numero de compte bancaire</label> 
                                                               <input class="form-control" type="text" name="bank_acc2" placeholder="" id="bank_acc2" disabled="true"> 
                                                           </div>
                                                       </div>
                                                       
                                                       
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Numero de passport/ Cni</label> 
                                                               <input class="form-control" type="text" name="num_piece2" id="num_piece2" placeholder="" disabled="true"> 
                                                           </div>
                                                       </div>

                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Nom de la Banque</label> 
                                                               <input class="form-control" type="text" name="bank_name" id="bank_name2" placeholder="" disabled="true"> 
                                                           </div>
                                                       </div>

                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label>Copie de CNI / Passeport</label> 
                                                               <img src=""> 
                                                           </div>
                                                       </div>
                                                       
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="container">
                                        <div class="row">
                                            <input type="button" id="sign" name ="signature" data-toggle="modal" data-target="#myModal" style="background: #efaa1e; color: white;" value="Signature" class="btn" style="background: #747c7c; color: white ">
                                        </div>
                                        <!-- <div class="row">
                                                <div class="col-md-12" style="align-text: right; ">
                                                    <canvas id="sig-canvas" width="620" height="160">
                                                        Please, update your browser and try again.
                                                    </canvas>
                                                    <div class="row">
                                                <div class="col-md-12">
                                                    
                                                    <input type="button" id="sig-submitBtn" name ="valider" style="background: #efaa1e; color: white;" value="valider la Signature" class="btn" style="background: #747c7c; color: white ">
                                                    <input type="button" id="sig-clearBtn" name ="cancel" id="sig-clearBtn" value="Annuler la Signature" class="btn" style="background: #747c7c; color: white "><br><br>
                                                </div>
                                        </div>-->
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea id="sig-dataUrl" class="form-control" style="display:none;" rows="5">Data URL for your signature will go here!</textarea>
                                                <input class="form-control" type="hidden" name="num_compte" id="numcompte" placeholder="">
                                                <input class="form-control" type="hidden" name="signature" id="signature" placeholder="">
                                                <input class="form-control" type="hidden" name="phone_number" id="phone_number" placeholder="">
                                                <input class="form-control" type="hidden" name="identifiant" id="identifiant" placeholder="">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Votre Signature</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    
                                                </div>
                                                <div class="modal-body">
                                                    <canvas id="sig-canvas" width="455" height="160">
                                                        Please, update your browser and try again.
                                                    </canvas>
                                                    <input type="button" id="sig-submitBtn" name ="valider" style="background: #efaa1e; color: white;" value="valider la Signature" class="btn" style="background: #747c7c; color: white ">
                                                            <input type="button" id="sig-clearBtn" name ="cancel" id="sig-clearBtn" value="Annuler la Signature" class="btn" style="background: #747c7c; color: white "><br><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row" hidden>                                            
                                        <div class="col-md-12">
                                            <img id="sig-image" src="" alt="Your signature will go here!"/>
                                        </div>
                                    </div>
                                        
                                        <input type="checkbox" name="accepted" id="conditions" value="accepted">J'ai lu et j'accepte les <a href="/tos" target="_blank">Conditions Générales du Service Money Maker en ligne </a>

                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn prev-step">Back</button></li>
                                        <li><input type="reset" id="cancel2" name ="cancel_save" value="Annuler l'enregistrement" class="btn" style="background: #424145; color: white "></li> 
                                        <li><input type="submit" value="M'enregistrer" id="btn-submit" name="regist" class="btn" style="background: #efaa1e; color: white;"></li>                                       
                                    </ul>
                                </div>
                            </div>
                            
                        </form>
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

    $('#btn-submit').attr("disabled", true);

    var teleph = document.getElementById("tel");
    var iti = intlTelInput(teleph, {
        initialCountry: "cm",
        separateDialCode: "true",
        geoIpLookup: function(success, failure) {
            $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "cm";
            success(countryCode);
            });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js?1590403638580",
    // any initialisation options go here
        });
        // alert(iti.getNumber());
        

        $('#phone_number').val(iti.getNumber());

    var checkBox = document.getElementById("conditions");

    $('#conditions').change(function() {
        $('#phone_number').val(iti.getNumber());
        // alert($('#phone_number').val());
        if($('#sig-dataUrl').val() == "Data URL for your signature will go here!" || $('#country_id').val() == "" || $('#num_piece').val() == "" ) {
            new PNotify({
            title: 'Champs vides',
            text: 'Veuillez valider votre signature et/ou champs',
            icon: 'icofont icofont-info-square',
            delay: 1500,
            type: 'error'
        });
        return;
        } else {
            if(checkBox.checked == true)
            $('#btn-submit').removeAttr('disabled');
        }
    });

    if($('#signature').val() != null && checkBox.checked == true) {
        $('#btn-submit').removeAttr('disabled');
    } 

    $('#bank_name').change(function () {
        $('#phone_number').val(iti.getNumber());
        $('#btn-submit').removeAttr('disabled');
   });

   // gestion de l'idebtifiant unique pour zone cemac
   $("#next2").on('click', function() {

        var errors2 = [];
        var listeCemac = ["+237", "+236", "+235", "+242", "+241", "+240"]

        let numero = iti.getNumber();
        let indicatif = numero.substring(0, 4);
        /*alert('gg'+ numero);
        alert('test'+ indicatif);
        alert(listeCemac[1]);*/

        for(let i = 0; i < listeCemac.length; i++ ){
            if(indicatif == listeCemac[i]){
                if($("#country_id").val() == ""){
                    errors2.push($(this).attr("name")); 
                    $("#identifiant").val("erreur");
                } else {
                    $("#identifiant").val("valide");
                }
            } else if(indicatif != "+235" && indicatif != "+236" && indicatif != "+237" && indicatif != "+240" && indicatif != "+241" && indicatif != "+242") {
                    $("#identifiant").val("valide");
                }
        // alert(listeCemac[i]);
        }

        /*if($("#country_id").val() == ""){
            errors2.push($(this).attr("name")); 
        }*/

        // alert($("#identifiant").val());
        if (errors2.length > 0) {
            new PNotify({
                title: 'Champs vides',
                text: 'Erreur remplissez votre identifiant unique',
                icon: 'icofont icofont-info-square',
                delay: 1500,
                type: 'error'
            });
            return;
        }
        });
    /*var checkBox = document.getElementById("conditions");

    if(checkBox.checked == true) {
        $('#btn-submit').removeAttr('disabled');
        new PNotify({
        title: 'Champs vides',
        text: 'Veuillez consulter et accepter nos conditions d\'utilisations',
        icon: 'icofont icofont-info-square',
        delay: 1500,
        type: 'error'
      });
      return;
    }*/
    let pays = $(".country").val();
    let sexe = $(".sexe").val();
    let type_compte = $(".type_compte").val();
    $("#country2").val(pays);
    $("#sexe2").val(sexe);
    $("#type_compte2").val(type_compte);


   $('.nav-tabs > li a[title]').tooltip();
   
   //Wizard
   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

       var target = $(e.target);
   
       if (target.parent().hasClass('disabled')) {
           return false;
       }
   });

   $("#next1").click(function (e) {

    var errors = [];
    /*var teleph = document.getElementById("tel");
    var iti = intlTelInput(teleph, {
        
        separateDialCode: "true",
        geoIpLookup: function(success, failure) {
            $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "cm";
            success(countryCode);
            });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js?1590403638580",
    // any initialisation options go here
        });*/
        
        
        

    $("#step1")
    .find("input")
    .each(function() {
        $(this).css("border", "1px solid #ccc");
        if($(this).val() == "" || $(this).val() == null) {
            $(this).css("border", "1px solid #f77575");
            errors.push($(this).attr("name")); 
        }
       
    });

    if (error_password == true){
        errors.push("erreur"); 
    }            
    
    if (error_email == true){
        errors.push("erreur"); 
    }

    if (errors.length > 0) {
		new PNotify({
			title: 'Champs vides',
			text: 'Erreur remplissez tous vos champs importants',
			icon: 'icofont icofont-info-square',
            delay: 1500,
			type: 'error'
		});
		return;
        }
        
      
    if(errors.length == 0) {
       var active = $('.wizard .nav-tabs li.active');
       active.next().removeClass('disabled');
       nextTab(active);
    }

    

   });
   $("#next2").click(function (e) {

var errors2 = [];

$("#step2")
.find("input")
.each(function() {
    $(this).css("border", "1px solid #ccc");
    if($(this).val() == "" || $(this).val() == null) {
        
        if($(this).attr("name") != "country_id"){
            $(this).css("border", "1px solid #f77575");
            errors2.push($(this).attr("name")); 
        }
    }

});

        if($("#identifiant").val() == "erreur"){
            errors2.push("erreur"); 
        }


if (errors2.length > 0) {
    new PNotify({
        title: 'Champs vides',
        text: 'Erreur remplissez tous vos champs importants',
        icon: 'icofont icofont-info-square',
        delay: 1500,
        type: 'error'
    });
    return;
    }
    
  
if(errors2.length == 0) {
   var active = $('.wizard .nav-tabs li.active');
   active.next().removeClass('disabled');
   nextTab(active);
}

$("#next3").click(function (e) {

var errors3 = [];

$("#step3")
.find("input")
.each(function() {
    $(this).css("border", "1px solid #ccc");
    if($(this).val() == "" || $(this).val() == null) {
        
        if($(this).attr("name") != "bank_acc" && $(this).attr("name") != "parrain" && $(this).attr("name") != "bank_name"){
            $(this).css("border", "1px solid #f77575");
            errors3.push($(this).attr("name"));
            // console.log("1 "+$(this).attr("name"));
          }
    }
   
}); 

    if (error_scan_recto == true){
        errors3.push("erreur"); 
    }        
    
    if (error_scan_verso == true){
        errors3.push("erreur"); 
    }

    if (error_photo == true){
        errors3.push("erreur"); 
    } 

    /*if (errors3.length > 0) {
        console.log(errors3.length)
        new PNotify({
        title: 'Champs vides',
        text: 'Erreur remplissez tous vos champs importants',
        icon: 'icofont icofont-info-square',
        delay: 1500,
        type: 'error'
    });
    return;
    }*/
    
  
if(errors3.length == 0) {
   var active = $('.wizard .nav-tabs li.active');
   active.next().removeClass('disabled');
   nextTab(active);
}



});

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
       $src10 = $('#num_piece'),
       $dst10 = $('#num_piece2'),
       $src12 = $('#scan_piece'),
       $dst12 = $('#scan_piece2'),
       $src14 = $('#bank_name'),
       $dst14 = $('#bank_name2'),
       $src15 = $('#referee'),
       $dst15 = $('#referee2'),
       $src16 = $('#bank_acc'),
       $dst16 = $('#bank_acc2'),
       $src17 = $('#sexe'),
       $dst17 = $('#sexe2'),
       $src18 = $('#numcompte'),
       $src19 = $('#signature');
       $src20 = $('#type_compte'),
       $dst20 = $('#type_compte2'),
       $src21 = $('#signature_image');

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
       $dst7.val($(".country").val());
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
   $src12.on('input', function () {
       $dst12.val($src12.val());
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

   $src17.on('input', function () {
       $dst17.val($src17.val());
   });

   $src20.on('input', function () {
       $dst20.val($(".type_compte").val());
       
   });

   $('#sig-submitBtn').on('click', function() {

    // alert($('#sig-dataUrl').val());
    
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

let num = Math.floor(Math.random() *(90100000100 - 10100000100) + 90100000100);
    $('#numcompte').val(num);

    // url signature
    $('#signature').val($('#sig-dataUrl').val());
   
    // alert("compte "+ $('#numcompte').val());
    // alert("signature "+ $('#signature').val());
var checkBox = document.getElementById("conditions");

    if(checkBox.checked == false) {
        new PNotify({
        title: 'Conditions d\'utilisations',
        text: 'Veuillez consulter et accepter nos conditions d\'utilisations',
        icon: 'icofont icofont-info-square',
        delay: 1500,
        type: 'error'
      });
      return; 
    }

    if($('#country_id').val() == "" || $('#num_piece').val() == "") {
        new PNotify({
        title: 'Champs vides',
        text: 'Veuillez remplir tout vos champs',
        icon: 'icofont icofont-info-square',
        delay: 1500,
        type: 'error'
      });
      return; 
    }

    sigImage.setAttribute("src", dataUrl);
}, false);

})();


</script>
<script>
    function togglePasswordFieldClicked() {

       //  alert('hh');
    var passwordField = document.getElementById('password');
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

<script type="text/javascript" src="{{ URL::asset('complement/register.js') }}"></script>
<script src="{{ URL::asset('assets/js/intltelinput.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.desktop.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.buttons.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.confirm.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.callbacks.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.animate.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.history.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.mobile.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.nonblock.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js" integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw==" crossorigin="anonymous"></script>
@endsection


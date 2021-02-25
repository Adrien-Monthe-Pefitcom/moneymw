
   @extends('layouts.layout1')
   @section('content')

   <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.brighttheme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.buttons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.history.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/pnotify/dist/pnotify.mobile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/pages/pnotify/notify.css')}}">
 <!-- App Capsule -->
 <div id="appCapsule">
   <div class="section mt-2 text-center">
     <h1>Bienvenue !!</h1>
     <h4>Remplissez la fiche signalitique de votre Business</h4>
   </div>
   
</div>
<div class="row form">
    <div class="col-md-6 form">
        <form onsubmit="return SignUp()" id="marchandform">
            <div class="form-group">
                <label for="nom_business">Nom de votre Business *</label>
                <input type="text" class="form-control" id="nom_business" aria-describedby="emailHelp" name="name" placeholder="">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="raison_sociale">Raison Sociale *</label>
                <input type="text" class="form-control" id="raison_sociale" aria-describedby="emailHelp" name="raison" placeholder="">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="formejuri">Forme Juridique</label>
                <select class="forme form-control" id="formejuri" name="formejuri">
                    <option value="SCS">SCS</option>
                    <option value="SNC">SNC</option>
                    <option value="SARL">SARL</option>
                    <option value="SA">SA</option>
                    <option value="SAS">SAS</option>
                    <option value="GIE">GIE</option>
                    <option value="SCS">SCS</option>
                    <option value="SEP">SEP</option>
                    <option value="SCP">SCP</option>
                    <option value="SCI">SCI</option>
                </select>
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="date_creation">Date de Création de votre activité</label>
                <input type="date" class="form-control" id="date_creation" aria-describedby="emailHelp" name="date">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="nom_gerant">Nom du Gerant *</label>
                <select class="nom_gerant form-control"  name="nom_gerant">
                        @foreach($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endforeach
                </select>
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="email">Adresse E-mail*</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="contact">Numero à contacter *</label>
                <input type="number" class="form-control" id="contact" aria-describedby="emailHelp" placeholder="contact dirigeant" name="contactDiri"> 
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse du siege ou du local *</label>
                <input type="text" class="form-control" id="adresse" aria-describedby="emailHelp" placeholder="" name="location">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="phone">Téléphone du business *</label>
                <input type="number" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="" name="tel">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="siteiternet">Site internet</label>
                <input type="text" class="form-control" id="siteiternet" aria-describedby="emailHelp" placeholder="" name="web">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="activites">Activités de Votre business *</label>
                <input type="text" class="form-control" id="activites" aria-describedby="emailHelp" placeholder="" name="activites">
                <small id="emailHelp" class="form-text text-muted">services et produits</small>
            </div>
            <ul class="list-inline pull-right">
                <li><input type="reset" id="cancel2" name ="cancel_save" value="Annuler" class="btn" style="background: #424145; color: white "></li> 
                <li><input type="submit" value="Valider" name="regist" id="btn-submit" class="btn" style="background: #efaa1e; color: white;"></li>                                       
            </ul>
            
    </form>
    </div>
    <div class="col-md-6">
        <img src="/complement/assets/img/bus.jpg">
    </div>
</div>
<div class="row">
</div>

<style>
    .form{
        padding-left: 5rem;
    }
</style>

<script>
function SignUp(){
    event.preventDefault();
    PNotify.removeAll();
    var info = {};
    var errors = [];
      $("#marchandform")
      .find("input")
      .each(function() {
        $(this).css("border", "1px solid #ccc");
        if ($(this).val() == "" || $(this).val() == null) {
          $(this).css("border", "1px solid #f77575");
          errors.push($(this).attr("name"));
          console.log($(this).attr("name"));
        }
        info[$(this).attr("name")] = $(this).val();
      });
    if (errors.length > 0) {
      new PNotify({
        title: 'Champs vides',
        text: 'Erreur remplissez tous vos champs importants',
        icon: 'icofont icofont-info-square',
        type: 'error'
      });
      return;
    }

    // nom_gerant
    if($('.nom_gerant').val() == null) {
        errors.push($('.nom_gerant').val());
    } else {
        info["nom_gerant"] = $('.nom_gerant').val();
    }

    // forme
    if($('.forme').val() == null) {
        errors.push($('.forme').val());
    } else {
        info["forme"] = $('.forme').val();
    }
    // num compte marchant
    let nummarchantcomm = Math.floor(Math.random() *(90100000100 - 10100000100) + 90100000100);
    // $('#numcompte_comm').val(numcomm);

    info["num_marchant"] = nummarchantcomm;

    console.log(info);

    login(info);

}

function login(info) {
    $.ajax({

        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },

        type:'POST',

        data:info,

        url: '{{route('process-marchant-by-comm')}}',

        success:function(response){
             $("#btn-submit").removeClass("disabled");


            if(response.status=='success'){
                new PNotify({
                    text: response.message,
                    icon: 'icofont icofont-info-square',
                    animate_speed: 'fast',
                    type: 'info'
                });
                setTimeout(()=>{
                    window.location.href="{{route('liste-comptes')}}";
                  }, 1000);
            }

            if(response.status=='info'){
                new PNotify({
                    text: response.message,
                    icon: 'icofont icofont-info-square',
                    animate_speed: 'fast',
                    type: 'info'
                });
            }

        },

        error:function(response){
            $("#btn-submit").removeClass("disabled");
                new PNotify({
                    text: 'Error occurred , try again later',
                    icon: 'icofont icofont-info-square',
                    animate_speed: 'fast',
                    type: 'info'
                });
        }

    });
}

</script>
<script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.desktop.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.buttons.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.confirm.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.callbacks.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.animate.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.history.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.mobile.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bower_components/pnotify/dist/pnotify.nonblock.js')}}"></script>

@endsection
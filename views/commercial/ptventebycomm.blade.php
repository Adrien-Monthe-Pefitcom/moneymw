
   @extends('layouts.dash')
   @section('content')

 <!-- App Capsule -->
 <div id="appCapsule">
   <div class="section mt-2 text-center">
     <h1>Nouveau Point de Vente</h1>
     <h4>Terminer le processus d'enregistrement</h4>
   </div>
   
</div>
<div class="row form">
    <div class="col-md-6 form">
        <form method="POST"><!--  action="{{route('storeptvente')}}"-->
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Candidature par: *</label>
                
                <select name="owner" class="form-control">
                    @foreach($ptventes as $ptvente)
                        <option value="{{$ptvente->no_compte_carte_virtuelle}}">{{$ptvente->name}}</option>
                    @endforeach
                </select>
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Numero d'enregistrement RCCM *</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rccm" placeholder="">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Copie RCCM *</label>
                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="copieRccm" placeholder="">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Copie carte de contribuable</label>
                <input type="file" class="form-control" name="contribuable">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Copie non redevance</label>
                <input type="file" class="form-control"  name="copieRedevance">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Localisation Point de Vente *</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="API Geolocalisation" name="localisation">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>            
            <ul class="list-inline pull-right">
                <li><input type="reset" id="cancel2" name ="cancel_save" value="Annuler" class="btn" style="background: #424145; color: white "></li> 
                <li><input type="submit" value="Valider" name="regist" class="btn" style="background: #efaa1e; color: white;"></li>                                       
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
    let numptvente = Math.floor(Math.random() *(90100000100 - 10100000100) + 90100000100);
    // $('#num_ptvente').val(numptvente);
</script>
@endsection;
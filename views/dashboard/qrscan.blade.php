@extends('layouts.dash')
   @section('content')
<main>
 <!-- App Capsule -->
 <div id="appCapsule">
   <div class="section mt-2 text-center">
     <h1>SCANNER LE QR CODE</h1>
     <h4>Remplissez la fiche signalitique de votre Bussiness</h4>
   </div>
   
</div>
<div class="row form">
    <div class="col-md-4">
        <div class="card card-1">
        {!! QrCode::size(300)
             ->color(239, 170, 30)
             ->generate(Auth::user()->no_compte_carte_virtuelle); !!}
        </div>
        <form method="POST" action="">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Numero de compte du Marchant *</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>            
            <div class="form-group">
                <label for="exampleInputEmail1">Pays du Marchant</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="placer le nom de l'utilisateur inscrit" name="gerant">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Montant</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="placer le nom de l'utilisateur inscrit" name="gerant">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Devise</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="placer le nom de l'utilisateur inscrit" name="gerant">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Frais</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="placer le nom de l'utilisateur inscrit" name="gerant">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Montant</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="placer le nom de l'utilisateur inscrit" name="gerant">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Total à Payer</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="placer le nom de l'utilisateur inscrit" name="gerant">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            
           
            <ul class="list-inline pull-right">
                <li><input type="reset" id="cancel2" name ="cancel_save" value="Annuler" class="btn" style="background: #424145; color: white "></li> 
                <li><input type="submit" value="Valider" name="regist" class="btn" style="background: #efaa1e; color: white;"></li>                                       
            </ul>
    </form>
    </div>
    <div class="col-md-6 form">
        <form>
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Nom de votre Business *</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>            
            <div class="form-group">
                <label for="exampleInputEmail1">Nom du Gerant *</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="placer le nom de l'utilisateur inscrit" name="gerant">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Adresse du siege ou du local *</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="location">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Téléphone du business *</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="tel">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Site internet</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="web">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Activités de Votre business *</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="activités">
                <small id="emailHelp" class="form-text text-muted">services et produits</small>
            </div>
    </form>
    </div>
</div>
<div class="row">
</div>

<style>
    .form{
        padding-left: 5rem;
    }
    .card-1:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}
.card {
  background: #fff;
  border-radius: 2px;
  display: inline-block;
  height: 300px;
  margin: 1rem;
  position: relative;
  width: 300px;
}
</style>
    
</main>

   @endsection
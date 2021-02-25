
    @extends('layouts.dash')
    @section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Compte et Parametres</h1>
        @if(Session::has('message'))

      <div class="section mt-2 text-center">
          <p style="color: #efaa1e; font-size: 2rem;"><strong>{{ Session::get('message') }}</p>
      </div>

      @endif
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard/Compte et Parametres</li>
        </ol>
        <div>
            <div>
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                Numero de compte:
                                <p style = 'color : #efaa1e; font-weight : bold;'>{{!empty(Auth::user()->no_compte_carte_virtuelle) ? Auth::user()->no_compte_carte_virtuelle : 'Nous vous creons votre compte'}}</p>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Telephone:
                                <p>{{!empty(Auth::user()->phone) ? Auth::user()->phone : 'Votre numero de telephone'}}</p>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Email:
                                <p>{{!empty(Auth::user()->email) ? Auth::user()->email : 'Votre numero de telephone'}}</p>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="card-body row" >
                        <div class="col-md-4">
                                <img  style="width: 100px; border-radius: 200px;" src="{{asset('photos/'. Auth::user()->photo)}}">
                                <span>{{!empty(Auth::user()->name) ? Auth::user()->name : 'Entrez votre nom'}}</span><br>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>FCFA {{Auth::user()->solde}}
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-birthday-cake" aria-hidden="true"></i>{{!empty(Auth::user()->date_naissance) ? Auth::user()->date_naissance : 'Votre numero date de naissance'}}
                        </div>
                        <!-- <div class="col-md-3">
                            <button class="btn btn-success">Telecharger le rapport d'activité</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 design">
    <form role="form" action="/profilupdate" id="msform" enctype="multipart/form-data" class="login-box">
        <div class="tab-pane" role="tabpanel" id="step4">
            <h4 class="text-center">Mise à  jour de vos informations</h4>
            <div class="all-info-container">
                <div class="list-content">
                    <a href="#listone" data-toggle="collapse" aria-expanded="false" aria-controls="listone">Vos informations de base <i class="fa fa-chevron-down"></i></a>
                    <div class="collapse" id="listone">
                        <div class="list-box">
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First and Last Name *</label> 
                                        <input class="form-control" type="text"  name="nom" placeholder="" value="{{!empty(Auth::user()->name) ? Auth::user()->name : 'Entrez votre nom'}}"> 
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telephone *</label> 
                                        <input class="form-control" type="text" name="tel" placeholder="" value="{{!empty(Auth::user()->phone) ? Auth::user()->phone : ''}}" > 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email *</label> 
                                        <input class="form-control" type="email" name="email" placeholder="" value="{{!empty(Auth::user()->email) ? Auth::user()->email : ''}}"> 
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
                                        <input class="form-control" type="text" placeholder=""  name="country_id" value="{{!empty(Auth::user()->identifiant_unique) ? Auth::user()->identifiant_unique : ''}}"> 
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ville</label> 
                                        <input class="form-control" type="text" name="ville" placeholder="" value="{{!empty(Auth::user()->ville) ? Auth::user()->ville : ''}}"> 
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pays Choisi</label> 
                                        <input class="form-control" type="text" name="pays" placeholder="" value="{{!empty(Auth::user()->pays) ? Auth::user()->pays : ''}}" > 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Profession</label> 
                                        <input class="form-control" type="text" name="profession" placeholder="" value="{{!empty(Auth::user()->profession) ? Auth::user()->profession : ''}}"> 
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
                                        <input class="form-control" type="date" placeholder="" name="dob" value="{{!empty(Auth::user()->date_naissance) ? Auth::user()->date_naissance : ''}}"> 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numero de compte bancaire</label> 
                                        <input class="form-control" type="text" name="num_compte" placeholder="" value="{{!empty(Auth::user()->num_compte_bancaire) ? Auth::user()->num_compte_bancaire : ''}}"> 
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numero de la piece</label> 
                                        <input class="form-control" type="text" name="num_piece" placeholder="" value="{{!empty(Auth::user()->num_piece) ? Auth::user()->num_piece : ''}}"> 
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom de la Banque</label> 
                                        <input class="form-control" type="text" name="nom_bank" placeholder="" value="{{!empty(Auth::user()->nom_banque) ? Auth::user()->nom_banque : ''}}"> 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Referé par</label> 
                                        <input class="form-control" type="text" name="refere_par" disabled="true" placeholder="" value="{{!empty(Auth::user()->refere_par) ? Auth::user()->refere_par : ''}}"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Statut</label> 
                                        <input class="form-control" type="text" name="statut" disabled="true" placeholder="" value="{{!empty(Auth::user()->statut) ? Auth::user()->statut : ''}}"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Copie Piece(Recto)/Passeport</label> 
                                        <img src="{{asset('scan_piece/'. Auth::user()->scan_piece_recto)}}" width="500px;" height="300px;">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Copie Piece(Verso)</label> 
                                        <img src="{{asset('scan_piece/'. Auth::user()->scan_piece_verso)}}" width="500px;" height="300px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Signature</label> 
                                        <img src="{{Auth::user()->signature}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type de compte</label> 
                                        <input class="form-control" type="text" name="name" placeholder="" disabled="true" value="{{!empty(Auth::user()->type_compte) ? Auth::user()->type_compte : ''}}"> 
                                    </div>
                                </div>
                            @if((Auth::user()->type_compte) == 'Compte Marchand')
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-left: 10rem;">
                                        {!! QrCode::size(200)
                                                    ->color(239, 170, 30)
                                                    ->generate(Auth::user()->no_compte_carte_virtuelle); !!}
                                    </div>
                                </div>
                            @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nouveau scan Passeport/ Cni</label> 
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="nv_scan_piece" id="nv_scan_piece" accept="image/png, image/jpeg, image/jpg">
                                            <label class="custom-file-label" for="customFile">Select file</label>
                                        </div>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <ul class="list-inline pull-right">
                <li><a href="/statut" class="btn" style="background: #424145; color: white ">Annuler Operation</a></li>
                <li><input type="submit" value="Enregistrer" class="btn" style="background:  #efaa1e; color: white"></li>
            </ul>
    </form>
</div>  
</main>

    @endsection
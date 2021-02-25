
    @extends('layouts.dash')
    @section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Profil de l'Utilisateur</h1>
        
        <div class="row">
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                                <img  style="width: 100px; border-radius: 10px;" src="https://arc-anglerfish-arc2-prod-pmn.s3.amazonaws.com/public/7N2SNB73IBEC7G5FTRP4BYBBGE.jpg">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Numero de compte:
                                <p style="color: red">Numero de compte</p>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Telephone:
                                <p>{{$newdetail['phone']}}</p>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Email:
                                <p>{{$newdetail['email']}}</p>
                            </div>                            
                        </div>
                    </div>
                    <div class="card-body row" >
                        <div class="col-md-3">                             
                                
                                
                                    @if($newdetail['sexe'] == "Masculin")
                                            <span><strong>Mr {{$newdetail['name']}}</strong></span><br>
                                        @else 
                                           </span>Mme {{$newdetail['name']}}</span><br>
                                    @endif   
                                    <span><i>{{$newdetail['profession']}}</i></span>                             
                        </div>
                        <div class="col-md-3" style="color: red">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>FCFA 0
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-birthday-cake" aria-hidden="true"></i>{{$newdetail['date_naissance']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row" >
                    <p><button class="btn btn-warning">Telecharger Profil</button></p>
                </div>
                <div class="row">
                    <p><button class="btn btn-secondary">Telecharger les logs</button></p>
                </div>
                <div class="row">
                   <op> <a href="#" class="btn btn-danger">Bloquer ce Compte</a><p>
                </div>
                    <!--<br><br><button class="btn btn-secondary">Envoyer une notification</button>-->
                
            </div>
        </div>
    </div>

    <div class="col-md-12 design">
    <form role="form" class="login-box">
        <div class="tab-pane" role="tabpanel" id="step4">
                                    <h4 class="text-center">Informations Complètes</h4>
                                    <div class="all-info-container">
                                        <div class="list-content">
                                            <a href="#listone" data-toggle="collapse" aria-expanded="false" aria-controls="listone">Vos informations de base <i class="fa fa-chevron-down"></i></a>
                                            <div class="collapse" id="listone">
                                                <div class="list-box">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>First and Last Name *</label> 
                                                                <input class="form-control" type="text"  name="name" disabled value="{{$newdetail['name']}}"> 
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Phone Number *</label>                                                                 <input class="form-control" type="text" name="phone" disabled value="{{$newdetail['phone']}}" > 
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email *</label> 
                                                                <input class="form-control" type="email" name="email" disabled value="{{$newdetail['email']}}"> 
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Mot de Passe *</label> 
                                                                <input class="form-control" type="password" disabled value="admin ne peut pas lire cette valeur" > 
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
                                                                <input class="form-control" type="text" disabled value="{{$newdetail['identifiant_unique']}}"> 
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>ville</label> 
                                                                <input class="form-control" type="text" name="town" disabled value="{{$newdetail['ville']}}"> 
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Pays</label> 
                                                                <input class="form-control" type="text" name="country" disabled value="{{$newdetail['pays']}}">
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Profession</label> 
                                                                <input class="form-control" type="text" name="job" disabled value="{{$newdetail['profession']}}"> 
                                                                
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
                                                                <label>Date de naissance*</label> 
                                                                <input class="form-control" type="date" id="dob" name="dob" disabled value="{{$newdetail['date_naissance']}}" /> 
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Sexe</label> 
                                                                <input class="form-control" type="text" name="sexe" disabled value="{{$newdetail['sexe']}}"/>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Numero de compte Bancaire</label> 
                                                                <input class="form-control" type="number" name="bank_acc" id="bank_acc" disabled value="{{$newdetail['num_compte_bancaire']}}"> 
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nom de la banque</label> 
                                                                <input class="form-control" type="text" name="bank_name" id="bank_name" disabled value="{{$newdetail['nom_banque']}}"> 
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Numero de passport</label> 
                                                                <input class="form-control" type="number" name="passport_number" id="passport_number" disabled value="{{$newdetail['num_passeport']}}"> 
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Numero de CNI</label> 
                                                                <input class="form-control" type="text" name="cni_number" id="cni_number" disabled value="{{$newdetail['num_cni']}}"> 
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Scans Passport</label> 
                                                                <div class="custom-file">
                                                                    <img src="{{$newdetail['scan_passeport']}}">
                                                                </div>
                                                            </div>                                        
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Scans CNI</label> 
                                                                <div class="custom-file">
                                                                    <img src="{{$newdetail['scan_cni']}}">
                                                                </div>
                                                            </div>                                        
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Votre photo 4x4</label> 
                                                                <div class="custom-file">
                                                                    <img src="{{$newdetail['photo']}}">
                                                                </div>                                                                
                                                            </div>                                        
                                                        </div>                                
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Référé par</label> 
                                                                <input class="form-control" type="text" name="refer" id="refer" disabled value="{{$newdetail['refere_par']}}"> 
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>       
                            </form>
 

</main>



    @endsection
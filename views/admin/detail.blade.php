
    @extends('layouts.dash')
    @section('content')
    <main>
    <div class="container-fluid">
        <h1 class="mt-4">Verifier les Informations</h1>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                                <img  style="width: 100px; border-radius: 10px;" src="{{asset('photos/'. $id->photo)}}">
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Numero de compte:
                                <p style="color: #efaa1e; font-weight: bold">{{ $id->no_compte_carte_virtuelle }}</p>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Telephone:
                                <p>{{ $id->phone }}</p>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Email:
                                <p>{{ $id->email }}</p>
                            </div>                            
                        </div>
                    </div>
                    <div class="card-body row" >
                        <div class="col-md-3"> {{ $id->phone }}
                            @if($id->sexe == "Masculin")
                                    <span><strong>Mr {{ $id->name }}</strong></span><br>
                                @else 
                                    </span>Mme {{ $id->name }}</span><br>
                            @endif   
                            <span><i>{{ $id->profession }}</i></span>                             
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>FCFA <span style="color: #efaa1e; font-weight: bold">{{ $id->solde }}</span>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-birthday-cake" aria-hidden="true"></i>{{ $id->date_naissance }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 design">
    <form role="form" class="login-box" method="GET">
        <div class="tab-pane" role="tabpanel" id="step4">
                                    <h4 class="text-center">Informations Complètes</h4>
                                    <div class="all-info-container">
                                        <div class="list-content">
                                            <a href="#listone" data-toggle="collapse" aria-expanded="false" aria-controls="listone"> Informations de base <i class="fa fa-chevron-down"></i></a>
                                            <div class="collapse" id="listone">
                                                <div class="list-box">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>First and Last Name *</label> 
                                                                <input class="form-control" type="text"  name="name" disabled value="{{ $id->name }}"> 
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="nameChecked"  name="nameChecked" value="true" hidden onclick="changeElementColor()">
                                                                    <label class="form-check-label" for="nameChecked"><i class="fa fa-check smile fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="nameCheckedf"  name="nameChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="nameCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Phone Number *</label>         
                                                                     <input class="form-control" type="text" name="phone" disabled value="{{ $id->phone }}" >  
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email *</label> 
                                                                <input class="form-control" type="email" name="email" disabled value="{{ $id->email }}"> 
                                                                
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
                                                                <input class="form-control" type="text" disabled value="{{ $id->identifiant_unique }}"> 
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="uniIdChecked"  name="uniIdChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="uniIdChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="uniIdCheckedf"  name="uniIdChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="uniIdCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>ville</label> 
                                                                <input class="form-control" type="text" name="town" disabled value="{{ $id->ville }}"> 
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="townChecked"  name="townChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="townChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="townCheckedf"  name="townChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="townCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Pays</label> 
                                                                <input class="form-control" type="text" name="country" disabled value="{{ $id->pays }}">
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="countrycheck"  name="countrycheck" value="true" hidden>
                                                                    <label class="form-check-label" for="countrycheck"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="countrycheck"  name="countrycheck" value="false" hidden>
                                                                    <label class="form-check-label" for="countrycheck"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Profession</label> 
                                                                <input class="form-control" type="text" name="job" disabled value="{{ $id->profession }}"> 
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="jobChecked"  name="jobChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="jobChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="jobCheckedf"  name="jobChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="jobCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
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
                                                                <input class="form-control" type="date" id="dob" name="dob" disabled value="{{ $id->date_naissance }}" /> 
                                                            </div>
                                                            <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="dobChecked"  name="dobChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="dobChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>                                                            
                                                                    <input class="val" type="radio" id="dobCheckedf"  name="dobChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="dobCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Sexe</label> 
                                                                <input class="form-control" type="text" name="sexe" disabled value="{{ $id->sexe }}"/>
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="sexChecked"  name="sexChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="sexChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="sexCheckedf"  name="sexChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="sexCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Numero de compte Bancaire</label> 
                                                                <input class="form-control" type="number" name="bank_acc" id="bank_acc" disabled value="{{ $id->num_compte_bancaire }}"> 
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="sexChecked"  name="sexChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="sexChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="sexCheckedf"  name="sexChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="sexCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nom de la banque</label> 
                                                                <input class="form-control" type="text" name="bank_name" id="bank_name" disabled value="{{ $id->nom_banque }}"> 
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="bankChecked"  name="bankChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="bankChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="bankCheckedf"  name="bankChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="bankCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                         
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Numero de CNI/Passeport</label> 
                                                                <input class="form-control" type="text" name="num_piece" id="num_piece" disabled value="{{ $id->num_piece }}"> 
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="cniChecked"  name="cniChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="cniChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="cniCheckedf"  name="cniChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="cniCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Référé par</label> 
                                                                <input class="form-control" type="text" name="refer" id="refer" disabled value="{{ $id->refere_par }}"> 
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Signature</label> 
                                                                <div class="custom-file">
                                                                    <img src="{{$id->signature}}">
                                                                </div>
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="tofpassChecked"  name="tofpassChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="tofpassChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="tofpassCheckedf"  name="tofpassChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="tofpassCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>                                        
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Votre photo 4x4</label> 
                                                                <div class="custom-file">
                                                                    <img src="{{asset('photos/'. $id->photo)}}" width="150px;" height="150px;">
                                                                </div>
                                                                <div class="form-check form-switch align">
                                                                    
                                                                        <input class="val" type="radio" id="selfieChecked"  name="selfieChecked" value="true" hidden>
                                                                        <label class="form-check-label" for="selfieChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                   
                                                                        <input class="val" type="radio" id="selfieCheckedf"  name="selfieChecked" value="false" hidden>
                                                                        <label class="form-check-label" for="selfieCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                            
                                                                    
                                                                </div>
                                                            </div>                                        
                                                        </div> 

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Scans Passport/Cni (Cni recto)</label> 
                                                                <div class="custom-file">
                                                                    <img src="{{asset('scan_piece/'. $id->scan_piece_recto)}}" width="500px;" height="300px;">
                                                                </div>
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="tofpassChecked"  name="tofpassChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="tofpassChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="tofpassCheckedf"  name="tofpassChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="tofpassCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>                                        
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Scans Cni (CNI VERSO)</label> 
                                                                <div class="custom-file">
                                                                    <img src="{{asset('scan_piece/'. $id->scan_piece_verso)}}" width="500px;" height="300px;">
                                                                </div>
                                                                <div class="form-check form-switch align">
                                                                    <input class="val" type="radio" id="tofpassChecked"  name="tofpassChecked" value="true" hidden>
                                                                    <label class="form-check-label" for="tofpassChecked"><i class="fa fa-check fa-2x" aria-hidden="true"></i></label>
                                                                    <input class="val" type="radio" id="tofpassCheckedf"  name="tofpassChecked" value="false" hidden>
                                                                    <label class="form-check-label" for="tofpassCheckedf"><i class="fa fa-times frown fa-2x" aria-hidden="true"></i></label>
                                                                </div>
                                                            </div>                                        
                                                        </div>  
                                                        <input type="number" value="{{ $id->id }}" name="hiddenid" hidden>                                
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                            </form>
 

</main>

<style>
    .align{
            margin-top: 1rem;
        }
    .smile:hover{
        color: green;
    }
    .frown:hover{
        color: red;
    }
</style>

<script>
    function changeElementColor(smile) {
    var obj = document.getElementsByClassName(smile);
    var color = 'green';
    obj.style.backgroundColor = color;
    }
</script>

    @endsection
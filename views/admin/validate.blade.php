@extends('layouts.dash')
    @section('content')
    <main>

        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

                    <div class="container-fluid">
                        <h1 class="mt-4">Valider une inscription</h1>
                        <h2 class="mt-4">Compte CLient</h2>
                       
                        @if(Session::has('message'))

                        <div class="section mt-2 text-center">
                            <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close">
                                <i
                                    class="icofont icofont-close-line-circled"></i>
                            </button>
                            <p style="color: #efaa1e; font-size: 2rem;"><strong>{{ Session::get('message') }}</p>
                        </div>

                        @endif
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Inscriptions récentes
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Tel</th>
                                                <th>email</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Date de creation</th>
                                                <th>Statut</th>
                                                <th>action</th>
                                                <th>Delete</th>                                                  
                                                <th>Bloquer</th>                                                  
                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Tel</th>
                                                <th>email</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Date de creation</th>
                                                <th>Statut</th>
                                                <th>action</th>                                                
                                                <th>Delete</th> 
                                                <th>Bloquer</th>                                               
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($newusers as $row)
                                            @if($row['statut']== 'En Attente' && $row['type_compte'] == 'Compte Personnel')   
                                            <tr>
                                                <td>{{$row['identifiant_unique']}}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['phone']}}</td>
                                                <td>{{$row['email']}}</td>
                                                <td>{{$row['profession']}}</td>
                                                <td>{{$row['sexe']}}</td>
                                                <td>{{$row['created_at']}}</td>
                                                <td><button class="btn btn-warning">{{($row['statut'])}}</button></td>
                                                <td><a href="{{route('newdetail', ['id' => $row->id])}}" class="btn btn-secondary">Verifier</a></td>                                                     
                                                <td><a href="{{route('delete', ['id' => $row->id])}}" class="btn btn-secondary">Supprimer</a></td>                                                     
                                                <td><a href="{{route('block', ['id' => $row->id])}}" class="btn btn-secondary">Bloquer</a></td>                                                     
                                            </tr>
                                        @endif
                                        @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="container-fluid">
                        <h2 class="mt-4">Compte Marchand</h2>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Inscriptions récentes
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Tel</th>
                                                <th>email</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Statut</th>
                                                <th>Date de creation</th>
                                                <th>action</th> 
                                                <th>Supprimer</th>                                                
                                                <th>Bloquer</th>                                               
                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Tel</th>
                                                <th>email</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Statut</th>
                                                <th>Date de creation</th>
                                                <th>action</th>                                                
                                                <th>Supprimer</th>                                                
                                                <th>Bloquer</th>                                                
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($newusers as $row)
                                            @if($row['statut']== 'En Attente' && $row['type_compte'] == 'Compte Marchand')   
                                            <tr>
                                                <td>{{$row['identifiant_unique']}}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['phone']}}</td>
                                                <td>{{$row['email']}}</td>
                                                <td>{{$row['profession']}}</td>
                                                <td>{{$row['sexe']}}</td>
                                                <td><button class="btn btn-warning">{{($row['statut'])}}</button></td>
                                                <td>{{$row['created_at']}}</td>
                                                <td><a href="{{route('newdetail', ['id' => $row->id])}}" class="btn btn-secondary">Verifier</a></td>                                                     
                                                <td><a href="{{route('delete', ['id' => $row->id])}}" class="btn btn-secondary">Supprimer</a></td>                                                     
                                                <td><a href="{{route('block', ['id' => $row->id])}}" class="btn btn-secondary">Bloquer</a></td>
                                            </tr>
                                        @endif
                                        @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <h2 class="mt-4">Compte Marchand (Ajout informations)</h2>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Inscriptions récentes
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nom Business</th>
                                                <th>Raison</th>
                                                <th>Forme</th>
                                                <th>Date de creation</th>
                                                <th>Email</th>
                                                <th>Siege</th>
                                                <th>Activites</th>
                                                <th>Commercial</th>                                                 
                                                <th>Statut</th>                                                 
                                                <th>Action</th>   
                                                <th>Supprimer</th>                                               
                                                <th>Bloquer</th>                                             
                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                            <tr>
                                                <th>Nom Business</th>
                                                <th>Raison</th>
                                                <th>Forme</th>
                                                <th>Date de creation</th>
                                                <th>Email</th>
                                                <th>Siege</th>
                                                <th>Activites</th>
                                                <th>Commercial</th>                                                 
                                                <th>Statut</th>                                                 
                                                <th>Action</th>                                                 
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($marchants as $marchant)
                                            @if($marchant['statut']== 'En Attente')   
                                            <tr>
                                                <td>{{ $marchant->nom }}</td>
                                                <td>{{ $marchant->raison }}</td>
                                                <td>{{ $marchant->forme }}</td>
                                                <td>{{ $marchant->date_creation }}</td>
                                                <td>{{ $marchant->email }}</td>
                                                <td>{{ $marchant->siege }}</td>
                                                <td>{{ $marchant->activite }}</td>
                                                @if($marchant->commercial_id == NULL)
                                                <td>{{ $marchant->commercial_id }}</td>
                                                @else 
                                                <td>{{$users::find($marchant->commercial_id)->name}}</td>
                                                @endif
                                                <td><button class="btn btn-warning">{{ $marchant->statut }}</td>
                                                <td><a href="" class="btn btn-secondary">Verifier</a></td>                                                     
                                            </tr>
                                        @endif
                                        @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="container-fluid">
                        <h2 class="mt-4">Candidatures Points de vente</h2>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Inscriptions récentes
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Tel</th>
                                                <th>email</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Statut</th>
                                                <th>Date de creation</th>
                                                <th>action</th>                                               
                                                <th>Supprimer</th>                                               
                                                <th>Bloquer</th>                                               
                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Tel</th>
                                                <th>email</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Statut</th>
                                                <th>Date de creation</th>
                                                <th>action</th>                                               
                                                <th>Supprimer</th>                                               
                                                <th>Bloquer</th>                                               
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($newusers as $row)
                                            @if($row['statut'] == 'En Attente' && $row['type_compte'] == 'Point de Vente' )   
                                            <tr>
                                                <td>{{$row['identifiant_unique']}}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['phone']}}</td>
                                                <td>{{$row['email']}}</td>
                                                <td>{{$row['profession']}}</td>
                                                <td>{{$row['sexe']}}</td>
                                                <td><button class="btn btn-warning">{{($row['statut'])}}</button></td>
                                                <td>{{$row['created_at']}}</td>
                                                <td><a href="{{route('newdetail', ['id' => $row->id])}}" class="btn btn-secondary">Verifier</a></td>                                                     
                                                <td><a href="{{route('delete', ['id' => $row->id])}}" class="btn btn-secondary">Supprimer</a></td>                                                     
                                                <td><a href="{{route('block', ['id' => $row->id])}}" class="btn btn-secondary">Bloquer</a></td>
                                            </tr>
                                        @endif
                                        @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <h2 class="mt-4">Point de Vente (Ajout informations)</h2>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Inscriptions récentes
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Proprietaire</th>
                                                <th>RCCM</th>
                                                <th>Localisation</th>
                                                <th>Depot initial</th>
                                                <th>Date de creation</th>
                                                <th>Statut</th>         
        

                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                            <tr>
                                                <th>Proprietaire</th>
                                                <th>RCCM</th>
                                                <th>Localisation</th>
                                                <th>Depot initial</th>
                                                <th>Date de creation</th>
                                                <th>Statut</th>                                                 
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($pointventes as $ptvente)   
                                                <tr>
                                                    <td>{{$ptvente->owner}}</td>
                                                    <td>{{$ptvente->rccm}}</td>
                                                    <td>{{$ptvente->localisation}}</td>
                                                    <td>{{$ptvente->init_deposit}}</td>
                                                    <td>{{$ptvente->created_at}}</td>
                                                    <td><button class="btn btn-warning">En Attente</button></td>     <!--Mettre en attente ici -->                                              
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <h1 class="mt-4">Liste des superviseurs</h1>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Inscriptions récentes
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Matricule</th>
                                                <th>email</th>
                                                <th>phone</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Dernier Diplome</th>
                                                <th>Date de debut</th>
                                                <th>Date de fin</th>
                                                <th>Revenu</th>
                                                <th>Date de creation</th>  
                                                <th>Statut</th>                                              
                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Matricule</th>
                                                <th>email</th>
                                                <th>phone</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Dernier Diplome</th>
                                                <th>Date de debut</th>
                                                <th>Date de fin</th>
                                                <th>Revenu</th>
                                                <th>Date de creation</th>  
                                                <th>Statut</th>                                
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($superviseur as $super)   
                                                <tr>
                                                    <td>{{$valeuruser::find($super->user_id)->identifiant_unique}}</td>
                                                    <td>{{$valeuruser::find($super->user_id)->name}}</td>
                                                    <td>{{$super->matricule}}</td>
                                                    <td>{{$valeuruser::find($super->user_id)->email}}</td>
                                                    <td>{{$valeuruser::find($super->user_id)->phone}}</td>
                                                    <td>{{$valeuruser::find($super->user_id)->profession}}</td>
                                                    <td>{{$valeuruser::find($super->user_id)->sexe}}</td>
                                                    <td>{{$super->last_diploma}}</td>
                                                    <td>{{$super->start_date}}</td>
                                                    <td>{{$super->end_date}}</td>
                                                    <td>{{$super->revenu}}</td>
                                                    <td>{{$super->created_at}}</td>
                                                    <td><button class="btn btn-warning">{{$valeuruser::find($super->user_id)->statut}}</button></td>                                                    
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <h1 class="mt-4">Liste des commerciaux</h1>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Inscriptions récentes
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Matricule</th>
                                                <th>email</th>
                                                <th>phone</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Dernier Diplome</th>
                                                <th>Date de debut</th>
                                                <th>Date de fin</th>
                                                <th>Revenu</th>
                                                <th>Statut</th>     
                                                <th>Superviseur</th>
                                                <th>Date de creation</th>                                             
                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                            <tr>
                                                <th>Identifiant Unique</th>
                                                <th>Nom</th>
                                                <th>Matricule</th>
                                                <th>email</th>
                                                <th>phone</th>
                                                <th>Profession</th>
                                                <th>sexe</th>
                                                <th>Dernier Diplome</th>
                                                <th>Date de debut</th>
                                                <th>Date de fin</th>
                                                <th>Revenu</th>
                                                <th>Statut</th>                                               
                                                <th>Superviseur</th>                                               
                                                <th>Date de creation</th>                                               
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($commercial as $commer)   
                                                <tr>
                                                    <td>{{$valeuruser::find($commer->user_id)->identifiant_unique}}</td>
                                                    <td>{{$valeuruser::find($commer->user_id)->name}}</td>
                                                    <td>{{$commer->matricule}}</td>
                                                    <td>{{$valeuruser::find($commer->user_id)->email}}</td>
                                                    <td>{{$valeuruser::find($commer->user_id)->phone}}</td>
                                                    <td>{{$valeuruser::find($commer->user_id)->profession}}</td>
                                                    <td>{{$valeuruser::find($commer->user_id)->sexe}}</td>
                                                    <td>{{$commer->last_diploma}}</td>
                                                    <td>{{$commer->start_date}}</td>
                                                    <td>{{$commer->end_date}}</td>
                                                    <td>{{$commer->revenu}}</td>
                                                    <td><button class="btn btn-warning">{{$valeuruser::find($commer->user_id)->statut}}</button></td>                                                    
                                                    @if($commer->superviseur_id == NULL)
                                                    <td>{{ $commer->superviseur_id }}</td>
                                                    @else
                                                    <td>{{$valeuruser::find($commer->superviseur_id)->name}}</td>
                                                    @endif
                                                    <td>{{$commer->created_at}}</td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <script>
                    $(document).ready(function() {
                      $('#dataTable').DataTable();
                  } );
                   </script>
    @endsection
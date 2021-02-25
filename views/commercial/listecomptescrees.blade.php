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
                        <h1 class="mt-4">Liste des comptes crees (Compte Client)</h1>
                       
                        @if(Session::has('message'))

                        <div class="section mt-2 text-center">
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
                                                <th>Type de compte</th>
                                                <th>Date de creation</th>
                                                <th>Statut</th>                                              
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
                                                <th>Type de compte</th>
                                                <th>Date de creation</th>
                                                <th>Statut</th>                                               
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($comptescrees as $compte)   
                                                <tr>
                                                    <td>{{$compte->identifiant_unique}}</td>
                                                    <td>{{$compte->name}}</td>
                                                    <td>{{$compte->phone}}</td>
                                                    <td>{{$compte->email}}</td>
                                                    <td>{{$compte->profession}}</td>
                                                    <td>{{$compte->sexe}}</td>
                                                    <td>{{$compte->type_compte}}</td>
                                                    <td>{{$compte->created_at}}</td>
                                                    <td><button class="btn btn-success">{{$compte->statut}}</button></td>                                                    
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <h1 class="mt-4">Liste des comptes crees (Compte Marchant)</h1>
                       
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
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($marchants as $marchant)
                                               
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
                                                <td>{{$marchantuser::find($marchant->commercial_id)->name}}</td>
                                                @endif
                                                <td><button class="btn btn-warning">{{ $marchant->statut }}</td>                                                    
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
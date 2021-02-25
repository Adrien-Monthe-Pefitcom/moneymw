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
                        <h1 class="mt-4">Liste des points de vente</h1>
                       
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
                                                <th>Proprietaire</th>
                                                <th>RCCM</th>
                                                <th>Localisation</th>
                                                <th>Depot initial</th>
                                                <th>Date de creation</th>
                                                <th>Statut</th>                                                
                                                <th>Superviseur</th>                                                
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
                                                <th>Superviseur</th>                                                  
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
                                                    <td><button class="btn btn-success">En Attente</button></td>     <!--Mettre en attente ici -->                                               
                                                    @if($ptvente->superviseur_id == NULL)
                                                    <td>{{ $ptvente->superviseur_id }}</td>
                                                    @else 
                                                    <td>{{$valeuruser::find($ptvente->superviseur_id)->name}}</td>
                                                    @endif
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
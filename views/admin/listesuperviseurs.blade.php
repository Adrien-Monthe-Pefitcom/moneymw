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
                        <h1 class="mt-4">Liste des superviseurs</h1>
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
                                                    <td><button class="btn btn-success">{{$valeuruser::find($super->user_id)->statut}}</button></td>                                                    
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
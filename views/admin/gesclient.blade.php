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
                        <h1 class="mt-4">Gerer vos Clients</h1>

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
                                                <th>Statut</th>
                                                <th>Date de creation</th>
                                                <th>Action</th>                                                
                                                <th>Delete</th>                                                
                                                <th>Debloquer</th>                                                
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
                                                <th>Date de Creation</th>
                                                <th>Action</th>                                                
                                                <th>Delete</th>                                                
                                                <th>Debloquer</th>                                                
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($newusers as $row)
                                            @if($row['statut'] == 'validated' || $row['statut'] == 'blocked' )   
                                            <tr>
                                                <td>{{$row['identifiant_unique']}}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['phone']}}</td>
                                                <td>{{$row['email']}}</td>
                                                <td>{{$row['profession']}}</td>
                                                <td>{{$row['sexe']}}</td>
                                                <td><button class="btn btn-success">{{($row['statut'])}}</button></td>
                                                <td>{{$row['created_at']}}</td>
                                                <td><a href="{{route('detail', ['id' => $row->id])}}" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a></td>                                                     
                                                <td><a href="{{route('delete', ['id' => $row->id])}}" class="btn btn-secondary">Supprimer</a></td>                                                     
                                                <td><a href="{{route('unblock', ['id' => $row->id])}}" class="btn btn-secondary">Debloquer</a></td>
                                            </tr>
                                        @endif
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
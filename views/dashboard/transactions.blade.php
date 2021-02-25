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

                        <h1 class="mt-4">Historique des Transactions</h1>

                        <ol class="breadcrumb mb-4">

                            <li class="breadcrumb-item active">Compte/Transaction/Historique</li>

                        </ol>

                       

                        <div class="card mb-4">

                            <div class="card-header">

                                <i class="fas fa-table mr-1"></i>

                                Toutes mes transactions recentes 

                            </div>

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>

                                                <th>Numéro</th>

                                                <th>Type de Transaction</th>

                                                <th>Source</th>

                                                <th>Destination</th>

                                                <th>Date</th>

                                                <th>Montant</th>

                                                <th>Status</th>

                                            </tr>

                                        </thead>

                                        

                                        <tfoot>

                                            <tr>

                                                <th>Numéro</th>

                                                <th>Type de Transaction</th>

                                                <th>Source</th>

                                                <th>Destination</th>

                                                <th>Date</th>

                                                <th>Montant</th>

                                                <th>Status</th>

                                            </tr>

                                        </tfoot>

                                        <tbody>

                                            @foreach($transactions as $row)

                                            <tr>

                                                <td>{{$row['trans_code']}}</td>

                                                <td>{{$row['trans_type']}}</td>

                                                <td>{{$row['sender_name']}}</td>

                                                <td>{{$row['receiver_name']}}</td>

                                                <td>{{$row['created_at']}}</td>

                                                <td>{{$row['amount']}}</td>

                                                <td>@if ($row['status'] == "Pending" )

                                                     <button class="btn btn-warning">En cours</button>

                                                @else

                                                    @if ($row['status'] == "Done")

                                                        <button class="btn btn-success">Effectué</button>

                                                    @else

                                                    <button class="btn btn-dark">Annulé</button>

                                                    @endif

                                                @endif

                                                </td>

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
@extends('layouts.dash')

    @section('content')

                <main>

                    <div class="container-fluid">

                    <h1 class="mt-4"> Bonjour @if(Auth::user()->sexe === "Masculin")

                            Mr

                        @else

                            Mme

                        @endif

                        <span style="color: #efaa1e;">{{Auth::user()->name}}</span></h1>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="card mb-4">                                    

                                    <div class="card-body row" >

                                    <div class="col-md-6" >

                                            <h3>Votre Solde</h3>

                                        </div>

                                        <div class="col-md-6" style="text-align: right; font-family: Trebuchet MS, sans-serif; font-size: 10rem; color: #efaa1e">

                                            <h1>FCFA {{Auth::user()->solde}}</h1>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                        <div class="col-xl-3 col-md-6">

                                <div class="card bg-gradiant text-white mb-4">

                                    <div class="card-body row">

                                        <div class="col-md-8">

                                            Money Maker <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Money Maker

                                        </div>

                                        <div class="col-md-4">

                                            <i class="fa fa-credit-card fa-3x" aria-hidden="true"></i>

                                        </div>                                         

                                    </div>

                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                        <a class="small text-white stretched-link" href="/newop">Effectuer la transaction <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>

                                        <div class="small text-white"></div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-3 col-md-6">

                                <div class="card bg-gradiant2 text-white mb-4">

                                    <div class="card-body row">

                                        <div class="col-md-8">

                                            DEPOTS

                                        </div>

                                        <div class="col-md-4">

                                            <i class="fa fa-arrow-circle-down fa-3x" aria-hidden="true"></i>

                                        </div>                                     

                                        

                                    </div>

                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                        <a class="small text-white stretched-link" href="/newop">Faire un depot</a>

                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-3 col-md-6">

                                <div class="card bg-gradiant3 text-white mb-4">

                                    <div class="card-body row">

                                        <div class="col-md-8">

                                            RETRAITS

                                        </div>

                                        <div class="col-md-4">

                                            <i class="fa fa-arrow-circle-up fa-3x" aria-hidden="true"></i>

                                        </div>

                                    </div>

                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                        <a class="small text-white stretched-link" href="/newop">Faire un retrait</a>

                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-3 col-md-6">

                                <div class="card bg-gradiant4 text-white mb-4">

                                    <div class="card-body row">

                                        <div class="col-md-8">

                                            TRANSFERTS

                                        </div>

                                        <div class="col-md-4">

                                            <i class="fa fa-paper-plane fa-3x" aria-hidden="true"></i>

                                        </div>

                                    </div>

                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                        <a class="small text-white stretched-link" href="/newop">Faire un transfert</a>

                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-3 col-md-6">

                                <div class="card bg-gradiant5 text-white mb-4">

                                    <div class="card-body row">

                                        <div class="col-md-8">

                                            PAIEMENT

                                        </div>

                                        <div class="col-md-4">

                                            <i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i>

                                        </div>

                                    </div>

                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                        <a class="small text-white stretched-link" href="#">Faire un paiement</a>

                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card mb-4">

                            <div class="card-header">

                                <i class="fas fa-table mr-1"></i>

                                Toutes mes transactions recentes <a href="/transactions">(Voir tout)</a>

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



<style>

    .bg-gradiant {

        background: linear-gradient(50deg,#faca0c  0,#efaa1e  100%);

    }

    .bg-gradiant2 {

        background: linear-gradient(50deg,slateblue 0,darkturquoise 100%);

    }



    .bg-gradiant3 {

        background: linear-gradient(50deg,#0f0d0c 0,#264653  100%);

    }



    .bg-gradiant4 {

        background: linear-gradient(50deg,#861657 0,#FFA69E  100%);

    }

    .bg-gradiant5 {

        background: linear-gradient(50deg,#000 0,#a5a58d  100%);

    }

        #nav-toggle {

        display: block !important;

    }

</style>

    @endsection
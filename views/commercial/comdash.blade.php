@extends('layouts.dash')
    @section('content')
                <main>
                    <div class="container-fluid"><!-- matricule commercial -->
                    <h1 class="mt-4"> Bonjour @if(Auth::user()->sexe === "Masculin")
                            Mr
                        @else
                            Mme
                        @endif
                        <span style="color: #efaa1e;">{{Auth::user()->name}}</span></h1>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">                                    
                                    <div class="card-body row" >
                                    <div class="col-md-6" >
                                            <h3>Votre Solde Commercial</h3>
                                        </div>
                                        <div class="col-md-6" style="text-align: right; font-family: Trebuchet MS, sans-serif; font-size: 10rem; color: #efaa1e">
                                            <h1>FCFA {{$solde}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4">                                    
                                    <div class="card-body row" >
                                    <div class="col-md-6" >
                                            <h3>Votre Numero de compte commercial</h3>
                                        </div>
                                        <div class="col-md-6" style="text-align: right; font-family: Trebuchet MS, sans-serif; font-size: 10rem; color: #efaa1e">
                                           <h1>{{$no_compte}}</h1>
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
                                            CREER UN NOUVEAU COMPTE
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa fa-credit-card fa-3x" aria-hidden="true"></i>
                                        </div>                                         
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/depot">inscrire <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                        <div class="small text-white"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-gradiant2 text-white mb-4">
                                    <div class="card-body row">
                                        <div class="col-md-8">
                                            PREMIER DEPOT 
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa fa-arrow-circle-down fa-3x" aria-hidden="true"></i>
                                        </div>                                     
                                        
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/depot">Faire un depot <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-gradiant3 text-white mb-4">
                                    <div class="card-body row">
                                        <div class="col-md-8">
                                            CE MOIS
                                           <p style="margin-top: 2rem;">
                                                0 clients
                                           </p>
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa fa-arrow-circle-up fa-3x" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Faire un retrait <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-gradiant4 text-white mb-4">
                                    <div class="card-body row">
                                        <div class="col-md-8">
                                            TOUTES MES STATISTIQUES
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa fa-paper-plane fa-3x" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Faire un transfert <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
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
                                                <th>numero</th>
                                                <th>type transaction</th>
                                                <th>vers</th>
                                                <th> date</th>
                                                <th>montant</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>numero</th>
                                                <th>type transaction</th>
                                                <th>vers</th>
                                                <th> date</th>
                                                <th>montant</th>
                                                <th>status</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>tets</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            
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
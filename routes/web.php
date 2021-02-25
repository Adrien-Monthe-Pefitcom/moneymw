<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('next.test');
});

Route::get('/urecap', function () {
    return view('next.userrecap');
});

Route::get('/tos', function () {
    return view('next.tos');
});

Route::get('/userinfo', function () {
    return view('next.userinfo');
});


Route::get('/next-page','App\Http\Controllers\PageController@nextconnected')->name('page-next');
Route::get('/register','App\Http\Controllers\PageController@register')->name('register');
Route::get('/signin','App\Http\Controllers\UserController@signin')->name('user-login');
Route::get('/dashboard','App\Http\Controllers\PageController@dashboard')->name('dashboard');
Route::get('/dashboardcomm','App\Http\Controllers\PageController@dashboardcomm')->name('dashboard-comm');
Route::get('/depot','App\Http\Controllers\PageController@depot')->name('depot');
Route::get('/transactions','App\Http\Controllers\PageController@transactions')->name('transactions');

Route::get('/newop','App\Http\Controllers\PageController@newOp')->name('newop');
Route::get('/statut','App\Http\Controllers\PageController@statut')->name('user-statut');


Route::get('/lead', function () {
    return view('dashboard.lead');
});

Route::get('/facture', function () {
    return view('dashboard.facture');
});

Route::get('/phone', function () {
    return view('next.phone');
});

Route::get('/profilupdate' ,'App\Http\Controllers\PageController@profilUpdate')->name('profil-update');

Route::post('/register','App\Http\Controllers\UserController@register')->name('process-user-register');

Route::post('/loginPost','App\Http\Controllers\UserController@loginPost')->name('process-user-login');

Route::group(['middleware'=>'auth'],function () {

Route::get('/userrecap','App\Http\Controllers\UserController@recap')->name('user-recap');
Route::get('/statutAdmin','App\Http\Controllers\PageController@statutAdmin')->name('admin-statut');
});

//Route::get('/statutupdate/{id}' ,'App\Http\Controllers\PageController@statutupdate')->name('statut-update');
//Route::post('/statutpostupdate' ,'App\Http\Controllers\PageController@statutpostup')->name('post-update-statut');

Route::get('/logout', 'App\Http\Controllers\UserController@UserLogout')->name('user-logout');


Route::get('/detailnewuser{id}','App\Http\Controllers\PageController@newdetail')->name('newdetail');
Route::get('/detailuser{id}','App\Http\Controllers\PageController@detail')->name('detail');

Route::get('/add_transaction','App\Http\Controllers\TransactionController@insert')->name('add_transaction');
Route::get('/add_transaction_card','App\Http\Controllers\TransactionController@insert2')->name('add_transaction_card');
Route::get('/add_transaction_money_maker','App\Http\Controllers\TransactionController@money_maker')->name('add_transaction_money_maker');

//Gilles
Route::get('/crediter_compte','App\Http\Controllers\TransactionController@crediter_compte')->name('crediter_compte');

// crediter comptes
Route::get('/crediter_compte_marchant','App\Http\Controllers\TransactionController@crediter_compte_marchant')->name('crediter_compte_marchant');
Route::get('/crediter_compte_commercial','App\Http\Controllers\TransactionController@crediter_compte_comm')->name('crediter_compte_commercial');
Route::get('/crediter_compte_ptvente','App\Http\Controllers\TransactionController@crediter_compte_ptvente')->name('crediter_compte_ptvente');
Route::get('/crediter_compte_superviseur','App\Http\Controllers\TransactionController@crediter_compte_supp')->name('crediter_compte_superviseur');

Route::get('/add_transaction_withdrawal','App\Http\Controllers\TransactionController@insert_withdraw')->name('add_transaction2');

Route::get('/visa','App\Http\Controllers\PageController@visa')->name('visa');
Route::get('/settings','App\Http\Controllers\PageController@settings')->name('settings');
Route::get('/tarifs','App\Http\Controllers\PageController@tarifs')->name('tarifs');

Route::get('/validuser', 'App\Http\Controllers\PageController@validuser')->name('validuser');
Route::get('/validate','App\Http\Controllers\PageController@validateur')->name('validate');
Route::get('/gestionclient','App\Http\Controllers\PageController@gesclient')->name('gestion-client');
Route::get('/profil','App\Http\Controllers\PageController@profil')->name('profil');
Route::get('/qrcode','App\Http\Controllers\PageController@qrcode')->name('qrcode');
Route::post('/qrcodePost','App\Http\Controllers\PageController@payByQrCode')->name('pay-by-qrcode');

//business controller

Route::get('/comptemarchand','App\Http\Controllers\MarchantController@index')->name('newbusiness');
Route::get('/pointdevente','App\Http\Controllers\MarchantController@ptvente')->name('point-de-vente');
Route::post('/storebusiness','App\Http\Controllers\MarchantController@store')->name('storebusiness');
Route::get('/pointvente','App\Http\Controllers\MarchantController@ptventeCreate')->name('point-vente');
Route::post('/pointventePost','App\Http\Controllers\MarchantController@ptventePost')->name('process-nv-ptvente');

//commercial

Route::post('/registerbycommPost','App\Http\Controllers\UserController@registerByComm')->name('process-register-by-comm');
Route::get('/registerbycomm','App\Http\Controllers\PageController@registerByCommercial')->name('register-by-comm');
Route::get('/listecomptes','App\Http\Controllers\PageController@listecomptes')->name('liste-comptes');

Route::post('/marchantbycommPost','App\Http\Controllers\MarchantController@marchantByComm')->name('process-marchant-by-comm');
Route::get('/marchantbycomm','App\Http\Controllers\MarchantController@marchantByCommercial')->name('marchant-by-comm');

//admin comm
Route::get('/registercomm','App\Http\Controllers\PageController@registerCommercial')->name('register-comm');
Route::post('/registercommPost','App\Http\Controllers\UserController@registerCommercialPost')->name('process-register-comm');

Route::get('/registersuperviseur','App\Http\Controllers\PageController@registerSuperviseur')->name('register-superviseur');
Route::post('/registersuperviseurPost','App\Http\Controllers\UserController@registerSuperviseurPost')->name('process-register-superviseur');
Route::get('/listecommerciaux','App\Http\Controllers\PageController@listecommerciaux')->name('liste-commerciaux');
Route::get('/listesuperviseurs','App\Http\Controllers\PageController@listesuperviseurs')->name('liste-superviseurs');
Route::get('/listepointventes','App\Http\Controllers\PageController@listepointventes')->name('liste-point-ventes');
Route::get('/dashboardsupp','App\Http\Controllers\PageController@dashboardsupp')->name('dashboard-supp');


//admin client
Route::get('/registerclient','App\Http\Controllers\PageController@registerClient')->name('register-client');
Route::post('/registerclientPost','App\Http\Controllers\UserController@registerClientPost')->name('process-register-client');

//log commer
Route::get('/dashboardcommercial','App\Http\Controllers\PageController@dashComm')->name('dashboard-commercial');
Route::get('/crediter','App\Http\Controllers\PageController@creditCompte')->name('credit');
// vues
Route::get('/creditermarchant','App\Http\Controllers\PageController@creditCompteMarchant')->name('credit-marchant');
Route::get('/crediterptvente','App\Http\Controllers\PageController@creditComptePtvente')->name('credit-ptvente');
Route::get('/creditercommercial','App\Http\Controllers\PageController@creditCompteCommercial')->name('credit-comm');
Route::get('/creditersuperviseur','App\Http\Controllers\PageController@creditCompteSuperviseur')->name('credit-supp');

//superviseur

Route::post('/registerbysuppPost','App\Http\Controllers\UserController@registerBySuperviseurPost')->name('process-register-by-superviseur');
Route::get('/registerbysupp','App\Http\Controllers\PageController@registerBySuperviseur')->name('register-by-superviseur');
Route::get('/listecomptessuperviseurs','App\Http\Controllers\PageController@listecomptessupp')->name('liste-comptes-sup');

Route::post('/marchantbysuppPost','App\Http\Controllers\MarchantController@marchantBySup')->name('process-marchant-by-superviseur');
Route::get('/marchantbysupp','App\Http\Controllers\MarchantController@marchantBySuperviseur')->name('marchant-by-superviseur');

Route::post('/ptventebysuppPost','App\Http\Controllers\MarchantController@ptventeBySup')->name('process-ptvente-by-superviseur');
Route::get('/ptventebysupp','App\Http\Controllers\MarchantController@ptventeBySuperviseur')->name('ptvente-by-superviseur');
Route::get('/infoptvente','App\Http\Controllers\MarchantController@ptventeInfo')->name('info-ptvente-by-superviseur');

//supp comm

Route::get('/registercommbySup','App\Http\Controllers\PageController@registerCommercialBySup')->name('register-comm-by-supp');
Route::post('/registercommbySupPost','App\Http\Controllers\UserController@registerCommercialBySupPost')->name('process-register-comm-by-sup');

//superadmin

Route::get('/registeradmin','App\Http\Controllers\PageController@registerAdmin')->name('register-admin');
Route::post('/registeradminPost','App\Http\Controllers\UserController@registerAdminPost')->name('process-register-admin');

//Route pour delete un user
Route::get('/deleteuser{id}','App\Http\Controllers\PageController@deleteUser')->name('delete');
Route::get('/deleteuserbystatut{id}','App\Http\Controllers\PageController@delete_user_by_statut')->name('delete-by-statut');
Route::get('/blockuser{id}','App\Http\Controllers\PageController@blockUser')->name('block');
Route::get('/unblockuser{id}','App\Http\Controllers\PageController@unblock')->name('unblock');

//Route pour delete , update et blocker un compte marchant
Route::get('/deletemarchant{id}','App\Http\Controllers\PageController@deleteMarchant')->name('delete-marchant');
Route::get('/deletemarchantbystatut{id}','App\Http\Controllers\PageController@delete_marchant_by_statut')->name('delete-marchant-by-statut');
Route::get('/blockmarchant{id}','App\Http\Controllers\PageController@blockMarchant')->name('block-marchant');

//Route pour delete , update et blocker un compte marchant
Route::get('/deleteptvente{id}','App\Http\Controllers\PageController@deletePtvente')->name('delete-ptvente');
Route::get('/deleteptventebystatut{id}','App\Http\Controllers\PageController@ptvente')->name('delete-ptvente-by-statut');
Route::get('/blockptvente{id}','App\Http\Controllers\PageController@blockPtvente')->name('block-ptvente');

// Route pour l'import des fichiers
Route::get('/import_excel', 'App\Http\Controllers\ImportExcelController@index');
Route::post('/import_excel/import', 'App\Http\Controllers\ImportExcelController@import');

Route::get('/change_password','App\Http\Controllers\PageController@change_password')->name('change_password');
Route::get('/new_pass','App\Http\Controllers\UserController@change_password')->name('c_pass');

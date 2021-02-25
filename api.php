<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    

    $api->post('authenticate', 'App\Http\Controllers\AuthController@authenticate');

});

$api->version('v1', ['middleware' => 'api.auth'], function($api)
{
    $api->get('qrcode/{id}', 'App\Http\Controllers\APIController@qrcode')->name('qrcode');
    $api->get('users', 'App\Http\Controllers\UserController@showall')->name('show-all-users');
    $api->post('add_mobile_deposit_transaction', 'App\Http\Controllers\APIController@add_mobile_deposit_transaction')->name('add_transaction_mobile');
    $api->post('add_card_deposit_transaction', 'App\Http\Controllers\APIController@add_card_deposit_transaction')->name('add_card_deposit_transaction');
    $api->post('add_transaction_money_maker', 'App\Http\Controllers\APIController@add_transaction_money_maker')->name('add_transaction_money_maker');
    $api->post('add_transaction_withdrawal/{id}', 'App\Http\Controllers\APIController@add_transaction_withdrawal')->name('add_transaction_money_maker');

    $api->get('transactions', 'App\Http\Controllers\APIController@transactions')->name('show-all-transactions');
    $api->put('implement_withdraw', 'App\Http\Controllers\APIController@implement_withdraw')->name('implement_withdraw');
    $api->put('implement_deposit', 'App\Http\Controllers\APIController@implement_deposit')->name('implement_deposit');
    $api->get('transactions/{id}', 'App\Http\Controllers\APIController@personal_transactions_id')->name('show-personal-transactions');

    $api->get('personal_transactions_id/{id}', 'App\Http\Controllers\APIController@personal_transactions_id')->name('show-personal-transactions');
    $api->get('personal_transactions_account/{account}', 'App\Http\Controllers\APIController@personal_transactions_account')->name('show-personal-transactions');
    $api->get('personal_transactions_name/{name}', 'App\Http\Controllers\APIController@personal_transactions_name')->name('show-personal-transactions');
    $api->get('personal_transactions_phone/{phone}', 'App\Http\Controllers\APIController@personal_transactions_phone')->name('show-personal-transactions');

    $api->get('transactions_received_id/{id}', 'App\Http\Controllers\APIController@transactions_received_id')->name('show-personal-transactions');
    $api->get('transactions_received_account/{account}', 'App\Http\Controllers\APIController@transactions_received_account')->name('show-personal-transactions');
    $api->get('transactions_received_name/{name}', 'App\Http\Controllers\APIController@transactions_received_name')->name('show-personal-transactions');
    $api->get('transactions_received_phone/{phone}', 'App\Http\Controllers\APIController@transactions_received_phone')->name('show-personal-transactions');

    $api->get('transactions_sent_id/{id}', 'App\Http\Controllers\APIController@transactions_sent_id')->name('show-personal-transactions');
    $api->get('transactions_sent_account/{account}', 'App\Http\Controllers\APIController@transactions_sent_account')->name('show-personal-transactions');
    $api->get('transactions_sent_name/{name}', 'App\Http\Controllers\APIController@transactions_sent_name')->name('show-personal-transactions');
    $api->get('transactions_sent_phone/{phone}', 'App\Http\Controllers\APIController@transactions_sent_phone')->name('show-personal-transactions');

    $api->get('status_transactions/{id}', 'App\Http\Controllers\APIController@status_transactions')->name('status-transactions');
    $api->get('transactions_type/{type}', 'App\Http\Controllers\APIController@transactions_type')->name('transactions_type');
    $api->get('transactions_mode/{mode}', 'App\Http\Controllers\APIController@transactions_mode')->name('transactions_mode');

    $api->put('cancel_transaction/{id}', 'App\Http\Controllers\APIController@cancel_transaction')->name('cancel_transaction');
    $api->get('transactions_status/{status}', 'App\Http\Controllers\APIController@transactions_status')->name('transaction_status');
    $api->get('transaction_author/{id}', 'App\Http\Controllers\APIController@transaction_author')->name('transaction_author');
    $api->get('transaction_parties/{id}', 'App\Http\Controllers\APIController@transaction_parties')->name('transaction_parties');
    $api->get('all_transactions_on_date/{date}', 'App\Http\Controllers\APIController@all_transactions_on_date');
    $api->get('all_transactions_before_date/{date}', 'App\Http\Controllers\APIController@all_transactions_before_date');
    $api->get('all_transactions_after_date/{date}', 'App\Http\Controllers\APIController@all_transactions_after_date');
    $api->get('personal_transactions_on_date', 'App\Http\Controllers\APIController@personal_transactions_on_date');
    $api->get('personal_transactions_before_date', 'App\Http\Controllers\APIController@personal_transactions_before_date');
    $api->get('personal_transactions_after_date', 'App\Http\Controllers\APIController@personal_transactions_after_date');

    $api->get('users', 'App\Http\Controllers\APIController@showall')->name('show-all-users');
    $api->get('commerciaux', 'App\Http\Controllers\APIController@showCommerciaux')->name('show-commerciaux');
    $api->post('register', 'App\Http\Controllers\APIController@register')->name('register-user');
    $api->put('users/{id}', 'App\Http\Controllers\APIController@putUser')->name('put-users');
    $api->put('usertocommercial/{id}', 'App\Http\Controllers\APIController@changeToCommercial')->name('change-to-commercial');
    $api->delete('users/{id}', 'App\Http\Controllers\APIController@deleteUser')->name('delete-users');
    $api->get('users/{id}','App\Http\Controllers\APIController@getUserById')->name('user-by-id');

    $api->get('usersbyaccountnumber', 'App\Http\Controllers\APIController@getUsersByAccountNumber')->name('users-by-account-number');
    $api->put('usersbyaccountnumber/{account_number}', 'App\Http\Controllers\APIController@putUserByAccountNumber')->name('put-users-by-account-number');
    $api->delete('usersbyaccountnumber/{account_number}', 'App\Http\Controllers\APIController@deleteUserByAccountNumber')->name('delete-users-by-account-number');

    $api->get('usersbypiecenumber', 'App\Http\Controllers\APIController@getUsersByPieceNumber')->name('users-by-piece-number');
    $api->put('usersbypiecenumber/{piece_number}', 'App\Http\Controllers\APIController@putUserByPieceNumber')->name('put-users-by-piece-number');
    $api->delete('useusersbypiecenumber/{piece_number}', 'App\Http\Controllers\APIController@deleteUserByPieceNumber')->name('delete-users-by-piece-number');

    $api->get('usersbyaccounttype', 'App\Http\Controllers\APIController@getUsersByAccountType')->name('users-by-account-type');
    $api->put('usersbyaccounttype/{account_type}', 'App\Http\Controllers\APIController@putUserByAccountType')->name('put-users-by-account-type');
    $api->delete('usersbyaccounttype/{account_type}', 'App\Http\Controllers\APIController@deleteUserByAccountType')->name('delete-users-by-account-type');

    $api->get('usersbyphonenumber', 'App\Http\Controllers\APIController@getUsersByPhoneNumber')->name('users-by-phone-number');
    $api->put('usersbyphonenumber/{phone_number}', 'App\Http\Controllers\APIController@putUserByPhoneNumber')->name('put-by-phone-number');
    $api->delete('usersbyphonenumber/{phone_number}', 'App\Http\Controllers\APIController@deleteUserByPhoneNumber')->name('delete-by-phone-number');

    $api->get('usersreferes', 'App\Http\Controllers\APIController@getUsersRefered')->name('users-refered');
    $api->get('usersreferedby/{account_number}', 'App\Http\Controllers\APIController@getUsersReferedBy')->name('users-refered-by');
    $api->put('usersreferedby/{account_number}', 'App\Http\Controllers\APIController@putUserReferedBy')->name('put-user-refered');
    $api->delete('usersreferedby/{account_number}', 'App\Http\Controllers\APIController@deleteUserReferedBy')->name('delete-user-refered');

    $api->get('usersbyuniqueidentifier', 'App\Http\Controllers\APIController@getUsersByUniqueIdentifier')->name('users-by-unique-identifier');
    $api->put('usersbyuniqueidentifier/{country_id}', 'App\Http\Controllers\APIController@putUserByUniqueIdentifier')->name('put-users-by-unique-identifier');
    $api->delete('usersbyuniqueidentifier/{country_id}', 'App\Http\Controllers\APIController@deleteUserByUniqueIdentifier')->name('delete-users-by-unique-identifier');

    $api->get('usersbystatut', 'App\Http\Controllers\APIController@getUsersByStatut')->name('users-by-statut');
    $api->put('validatestatut/{id}', 'App\Http\Controllers\APIController@validateStatut')->name('validate-user');
    $api->put('bloquedstatut/{id}', 'App\Http\Controllers\APIController@bloquedStatut')->name('bloqued-user');

    $api->put('validatestatutbystatut/{statut}', 'App\Http\Controllers\APIController@validateStatutByStatut')->name('validate-user-by-statut');
    $api->put('bloquedstatutbystatut/{statut}', 'App\Http\Controllers\APIController@bloquedStatutByStatut')->name('bloqued-user-by-statut');
    $api->delete('usersbystatut/{statut}', 'App\Http\Controllers\APIController@deleteUserByStatut')->name('delete-users-by-statut');

    $api->get('usersbycountry', 'App\Http\Controllers\APIController@getUsersByCountry')->name('users-by-country');
    $api->put('usersbycountry/{country}', 'App\Http\Controllers\APIController@putUserByCountry')->name('put-users-by-country');
    $api->delete('usersbycountry/{country}', 'App\Http\Controllers\APIController@deleteUserByCountry')->name('delete-users-by-country');

    $api->get('usersbysexe', 'App\Http\Controllers\APIController@getUsersBySexe')->name('users-by-sexe');
    $api->put('usersbysexe/{country_id}', 'App\Http\Controllers\APIController@putUserBySexe')->name('put-users-by-sexe');
    $api->delete('usersbysexe/{country_id}', 'App\Http\Controllers\APIController@deleteUserBySexe')->name('delete-users-by-sexe');

    $api->get('usersolde/{id}', 'App\Http\Controllers\APIController@getUserSolde')->name('user-solde');
    $api->put('usersolde/{id}', 'App\Http\Controllers\APIController@putUserSolde')->name('put-user-solde');

    $api->post('login', 'App\Http\Controllers\APIController@login')->name('login-user');


    $api->post('logout', 'App\Http\Controllers\AuthController@logout')->name('log-out');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);


});



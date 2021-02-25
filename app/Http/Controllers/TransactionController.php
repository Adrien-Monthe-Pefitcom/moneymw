<?php

namespace App\Http\Controllers;

use App\Models\Retrieval;
use App\Models\Marchant;
use App\Models\Superviseur;
use App\Models\Commercial;
use App\Models\PointVente;
use Dingo\Api\Dispatcher;
use Dingo\Api\Routing\Helpers;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\returnArgument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderby("id","asc")
        ->where("sender_id",Auth::user()->no_compte_carte_virtuelle)
        ->orwhere("receiver_id",Auth::user()->no_compte_carte_virtuelle)
        ->get();
        return view('dashboard.transactions', compact("transactions"));
    }

    public function getRetrievalfee($amount= 0)
    {
        if(!$amount==0){
            $retrieval = Retrieval::orderby("id","asc")
            ->where('min','<=',$amount)
            ->where('max','>=',$amount)
            ->get();
        }
        $transactionData['data'] = $retrieval;
        echo json_encode($transactionData);
        exit;
    }

    public function getTransaction($id = 0)
    {
        if($id==0){
            $transactions = Transaction::orderby("id","asc")
            ->select()
            ->get();
        }
        else{
            $transactions = Transaction::orderby("id","asc")
            ->where("sender_id",$id)
            ->orwhere("receiver_id",$id)
            ->get();
        }

        $transactionData['data'] = $transactions;
        echo json_encode($transactionData);
        exit;
    }

    public function insert(Request $request){
        $rules = [
			'tel1' => 'required',
            'amount1' => 'required',
            'mode' => 'required',
            'password1' => 'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
		    return redirect("/newop")
                ->withFail('Veillez remplir toutes les informations');
		}
		else{
            $data = $request->input();
            if(password_verify($data['password1'],Auth::user()->password)){
                try{
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = "depot";
                    $transaction->currency = 1;
                    $transaction->amount = $data['amount1'];
                    $transaction->trans_mode = $data['mode'];
                    $transaction->sender_id = "+"+$data['tel1'];
                    $transaction->receiver_id = Auth::user()->no_compte_carte_virtuelle;
                    $transaction->sender_name = "+"+$data['tel1'];
                    $transaction->receiver_name = Auth::user()->no_compte_carte_virtuelle;
                    $transaction->status = "Pending";
                    $transaction->save();
                    return redirect("/newop")
                        ->withSuccess('Success message');
                }
                catch(Exception $e){
                    return redirect("/newop")
                        ->withFail('Une Erreur C\'est Produite Lors De la Transaction');
                }
            }else{
                return redirect("/newop")
                    ->withFail('Mot de passe Incorrect');
            }

        }
    }


    public function insert2(Request $request){

            $data = $request->input();
			try{
                $transaction = new Transaction;
                $transaction->trans_code = $this->generateRandomString(8);
                $transaction->trans_type = "depot";
                $transaction->currency = 1;
				$transaction->amount = $data['amount1'];
                $transaction->trans_mode = "carte";
                $transaction->sender_id = Auth::user()->no_compte_carte_virtuelle; // should be obtained after login
                $transaction->receiver_id = Auth::user()->no_compte_carte_virtuelle; // should be obtained after login
                $transaction->sender_name = Auth::user()->name; // should be obtained after login
                $transaction->receiver_name = Auth::user()->name; // should be obtained after login
                $transaction->status = "Pending"; // After Obtaining API we can validate
				$transaction->save();
				return redirect()
                ->route("newop")->withSuccess('status',"Transaction has been launched");
			}
			catch(Exception $e){
                return redirect()
                ->route("newop")
                ->withFail("operation failed : Please contact Assistance");
            }
        }


    public function money_maker(Request $request)
    {
        $rules = [
            'compte_dest' => 'required',
            'country_dest' => 'required',
            'currency_dest' => 'required',
            'amount_trans' => 'required',
            'total_trans' => 'required'

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->route("newop")
                ->with('error', 'Veuillez remplir tous les champs');
        } else {
            $data = $request->input();
            $user2 = DB::table('users')->where('no_compte_carte_virtuelle', $data['compte_dest'])->first();
            $money_maker = DB::table('users')->where('no_compte_carte_virtuelle', 00000000000)->first();
            $commercial = DB::table('users')->where('id',Auth::user()->commercial_id )->first();
            $referee = DB::table('users')->where('no_compte_carte_virtuelle', Auth::user()->refere_par)->first();
            $superviseur = DB::table('users')->where('id', Auth::user()->superviseur_id)->first();
            if ($user2 == NULL) {
                return redirect("newop")->withFail('Le compte de Destination n\'pas valide ');

            }

            else if(!password_verify($data['password'],Auth::user()->password)){
                return redirect("newop")
                    ->withFail('Erreur le Mot de passe est incorrect');
            }

            else if (Auth::user()->solde < $data['amount_trans']) {
                return redirect("newop")
                    ->withFail('Votre Solde est insuffisant pour ce transfert');
            }

            else {
                try {
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = "Transfert";
                    $transaction->currency = $data['currency_dest'];;
                    $transaction->amount = $data['total_trans'];
                    $transaction->trans_mode = "Money Maker";
                    $transaction->sender_id = Auth::user()->no_compte_carte_virtuelle; // should be obtained after login
                    $transaction->receiver_id = $user2->no_compte_carte_virtuelle; // should be obtained after login
                    $transaction->sender_name = Auth::user()->name;// should be obtained after login
                    $transaction->receiver_name = $user2->name;
                    $transaction->status = "Done";
                    $transaction->description = $data['des'];
                    $transaction->save();

                    $updateusers = User::where('id', Auth::user()->id)->update([
                        'solde' => Auth::user()->solde - $data['total_trans']
                    ]);

                    $updateuser = User::where('id', $user2->id)->update([
                        'solde' => $user2->solde + $data['amount_trans']
                    ]);

                    $frais = $data['total_trans'] - $data['amount_trans'];

                    if($referee != null && $commercial != null && $superviseur != null  ){
                        $updateuser = User::where('id', $referee->id)->update([
                            'solde' => $referee->solde + $frais/4
                        ]);

                        $updateuser = User::where('id', $money_maker->id)->update([
                            'solde' => $money_maker->solde + $frais/4
                        ]);

                        $updateuser = User::where('id', $commercial->id)->update([
                            'solde' => $commercial->solde + $frais/4
                        ]);

                        $updateuser = User::where('id', $superviseur->id)->update([
                            'solde' => $superviseur->solde + $frais/4
                        ]);
                    }
                    elseif ($referee == null && $commercial != null && $superviseur == null){
                        $updateuser = User::where('id', $money_maker->id)->update([
                            'solde' => $money_maker->solde + $frais*3/4
                        ]);

                        $updateuser = User::where('id', $commercial->id)->update([
                            'solde' => $commercial->solde + $frais*1/4
                        ]);
                    }
                    elseif ($referee == null && $commercial != null && $superviseur != null){
                        $updateuser = User::where('id', $money_maker->id)->update([
                            'solde' => $money_maker->solde + $frais/2
                        ]);

                        $updateuser = User::where('id', $commercial->id)->update([
                            'solde' => $commercial->solde + $frais/4
                        ]);

                        $updateuser = User::where('id', $superviseur->id)->update([
                            'solde' => $superviseur->solde + $frais/4
                        ]);
                    }
                    elseif ($referee != null && $commercial == null && $superviseur == null){
                        $updateuser = User::where('id', $referee->id)->update([
                            'solde' => $referee->solde + $frais/4
                        ]);

                        $updateuser = User::where('id', $money_maker->id)->update([
                            'solde' => $money_maker->solde + $frais*3/4
                        ]);
                    }
                    elseif ($referee != null && $commercial == null && $superviseur != null){
                        $updateuser = User::where('id', $referee->id)->update([
                            'solde' => $referee->solde + $frais/4
                        ]);

                        $updateuser = User::where('id', $superviseur->id)->update([
                            'solde' => $superviseur->solde + $frais/4
                        ]);

                        $updateuser = User::where('id', 0)->update([
                            'solde' => $money_maker->solde + $frais/2
                        ]);
                    }

                    else{
                        $updateuser = User::where('id', 0)->update([
                            'solde' => $money_maker->solde + $frais
                        ]);
                    }



                    return redirect()
                        ->route("newop")->withSuccess("Insert successfully");
                } catch (SQLException $e) {
                    return redirect()
                        ->route("newop")
                        ->withFail('failed', "operation failed");
                }
            }
        }
    }


    public function insert_withdraw(Request $request){
        $rules = [
			'tel1' => 'required',
            'amount1' => 'required',
            'password' => 'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
            return redirect()
            ->route("newop")
			->withFail('Veuillez Renseigner toutes les informations');
		}
		else{
            $data = $request->input();
			try{
                $transaction = new Transaction;
                $transaction->trans_code = $this->generateRandomString(8);
                $transaction->trans_type = "Retrait";
                $transaction->currency = 0;
				$transaction->amount = $data['amount1'];
                $transaction->trans_mode = " Mobile Money";
                $transaction->sender_id = Auth::user()->no_compte_carte_virtuelle; // should be obtained after login
                $transaction->receiver_id = $data['tel1']; // should be obtained after login
                $transaction->sender_name =  Auth::user()->name;// should be obtained after login
                $transaction->receiver_name = $data['tel1']; // should be obtained after login
                $transaction->status = "Pending"; // After Obtaining API we can validate
				$transaction->save();
				return redirect()
                ->route("newop")->with('status',"Insert successfully");
			}
			catch(Exception $e){
                return redirect()
                ->route("newop")
                ->with('failed',"operation failed");
            }
        }
    }

    public  function generateRandomString($length = 20) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }


    public function Depot_compte_Point_Vente(Request $request)
    {
        $data = $request->input();
        $user = DB::table('users')->where('no_compte_carte_virtuelle', $data['compte_dest'])->first();
        if ($user == NULL) {
            return redirect("newop")->withFail('Le compte de Destination n\' est pas valide ');
        } else {
            try {
                $transaction = new Transaction;
                $transaction->trans_code = $this->generateRandomString(8);
                $transaction->trans_type = 0;
                $transaction->currency = 0;
                $transaction->amount = $data['amount'];
                $transaction->trans_mode = 3;
                $transaction->sender_id = 0; // should be obtained after login
                $transaction->receiver_id = $user->no_compte_carte_virtuelle; // should be obtained after login
                $transaction->sender_name = "Money Maker";// should be obtained after login
                $transaction->receiver_name = $user->name; // should be obtained after login
                $transaction->status = "Done"; // After Obtaining API we can validate
                $transaction->save();
                return redirect()
                    ->route("newop")->withSuccess("Insert successfully");
            } catch (Exception $e) {
                return redirect()
                    ->route("newop")
                    ->withFail("operation failed");
            }

        }
    }

    public function Retrait_par_compte_Point_Vente(Request $request)
    {
        $data = $request->input();
        $user = DB::table('users')->where('no_compte_carte_virtuelle', $data['compte_dest'])->first();
        $money_maker = DB::table('users')->where('id', 0)->first();
        $commercial = DB::table('users')->where('id',Auth::user()->commercial_id )->first();
        $referee = DB::table('users')->where('no_compte_carte_virtuelle', Auth::user()->refere_par)->first();
        if ($user == NULL) {
            return redirect("newop")->withFail('Le compte de Destination n\'pas valide ');
        } else {
            try {
                $transaction = new Transaction;
                $transaction->trans_code = $this->generateRandomString(8);
                $transaction->trans_type = 1;
                $transaction->currency = 0;
                $transaction->amount = $data['total_trans'];
                $transaction->trans_mode = 3;
                $transaction->sender_id = Auth::user()->no_compte_carte_virtuelle; // should be obtained after login
                $transaction->receiver_id = $user->no_compte_carte_virtuelle; // should be obtained after login
                $transaction->sender_name = Auth::user()->name;// should be obtained after login
                $transaction->receiver_name = $user->name; // should be obtained after login
                $transaction->status = "Done"; // After Obtaining API we can validate
                $transaction->save();



                $updateuser = User::where('id', Auth::user()->id)->update([
                    'solde' => $user->solde - $data['total_trans']
                ]);

                $updateuser = User::where('id', $user->id)->update([
                    'solde' => Auth::user()-> solde + $data['total_trans']
                ]);

                $frais = $data['total_trans'] - $data['amount_trans'];

                if($referee != null && $commercial != null){
                    $updateuser = User::where('id', $referee->id)->update([
                        'solde' => $referee->solde + $frais/3
                    ]);

                    $updateuser = User::where('id', 0)->update([
                        'solde' => $money_maker->solde + $frais/6
                    ]);

                    $updateuser = User::where('id', Auth::user()->id)->update([
                        'solde' => Auth::user()->solde + $frais/6
                    ]);

                    $updateuser = User::where('id', $commercial->id)->update([
                        'solde' => $money_maker->solde + $frais/3
                    ]);
                }
                elseif ($referee == null && $commercial != null){
                    $updateuser = User::where('id', 0)->update([
                        'solde' => $money_maker->solde + $frais/3
                    ]);

                    $updateuser = User::where('id', Auth::user()->id)->update([
                        'solde' => Auth::user()->solde + $frais/3
                    ]);

                    $updateuser = User::where('id', $commercial->id)->update([
                        'solde' => $money_maker->solde + $frais/3
                    ]);


                }
                elseif ($referee != null && $commercial == null){
                    $updateuser = User::where('id', $referee->id)->update([
                        'solde' => $referee->solde + $frais/3
                    ]);

                    $updateuser = User::where('id', 0)->update([
                        'solde' => $money_maker->solde + $frais*2/3
                    ]);

                    $updateuser = User::where('id', Auth::user()->id)->update([
                        'solde' => Auth::user()->solde + $frais/3
                    ]);
                }
                else{
                    $updateuser = User::where('id', 0)->update([
                        'solde' => $money_maker->solde + $frais * 2/3
                    ]);

                    $updateuser = User::where('id', Auth::user()->id)->update([
                        'solde' => Auth::user()->solde + $frais/3
                    ]);
                }


                return redirect()
                    ->route("newop")->withSuccess("Insert successfully");
            } catch (Exception $e) {
                return redirect()
                    ->route("newop")
                    ->withFail("operation failed");
            }

        }
    }

    //Gilles

    public function crediter_compte(Request $request)
    {
        $rules = [
            'compte_dest' => 'required',
            'country_dest' => 'required',
            'currency_dest' => 'required',
            'amount_trans' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->route("credit")
                ->with('error', 'Veuillez remplir tous les champs');
        } else {
            $data = $request->input();
            $user2 = DB::table('users')->where('no_compte_carte_virtuelle', $data['compte_dest'])->first();

            if(Auth::user()->role = "commercial"){
                $auth_account = DB::table('commercials')->where('user_id', Auth::user()->id)->first();
            }
            if(Auth::user()->role = "superviseur"){
                $auth_account = DB::table('superviseurs')->where('user_id', Auth::user()->id)->first();
            }
            if(Auth::user()->type_compte = "Compte Marchand"){
                $auth_account = DB::table('marchants')->where('gerant_id', Auth::user()->id)->first();
            }
            if(Auth::user()->type_compte = "Point de Vente"){
                $auth_account = DB::table('point_ventes')->where('owner', Auth::user()->no_compte_carte_virtuelle)->first();
            }


            if ($user2 == NULL) {
                return redirect("crediter_compte")->withFail('Le compte de Destination n\'pas valide ');
            } else if (Auth::user()->solde < $data['amount_trans']) {
                return redirect("crediter_compte")
                    ->withFail('Votre Solde est insuffisant pour ce transfert');
            } else {
                try {
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = "Crediter Compte Superviseur";
                    $transaction->currency = $data['currency_dest'];;
                    $transaction->amount = $data['amount_trans'];
                    $transaction->trans_mode = "Money Maker";
                    $transaction->sender_id = $auth_account->no_compte; // should be obtained after login
                    $transaction->receiver_id = $user2->no_compte_carte_virtuelle; // should be obtained after login
                    $transaction->sender_name = Auth::user()->name;// should be obtained after login
                    $transaction->receiver_name = $user2->name;
                    $transaction->status = "Effectué";
                    $transaction->description = $data['des'];
                    $transaction->save();

                    if(Auth::user()->role = "commercial"){
                        $updateusers = Commercial::where('id', $auth_account->id)->update([
                            'solde' => Auth::user()->solde_compte - $data['amount_trans']
                        ]);
                    }
                    elseif(Auth::user()->role = "superviseur"){
                        $updateusers = Superviseur::where('id', $auth_account->id)->update([
                            'solde' => Auth::user()->solde_compte  - $data['amount_trans']
                        ]);
                    }
                    elseif(Auth::user()->type_compte = "Compte Marchand"){
                        $updateusers = Marchant::where('id', $auth_account->id)->update([
                            'solde' => Auth::user()->solde_compte  - $data['amount_trans']
                        ]);
                    }
                    elseif(Auth::user()->type_compte = "Point de Vente"){
                        $updateusers = PointVente::where('id', $auth_account->id)->update([
                            'solde' => Auth::user()->solde_compte  - $data['amount_trans']
                        ]);
                    }
                    else{
                        $updateusers = User::where('id', Auth::user()->id)->update([
                            'solde' => Auth::user()->solde - $data['amount_trans']
                        ]);
                    }




                    $updateuser = User::where('id', $user2->id)->update([
                        'solde' => $user2->solde + $data['amount_trans']
                    ]);

                    return redirect()
                        ->route("credit")->withSuccess("Insert successfully");
                } catch (SQLException $e) {
                    return redirect()
                        ->route("crediter_compte")
                        ->withFail('failed', "operation failed");
                }
            }
        }
    }

    public function crediter_compte_supp(Request $request)
    {
        $rules = [
            'compte_dest' => 'required',
            'country_dest' => 'required',
            'currency_dest' => 'required',
            'amount_trans' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->route("credit")
                ->with('error', 'Veuillez remplir tous les champs');
        } else {
            $data = $request->input();
            $user2 = DB::table('superviseurs')->where('no_compte', $data['compte_dest'])->first();
            $user_name = DB::table('users')->where('id', $user2->user_id )->first();
            if ($user2 == NULL) {
                return redirect("crediter_compte_superviseur")->withFail('Le compte de Destination n\'pas valide ');
            } else if (Auth::user()->solde < $data['amount_trans']) {
                return redirect("crediter_compte_superviseur")
                    ->withFail('Votre Solde est insuffisant pour ce transfert');
            } else {
                try {
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = 3;
                    $transaction->currency = $data['currency_dest'];;
                    $transaction->amount = $data['amount_trans'];
                    $transaction->trans_mode = 3;
                    $transaction->sender_id = Auth::user()->no_compte_carte_virtuelle; // should be obtained after login
                    $transaction->receiver_id = $user2->no_compte; // should be obtained after login
                    $transaction->sender_name = Auth::user()->name;// should be obtained after login
                    $transaction->receiver_name = $user_name->name;
                    $transaction->status = "Done";
                    $transaction->description = $data['des'];
                    $transaction->save();

                    $updateusers = User::where('id', Auth::user()->id)->update([
                        'solde' => Auth::user()->solde - $data['amount_trans']
                    ]);

                    $updateuser = Superviseur::where('id', $user2->id)->update([
                        'solde_compte' => $user2->solde_compte + $data['amount_trans']
                    ]);

                    return redirect()
                        ->route("crediter_compte_superviseur")->withSuccess("Insert successfully");
                } catch (SQLException $e) {
                    return redirect()
                        ->route("crediter_compte_superviseur")
                        ->withFail('failed', "operation failed");
                }
            }
        }
    }

    public function crediter_compte_comm(Request $request)
    {
        $rules = [
            'compte_dest' => 'required',
            'country_dest' => 'required',
            'currency_dest' => 'required',
            'amount_trans' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->route("crediter_compte_commercial")
                ->with('error', 'Veuillez remplir tous les champs');
        } else {
            $data = $request->input();
            $user2 = DB::table('commercials')->where('no_compte', $data['compte_dest'])->first();
            $user_name = DB::table('users')->where('id', $user2->user_id )->first();
            $auth_sup = DB::table('superviseurs')->where('user_id', Auth::user()->id )->first();
            if ($user2 == NULL) {
                return redirect("crediter_compte_commerciale")->withFail('Le compte de Destination n\'pas valide ');
            } else if (Auth::user()->solde < $data['amount_trans']) {
                return redirect("crediter_compte_commercial")
                    ->withFail('Votre Solde est insuffisant pour ce transfert');
            } else {
                try {
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = "Crediter Commercial";
                    $transaction->currency = $data['currency_dest'];;
                    $transaction->amount = $data['amount_trans'];
                    $transaction->trans_mode = "Money Maker";
                    $transaction->sender_id = Auth::user()->no_compte_carte_virtuelle; // should be obtained after login
                    $transaction->receiver_id = $user2->no_compte; // should be obtained after login
                    $transaction->sender_name = Auth::user()->name;// should be obtained after login
                    $transaction->receiver_name = $user_name->name;
                    $transaction->status = "Done";
                    $transaction->description = $data['des'];
                    $transaction->save();

                    $updateusers = User::where('id', Auth::user()->id)->update([
                        'solde' => Auth::user()->solde - $data['amount_trans']
                    ]);

                    $updateuser = Commercial::where('id', $user2->id)->update([
                        'solde_compte' => $user2->solde_compte + $data['amount_trans']
                    ]);

                    return redirect()
                        ->route("crediter_compte_commercial")->withSuccess("Insert successfully");
                } catch (SQLException $e) {
                    return redirect()
                        ->route("crediter_compte_commercial")
                        ->withFail('failed', "operation failed");
                }
            }
        }
    }

    public function crediter_compte_ptvente(Request $request)
    {
        $rules = [
            'compte_dest' => 'required',
            'country_dest' => 'required',
            'currency_dest' => 'required',
            'amount_trans' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->route("crediter_compte_ptvente")
                ->with('error', 'Veuillez remplir tous les champs');
        } else {
            $data = $request->input();
            $user2 = DB::table('point_ventes')->where('no_compte', $data['compte_dest'])->first();
            $user_name = DB::table('users')->where('no_compte_carte_virtuelle', $user2->owner)->first();
            if ($user2 == NULL) {
                return redirect("crediter_compte_ptvente")->withFail('Le compte de Destination n\'pas valide ');
            } else if (Auth::user()->solde < $data['amount_trans']) {
                return redirect("crediter_compte_ptvente")
                    ->withFail('Votre Solde est insuffisant pour ce transfert');
            } else {
                try {
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = "Crediter Point de vente";
                    $transaction->currency = $data['currency_dest'];;
                    $transaction->amount = $data['amount_trans'];
                    $transaction->trans_mode = "Money Maker";
                    $transaction->sender_id = Auth::user()->no_compte_carte_virtuelle; // should be obtained after login
                    $transaction->receiver_id = $user2->no_compte; // should be obtained after login
                    $transaction->sender_name = Auth::user()->name;// should be obtained after login
                    $transaction->receiver_name = $user_name->name;
                    $transaction->status = "Done";
                    $transaction->description = $data['des'];
                    $transaction->save();

                    $updateusers = User::where('id', Auth::user()->id)->update([
                        'solde' => Auth::user()->solde - $data['amount_trans']
                    ]);

                    $updateuser = User::PointVente('id', $user2->id)->update([
                        'solde_compte' => $user2->solde_compte + $data['amount_trans']
                    ]);

                    return redirect()
                        ->route("crediter_compte_ptvente")->withSuccess("Insert successfully");
                } catch (SQLException $e) {
                    return redirect()
                        ->route("crediter_compte_ptvente")
                        ->withFail('failed', "operation failed");
                }
            }
        }
    }

    public function crediter_compte_marchant(Request $request)
    {
        $rules = [
            'compte_dest' => 'required',
            'country_dest' => 'required',
            'currency_dest' => 'required',
            'amount_trans' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->route("crediter_compte_marchant")
                ->with('error', 'Veuillez remplir tous les champs');
        } else {
            $data = $request->input();
            $user2 = DB::table('marchants')->where('no_compte', $data['compte_dest'])->first();
            $user_name = DB::table('users')->where('id', $user2->gerant_id )->first();
            if ($user2 == NULL) {
                return redirect("crediter_compte_marchant")->withFail('Le compte de Destination n\'pas valide ');
            } else if (Auth::user()->solde < $data['amount_trans']) {
                return redirect("crediter_compte_marchant")
                    ->withFail('Votre Solde est insuffisant pour ce transfert');
            } else {
                try {
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = "Crediter Marchand";
                    $transaction->currency = $data['currency_dest'];;
                    $transaction->amount = $data['amount_trans'];
                    $transaction->trans_mode = "Money Maker";
                    $transaction->sender_id = Auth::user()->no_compte_carte_virtuelle; // should be obtained after login
                    $transaction->receiver_id = $user2->no_compte; // should be obtained after login
                    $transaction->sender_name = Auth::user()->name;// should be obtained after login
                    $transaction->receiver_name = $user_name->name;
                    $transaction->status = "Done";
                    $transaction->description = $data['des'];
                    $transaction->save();

                    $updateusers = User::where('id', Auth::user()->id)->update([
                        'solde' => Auth::user()->solde - $data['amount_trans']
                    ]);

                    $updateuser = Marchant::where('id', $user2->id)->update([
                        'solde_compte' => $user2->solde_compte + $data['amount_trans']
                    ]);

                    return redirect()
                        ->route("crediter_compte_marchant")->withSuccess("Insert successfully");
                } catch (SQLException $e) {
                    return redirect()
                        ->route("crediter_compte_marchant")
                        ->withFail('failed', "operation failed");
                }
            }
        }
    }
}

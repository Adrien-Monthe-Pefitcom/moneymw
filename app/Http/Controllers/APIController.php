<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Dingo\Api\Dispatcher;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Response;
use League\Fractal;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_mobile_deposit_transaction(Request $request)
    {
        $rules = [
            'tel1' => 'required',
            'amount1' => 'required',
            'mode' => 'required',
            'password1' => 'required',
            'id' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'message'=>'error Veillez Renseignez tous les champs'
            ]);
        }
        else{
            $data = $request->input();
            if(password_verify($data['password1'],Auth::user()->password)){
                try{
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = 1;
                    $transaction->currency = 0;
                    $transaction->amount = $data['amount1'];
                    $transaction->trans_mode = $data['mode'];
                    $transaction->sender_id = Auth::user()->id; // should be obtained after login
                    $transaction->receiver_id = Auth::user()->id; // should be obtained after login
                    $transaction->sender_name = Auth::user()->name; // should be obtained after login
                    $transaction->receiver_name = "My Money Maker account"; // should be obtained after login
                    $transaction->status = "Pending"; // After Obtaining API we can validate
                    $transaction->save();
                    return $transaction;
                }
                catch(Exception $e){
                    return response()->json([
                        'message'=>'error Une erreur s\'est produite dans la base de données'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'Votre mot de passe est incorrecte'
                ]);
            }

        }
    }

    public function add_card_deposit_transaction(Request $request)
    {
        $rules = [
            'tel1' => 'required',
            'amount1' => 'required',
            'password1' => 'required',
            'id' => 'required'
        ];
        $data = $request->input();
        $user = DB::table('users')->where('id', $data['id'])->first();
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'message'=>'error Veillez Renseignez tous les champs'
            ]);
        }
        else{

            if(password_verify($data['password1'],$user->password)){
                try{
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = 1;
                    $transaction->currency = 0;
                    $transaction->amount = $data['amount1'];
                    $transaction->trans_mode = 4;
                    $transaction->sender_id = $user->id;
                    $transaction->receiver_id = $user->id;
                    $transaction->sender_name = $user->name;
                    $transaction->receiver_name = "My Money Maker account";
                    //if( La Methode qui doit faire le transfert par carte)
                    $transaction->status = "Pending";
                    $transaction->save();
                    return $transaction;
                }
                catch(Exception $e){
                    return response()->json([
                        'message'=>'error Une erreur s\'est produite dans la base de données'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'Votre mot de passe est incorrecte'
                ]);
            }

        }
    }

    public function transactions(Request $request){
        return Transaction::orderby("id","asc")
            ->select()
            ->get();
    }

    public function status_transaction($id){
        $trans = Transaction::orderby("id","asc")
            ->select()
            ->get()->first();
        if($trans == null){
            return response()->json([
                'status'=>'Fail',
                'message'=>' There is no user with that ID '
            ]);
        }
        return $trans->status;
    }

    public function personal_transactions_id($id){
        return Transaction::orderby("id","asc")
            ->where("sender_id",$id)
            ->orwhere("receiver_id",$id)
            ->get();
    }

    public function personal_transactions_account($account){

        $user = DB::table('users')->where('no_compte_carte_virtuelle', $account)->first();
        if($user == null){
            return response()->json([
                'status'=>'Fail',
                'message'=>' There is no user with that Account Number '
            ]);
        }
        return Transaction::orderby("id","asc")
            ->where("sender_id",$user->id)
            ->orwhere("receiver_id",$user->id)
            ->get();
    }

    public function personal_transactions_phone($phone){
        $user = DB::table('users')->where('phone', $phone)->first();
        if($user == null){
            return response()->json([
                'status'=>'Fail',
                'message'=>' There is no user with that Phone Number '
            ]);
        }
        return Transaction::orderby("id","asc")
            ->where("sender_id",$user->id)
            ->orwhere("receiver_id",$user->id)
            ->get();
    }

    public function personal_transactions_name($name){
        $user = DB::table('users')->where('name', $name)->first();
        if($user == null){
            return response()->json([
                'status'=>'Failure',
                'message'=>' There is no user with that ID '
            ]);
        }
        return Transaction::orderby("id","asc")
            ->where("sender_id",$user->id)
            ->orwhere("receiver_id",$user->id)
            ->get();
    }

    public function transactions_recieved_id($id){
        return Transaction::orderby("id","asc")
            ->where("receiver_id",$id)
            ->get();
    }

    public function transactions_recieved_account($account){

        $user = DB::table('users')->where('no_compte_carte_virtuelle', $account)->first();
        return Transaction::orderby("id","asc")
            ->orwhere("receiver_id",$user->id)
            ->get();
    }

    public function transactions_recieved_phone($phone){
        $user = DB::table('users')->where('tel', $phone)->first();
        return Transaction::orderby("id","asc")
            ->orwhere("receiver_id",$user->id)
            ->get();
    }

    public function transactions_recieved_name($name){
        $user = DB::table('users')->where('name', $name)->first();
        return Transaction::orderby("id","asc")
            ->orwhere("receiver_id",$user->id)
            ->get();
    }

    public function transactions_sent_id($id){
        return Transaction::orderby("id","asc")
            ->where("sender_id",$id)
            ->get();
    }

    public function transactions_sent_account($account){

        $user = DB::table('users')->where('no_compte_carte_virtuelle', $account)->first();
        return Transaction::orderby("id","asc")
            ->where("sender_id",$user->id)
            ->get();
    }

    public function transactions_sent_phone($phone){
        $user = DB::table('users')->where('tel', $phone)->first();
        return Transaction::orderby("id","asc")
            ->where("sender_id",$user->id)
            ->get();
    }

    public function transactions_sent_name($name){
        $user = DB::table('users')->where('name', $name)->first();
        return Transaction::orderby("id","asc")
            ->where("sender_id",$user->id)
            ->get();
    }

    public function transactions_mode($mode){
        return Transaction::orderby("id","asc")
            ->where("trans_mode",$mode)
            ->get();
    }

    public function all_transactions_on_date($date)
    {
        return DB::table('transactions')
            ->select('*')
            ->whereDate('created_at', $date)
            ->get();
    }

    public function personal_transactions_on_date(Request $request)
    {
        $data = $request->input();
        $user = DB::table('users')->where('id', $data['id'])->first();
        if($user == null){
            return response()->json([
                'status'=>'Failure',
                'message'=>' There is no user with that ID '
            ]);
        }
        return DB::table('transactions')
            ->select('*')
            ->where("sender_id",$user->id)
            ->orwhere("receiver_id",$user->id)
            ->whereDate('created_at', $data['date'] )
            ->get();
    }

    public function all_transactions_before_date($date)
    {
        return DB::table('transactions')
            ->select('*')
            ->whereDate('created_at','<', $date)
            ->get();
    }

    public function personal_transactions_before_date(Request $request)
    {
        $data = $request->input();
        $user = DB::table('users')->where('id', $data['id'])->first();
        if($user == null){
            return response()->json([
                'status'=>'Failure',
                'message'=>' There is no user with that ID '
            ]);
        }
        return DB::table('transactions')
            ->select('*')
            ->where("sender_id",$user->id)
            ->orwhere("receiver_id",$user->id)
            ->whereDate('created_at','<', $data['date'] )
            ->get();
    }

    public function all_transactions_after_date($date)
    {
        return DB::table('transactions')
            ->select('*')
            ->whereDate('created_at','>', $date)
            ->get();
    }

    public function personal_transactions_after_date(Request $request)
    {
        $data = $request->input();
        $user = DB::table('users')->where('id', $data['id'])->first();
        if($user == null){
            return response()->json([
                'status'=>'Failure',
                'message'=>' There is no user with that ID '
            ]);
        }
        return DB::table('transactions')
            ->select('*')
            ->where("sender_id",$user->id)
            ->orwhere("receiver_id",$user->id)
            ->whereDate('created_at','>', $data['date'] )
            ->get();
    }

    public function transactions_type($type){
        return Transaction::orderby("id","asc")
            ->where("trans_type",$type)
            ->get();
    }

    public function transactions_status($status){
        return Transaction::orderby("id","asc")
            ->where("status",$status)
            ->get();
    }

    public function add_transaction_money_maker(Request $request)
    {
        $rules = [
            'compte_dest' => 'required',
            'currency_dest' => 'required',
            'amount_trans' => 'required',
            'total_trans' => 'required'

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=>'error',
                'message'=>'Veillez remplir tous les champs'
            ]);
        } else {
            $data = $request->input();
            $user = DB::table('users')->where('id', $data['id'])->first();
            $user2 = DB::table('users')->where('no_compte_carte_virtuelle', $data['compte_dest'])->first();

            if ($user2 == NULL) {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Le compte de Destination n\'existe pas'
                ]);
            }

            if ($user == NULL) {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Le compte de Source n\'existe pas'
                ]);
            }
            //0 Represente l'id du compte MONEY MAKER qui doit recevoir toutes les Commissions

            $money_maker = DB::table('users')->where('id', 0)->first();
            $commercial = DB::table('users')->where('id',$user->commercial_id )->first();
            $referee = DB::table('users')->where('no_compte_carte_virtuelle', $user->refere_par)->first();
            if ($user->solde < $data['amount_trans']) {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Vous n\'avez pas assez de Fonds pour cette Transaction'
                ]);
            } else if(!password_verify($data['password'],$user->password)){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Le Mot de Passe est Incorrect.'
                ]);
            } else {
                try {
                    $transaction = new Transaction;
                    $transaction->trans_code = $this->generateRandomString(8);
                    $transaction->trans_type = 3;
                    $transaction->currency = $data['currency_dest'];;
                    $transaction->amount = $data['total_trans'];
                    $transaction->trans_mode = 3;
                    $transaction->sender_id = $user->id;
                    $transaction->receiver_id = $user2->id;
                    $transaction->sender_name = $user->name;
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

                    if($referee != null && $commercial != null){
                        $updateuser = User::where('id', $referee->id)->update([
                            'solde' => $referee->solde + $frais/3
                        ]);

                        $updateuser = User::where('id', 0)->update([
                            'solde' => $money_maker->solde + $frais/3
                        ]);

                        $updateuser = User::where('id', $commercial->id)->update([
                            'solde' => $commercial->solde + $frais/3
                        ]);
                    }
                    elseif ($referee == null && $commercial != null){
                        $updateuser = User::where('id', 0)->update([
                            'solde' => $money_maker->solde + $frais/3
                        ]);

                        $updateuser = User::where('id', $commercial->id)->update([
                            'solde' => $commercial->solde + $frais*2/3
                        ]);
                    }
                    elseif ($referee != null && $commercial == null){
                        $updateuser = User::where('id', $referee->id)->update([
                            'solde' => $referee->solde + $frais/3
                        ]);

                        $updateuser = User::where('id', 0)->update([
                            'solde' => $money_maker->solde + $frais*2/3
                        ]);
                    }
                    else{
                        $updateuser = User::where('id', 0)->update([
                            'solde' => $money_maker->solde + $frais
                        ]);
                    }

                    return $transaction;

                } catch (SQLException $e) {
                    return response()->json([
                        'status'=>'error',
                        'message'=>'une erreur s\'est produite Réessayer plus tard'
                    ]);
                }
            }
        }
    }

    public function add_transaction_withdrawal(Request $request){

        $rules = [
            'tel1' => 'required',
            'amount1' => 'required',
            'password' => 'required',
            'id' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        $data = $request->input();

        $user = DB::table('users')->where('id', $data['id'])->first();

        if ($validator->fails()) {
            return response()->json([
                'status'=>'error',
                'message'=>'Veillez remplir tous les champs'
            ]);
        }
        else if($user==null){
            return response()->json([
                'status'=>'error',
                'message'=>' l\'Identifiant de l\'utilisateur n\'est pas valide'
            ]);
        }
        else if($user->solde < $data['total_trans']){
            return response()->json([
                'status'=>'error',
                'message'=>'Votre solde est insuffisant pour cette operation'
            ]);
        }
        else if(!password_verify($data['password'],$user->password)){
            return response()->json([
                'status'=>'error',
                'message'=>'Le Mot de Passe est Incorrect.'
            ]);
        }
        else{
            try{
                $transaction = new Transaction;
                $transaction->trans_code = $this->generateRandomString(8);
                $transaction->trans_type = 0;
                $transaction->currency = 0;
                $transaction->amount = $data['amount1'];
                $transaction->trans_mode = 1;
                $transaction->sender_id = $user->id; // should be obtained after login
                $transaction->receiver_id = $data['tel1']; // should be obtained after login
                $transaction->sender_name =  $user->name;// should be obtained after login
                $transaction->receiver_name = $data['tel1']; // should be obtained after login
                $transaction->status = "Pending"; // After Obtaining API we can validate
                $transaction->save();

                return $transaction;
            }
            catch(Exception $e){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Une Erreur s\'est Produite Réessayer plus tard '
                ]);
            }
        }
    }

    public function implement_withdraw(Request $request){
        /*
         * fee
         * amount
         * trans_code
         */
        $data = $request->input();

        $trans = DB::table('transactions')->where('trans_code', $data['trans_code'])->first();
        $user = DB::table('users')->where('id', $trans->sender_id)->first();
        $trans = DB::table('transactions')->where('trans_code', $data['trans_code'])->first();
        if ($trans == NULL) {
            return response()->json([
                'status'=>'error',
                'message'=>'Cette Transaction n\'existe pas'
            ]);
        }
        $commercial = DB::table('users')->where('id',$user->commercial_id )->first();
        $referee = DB::table('users')->where('no_compte_carte_virtuelle', $user->refere_par)->first();

        //0 Represente l'id du compte MONEY MAKER qui doit recevoir toutes les Commissions
        $money_maker = DB::table('users')->where('id', 0)->first();


        $updateusers = User::where('id', $user->id)->update([
            'solde' => $user->solde - $data['amount']
        ]);

        $updatetransactions = Transaction::where('trans_code', $data['trans_code'])->update([
            'status' => 'Done'
        ]);

        $frais = data['fee'];

        if($referee != null && $commercial != null){
            $updateuser = User::where('id', $referee->id)->update([
                'solde' => $referee->solde + $frais/3
            ]);

            $updateuser = User::where('id', 0)->update([
                'solde' => $money_maker->solde + $frais/3
            ]);

            $updateuser = User::where('id', $commercial->id)->update([
                'solde' => $commercial->solde + $frais/3
            ]);
        }
        elseif ($referee == null && $commercial != null){
            $updateuser = User::where('id', 0)->update([
                'solde' => $money_maker->solde + $frais/3
            ]);

            $updateuser = User::where('id', $commercial->id)->update([
                'solde' => $commercial->solde + $frais*2/3
            ]);
        }
        elseif ($referee != null && $commercial == null){
            $updateuser = User::where('id', $referee->id)->update([
                'solde' => $referee->solde + $frais/3
            ]);

            $updateuser = User::where('id', 0)->update([
                'solde' => $money_maker->solde + $frais*2/3
            ]);
        }
        else{
            $updateuser = User::where('id', 0)->update([
                'solde' => $money_maker->solde + $frais
            ]);
        }

        return response()->json([
            'status'=>'success',
            'message'=>'Transaction Succesful'
        ]);
    }

    public function implement_deposit(Request $request){
        /*
         * user_id
         * amount
         * trans_code
         */

        $data = $request->input();
        $trans = DB::table('transactions')->where('trans_code', $data['trans_code'])->first();
        if ($trans == NULL) {
            return response()->json([
                'status'=>'error',
                'message'=>'Cette Transaction n\'existe pas'
            ]);
        }
        $user = DB::table('users')->where('id', $data['user_id'])->first();
        $updateusers = User::where('id', $user->id)->update([
            'solde' => $user->solde + $data['amount']
        ]);

        $updatetransactions = Transaction::where('trans_code', $data['trans_code'])->update([
            'status' => 'Done'
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>'Transaction Succesful'
        ]);

    }

    public function cancel_transaction($id){
        $updatetransactions = Transaction::where('id', $id)->update([
            'status' => 'Annulé'
        ]);

        return response()->json([
            'status'=>'successs',
            'message'=>'La Transaction à été annulé '
        ]);
    }

    public function transaction_author($id){
        $trans = DB::table('transactions')->where('id', $id)->first();
        $user =  DB::table('users')->where('no_compte_carte_virtuelle', $trans->sender_id)->first();
        return response()->json([
            'status'=>'successs',
            'message'=> $user->name
        ]);
    }

    public function transaction_parties($id){
        $trans = DB::table('transactions')->where('id', $id)->first();
        $user =  DB::table('users')->where('no_compte_carte_virtuelle', $trans->sender_id)->first();
        return response()->json([
            'status'=>'successs',
            'message'=> $user->name
        ]);
    }



    /***************************************************************************************************/
    /********************************GILLES************************************************************/
    /*************************************************************************************************/

    public function showAll()
    {
        //
        $user = User::all();
        if($user) {
            return $user;
        }else {
            return response()->json([
                'message'=>'error'
            ]);
        }
    }

    public function showCommerciaux()
    {
        //
        $user = User::where('role', 'commercial')->get();
        if($user) {
            return $user;
        }else {
            return response()->json([
                'message'=>'error'
            ]);
        }
    }

    public function getUsersByAccountNumber(Request $request)
    {
        try{
            $number = $request->input('number');
            $user = User::where('no_compte_carte_virtuelle', $number)->first();
            if($user)
            {
                return Response::json($user,200);
            }
            else
            {
                return response()->json([
                    'status'=> 'error',
                    'message' => 'Utilisateur pas trouve',
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'error' =>'erreur'
            ]);
        }
    }

    function getUsersByAccountType(Request $request)
    {
        try{
            $type = $request->input('type_compte');
            $user = User::where('type_compte', $type)->get();
            if($user)
            {
                return Response::json($user,200);
            }
            else
            {
                return response()->json([
                    'status'=> 'error',
                    'message' => 'Utilisateur pas trouve',
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'error' =>'erreur'
            ]);
        }
    }

    function getUserById($id)
    {
        try{
            $user=User::find($id);
            //print($user);
            if($user)
            {
                return Response::json($user,200);
            }
            else
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Utilisateur pas trouve'
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                'error' => 'erreur'
            ]);
        }
    }

    function getUsersByPieceNumber(Request $request)
    {
        try{
            $piece_number = $request->input('num_piece');
            $user = User::where('num_piece', $piece_number)->get();
            if($user)
            {
                return Response::json($user,200);
            }
            else
            {
                return response()->json([
                    'status'=> 'error',
                    'message' => 'Utilisateur pas trouve',
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'error' =>'erreur'
            ]);
        }
    }

    function getUsersByPhoneNumber(Request $request)
    {
        try{
            $phon = $request->input('telephone');
            $user = User::where('phone', $phon)->get();
            if($user)
            {
                return Response::json($user,200);
            }
            else
            {
                return response()->json([
                    'status'=> 'error',
                    'message' => 'Utilisateur pas trouve',
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'error' =>'erreur'
            ]);
        }
    }

    public function login(Request $request) {

        $telephone = $request->input('tel');
        $user = User::where('phone', $telephone)->first();
        //$model = User::class;
        if ($user) {
            if (Auth::attempt(['phone' => $request->tel,'password' => $request->pin])) {

                $user=Auth::user();

                $user->save();
                //dd($user);
                if ($user->role == "user") {
                    if($user->statut == "bloqued") {
                        return response()->json([
                            'status'=>'error',
                            'message'=>'Votre compte a ete bloque. Veuillez appeler notre service client'
                        ]);
                    }else {
                        return response()->json([
                            'status'=>'success',
                            'code'=>1,
                            'role'=>'user'
                        ]);
                    }
                }
                if ($user->role == "admin") {
                    return response()->json([
                        'status'=>'success',
                        'code'=>2,
                        'role'=>'admin'
                    ]);
                }

                if ($user->role == "commercial") {
                    return response()->json([
                        'status'=>'success',
                        'code'=>3,
                        'role'=>'commercial'
                    ]);
                }

                if ($user->role == "superviseur") {
                    return response()->json([
                        'status'=>'success',
                        'code'=>4,
                        'role'=>'superviseur'
                    ]);
                }

            }
            else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Identifiants de Connexion invalides ,Veuillez ressayer plutard'
                ]);
            }
        } else {
            return response()->json([
                'status'=>'error',
                'message'=>'Cet Utilisateur n\'existe pas!. Veuillez ajouter l\'indicateur de votre pays d\'inscription'
            ]);
            /*if (Auth::attempt(['phone' => $request->tel,'password' => $request->pin], $remember)) {

                $user=Auth::user();

                $user->save();
                //dd($user);
                if ($user->role == "user") {
                    if($user->statut == "bloqued") {
                        return response()->json([
                            'status'=>'error',
                            'message'=>'Votre compte a ete bloque. Veuillez appeler notre service client'
                        ]);
                    }else {
                        return response()->json([
                            'status'=>'success',
                            'code'=>1
                        ]);
                    }
                }
                if ($user->role == "admin") {
                    return response()->json([
                        'status'=>'success',
                        'code'=>2
                    ]);
                }

                if ($user->role == "commercial") {
                    return response()->json([
                        'status'=>'success',
                        'code'=>3
                    ]);
                }

            }
            else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Identifiants de Connexion invalides ,Veuillez ressayer plutard'
                ]);
            }*/
        }


    }

    public function logout(Request $request){

        $remember = ($request->remember) ? true : false;
        /*if (Auth::attempt(['phone' => $request->tel,'password' => $request->pin], $remember)) {
            $user=Auth::user();
            //$user->online = false;
            $user->save();
            auth()->user()->token()->revoke();
            if (Auth::logout()) {
                return response()->json([
                    'status'=>'success',
                    'message'=>'Log Out successfully'
                ]);
            } else {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Erreur lors du logout'
                ]);
            }
        }*/
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function qrcode($id){
        try{
            $user = User::find($id);
            if($user)
            {
                return Response::json($user->no_compte_carte_virtuelle,200);
            }
            else
            {
                return response()->json([
                    'status'=> 'error',
                    'message' => 'Utilisateur pas trouve',
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'error' =>'erreur'
            ]);
        }
    }

    public function register(Request $request){
        if($request->isMethod('POST')) // revoir pk pas post poste
        {

            $rules = [
                'country_id' => 'required'
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'=> 'error',
                    'message'=>' Champs importants'
                ]);
            }

            if (User::where('phone',$request->phone_number)->exists()) {
                return response()->json([
                    'status'=> 'error',
                    'message'=>' Ce numero de telephone existe deja'
                ]);
            }
            if (User::where('no_compte_carte_virtuelle',$request->num_compte)->exists()) {
                return response()->json([
                    'status'=> 'error',
                    'message'=>' Ce numero de carte virtuelle existe deja. Veuillez ressayer'
                ]);
            }
            if (User::where('num_piece',$request->num_piece)->exists()) {
                return response()->json([
                    'status'=> 'error',
                    'message'=>' Ce numero de piece existe deja'
                ]);
            }
            if (User::where('identifiant_unique',$request->country_id)->exists()) {
                return response()->json([
                    'status'=> 'error',
                    'message'=>'Cet Identifiant unique existe deja'
                ]);
            }



            $useradd = new User();
            $useradd->email = $request->email;
            $useradd->name = $request->name;
            $useradd->sexe = $request->sexe;
            $useradd->identifiant_unique = $request->country_id;
            $useradd->ville = $request->town;
            $useradd->pays = $request->country;
            $useradd->profession = $request->profession;
            $useradd->date_naissance = $request->dob;
            $useradd->nom_banque = $request->bank_name;
            $useradd->num_piece = $request->num_piece;
            $useradd->scan_piece = $request->scan_piece;
            $useradd->photo = $request->photo;
            $useradd->phone = $request->phone_number;
            $useradd->refere_par = $request->parrain;
            $useradd->no_compte_carte_virtuelle = $request->num_compte;
            $useradd->signature = $request->signature;
            $useradd->type_compte = $request->type_compte;
            $useradd->num_compte_bancaire = $request->bank_acc;
            $useradd->password = Hash::make($request->password);
            $useradd->remember_token  =  Str::random(100);
            //dd($user);

            $useradd->save();
            // return Response::json($useradd,200);
            if($useradd->save()) {
                return response()->json([
                    'status'=> 'succes',
                    'message'=>' Utilisateur ajoute'
                ]);
            } else {
                return response()->json([
                    'status'=> 'error',
                    'message'=>' Erreur lors de l\'ajout de l\'utilisateur'
                ]);
            }

        }
        else
        {
            return response()->json([
                'status'=> 'error',
                'message'=>' methode de requete invalide'
            ]);
        }
    }

    //put user
    public function putUser($id){
        $user = User::find($id);
        $updateUser = User::Where('id', $id)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    //put user
    public function changeToCommercial($id){
        $user = User::find($id);
        $updateUser = User::Where('id', $id)->update([
            'role'=> 'commercial'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    //delete user

    public function deleteUser($id){
        $user = User::find($id);
        $deleteUser = User::Where('id', $id)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    //put user by account number
    public function putUserByAccountNumber($account_number){
        $updateUser = User::Where('no_compte_carte_virtuelle', $account_number)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    //delete user by account number

    public function deleteUserByAccountNumber($account_number){

        $deleteUser = User::Where('no_compte_carte_virtuelle', $account_number)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    //put user by num piece
    public function putUserByPieceNumber($piece_number){
        $updateUser = User::Where('num_piece', $piece_number)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    //delete user by num piece

    public function deleteUserByPieceNumber($piece_number){

        $deleteUser = User::Where('num_piece', $piece_number)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    //put user by phone number
    public function putUserByPhoneNumber($phone_number){
        $updateUser = User::Where('phone', $phone_number)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    //delete user by phone number

    public function deleteUserByPhoneNumber($phone_number){

        $deleteUser = User::Where('phone', $phone_number)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    //put user by account type
    public function putUserByAccountType($account_type){
        $updateUser = User::Where('type_compte', $account_type)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    //delete user by account type

    public function deleteUserByAccountType($account_type){

        $deleteUser = User::Where('type_compte', $account_type)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    // get users refered
    public function getUsersRefered() {
        $user = User::where('refere_par', '!=', NULL)->get();
        if($user) {
            return Response::json($user,200);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    // get users refered by
    public function getUsersReferedBy($account_number) {
        $user = User::where('refere_par', $account_number)->get();
        if($user) {
            return Response::json($user, 200);
        }
        else {
            return response()->json([
                'message' => 'Error',
                'status' => 'error',
            ]);
        }
    }

    // put users refered
    public function putUserReferedBy($account_number) {
        $updateUser = User::Where('refere_par', $account_number)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    // delete users refered
    public function deleteUserReferedBy($account_number) {
        $deleteUser = User::Where('refere_par', $account_number)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    //get users by unique identifier
    function getUsersByUniqueIdentifier(Request $request)
    {
        try{
            $country_id = $request->input('country_id');
            $user = User::where('identifiant_unique', $country_id)->get();
            if($user)
            {
                return Response::json($user,200);
            }
            else
            {
                return response()->json([
                    'status'=> 'error',
                    'message' => 'Utilisateur pas trouve',
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'error' =>'erreur'
            ]);
        }
    }

    // put users by unique identifier
    public function putUserByUniqueIdentifier($country_id) {
        $updateUser = User::Where('identifiant_unique', $country_id)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    // delete users unique identifier
    public function deleteUserByUniqueIdentifier($country_id) {
        $deleteUser = User::Where('identifiant_unique', $country_id)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    // get users by status
    function getUsersByStatut(Request $request)
    {
        try{
            $statut = $request->input('statut');
            $user = User::where('statut', $statut)->get();
            if($user)
            {
                return Response::json($user,200);
            }
            else
            {
                return response()->json([
                    'status'=> 'error',
                    'message' => 'Utilisateur pas trouve',
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'error' =>'erreur'
            ]);
        }
    }

    // validate users by id
    public function validateStatut($id) {
        $updateUser = User::Where('id', $id)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    // validate users by id
    public function bloquedStatut($id) {
        $updateUser = User::Where('id', $id)->update([
            'statut'=> 'bloqued'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    // validate users by statut
    public function validateStatutByStatut($statut) {
        $updateUser = User::Where('statut', $statut)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    // delete users by statut
    public function bloquedStatutByStatut($statut) {
        $updateUser = User::Where('statut', $statut)->update([
            'statut'=> 'bloqued'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    // delete users unique identifier
    public function deleteUserByStatut($statut) {
        $deleteUser = User::Where('statut', $statut)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    //get users by country
    function getUsersByCountry(Request $request)
    {
        try{
            $country = $request->input('country');
            $user = User::where('pays', $country)->get();
            if($user)
            {
                return Response::json($user,200);
            }
            else
            {
                return response()->json([
                    'status'=> 'error',
                    'message' => 'Utilisateur pas trouve',
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'error' =>'erreur'
            ]);
        }
    }

    // put users by country
    public function putUserByCountry($country) {
        $updateUser = User::Where('pays', $country)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    // delete users by country
    public function deleteUserByCountry($country) {
        $deleteUser = User::Where('pays', $country)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    //get users by sexe
    function getUsersBySexe(Request $request)
    {
        try{
            $sexe = $request->input('sexe');
            $user = User::where('sexe', $sexe)->get();
            if($user)
            {
                return Response::json($user,200);
            }
            else
            {
                return response()->json([
                    'status'=> 'error',
                    'message' => 'Utilisateur pas trouve',
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'error' =>'erreur'
            ]);
        }
    }

    // put users by sexe
    public function putUserBySexe($sexe) {
        $updateUser = User::Where('sexe', $sexe)->update([
            'statut'=> 'validated'
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }
    }

    // delete users by sexe
    public function deleteUserBySexe($sexe) {
        $deleteUser = User::Where('sexe', $sexe)->delete();
        if($deleteUser) {
            return response()->json([
                'message' => 'User Successful deleted',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while deleting',
                'status' => 'error',
            ]);
        }
    }

    public function getUserSolde($id) {
        $user = User::find($id);

        if($user) {
            return Response::json($user->solde,200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Utilisateur pas trouve'
            ]);
        }

    }

    public function putUserSolde(Request $request, $id) {
        $solde = $request->input('solde');
        $updateUser = User::where('id', $id)->update([
            'solde' => $solde
        ]);

        if($updateUser) {
            return response()->json([
                'message' => 'User Successful updated',
                'status' => 'success',
            ]);
        }
        else {
            return response()->json([
                'message' => 'Error while updating',
                'status' => 'error',
            ]);
        }

    }
}

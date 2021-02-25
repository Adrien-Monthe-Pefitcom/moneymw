<?php

/**

 * Created by PhpStorm.

 * User: SOFT

 * Date: 1/6/2021

 * Time: 2:57 PM

 */



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

use App\Models\User;

use App\Models\Commercial;

use App\Models\Superviseur;

use App\Models\Transaction;

use App\Models\Currency;

use App\Models\Country;

use App\Models\Marchant;

use App\Models\PointVente;

use App\Models\Retrieval;

use Illuminate\Support\Facades\Auth;

use Validator;



use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;



use SimpleSoftwareIO\QrCode\Generator;

use Illuminate\Routing\Controller as BaseController;  // <<< See here - no real class, only an alias





class PageController extends Controller

{

    public function nextconnected()

    {

        return view('next.next');

    }



    public function nextconnected2()

    {

        return view('next.next-page');

    }



    public function register()

    {

        return view('next.register');

    }



    public function registerByCommercial()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        return view('commercial.registerbycomm');

    }



    //by supp



    public function registerBySuperviseur()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        return view('superviseur.registerbysup');

    }



    public function registerCommercial()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        return view('admin.registercomm');

    }





    //comm by supp



    public function registerCommercialBySup()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        return view('superviseur.registercommbysup');

    }



    public function registerAdmin()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        return view('superadmin.registeradmin');

    }



    public function registerSuperviseur()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        return view('admin.registersuperviseur');

    }



    public function registerClient()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        return view('admin.registerclient');

    }



    public function dashboard()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }
	$transactions = Transaction::orderby("id","asc")

        ->where("sender_id",Auth::user()->no_compte_carte_virtuelle)

        ->orwhere("receiver_id",Auth::user()->no_compte_carte_virtuelle)

        ->get();

      return view('dashboard.index', compact("transactions"));

    }



    public function dashboardcomm()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        $userauth = Auth::user()->id;

        $user1 = User::where('id', $userauth)->get();

        $valcomm = new Commercial();

        $comptecomm = Commercial::where('user_id', $userauth)->get();

        $solde = $comptecomm[0]->solde_compte;

        $no_compte = $comptecomm[0]->no_compte;

        return view('commercial.comm_prof', compact('user1', 'valcomm', 'solde' , 'no_compte'));

    }

    public function depot()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $currencies = Currency::All()->toArray();

        $countries = Country::All()->toArray();



        return view('dashboard.depot',  compact("countries"),compact("currencies"));

    }



    public function creditCompte()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        $currencies = Currency::All()->toArray();

        $countries = Country::All()->toArray();

        $retrievals = Retrieval::All()->toArray();

        return view('commercial.depot' ,  compact("countries"),compact("currencies"));

    }



    // crdit compte

    public function creditCompteMarchant()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        $currencies = Currency::All()->toArray();

        $countries = Country::All()->toArray();

        $retrievals = Retrieval::All()->toArray();

        return view('admin.crediter_marchant' ,  compact("countries"),compact("currencies"));

    }



    public function creditComptePtvente()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        $currencies = Currency::All()->toArray();

        $countries = Country::All()->toArray();

        $retrievals = Retrieval::All()->toArray();

        return view('admin.crediter_ptvente' ,  compact("countries"),compact("currencies"));

    }



    public function creditCompteCommercial()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        $currencies = Currency::All()->toArray();

        $countries = Country::All()->toArray();

        $retrievals = Retrieval::All()->toArray();

        return view('admin.crediter_comm' ,  compact("countries"),compact("currencies"));

    }



    public function creditCompteSuperviseur()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        $currencies = Currency::All()->toArray();

        $countries = Country::All()->toArray();

        $superviseurs = DB::select('select s.no_compte as account, u.name from users u, superviseurs s where u.id = s.user_id');


        return view('admin.crediter_supp' ,  compact("countries", "currencies", "superviseurs"));

    }



    public function dashComm()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        $userauth = Auth::user()->id;

        $user1 = User::where('id', $userauth)->get();

        $valcomm = new Commercial();

        $comptecomm = Commercial::where('user_id', $userauth)->get();

        $solde = $comptecomm[0]->solde_compte;

        $no_compte = $comptecomm[0]->no_compte;

        return view('commercial.comdash', compact('user1', 'valcomm', 'solde' , 'no_compte'));

    }

    public function settings()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        return view('dashboard.settings');

    }



    public function transactions()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $transactions = Transaction::orderby("id","asc")

        ->where("sender_id",Auth::user()->no_compte_carte_virtuelle)

        ->orwhere("receiver_id",Auth::user()->no_compte_carte_virtuelle)

        ->get();

      return view('dashboard.transactions', compact("transactions"));

    }

    public function newOp()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $currencies = Currency::All()->toArray();

        $countries = Country::All()->toArray();

        $retrievals = Retrieval::All()->toArray();

        return view('dashboard.newtrans',  compact("countries"),compact("currencies"),compact("retrievals"));

    }



    public function payByQrCode(Request $request) {

        if($request->isMethod('POST')) {

            print('hello');

        } else {

            return response()->json([

                'status'=>'error',

                'message'=>'Methode de requete invalide'

            ]);

        }

    }



    public function statut() {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        /*$user_id=Auth::user()->id;

        $users= User::where('id','!=',$user_id)->get();*/



        // $data1 = QrCode::email('foo@bar.com', 'this is the subject', 'this is the body');



        return view('dashboard.userstatut');

    }



    public function statutAdmin() {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        /*$user_id=Auth::user()['id'];

        $users= User::where('id','!=',$user_id)->get();*/

        $users= User::all();

        return view('dashboard.admindash', compact('users'));

    }



    //validations

    public function validates()

    {

        if (!Auth::check())

        {

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();

        return view('admin.validate', compact('newusers'));

    }



    public function statutupdate($id)

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $id = User::find($id);

        //dd($id->title_fr);

        $users= User::all();

        return view('dashboard.statutupdate', compact('users'))->with('id', $id);

    }



    public function tarifs()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        return view('dashboard.tarifs');

    }





    public function statutpostup(Request $request)

    {

        if ($request->isMethod('POST'))

        {

            if (User::where(['id'=>$request->id])->update([

                'statut'=>$request->statut,

                ])){

                    Session::flash('message', "Le statut a bien été mis à jour");

                    return Redirect::back();

                }

                else

                {

                    Session::flash('message', "Le statut n'a pas été mis à jour");

                    return Redirect::back();

                }



        }

    }



    //validation utilisateur

    public function  validuser()

    {

        //if(isset($_GET['selfieChecked'])){

          //  echo 'ok';

        //}elseif (isset($_GET['selfieCheckedf'])){

         //   echo 'nope';

       // }else{

        //    echo 'no value';

        //}



        //$selfie=$_GET['selfieChecked'];



        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();

        $marchants= Marchant::all();

        $users= new User();

        $pointventes= PointVente::all();



        $updateusers = User::where('id', $_GET['hiddenid'])->update([

            'statut'=> 'validated'

            ]);

            Session::flash('message', "Statut valide avec success");

     return redirect()->route('gestion-client');

    }



    //Pour changer le statut de l'utilisateur à deleted

	public function delete_user_by_statut($id){

        $updateuser = User::where('id', $id)->update([

            'statut' => 'deleted'

        ]);

    }



     //Debloquer l'utilisateur

     public function  unblock($id)

     {

         if(!Auth::check()){

             return redirect()->route('user-login');

         }

         $updateuser = User::where('id', $id)->update([

             'statut' => 'validated'

         ]);



         $user_id=Auth::user()->id;

         $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();



         return view('admin.gesclient', compact("newusers"));



     }



    public function  deleteUser($id)// de la base de donnees

    {



        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;

        /*$newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();

        $marchants= Marchant::all();

        $users= new User();

        $pointventes= PointVente::all();*/



        $deleteusers = User::where('id', $id)->delete();

        Session::flash('message', "Utilisateur supprime avec succes");

     return redirect()->route('gestion-client');

    }



    public function  blockUser($id)

    {



        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;

        /*$newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();

        $marchants= Marchant::all();

        $users= new User();

        $pointventes= PointVente::all();*/



        $blockusers = User::where('id', $id)->update([

            'statut' => 'blocked',

        ]);

        Session::flash('message', "Status bloque avec succes");

     return redirect()->route('gestion-client');

    }





    //marchant update delete



    public function delete_marchant_by_statut($id){

        $updatemarchant = Marchant::where('id', $id)->update([

            'statut' => 'deleted'

        ]);

    }



    public function  deleteMarchant($id)// de la base de donnees

    {



        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;

        /*$newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();

        $marchants= Marchant::all();

        $users= new User();

        $pointventes= PointVente::all();*/



        $deletemarchants = Marchant::where('id', $id)->delete();

        Session::flash('message', "Marchant supprime avec succes");

     return redirect()->route('gestion-client');

    }



    public function  blockMarchant($id)

    {



        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;

        /*$newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();

        $marchants= Marchant::all();

        $users= new User();

        $pointventes= PointVente::all();*/



        $blockmarchants = Marchant::where('id', $id)->update([

            'statut' => 'blocked',

        ]);

        Session::flash('message', "Marchant bloque avec succes");

     return redirect()->route('gestion-client');

    }





    //marchant update delete



    public function delete_ptvente_by_statut($id){

        $updateptvente = PointVente::where('id', $id)->update([

            'statut' => 'deleted'

        ]);

    }



    public function  deletePtvente($id)// de la base de donnees

    {



        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;

        /*$newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();

        $marchants= Marchant::all();

        $users= new User();

        $pointventes= PointVente::all();*/



        $deleteptvente = PointVente::where('id', $id)->delete();

        Session::flash('message', "Point de vente supprime avec succes");

     return redirect()->route('gestion-client');

    }



    public function  blockPtvente($id)

    {



        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;

        /*$newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();

        $marchants= Marchant::all();

        $users= new User();

        $pointventes= PointVente::all();*/



        $blockptventes = PointVente::where('id', $id)->update([

            'statut' => 'blocked',

        ]);

        Session::flash('message', "Point de vente bloque avec succes");

     return redirect()->route('gestion-client');

    }



    public function  gesclient()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }



        $user_id=Auth::user()->id;

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();



        return view('admin.gesclient', compact("newusers"));

    }







    public function  listecomptes()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }



        /* $user_id=Auth::user()->id;

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();   */

        $user_id = Auth::user()->id;

       // $comptescrees = User::where(['role' => 'user'])->where('num_piece', '!=', '12312')->get();



       $comptescrees = User::where('commercial_id', $user_id)->get();

       $marchants = Marchant::where('commercial_id', $user_id)->get();

       $marchantuser = new User();

        return view('commercial.listecomptescrees', compact('comptescrees', 'marchants', 'marchantuser'));

    }



    public function  listecomptessupp()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }



        /* $user_id=Auth::user()->id;

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();   */

        $user_id = Auth::user()->id;

       // $comptescrees = User::where(['role' => 'user'])->where('num_piece', '!=', '12312')->get();



       $comptescrees = User::where('superviseur_id', $user_id)->get();

       $marchants = Marchant::where('superviseur_id', $user_id)->get();

       $ptventes = PointVente::where('superviseur_id', $user_id)->get();

       $commercial = Commercial::where('superviseur_id', $user_id)->get();

       $marchantuser = new User();

        return view('superviseur.listecomptescreessup', compact('comptescrees', 'marchants', 'commercial', 'ptventes', 'marchantuser'));

    }



    public function  listecommerciaux()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }



        /* $user_id=Auth::user()->id;

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();   */

        $valeuruser = new User();

        $commercial = Commercial::all();

        return view('admin.listecommerciaux', compact('valeuruser', 'commercial'));

    }



    //superviseur



    public function  listesuperviseurs()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }



        /* $user_id=Auth::user()->id;

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();   */

        $valeuruser = new User();

        $superviseur = Superviseur::all();

        return view('admin.listesuperviseurs', compact('valeuruser', 'superviseur'));

    }



    public function  listepointventes()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }



        /* $user_id=Auth::user()->id;

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();   */

        $valeuruser = new User();

        $pointventes = PointVente::all();

        return view('admin.listepointdeventes', compact('valeuruser', 'pointventes'));

    }



    public function  qrcode()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }



        /* $user_id=Auth::user()->id;

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();   */



        return view('dashboard.qrscan');

    }



    public function  newdetail($id)

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        /*$newdetail = User::find($_GET['row'])->toArray();

        $newdetail=$newdetail[0];*/



        $id = User::find($id);

        //return $newdetail['name'];



        return view('admin.newdetail')->with('id', $id);

    }



    public function  detail($id)

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        /*$newdetail = User::find($_GET['row'])->toArray();

        $newdetail=$newdetail[0];*/



        $id = User::find($id);

        //return $newdetail['name'];



        return view('admin.detail')->with('id', $id);

    }







    public function validateur()

    {

        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;

        $marchants= Marchant::all();

        $commercial= Commercial::all();

        $superviseur= Superviseur::all();

        $users= new User();

        $valeuruser= new User();

        $pointventes= PointVente::all();

        $newusers= User::where(['role'=>'user'])->where('id','!=',$user_id)->get();

        //dd($newusers);

        return view('admin.validate', compact("newusers", "marchants", "valeuruser", "pointventes", "users", "commercial", "superviseur"));

    }



    public function visa()

    {

        if(!Auth::check()){

            return redirect()->route('login');

        }

        return view('dashboard.visa');

    }



    //validation utilisateur

    public function  profilUpdate(Request $request) {

        //if(isset($_GET['selfieChecked'])){

          //  echo 'ok';

        //}elseif (isset($_GET['selfieCheckedf'])){

         //   echo 'nope';

       // }else{

        //    echo 'no value';

        //}



        //$selfie=$_GET['selfieChecked'];



        if(!Auth::check()){

            return redirect()->route('user-login');

        }

        $user_id=Auth::user()->id;



        /*if (User::where('phone',$request->tel)->exists()) {

            Session::flash('message', "Ce numero existe deja");

            return Redirect::back();

        }

        else if (User::where('num_piece',$request->num_piece)->exists()) {

            Session::flash('message', "Ce numero de piece existe deja");

            return Redirect::back();

        }

        else if (User::where('identifiant_unique',$request->country_id)->exists()) {

            Session::flash('message', "Cet Identifiant unique existe deja");

            return Redirect::back();

        }else {*/

            $updateusers = User::where('id', $user_id)->update([

                'email'=> $request->email,

                'phone'=> $request->tel,

                'name'=> $request->nom,

                'identifiant_unique'=> $request->country_id,

                'ville'=> $request->ville,

                'pays'=> $request->pays,

                'profession'=> $request->profession,

                'date_naissance'=> $request->dob,

                'num_compte_bancaire'=> $request->num_compte,

                'num_piece'=> $request->num_piece,

                'nom_banque'=> $request->nom_bank,



            ]);



        if($updateusers) {

            Session::flash('message', "Votre profil a bien été mis à jour");

              return Redirect::back();

        } else {

            Session::flash('message', "Votre profil n'a pas été mis à jour");

              return Redirect::back();

        }

    }

	public function change_password()
    {
        if (!Auth::check())
        {
            return redirect()->route('user-login');
        }

        return view('dashboard.change_password' );

    }



 }

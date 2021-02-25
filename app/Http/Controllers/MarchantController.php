<?php

namespace App\Http\Controllers;

use App\Models\Marchant;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PointVente;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MarchantController;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class MarchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('user-login');
        }
        $users = User::all();
        return view('next.business', compact('users'));
    }

    public function marchantByCommercial()
    {
        if(!Auth::check()){
            return redirect()->route('user-login');
        }

        $users = User::all();
        return view('commercial.marchantbycomm', compact('users'));
    }

    public function ptventeInfo() {
        return view('superviseur.infoptvente');
    }
    public function marchantBySuperviseur()
    {
        if(!Auth::check()){
            return redirect()->route('user-login');
        }

        $users = User::all();
        return view('superviseur.marchantbysup', compact('users'));
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

    public function store(Request $request) {
            if(!Auth::check()) {
                return redirect()->route('user-login');
            }

            if ($request->isMethod('POST')) {
                //dd($request->password);
                if (Marchant::where('email',$request->email)->exists()) {
                    return response()->json([
                        'status'=>'info',
                        'message'=>'Cet Email Existe deja'
                    ]);
                } else if (Marchant::where('no_compte',$request->num_marchant)->exists()) {
                    return response()->json([
                        'status'=>'info',
                        'message'=>'Cet Numero de compte Existe deja'
                    ]);
                }
                else {
                    $marchant = Marchant::create([
                    'nom' => $request->name,
                    'email' => $request->email,
                    'raison' => $request->raison,
                    'date_creation' => $request->date,
                    
                    'forme' => $request->forme,
                    'contact_gerant' => $request->contactDiri,
                    'siege' => $request->location,
                    'phone' => $request->tel,
                    'site' => $request->web,
                    'activite' => $request->activites,
                    'gerant_id' => $request->nom_gerant,
                    'no_compte' => $request->num_marchant,
                    // 'gerant_id' => Auth::user()->id
                    // 'gerant_id' => $request->contactDiri,
                ]);

                if ($marchant) {
                    /*try {
                        Mail::to($request->email)->queue(
                            new NewUserNotification()
                        );

                    } catch (\Exception $e) {
                        // return $e->getMessage();
                        return response()->json([
                            'status'=>'info',
                            'message'=>'Action failed ,Try again later!'
                        ]);
                    }*/
                    return response()->json([
                        'status'=>'success',
                        'message'=>'Compte Marchant Enregistre avec succes'
                    ]);
                } else{
                    return response()->json([
                        'status'=>'info',
                        'message'=>'Erreur lors de l\'enregistrement. Veuillez reesayer '
                    ]);
                }

                }
            }
            else{
                return response()->json([
                    'status'=>'info',
                    'message'=>'invalid request method'
                ]);
            }
        /*$newbusiness = new Marchant();
        $newbusiness->nom = $request->input('name'); 
        $newbusiness->raison = $request->input('raison'); 
        $newbusiness->forme = $request->input('formejuri'); 
        $newbusiness->gerant = $request->input('gerant'); 
        $newbusiness->date_creation = $request->input('date'); 
        $newbusiness->email = $request->input('email'); 
        $newbusiness->contact = $request->input('contactDiri'); //contact gerant
        $newbusiness->siege = $request->input('location'); 
        $newbusiness->phone = $request->input('tel');
        $newbusiness->site = $request->input('web'); 
        $newbusiness->activite = $request->input('activités');
        
        $newbusiness->save();
        return redirect()->route('user-recap');*/
    }

    public function marchantByComm(Request $request) {
        if(!Auth::check()) {
            return redirect()->route('user-login');
        }

        if ($request->isMethod('POST')) {
            //dd($request->password);
            if (Marchant::where('email',$request->email)->exists()) {
                return response()->json([
                    'status'=>'info',
                    'message'=>'Cet Email Existe deja'
                ]);
            }else if (Marchant::where('no_compte',$request->num_marchant)->exists()) {
                return response()->json([
                    'status'=>'info',
                    'message'=>'Cet Numero de compte Existe deja'
                ]);
            }
            else {
                $marchant = Marchant::create([
                'nom' => $request->name,
                'email' => $request->email,
                'raison' => $request->raison,
                'date_creation' => $request->date,
                
                'forme' => $request->forme,
                'contact_gerant' => $request->contactDiri,
                'siege' => $request->location,
                'phone' => $request->tel,
                'site' => $request->web,
                'activite' => $request->activites,
                'gerant_id' => $request->nom_gerant,
                'commercial_id' => Auth::user()->id,
                'no_compte' => $request->num_marchant,
                // 'gerant_id' => Auth::user()->id
                // 'gerant_id' => $request->contactDiri,
            ]);

            if ($marchant) {
                /*try {
                    Mail::to($request->email)->queue(
                        new NewUserNotification()
                    );

                } catch (\Exception $e) {
                    // return $e->getMessage();
                    return response()->json([
                        'status'=>'info',
                        'message'=>'Action failed ,Try again later!'
                    ]);
                }*/
                return response()->json([
                    'status'=>'success',
                    'message'=>'Compte Marchant Enregistre avec succes'
                ]);
            } else{
                return response()->json([
                    'status'=>'info',
                    'message'=>'Erreur lors de l\'enregistrement. Veuillez reesayer '
                ]);
            }

            }
        }
        else{
            return response()->json([
                'status'=>'info',
                'message'=>'invalid request method'
            ]);
        }
    /*$newbusiness = new Marchant();
    $newbusiness->nom = $request->input('name'); 
    $newbusiness->raison = $request->input('raison'); 
    $newbusiness->forme = $request->input('formejuri'); 
    $newbusiness->gerant = $request->input('gerant'); 
    $newbusiness->date_creation = $request->input('date'); 
    $newbusiness->email = $request->input('email'); 
    $newbusiness->contact = $request->input('contactDiri'); //contact gerant
    $newbusiness->siege = $request->input('location'); 
    $newbusiness->phone = $request->input('tel');
    $newbusiness->site = $request->input('web'); 
    $newbusiness->activite = $request->input('activités');
    
    $newbusiness->save();
    return redirect()->route('user-recap');*/
}

//sup 
    public function marchantBySup(Request $request) {
        if(!Auth::check()) {
            return redirect()->route('user-login');
        }

        if ($request->isMethod('POST')) {
            //dd($request->password);
            if (Marchant::where('email',$request->email)->exists()) {
                return response()->json([
                    'status'=>'info',
                    'message'=>'Cet Email Existe deja'
                ]);
            } else if (Marchant::where('no_compte',$request->num_marchant)->exists()) {
                return response()->json([
                    'status'=>'info',
                    'message'=>'Cet Numero de compte Existe deja'
                ]);
            }
            else {
                $marchant = Marchant::create([
                'nom' => $request->name,
                'email' => $request->email,
                'raison' => $request->raison,
                'date_creation' => $request->date,
                
                'forme' => $request->forme,
                'contact_gerant' => $request->contactDiri,
                'siege' => $request->location,
                'phone' => $request->tel,
                'site' => $request->web,
                'activite' => $request->activites,
                'gerant_id' => $request->nom_gerant,
                'superviseur_id' => Auth::user()->id,
                'no_compte' => $request->num_marchant,
                // 'gerant_id' => Auth::user()->id
                // 'gerant_id' => $request->contactDiri,
            ]);

            if ($marchant) {
                /*try {
                    Mail::to($request->email)->queue(
                        new NewUserNotification()
                    );

                } catch (\Exception $e) {
                    // return $e->getMessage();
                    return response()->json([
                        'status'=>'info',
                        'message'=>'Action failed ,Try again later!'
                    ]);
                }*/
                return response()->json([
                    'status'=>'success',
                    'message'=>'Compte Marchant Enregistre avec succes'
                ]);
            } else{
                return response()->json([
                    'status'=>'info',
                    'message'=>'Erreur lors de l\'enregistrement. Veuillez reesayer '
                ]);
            }

            }
        }
        else{
            return response()->json([
                'status'=>'info',
                'message'=>'invalid request method'
            ]);
        }
    /*$newbusiness = new Marchant();
    $newbusiness->nom = $request->input('name'); 
    $newbusiness->raison = $request->input('raison'); 
    $newbusiness->forme = $request->input('formejuri'); 
    $newbusiness->gerant = $request->input('gerant'); 
    $newbusiness->date_creation = $request->input('date'); 
    $newbusiness->email = $request->input('email'); 
    $newbusiness->contact = $request->input('contactDiri'); //contact gerant
    $newbusiness->siege = $request->input('location'); 
    $newbusiness->phone = $request->input('tel');
    $newbusiness->site = $request->input('web'); 
    $newbusiness->activite = $request->input('activités');

    $newbusiness->save();
    return redirect()->route('user-recap');*/
    }

    public function ptvente()
    {
        if(!Auth::check()){
            return redirect()->route('user-login');
        }
        return view('next.pointvente');
    }
 
    // supp
    public function ptventeBySuperviseur()
    {
        if(!Auth::check()){
            return redirect()->route('user-login');
        }

        // $validusers = User::where('statut', 'validated')->get();
        $validusers = User::where('statut', 'validated')->get();
        return view('superviseur.ptventebysup', compact('validusers'));
    }

    //supp post

    
    public function ptventeBySup(Request $request) {
    
        if ($request->isMethod('POST')) {
            if (PointVente::where('rccm',$request->rccm)->exists()) {
                Session::flash('message', "Ce rccm existe deja");
                return redirect()->route('ptvente-by-superviseur');
            } else if (PointVente::where('no_compte',$request->num_ptventesup)->exists()) {
                Session::flash('message', "Ce numero de compte existe deja");
                return redirect()->route('ptvente-by-superviseur');
            }
            else{
                $ptvente = new PointVente();
                // dd($request->tel);
                if ($request->has('copierccm')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png', 'pdf', 'docx'); // valid extensions
                    $copierccm = $request->file('copierccm');
                    $path = public_path('rccm/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['copierccm']['name'];
                    $tmp = $_FILES['copierccm']['tmp_name'];

                    $ext = pathinfo($img, PATHINFO_EXTENSION);
                    // can upload same image using rand function
                    $final_image = rand(1000,1000000).$img;
                    // check's valid format
                    if(in_array($ext, $valid_extensions))
                    {
                        $path = $path.$final_image;
                        if(move_uploaded_file($tmp,$path))
                        {
                            if(filesize($path) <= 1000000)
                            {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                //dd($base64);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                
                                //scan piece
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf', 'docx'); // valid extensions
                                $contribuable = $request->file('contribuable');
                                $path2 = public_path('contribuable/');
                
                
                                $img2 = $_FILES['contribuable']['name'];
                                $tmp2 = $_FILES['contribuable']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext2, $valid_extensions))
                                {
                                    $path2 = $path2.$final_image2;
                                    if(move_uploaded_file($tmp2,$path2))
                                    {
                                        //echo $filename . ': ' . filesize($filename) . ' bytes';
                                        //dd(filesize($path) . ' bytes');
                                        if(filesize($path2) <= 1000000)
                                        {
                                            $type2 = pathinfo($path2, PATHINFO_EXTENSION);
                                            $data = file_get_contents($path2);
                                            $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                
                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                            //dd($base64);
                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                            $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf', 'docx'); // valid extensions
                                            $copieredevance = $request->file('copieredevance');
                                            $path3 = public_path('redevance/');
                            
                            
                                            $img3 = $_FILES['copieredevance']['name'];
                                            $tmp3 = $_FILES['copieredevance']['tmp_name'];
                                            // get uploaded file's extension
                                            $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                            
                                            // can upload same image using rand function
                                            $final_image3 = rand(1000,1000000).$img3;
                                            // check's valid format
                                            if(in_array($ext3, $valid_extensions))
                                            {
                                                $path3 = $path3.$final_image3;
                                                if(move_uploaded_file($tmp3,$path3))
                                                {
                                                    //echo $filename . ': ' . filesize($filename) . ' bytes';
                                                    //dd(filesize($path) . ' bytes');
                                                    if(filesize($path3) <= 1000000)
                                                    {
                                                        $type3 = pathinfo($path3, PATHINFO_EXTENSION);
                                                        $data = file_get_contents($path3);
                                                        $base643 = 'data:image/' . $type3 . ';base64,' . base64_encode($data);
                            
                                                        //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                        //dd($base64);
                                                        //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                                        $ptvente->owner = $request->owner;
                                                        $ptvente->rccm = $request->rccm;
                                                        $ptvente->copie_rccm = $final_image;
                                                        $ptvente->init_deposit = $request->initialdepot;
                                                        $ptvente->carte_contribuable = $final_image2;
                                                        $ptvente->non_redevance = $final_image3;
                                                        $ptvente->no_compte = $num_ptventesup;
                                                        $ptvente->localisation = $request->localisation;
                                                        $ptvente->superviseur_id = Auth::user()->id;

                                                        $ptvente->save();
                                                        //dd($useradd);

                                                        if ($ptvente->save())
                                                        {
                                                            Session::flash('message', "Enregistrement avec succes");
                                                            return redirect()->route('liste-comptes-sup');
                                                        }
                                                    } else
                                                        {
                                                            Session::flash('message', "Le poids de l'image de votre copie de redevance est trop grande pour être traitée");
                                                            return redirect()->route('ptvente-by-superviseur');
                                                        }
                                                    
                                                }
                                            }
                                            
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre Carte de contribuable est trop grande pour être traitée");
                                                return redirect()->route('ptvente-by-superviseur');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre Rccm est trop grande pour être traitée");
                                    return redirect()->route('ptvente-by-superviseur');
                                }
                        }
                    }

                    
                } else {
                    $ptvente->owner = $request->owner;
                    $ptvente->rccm = $request->rccm;
                    // $ptvente->copie_rccm = $final_image;
                    $ptvente->init_deposit = $request->initialdepot;
                    // $ptvente->carte_contribuable = $final_image2;
                    // $ptvente->non_redevance = $final_image3;
                    $ptvente->localisation = $request->localisation;
                    $ptvente->no_compte = $num_ptventesup;
                    $ptvente->superviseur_id = Auth::user()->id;

                    $ptvente->save();
                    //dd($useradd);

                    if ($ptvente->save())
                    {
                        Session::flash('message', "Enregistrement avec succes");
                        return redirect()->route('liste-point-ventes');
                    }
                }
            }
        } else{
            return redirect()->route('ptvente-by-superviseur');
        }
    }

    public function ptventeCreate()
    {
        if(!Auth::check()){
            return redirect()->route('user-login');
        }

        // $validusers = User::where('statut', 'validated')->get();
        $validusers = User::where('statut', 'validated')->get();
        return view('next.newptvente', compact('validusers'));
    }

    public function ptventePost(Request $request) {
    
        if ($request->isMethod('POST')) {
            if (PointVente::where('rccm',$request->rccm)->exists()) {
                Session::flash('message', "Ce rccm existe deja");
                return redirect()->route('point-vente');
            } else if (PointVente::where('no_compte',$request->num_ptvente)->exists()) {
                Session::flash('message', "Ce numero de compte existe deja");
                return redirect()->route('point-vente');
            }
            else{
                $ptvente = new PointVente();
                // dd($request->tel);
                if ($request->has('copierccm')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png', 'pdf', 'docx'); // valid extensions
                    $copierccm = $request->file('copierccm');
                    $path = public_path('rccm/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['copierccm']['name'];
                    $tmp = $_FILES['copierccm']['tmp_name'];

                    $ext = pathinfo($img, PATHINFO_EXTENSION);
                    // can upload same image using rand function
                    $final_image = rand(1000,1000000).$img;
                    // check's valid format
                    if(in_array($ext, $valid_extensions))
                    {
                        $path = $path.$final_image;
                        if(move_uploaded_file($tmp,$path))
                        {
                            if(filesize($path) <= 1000000)
                            {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                //dd($base64);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                
                                //scan piece
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf', 'docx'); // valid extensions
                                $contribuable = $request->file('contribuable');
                                $path2 = public_path('contribuable/');
                
                
                                $img2 = $_FILES['contribuable']['name'];
                                $tmp2 = $_FILES['contribuable']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext2, $valid_extensions))
                                {
                                    $path2 = $path2.$final_image2;
                                    if(move_uploaded_file($tmp2,$path2))
                                    {
                                        //echo $filename . ': ' . filesize($filename) . ' bytes';
                                        //dd(filesize($path) . ' bytes');
                                        if(filesize($path2) <= 1000000)
                                        {
                                            $type2 = pathinfo($path2, PATHINFO_EXTENSION);
                                            $data = file_get_contents($path2);
                                            $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                
                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                            //dd($base64);
                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                            $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf', 'docx'); // valid extensions
                                            $copieredevance = $request->file('copieredevance');
                                            $path3 = public_path('redevance/');
                            
                            
                                            $img3 = $_FILES['copieredevance']['name'];
                                            $tmp3 = $_FILES['copieredevance']['tmp_name'];
                                            // get uploaded file's extension
                                            $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                            
                                            // can upload same image using rand function
                                            $final_image3 = rand(1000,1000000).$img3;
                                            // check's valid format
                                            if(in_array($ext3, $valid_extensions))
                                            {
                                                $path3 = $path3.$final_image3;
                                                if(move_uploaded_file($tmp3,$path3))
                                                {
                                                    //echo $filename . ': ' . filesize($filename) . ' bytes';
                                                    //dd(filesize($path) . ' bytes');
                                                    if(filesize($path3) <= 1000000)
                                                    {
                                                        $type3 = pathinfo($path3, PATHINFO_EXTENSION);
                                                        $data = file_get_contents($path3);
                                                        $base643 = 'data:image/' . $type3 . ';base64,' . base64_encode($data);
                            
                                                        //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                        //dd($base64);
                                                        //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                                        $ptvente->owner = $request->owner;
                                                        $ptvente->rccm = $request->rccm;
                                                        $ptvente->copie_rccm = $final_image;
                                                        $ptvente->init_deposit = $request->initialdepot;
                                                        $ptvente->carte_contribuable = $final_image2;
                                                        $ptvente->no_compte = $num_ptvente;
                                                        $ptvente->non_redevance = $final_image3;
                                                        $ptvente->localisation = $request->localisation;

                                                        $ptvente->save();
                                                        //dd($useradd);

                                                        if ($ptvente->save())
                                                        {
                                                            Session::flash('message', "Enregistrement avec succes");
                                                            return redirect()->route('liste-point-ventes');
                                                        }
                                                    } else
                                                        {
                                                            Session::flash('message', "Le poids de l'image de votre copie de redevance est trop grande pour être traitée");
                                                            return redirect()->route('point-vente');
                                                        }
                                                    
                                                }
                                            }
                                            
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre Carte de contribuable est trop grande pour être traitée");
                                                return redirect()->route('point-vente');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre Rccm est trop grande pour être traitée");
                                    return redirect()->route('point-vente');
                                }
                        }
                    }

                    
                } else {
                    $ptvente->owner = $request->owner;
                    $ptvente->rccm = $request->rccm;
                    // $ptvente->copie_rccm = $final_image;
                    $ptvente->init_deposit = $request->initialdepot;
                    $ptvente->no_compte = $num_ptvente;
                    // $ptvente->carte_contribuable = $final_image2;
                    // $ptvente->non_redevance = $final_image3;
                    $ptvente->localisation = $request->localisation;
                    //$ptvente->superviseur_id = Auth::user()->id;

                    $ptvente->save();
                    //dd($useradd);

                    if ($ptvente->save())
                    {
                        Session::flash('message', "Enregistrement avec succes");
                        return redirect()->route('liste-point-ventes');
                    }
                }
            }
        } else{
            return redirect()->route('point-vente');
        }
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
}

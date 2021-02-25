<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Commercial;
use App\Models\Superviseur;

use Illuminate\Routing\Controller as BaseController; 

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;

class UserController extends BaseController
{


        public function signin() {
        return view('next.login');
    }

    public function register(Request $request) {
    
        if ($request->isMethod('POST')) {
            if (User::where('phone',$request->phone_number)->exists()) {
                Session::flash('message', "Ce numero existe deja");
                return redirect()->route('register');
            } 
            else if (User::where('no_compte_carte_virtuelle',$request->num_compte)->exists()) {
                Session::flash('message', "Ce numero de carte virtuelle existe deja. Veuillez ressayer");
                return redirect()->route('register');
            }
            else if (User::where('num_piece',$request->num_piece)->exists()) {
                Session::flash('message', "Ce numero de piece existe deja");
                return redirect()->route('register');
            }
            else if (User::where('identifiant_unique',$request->country_id)->exists()) {
                Session::flash('message', "Cet Identifiant unique existe deja");
                return redirect()->route('register');
            }
            else if ($request->has('signature')){
                $useradd = new User();
                // dd($request->tel);
                if ($request->has('photo')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                    $photo = $request->file('photo');
                    $path = public_path('photos/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];

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

                                $image = $request->signature;  // your base64 encoded
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = Str::random(10) . '.png';

                             Storage::disk('local')->put($imageName, base64_decode($image));

                                //scan piece
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                $scan_piece = $request->file('scan_piece_recto');
                                $path2 = public_path('scan_piece/');
                
                
                                $img2 = $_FILES['scan_piece_recto']['name'];
                                $tmp2 = $_FILES['scan_piece_recto']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext, $valid_extensions))
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

                                            //scan piece verso
                                        $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                        $scan_piece2 = $request->file('scan_piece_verso');
                                        $path3 = public_path('scan_piece/');
                        
                        
                                        $img3 = $_FILES['scan_piece_verso']['name'];
                                        $tmp3 = $_FILES['scan_piece_verso']['tmp_name'];
                                        // get uploaded file's extension
                                        $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                        
                                        // can upload same image using rand function
                                        $final_image3 = rand(1000,1000000).$img3;
                                        // check's valid format
                                        if(in_array($ext3, $valid_extensions3))
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
                                                    $useradd->scan_piece_recto = $final_image2;
                                                    $useradd->scan_piece_verso = $final_image3;
                                                    $useradd->photo = $final_image;
                                                    $useradd->phone = $request->phone_number;
                                                    $useradd->refere_par = $request->parrain;
                                                    $useradd->no_compte_carte_virtuelle = $request->num_compte;
                                                    $useradd->signature = $request->signature;
                                                    $useradd->type_compte = $request->type_compte;
                                                    $useradd->num_compte_bancaire = $request->bank_acc;
                                                    $useradd->password = Hash::make($request->password);
                                                    $useradd->remember_token  =  Str::random(100);

                                                    $useradd->save();
                                                    //dd($useradd);

                                                    if ($useradd->save())
                                                    {
                                                        Session::flash('message', "Enregistrement avec succes. Veuillez vous connectez");
                                                        return redirect()->route('user-login');
                                                    }
                                                }
                                            }
                                                } else
                                                {
                                                    Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                    return redirect()->route('register');
                                                }
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                return redirect()->route('register');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre photo est trop grande pour être traitée");
                                    return redirect()->route('register');
                                }
                        }
                    }

                    
                }
            } else
            {
                Session::flash('message', "Veuillez valider votre signature avant de cliquer sur m\'enregister");
                return redirect()->route('register');
            }
        } else{
            return redirect()->route('register');
        }
    }

    public function registerByComm(Request $request) {
    
        if ($request->isMethod('POST')) {
            if (User::where('phone',$request->phone_number)->exists()) {
                Session::flash('message', "Ce numero existe deja");
                return redirect()->route('register-by-comm');
            } 
            else if (User::where('no_compte_carte_virtuelle',$request->num_compte)->exists()) {
                Session::flash('message', "Cet numero de carte virtuelle existe deja. Veuillez ressayer");
                return redirect()->route('register-by-comm');
            }
            else if (User::where('num_piece',$request->num_piece)->exists()) {
                Session::flash('message', "Ce numero de piece existe deja");
                return redirect()->route('register-by-comm');
            }
            else if (User::where('identifiant_unique',$request->country_id)->exists()) {
                Session::flash('message', "Cet Identifiant unique existe deja");
                return redirect()->route('register-by-comm');
            }
            else if ($request->has('signature')){
                $useradd = new User();
                // dd($request->tel);
                if ($request->has('photo')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                    $photo = $request->file('photo');
                    $path = public_path('photos/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];

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
                               // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                //dd($base64);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                $image = $request->signature;  // your base64 encoded
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = Str::random(10) . '.png';

                             Storage::disk('local')->put($imageName, base64_decode($image));

                                //scan piece
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                $scan_piece = $request->file('scan_piece_recto');
                                $path2 = public_path('scan_piece/');
                
                
                                $img2 = $_FILES['scan_piece_recto']['name'];
                                $tmp2 = $_FILES['scan_piece_recto']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext, $valid_extensions))
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
                                            // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                
                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                            //dd($base64);
                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                                    //scan piece
                                                $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                $scan_piece2 = $request->file('scan_piece_verso');
                                                $path3 = public_path('scan_piece/');
                                
                                
                                                $img3 = $_FILES['scan_piece_verso']['name'];
                                                $tmp3 = $_FILES['scan_piece_verso']['tmp_name'];
                                                // get uploaded file's extension
                                                $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                                
                                                // can upload same image using rand function
                                                $final_image3 = rand(1000,1000000).$img3;
                                                // check's valid format
                                                if(in_array($ext3, $valid_extensions3))
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
                                                            // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                                                            
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
                                                            $useradd->scan_piece_recto = $final_image2;
                                                            $useradd->scan_piece_verso = $final_image3;
                                                            $useradd->photo = $final_image;
                                                            $useradd->phone = $request->phone_number;
                                                            $useradd->refere_par = $request->parrain;
                                                            $useradd->no_compte_carte_virtuelle = $request->num_compte;
                                                            $useradd->signature = $request->signature;
                                                            $useradd->type_compte = $request->type_compte;
                                                            $useradd->num_compte_bancaire = $request->bank_acc;
                                                            $useradd->created_by = Auth::user()->role;
                                                            $useradd->commercial_id = Auth::user()->id;
                                                            $useradd->password = Hash::make($request->password);
                                                            $useradd->remember_token  =  Str::random(100);

                                                            $useradd->save();
                                                            //dd($useradd);

                                                            if ($useradd->save())
                                                            {
                                                                Session::flash('message', "Enregistrement avec succes. Veuillez vous connectez");
                                                                return redirect()->route('liste-comptes');
                                                            }
                                                        }else
                                                        {
                                                            Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                            return redirect()->route('register-by-comm');
                                                        }
                                                    }
                                                }
                                            
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                return redirect()->route('register-by-comm');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre photo est trop grande pour être traitée");
                                    return redirect()->route('register-by-comm');
                                }
                        }
                    }

                    
                }
            } else
            {
                Session::flash('message', "Veuillez valider votre signature avant de cliquer sur m\'enregister");
                return redirect()->route('register-by-comm');
            }
        } else{
            return redirect()->route('register-by-comm');
        }
    }

    

    public function registerCommercialPost(Request $request) {
    
        if ($request->isMethod('POST')) {
            if (User::where('phone',$request->phone_number)->exists()) {
                Session::flash('message', "Ce numero existe deja");
                return redirect()->route('register-comm');
            } 
            else if (User::where('no_compte_carte_virtuelle',$request->num_compte)->exists()) {
                Session::flash('message', "Cet numero de carte virtuelle existe deja. Veuillez ressayer");
                return redirect()->route('register-comm');
            }
            else if (User::where('num_piece',$request->num_piece)->exists()) {
                Session::flash('message', "Ce numero de piece existe deja");
                return redirect()->route('register-comm');
            }
            else if (User::where('identifiant_unique',$request->country_id)->exists()) {
                Session::flash('message', "Cet Identifiant unique existe deja");
                return redirect()->route('register-comm');
            }
            else if ($request->has('signature')){
                $useradd = new User();
                $commercialadd = new Commercial();
                // dd($request->tel);
                if ($request->has('photo')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                    $photo = $request->file('photo');
                    $path = public_path('photos/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];

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
                               //  $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                $image = $request->signature;  // your base64 encoded
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = Str::random(10) . '.png';

                             Storage::disk('local')->put($imageName, base64_decode($image));

                                //scan piece
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                $scan_piece = $request->file('scan_piece_recto');
                                $path2 = public_path('scan_piece/');
                
                
                                $img2 = $_FILES['scan_piece_recto']['name'];
                                $tmp2 = $_FILES['scan_piece_recto']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext, $valid_extensions))
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
                                            // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                
                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                            //dd($base64);
                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                            // scan cv
                                                $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                $scan_cv = $request->file('scan_cv');
                                                $path3 = public_path('scan_cv/');
                                
                                
                                                $img3 = $_FILES['scan_cv']['name'];
                                                $tmp3 = $_FILES['scan_cv']['tmp_name'];
                                                // get uploaded file's extension
                                                $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                                
                                                // can upload same image using rand function
                                                $final_image3 = rand(1000,1000000).$img3;
                                                // check's valid format
                                                if(in_array($ext, $valid_extensions))
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
                                                            // $base643 = 'data:image/' . $type3 . ';base64,' . base64_encode($data);
                                
                                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                            //dd($base64);
                                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                                            // scan casier
                                                            
                                                                $valid_extensions4 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                                $scan_casier = $request->file('scan_casier');
                                                                $path4 = public_path('scan_casier_judi/');
                                                
                                                
                                                                $img4 = $_FILES['scan_casier']['name'];
                                                                $tmp4 = $_FILES['scan_casier']['tmp_name'];
                                                                // get uploaded file's extension
                                                                $ext4 = pathinfo($img4, PATHINFO_EXTENSION);
                                                
                                                                // can upload same image using rand function
                                                                $final_image4 = rand(1000,1000000).$img4;
                                                                // check's valid format
                                                                if(in_array($ext, $valid_extensions))
                                                                {
                                                                    $path4 = $path4.$final_image4;
                                                                    if(move_uploaded_file($tmp4,$path4))
                                                                    {
                                                                        //echo $filename . ': ' . filesize($filename) . ' bytes';
                                                                        //dd(filesize($path) . ' bytes');
                                                                        if(filesize($path4) <= 1000000)
                                                                        {
                                                                            $type4 = pathinfo($path4, PATHINFO_EXTENSION);
                                                                            $data = file_get_contents($path4);
                                                                            // $base644 = 'data:image/' . $type4 . ';base64,' . base64_encode($data);
                                                
                                                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                                            //dd($base64);
                                                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                                                                            // scan casier
                                                            
                                                                            $valid_extensions5 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                                            $scan_piece2 = $request->file('scan_piece_verso');
                                                                            $path5 = public_path('scan_piece/');
                                                            
                                                            
                                                                            $img5 = $_FILES['scan_piece_verso']['name'];
                                                                            $tmp5 = $_FILES['scan_piece_verso']['tmp_name'];
                                                                            // get uploaded file's extension
                                                                            $ext5 = pathinfo($img5, PATHINFO_EXTENSION);
                                                            
                                                                            // can upload same image using rand function
                                                                            $final_image5 = rand(1000,1000000).$img5;
                                                                            // check's valid format
                                                                            if(in_array($ext5, $valid_extensions5))
                                                                            {
                                                                                $path5 = $path5.$final_image5;
                                                                                if(move_uploaded_file($tmp5,$path5))
                                                                                {
                                                                                    //echo $filename . ': ' . filesize($filename) . ' bytes';
                                                                                    //dd(filesize($path) . ' bytes');
                                                                                    if(filesize($path5) <= 1000000)
                                                                                    {
                                                                                        $type4 = pathinfo($path5, PATHINFO_EXTENSION);
                                                                                        $data = file_get_contents($path5);
                                                                                        // $base645 = 'data:image/' . $type5 . ';base64,' . base64_encode($data);

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
                                                                                        $useradd->scan_piece_recto = $final_image2;
                                                                                        $useradd->scan_piece_verso = $final_image5;
                                                                                        $useradd->photo = $final_image;
                                                                                        $useradd->phone = $request->phone_number;
                                                                                        $useradd->refere_par = $request->parrain;
                                                                                        $useradd->no_compte_carte_virtuelle = $request->num_compte;
                                                                                        $useradd->signature = $request->signature;
                                                                                        $useradd->type_compte = $request->type_compte;
                                                                                        $useradd->num_compte_bancaire = $request->bank_acc;
                                                                                        $useradd->created_by = Auth::user()->role;
                                                                                        $useradd->role = 'commercial';
                                                                                        $useradd->password = Hash::make($request->password);
                                                                                        $useradd->remember_token  =  Str::random(100);

                                                                                        $test1 = $useradd->save();

                                                                                        $commercialadd->matricule = Str::random(35);
                                                                                        $commercialadd->cv = $final_image3;
                                                                                        $commercialadd->last_diploma = $request->diplome;
                                                                                        // $commercialadd->motivation_letter = $request->name;
                                                                                        $commercialadd->casier_judi = $final_image4;
                                                                                        $commercialadd->languages = $request->langues;
                                                                                        $commercialadd->years_experience = $request->expr;
                                                                                        $commercialadd->start_date = $request->debut;
                                                                                        $commercialadd->end_date = $request->fin;
                                                                                        $commercialadd->type_contract = $request->contrat;
                                                                                        $commercialadd->revenu  = $request->revenu;
                                                                                        $commercialadd->no_compte  = $request->num_compte_comm;
                                                                                        $commercialadd->user_id  = $useradd  ->id;
                                                                                        
                                                                                        //dd($useradd);

                                                                                        $test2 = $commercialadd->save();
                                                                                        if ($test1 && $test2)
                                                                                        {
                                                                                            Session::flash('message', "Enregistrement avec succes");
                                                                                            return redirect()->route('liste-commerciaux');
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        } else
                                                                            {
                                                                                Session::flash('message', "Le poids de l'image de votre casier judiciaire est trop grande pour être traitée");
                                                                                return redirect()->route('register-comm');
                                                                            }
                                                                        
                                                                    }
                                                                }

                                            
                                                } else
                                                    {
                                                        Session::flash('message', "Le poids de l'image de votre CV est trop grande pour être traitée");
                                                        return redirect()->route('register-comm');
                                                    }
                                                
                                            }
                                        }
                                            
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                return redirect()->route('register-comm');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre photo est trop grande pour être traitée");
                                    return redirect()->route('register-comm');
                                }
                        }
                    }

                    
                }
            } else
            {
                Session::flash('message', "Veuillez valider votre signature avant de cliquer sur m\'enregister");
                return redirect()->route('register-comm');
            }
        } else{
            return redirect()->route('register-comm');
        }
    }

    //comm by supp 

    public function registerCommercialBySupPost(Request $request) {
    
        if ($request->isMethod('POST')) {
            if (User::where('phone',$request->phone_number)->exists()) {
                Session::flash('message', "Ce numero existe deja");
                return redirect()->route('register-comm-by-supp');
            } 
            else if (User::where('no_compte_carte_virtuelle',$request->num_compte)->exists()) {
                Session::flash('message', "Cet numero de carte virtuelle existe deja. Veuillez ressayer");
                return redirect()->route('register-comm-by-supp');
            }
            else if (User::where('num_piece',$request->num_piece)->exists()) {
                Session::flash('message', "Ce numero de piece existe deja");
                return redirect()->route('register-comm-by-supp');
            }
            else if (User::where('identifiant_unique',$request->country_id)->exists()) {
                Session::flash('message', "Cet Identifiant unique existe deja");
                return redirect()->route('register-comm-by-supp');
            }
            else if ($request->has('signature')){
                $useradd = new User();
                $commercialadd = new Commercial();
                // dd($request->tel);
                if ($request->has('photo')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                    $photo = $request->file('photo');
                    $path = public_path('photos/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];

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
                              //  $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                $image = $request->signature;  // your base64 encoded
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = Str::random(10) . '.png';

                             Storage::disk('local')->put($imageName, base64_decode($image));

                                //scan piece
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                $scan_piece = $request->file('scan_piece_recto');
                                $path2 = public_path('scan_piece/');
                
                
                                $img2 = $_FILES['scan_piece_recto']['name'];
                                $tmp2 = $_FILES['scan_piece_recto']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext, $valid_extensions))
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
                                           // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                
                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                            //dd($base64);
                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                            // scan cv
                                                $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                $scan_cv = $request->file('scan_cv');
                                                $path3 = public_path('scan_cv/');
                                
                                
                                                $img3 = $_FILES['scan_cv']['name'];
                                                $tmp3 = $_FILES['scan_cv']['tmp_name'];
                                                // get uploaded file's extension
                                                $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                                
                                                // can upload same image using rand function
                                                $final_image3 = rand(1000,1000000).$img3;
                                                // check's valid format
                                                if(in_array($ext, $valid_extensions))
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
                                                           // $base643 = 'data:image/' . $type3 . ';base64,' . base64_encode($data);
                                
                                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                            //dd($base64);
                                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                                            // scan casier
                                                            
                                                                $valid_extensions4 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                                $scan_casier = $request->file('scan_casier');
                                                                $path4 = public_path('scan_casier_judi/');
                                                
                                                
                                                                $img4 = $_FILES['scan_casier']['name'];
                                                                $tmp4 = $_FILES['scan_casier']['tmp_name'];
                                                                // get uploaded file's extension
                                                                $ext4 = pathinfo($img4, PATHINFO_EXTENSION);
                                                
                                                                // can upload same image using rand function
                                                                $final_image4 = rand(1000,1000000).$img4;
                                                                // check's valid format
                                                                if(in_array($ext, $valid_extensions))
                                                                {
                                                                    $path4 = $path4.$final_image4;
                                                                    if(move_uploaded_file($tmp4,$path4))
                                                                    {
                                                                        //echo $filename . ': ' . filesize($filename) . ' bytes';
                                                                        //dd(filesize($path) . ' bytes');
                                                                        if(filesize($path4) <= 1000000)
                                                                        {
                                                                            $type4 = pathinfo($path4, PATHINFO_EXTENSION);
                                                                            $data = file_get_contents($path4);
                                                                           // $base644 = 'data:image/' . $type4 . ';base64,' . base64_encode($data);
                                                
                                                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                                            //dd($base64);
                                                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                                                            // scan piece verso
                                                            
                                                                                $valid_extensions5 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                                                $scan_piece2 = $request->file('scan_piece_verso');
                                                                                $path5 = public_path('scan_piece/');
                                                                
                                                                
                                                                                $img5 = $_FILES['scan_piece_verso']['name'];
                                                                                $tmp5 = $_FILES['scan_piece_verso']['tmp_name'];
                                                                                // get uploaded file's extension
                                                                                $ext5 = pathinfo($img5, PATHINFO_EXTENSION);
                                                                
                                                                                // can upload same image using rand function
                                                                                $final_image5 = rand(1000,1000000).$img5;
                                                                                // check's valid format
                                                                                if(in_array($ext5, $valid_extensions5))
                                                                                {
                                                                                    $path5 = $path5.$final_image5;
                                                                                    if(move_uploaded_file($tmp5,$path5))
                                                                                    {
                                                                                        //echo $filename . ': ' . filesize($filename) . ' bytes';
                                                                                        //dd(filesize($path) . ' bytes');
                                                                                        if(filesize($path5) <= 1000000)
                                                                                        {
                                                                                            $type5 = pathinfo($path5, PATHINFO_EXTENSION);
                                                                                            $data = file_get_contents($path5);

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
                                                                                            $useradd->scan_piece_recto = $final_image2;
                                                                                            $useradd->scan_piece_verso = $final_image5;
                                                                                            $useradd->photo = $final_image;
                                                                                            $useradd->phone = $request->phone_number;
                                                                                            $useradd->refere_par = $request->parrain;
                                                                                            $useradd->no_compte_carte_virtuelle = $request->num_compte;
                                                                                            $useradd->signature = $request->signature;
                                                                                            $useradd->type_compte = $request->type_compte;
                                                                                            $useradd->num_compte_bancaire = $request->bank_acc;
                                                                                            $useradd->created_by = Auth::user()->role;
                                                                                            $useradd->superviseur_id = Auth::user()->id;
                                                                                            $useradd->role = 'commercial';
                                                                                            $useradd->password = Hash::make($request->password);
                                                                                            $useradd->remember_token  =  Str::random(100);

                                                                                            $test1 = $useradd->save();

                                                                                            $commercialadd->matricule = Str::random(35);
                                                                                            $commercialadd->cv = $final_image3;
                                                                                            $commercialadd->last_diploma = $request->diplome;
                                                                                            // $commercialadd->motivation_letter = $request->name;
                                                                                            $commercialadd->casier_judi = $final_image4;
                                                                                            $commercialadd->languages = $request->langues;
                                                                                            $commercialadd->years_experience = $request->expr;
                                                                                            $commercialadd->start_date = $request->debut;
                                                                                            $commercialadd->end_date = $request->fin;
                                                                                            $commercialadd->type_contract = $request->contrat;
                                                                                            $commercialadd->revenu  = $request->revenu;
                                                                                            $commercialadd->no_compte  = $request->num_compte_comm;
                                                                                            $commercialadd->user_id  = $useradd  ->id;
                                                                                            $commercialadd->superviseur_id  = Auth::user()->id;
                                                                                            
                                                                                            //dd($useradd);

                                                                                            $test2 = $commercialadd->save();
                                                                                            if ($test1 && $test2)
                                                                                            {
                                                                                                Session::flash('message', "Enregistrement avec succes");
                                                                                                return redirect()->route('liste-comptes-sup');
                                                                                            }

                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            Session::flash('message', "Le poids de l'image de votre casier judiciaire est trop grande pour être traitée");
                                                                                            return redirect()->route('register-comm-by-supp');
                                                                                        }
                                                                                    }
                                                                                }
                                                                            

                                                                            
                                                                        } else
                                                                            {
                                                                                Session::flash('message', "Le poids de l'image de votre casier judiciaire est trop grande pour être traitée");
                                                                                return redirect()->route('register-comm-by-supp');
                                                                            }
                                                                        
                                                                    }
                                                                }

                                            
                                                } else
                                                    {
                                                        Session::flash('message', "Le poids de l'image de votre CV est trop grande pour être traitée");
                                                        return redirect()->route('register-comm-by-supp');
                                                    }
                                                
                                            }
                                        }
                                            
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                return redirect()->route('register-comm-by-supp');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre photo est trop grande pour être traitée");
                                    return redirect()->route('register-comm-by-supp');
                                }
                        }
                    }

                    
                }
            } else
            {
                Session::flash('message', "Veuillez valider votre signature avant de cliquer sur m\'enregister");
                return redirect()->route('register-comm-by-supp');
            }
        } else{
            return redirect()->route('register-comm-by-supp');
        }
    }

    public function registerClientPost(Request $request) {
    
        if ($request->isMethod('POST')) {
            if (User::where('phone',$request->phone_number)->exists()) {
                Session::flash('message', "Ce numero existe deja");
                return redirect()->route('register-client');
            } 
            else if (User::where('no_compte_carte_virtuelle',$request->num_compte)->exists()) {
                Session::flash('message', "Cet numero de carte virtuelle existe deja. Veuillez ressayer");
                return redirect()->route('register-client');
            }
            else if (User::where('num_piece',$request->num_piece)->exists()) {
                Session::flash('message', "Ce numero de piece existe deja");
                return redirect()->route('register-client');
            }
            else if (User::where('identifiant_unique',$request->country_id)->exists()) {
                Session::flash('message', "Cet Identifiant unique existe deja");
                return redirect()->route('register-client');
            }
            else if ($request->has('signature')){
                $useradd = new User();
                // dd($request->tel);
                if ($request->has('photo')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                    $photo = $request->file('photo');
                    $path = public_path('photos/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];

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
                               // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                $image = $request->signature;  // your base64 encoded
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = Str::random(10) . '.png';

                             Storage::disk('local')->put($imageName, base64_decode($image));

                                //scan piece recto
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                $scan_piece = $request->file('scan_piece_recto');
                                $path2 = public_path('scan_piece/');
                
                
                                $img2 = $_FILES['scan_piece_recto']['name'];
                                $tmp2 = $_FILES['scan_piece_recto']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext, $valid_extensions))
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
                                           // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                
                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                            //dd($base64);
                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                            //scan piece verso
                                            $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                            $scan_piece2 = $request->file('scan_piece_verso');
                                            $path3 = public_path('scan_piece/');
                            
                            
                                            $img3 = $_FILES['scan_piece_verso']['name'];
                                            $tmp3 = $_FILES['scan_piece_verso']['tmp_name'];
                                            // get uploaded file's extension
                                            $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                            
                                            // can upload same image using rand function
                                            $final_image3 = rand(1000,1000000).$img3;
                                            // check's valid format
                                            if(in_array($ext3, $valid_extensions3))
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
                                                    // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                            
                                                        //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                        //dd($base64);
                                                        //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

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
                                                        $useradd->scan_piece_recto = $final_image2;
                                                        $useradd->scan_piece_verso = $final_image3;
                                                        $useradd->photo = $final_image;
                                                        $useradd->phone = $request->phone_number;
                                                        $useradd->refere_par = $request->parrain;
                                                        $useradd->no_compte_carte_virtuelle = $request->num_compte;
                                                        $useradd->signature = $request->signature;
                                                        $useradd->type_compte = $request->type_compte;
                                                        $useradd->num_compte_bancaire = $request->bank_acc;
                                                        $useradd->created_by = Auth::user()->role;
                                                        $useradd->password = Hash::make($request->password);
                                                        $useradd->remember_token  =  Str::random(100);
            
                                                        $useradd->save();
                                                        //dd($useradd);
            
                                                        if ($useradd->save())
                                                        {
                                                            Session::flash('message', "Enregistrement avec succes.");
                                                            return redirect()->route('validate');
                                                        }
                                        } else
                                        {
                                            Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                            return redirect()->route('register-client');
                                        }
                                    }
                                }
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                return redirect()->route('register-client');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre photo est trop grande pour être traitée");
                                    return redirect()->route('register-client');
                                }
                        }
                    }

                    
                }
            } else
            {
                Session::flash('message', "Veuillez valider votre signature avant de cliquer sur m\'enregister");
                return redirect()->route('register-client');
            }
        } else{
            return redirect()->route('register-client');
        }
    }


    // superviseur
    public function registerSuperviseurPost(Request $request) {
    
        if ($request->isMethod('POST')) {
            if (User::where('phone',$request->phone_number)->exists()) {
                Session::flash('message', "Ce numero existe deja");
                return redirect()->route('register-superviseur');
            } 
            else if (User::where('no_compte_carte_virtuelle',$request->num_compte)->exists()) {
                Session::flash('message', "Cet numero de carte virtuelle existe deja. Veuillez ressayer");
                return redirect()->route('register-superviseur');
            }
            else if (User::where('num_piece',$request->num_piece)->exists()) {
                Session::flash('message', "Ce numero de piece existe deja");
                return redirect()->route('register-superviseur');
            }
            else if (User::where('identifiant_unique',$request->country_id)->exists()) {
                Session::flash('message', "Cet Identifiant unique existe deja");
                return redirect()->route('register-superviseur');
            }
            else if ($request->has('signature')){
                $useradd = new User();
                $superviseuradd = new Superviseur();
                // dd($request->tel);
                if ($request->has('photo')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                    $photo = $request->file('photo');
                    $path = public_path('photos/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];

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
                               // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                //dd($base64);
                              //  $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                $image = $request->signature;  // your base64 encoded
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = Str::random(10) . '.png';

                             Storage::disk('local')->put($imageName, base64_decode($image));

                                //scan piece
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                $scan_piece = $request->file('scan_piece_recto');
                                $path2 = public_path('scan_piece/');
                
                
                                $img2 = $_FILES['scan_piece_recto']['name'];
                                $tmp2 = $_FILES['scan_piece_recto']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext, $valid_extensions))
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
                                           // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                
                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                            //dd($base64);
                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                            // scan cv
                                                $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                $scan_cv = $request->file('scan_cv');
                                                $path3 = public_path('scan_cv/');
                                
                                
                                                $img3 = $_FILES['scan_cv']['name'];
                                                $tmp3 = $_FILES['scan_cv']['tmp_name'];
                                                // get uploaded file's extension
                                                $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                                
                                                // can upload same image using rand function
                                                $final_image3 = rand(1000,1000000).$img3;
                                                // check's valid format
                                                if(in_array($ext, $valid_extensions))
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
                                                           // $base643 = 'data:image/' . $type3 . ';base64,' . base64_encode($data);
                                
                                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                            //dd($base64);
                                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                                            // scan casier
                                                            
                                                                $valid_extensions4 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                                $scan_casier = $request->file('scan_casier');
                                                                $path4 = public_path('scan_casier_judi/');
                                                
                                                
                                                                $img4 = $_FILES['scan_casier']['name'];
                                                                $tmp4 = $_FILES['scan_casier']['tmp_name'];
                                                                // get uploaded file's extension
                                                                $ext4 = pathinfo($img4, PATHINFO_EXTENSION);
                                                
                                                                // can upload same image using rand function
                                                                $final_image4 = rand(1000,1000000).$img4;
                                                                // check's valid format
                                                                if(in_array($ext, $valid_extensions))
                                                                {
                                                                    $path4 = $path4.$final_image4;
                                                                    if(move_uploaded_file($tmp4,$path4))
                                                                    {
                                                                        //echo $filename . ': ' . filesize($filename) . ' bytes';
                                                                        //dd(filesize($path) . ' bytes');
                                                                        if(filesize($path4) <= 1000000)
                                                                        {
                                                                            $type4 = pathinfo($path4, PATHINFO_EXTENSION);
                                                                            $data = file_get_contents($path4);
                                                                           // $base644 = 'data:image/' . $type4 . ';base64,' . base64_encode($data);
                                                
                                                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                                            //dd($base64);
                                                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                                                            //scan piece verso
                                                                            $valid_extensions5 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                                            $scan_piece2 = $request->file('scan_piece_verso');
                                                                            $path5 = public_path('scan_piece/');
                                                            
                                                            
                                                                            $img5 = $_FILES['scan_piece_verso']['name'];
                                                                            $tmp5 = $_FILES['scan_piece_verso']['tmp_name'];
                                                                            // get uploaded file's extension
                                                                            $ext5 = pathinfo($img5, PATHINFO_EXTENSION);
                                                            
                                                                            // can upload same image using rand function
                                                                            $final_image5 = rand(1000,1000000).$img5;
                                                                            // check's valid format
                                                                            if(in_array($ext5, $valid_extensions5))
                                                                            {
                                                                                $path5 = $path5.$final_image5;
                                                                                if(move_uploaded_file($tmp5,$path5))
                                                                                {
                                                                                    //echo $filename . ': ' . filesize($filename) . ' bytes';
                                                                                    //dd(filesize($path) . ' bytes');
                                                                                    if(filesize($path5) <= 1000000)
                                                                                    {
                                                                                        $type5 = pathinfo($path5, PATHINFO_EXTENSION);
                                                                                        $data = file_get_contents($path5);
                                                                                        // $base644 = 'data:image/' . $type4 . ';base64,' . base64_encode($data);
                                                                                        
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
                                                                                        $useradd->scan_piece_recto = $final_image2;
                                                                                        $useradd->scan_piece_verso = $final_image5;
                                                                                        $useradd->photo = $final_image;
                                                                                        $useradd->phone = $request->phone_number;
                                                                                        $useradd->refere_par = $request->parrain;
                                                                                        $useradd->no_compte_carte_virtuelle = $request->num_compte;
                                                                                        $useradd->signature = $request->signature;
                                                                                        $useradd->type_compte = $request->type_compte;
                                                                                        $useradd->num_compte_bancaire = $request->bank_acc;
                                                                                        $useradd->created_by = Auth::user()->role;
                                                                                        $useradd->role = 'superviseur';
                                                                                        $useradd->password = Hash::make($request->password);
                                                                                        $useradd->remember_token  =  Str::random(100);

                                                                                        $test1 = $useradd->save();

                                                                                        $superviseuradd->matricule = Str::random(35);
                                                                                        $superviseuradd->cv = $final_image3;
                                                                                        $superviseuradd->last_diploma = $request->diplome;
                                                                                        // $commercialadd->motivation_letter = $request->name;
                                                                                        $superviseuradd->casier_judi = $final_image4;
                                                                                        $superviseuradd->languages = $request->langues;
                                                                                        $superviseuradd->years_experience = $request->expr;
                                                                                        $superviseuradd->start_date = $request->debut;
                                                                                        $superviseuradd->end_date = $request->fin;
                                                                                        $superviseuradd->type_contract = $request->contrat;
                                                                                        $superviseuradd->revenu  = $request->revenu;
                                                                                        $superviseuradd->no_compte  = $request->num_compte_supp;
                                                                                        $superviseuradd->user_id  = $useradd  ->id;
                                                                                        
                                                                                        //dd($useradd);

                                                                                        $test2 = $superviseuradd->save();
                                                                                        if ($test1 && $test2)
                                                                                        {
                                                                                            Session::flash('message', "Enregistrement avec succes");
                                                                                            return redirect()->route('liste-superviseurs');
                                                                                        }
                                                                                    } else
                                                                                    {
                                                                                        Session::flash('message', "Le poids de l'image de votre casier judiciaire est trop grande pour être traitée");
                                                                                        return redirect()->route('register-superviseur');
                                                                                    }
                                                                                }
                                                                            }

                                                                            
                                                                        } else
                                                                            {
                                                                                Session::flash('message', "Le poids de l'image de votre casier judiciaire est trop grande pour être traitée");
                                                                                return redirect()->route('register-superviseur');
                                                                            }
                                                                        
                                                                    }
                                                                }

                                            
                                                } else
                                                    {
                                                        Session::flash('message', "Le poids de l'image de votre CV est trop grande pour être traitée");
                                                        return redirect()->route('register-superviseur');
                                                    }
                                                
                                            }
                                        }
                                            
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                return redirect()->route('register-superviseur');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre photo est trop grande pour être traitée");
                                    return redirect()->route('register-superviseur');
                                }
                        }
                    }

                    
                }
            } else
            {
                Session::flash('message', "Veuillez valider votre signature avant de cliquer sur m\'enregister");
                return redirect()->route('register-superviseur');
            }
        } else{
            return redirect()->route('register-superviseur');
        }
    }

    public function registerBySuperviseurPost(Request $request) {
        if ($request->isMethod('POST')) {
            if (User::where('phone',$request->phone_number)->exists()) {
                Session::flash('message', "Ce numero existe deja");
                return redirect()->route('register-by-superviseur');
            } 
            else if (User::where('no_compte_carte_virtuelle',$request->num_compte)->exists()) {
                Session::flash('message', "Cet numero de carte virtuelle existe deja. Veuillez ressayer");
                return redirect()->route('register-by-superviseur');
            }
            else if (User::where('num_piece',$request->num_piece)->exists()) {
                Session::flash('message', "Ce numero de piece existe deja");
                return redirect()->route('register-by-superviseur');
            }
            else if (User::where('identifiant_unique',$request->country_id)->exists()) {
                Session::flash('message', "Cet Identifiant unique existe deja");
                return redirect()->route('register-by-superviseur');
            }
            else if ($request->has('signature')){
                $useradd = new User();
                // dd($request->tel);
                if ($request->has('photo')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                    $photo = $request->file('photo');
                    $path = public_path('photos/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];

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
                               // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                $image = $request->signature;  // your base64 encoded
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = Str::random(10) . '.png';

                             Storage::disk('local')->put($imageName, base64_decode($image));

                                //scan piece
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                $scan_piece = $request->file('scan_piece_recto');
                                $path2 = public_path('scan_piece/');
                
                
                                $img2 = $_FILES['scan_piece_recto']['name'];
                                $tmp2 = $_FILES['scan_piece_recto']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext, $valid_extensions))
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
                                            // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                
                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                            //dd($base64);
                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                            //scan piece_verso
                                                $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                                $scan_piece2 = $request->file('scan_piece_verso');
                                                $path3 = public_path('scan_piece/');
                                
                                
                                                $img3 = $_FILES['scan_piece_verso']['name'];
                                                $tmp3 = $_FILES['scan_piece_verso']['tmp_name'];
                                                // get uploaded file's extension
                                                $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                                
                                                // can upload same image using rand function
                                                $final_image3 = rand(1000,1000000).$img3;
                                                // check's valid format
                                                if(in_array($ext3, $valid_extensions3))
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
                                                            $useradd->scan_piece_recto = $final_image2;
                                                            $useradd->scan_piece_verso = $final_image3;
                                                            $useradd->photo = $final_image;
                                                            $useradd->phone = $request->phone_number;
                                                            $useradd->refere_par = $request->parrain;
                                                            $useradd->no_compte_carte_virtuelle = $request->num_compte;
                                                            $useradd->signature = $request->signature;
                                                            $useradd->type_compte = $request->type_compte;
                                                            $useradd->num_compte_bancaire = $request->bank_acc;
                                                            $useradd->created_by = Auth::user()->role;
                                                            $useradd->superviseur_id = Auth::user()->id;
                                                            // $useradd->commercial_id = Auth::user()->id;
                                                            $useradd->password = Hash::make($request->password);
                                                            $useradd->remember_token  =  Str::random(100);

                                                            $useradd->save();
                                                            //dd($useradd);

                                                            if ($useradd->save())
                                                            {
                                                                Session::flash('message', "Enregistrement avec succes. Veuillez vous connectez");
                                                                return redirect()->route('liste-comptes-sup');
                                                            }
                                                        }
                                                        else
                                                        {
                                                            Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                            return redirect()->route('register-by-superviseur');
                                                        }
                                                    }
                                                }
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                return redirect()->route('register-by-superviseur');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre photo est trop grande pour être traitée");
                                    return redirect()->route('register-by-superviseur');
                                }
                        }
                    }

                    
                }
            } else
            {
                Session::flash('message', "Veuillez valider votre signature avant de cliquer sur m\'enregister");
                return redirect()->route('register-by-superviseur');
            }
        } else{
            return redirect()->route('register-by-comm');
        }
    }

    public function loginPost(Request $request)
    {
       
        if ($request->isMethod('POST')) {
            $remember = ($request->remember) ? true : false;
            //$model = User::class;
            if (!User::where('phone',$request->tel)->exists()) {
                return response()->json([
                    'status'=>'info',
                    'message'=>'Cet Utilisateur n\'existe pas!. Veuillez ajouter l\'indicateur de votre pays d\'inscription'
                ]);
            }

            //dd($request->password);
            if (Auth::attempt(['phone' => $request->tel,'password' => $request->pin], $remember)) {

                $user=Auth::user();
                
                $user->save();
                //dd($user);
                if ($user->role == "user") {
                    if($user->statut == "blocked") {
                        return response()->json([
                            'status'=>'info',
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
                    if($user->statut == "blocked") {
                        return response()->json([
                            'status'=>'info',
                            'message'=>'Votre compte a ete bloque. Veuillez appeler notre service client'
                        ]);
                    }else {
                        return response()->json([
                            'status'=>'success',
                            'code'=>2
                        ]);
                    }
                   
                }

                if ($user->role == "commercial") {
                    if($user->statut == "blocked") {
                        return response()->json([
                            'status'=>'info',
                            'message'=>'Votre compte a ete bloque. Veuillez appeler notre service client'
                        ]);
                    }else {
                        return response()->json([
                            'status'=>'success',
                            'code'=>3
                        ]);
                    }
                    
                }

                if ($user->role == "superviseur") {
                    if($user->statut == "blocked") {
                        return response()->json([
                            'status'=>'info',
                            'message'=>'Votre compte a ete bloque. Veuillez appeler notre service client'
                        ]);
                    }else {
                        return response()->json([
                            'status'=>'success',
                            'code'=>4
                        ]);
                    }
                    
                }

                if ($user->role == "superadmin") {
                    if($user->statut == "blocked") {
                        return response()->json([
                            'status'=>'info',
                            'message'=>'Votre compte a ete bloque. Veuillez appeler notre service client'
                        ]);
                    }else {
                         return response()->json([
                        'status'=>'success',
                        'code'=>5
                    ]);
                    }
                   
                }

            }
            else{
                return response()->json([
                    'status'=>'info',
                    'message'=>'Identifiants de Connexion invalides ,Veuillez ressayer plutard'
                ]);
            }
            if (Auth::viaRemember())
            {

            }
        }
    }

    public function UserLogout(Request $request){
        $user=Auth::user();
        //$user->online = false;
        $user->save();
        Auth::logout();
        return redirect()->route('user-login');
    }


    /**
     * list the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
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



    public function recap() {
       // $user=Auth::user();
                //dd($user);
        if (!Auth::check())
        {
            return view('next.login');
        }
        return view('next.userrecap');
    }


    public function  profilupdate()
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

        $updateusers = User::where('id', $_GET['hiddenid'])->update([
            'statut'=> 'validated'             
     ]);
     return view('admin.validate', compact("newusers"));
    }


    //controller pour api
    

    // superadmin
    public function registerAdminPost(Request $request) {
    
        if ($request->isMethod('POST')) {
            if (User::where('phone',$request->phone_number)->exists()) {
                Session::flash('message', "Ce numero existe deja");
                return redirect()->route('register-superviseur');
            } 
            else if (User::where('no_compte_carte_virtuelle',$request->num_compte)->exists()) {
                Session::flash('message', "Cet numero de carte virtuelle existe deja. Veuillez ressayer");
                return redirect()->route('register-superviseur');
            }
            else if (User::where('num_piece',$request->num_piece)->exists()) {
                Session::flash('message', "Ce numero de piece existe deja");
                return redirect()->route('register-superviseur');
            }
            else if (User::where('identifiant_unique',$request->country_id)->exists()) {
                Session::flash('message', "Cet Identifiant unique existe deja");
                return redirect()->route('register-superviseur');
            }
            else if ($request->has('signature')){
                $useradd = new User();
                // dd($request->tel);
                if ($request->has('photo')) {
                    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                    $photo = $request->file('photo');
                    $path = public_path('photos/');

                    //Image::make(request()->file('photo'))->resize(300, 200)->save('photos/foo.jpg');
                    
                    $img = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];

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
                               // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                $image = $request->signature;  // your base64 encoded
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = Str::random(10) . '.png';

                             Storage::disk('local')->put($imageName, base64_decode($image));

                                //scan piece recto
                                $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                $scan_piece = $request->file('scan_piece_recto');
                                $path2 = public_path('scan_piece/');
                
                
                                $img2 = $_FILES['scan_piece_recto']['name'];
                                $tmp2 = $_FILES['scan_piece_recto']['tmp_name'];
                                // get uploaded file's extension
                                $ext2 = pathinfo($img2, PATHINFO_EXTENSION);
                
                                // can upload same image using rand function
                                $final_image2 = rand(1000,1000000).$img2;
                                // check's valid format
                                if(in_array($ext, $valid_extensions))
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
                                           // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                
                                            //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                            //dd($base64);
                                            //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

                                            //scan piece verso
                                            $valid_extensions3 = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions
                                            $scan_piece2 = $request->file('scan_piece_verso');
                                            $path3 = public_path('scan_piece/');
                            
                            
                                            $img3 = $_FILES['scan_piece_verso']['name'];
                                            $tmp3 = $_FILES['scan_piece_verso']['tmp_name'];
                                            // get uploaded file's extension
                                            $ext3 = pathinfo($img3, PATHINFO_EXTENSION);
                            
                                            // can upload same image using rand function
                                            $final_image3 = rand(1000,1000000).$img3;
                                            // check's valid format
                                            if(in_array($ext3, $valid_extensions3))
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
                                                    // $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);
                            
                                                        //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                                                        //dd($base64);
                                                        //$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data);

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
                                                        $useradd->scan_piece_recto = $final_image2;
                                                        $useradd->scan_piece_verso = $final_image3;
                                                        $useradd->photo = $final_image;
                                                        $useradd->phone = $request->phone_number;
                                                        $useradd->refere_par = $request->parrain;
                                                        $useradd->no_compte_carte_virtuelle = $request->num_compte;
                                                        $useradd->signature = $request->signature;
                                                        $useradd->type_compte = $request->type_compte;
                                                        $useradd->num_compte_bancaire = $request->bank_acc;
                                                        $useradd->role = 'admin';
                                                        $useradd->created_by = Auth::user()->role;
                                                        $useradd->password = Hash::make($request->password);
                                                        $useradd->remember_token  =  Str::random(100);
            
                                                        $useradd->save();
                                                        //dd($useradd);
            
                                                        if ($useradd->save())
                                                        {
                                                            Session::flash('message', "Enregistrement avec succes.");
                                                            return redirect()->route('validate');
                                                        }
                                        } else
                                        {
                                            Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                            return redirect()->route('register-admin');
                                        }
                                    }
                                }
                                        } else
                                            {
                                                Session::flash('message', "Le poids de l'image de votre CNI/Passeport est trop grande pour être traitée");
                                                return redirect()->route('register-admin');
                                            }
                                        
                                    }
                                }
                            } else
                                {
                                    Session::flash('message', "Le poids de votre photo est trop grande pour être traitée");
                                    return redirect()->route('register-admin');
                                }
                        }
                    }

                    
                }
            } else
            {
                Session::flash('message', "Veuillez valider votre signature avant de cliquer sur m\'enregister");
                return redirect()->route('register-admin');
            }
        } else{
            return redirect()->route('register-admin');
        }
    }

	public function change_password(Request $request){
        if(!Auth::check()){
            return redirect()->route('user-login');
        }

        $rules = [
            'mdpa' => 'required',
            'nmdp' => 'required',
            'cmdp' => 'required'
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect("change_password")
                ->withFail('Veillez remplir tous les champs');
        }

        $data = $request->input();
        if(!password_verify($data['mdpa'],Auth::user()->password)){
            return redirect("change_password")
                ->withFail('Erreur le Mot de passe est incorrect');
        }
        if($data['nmdp'] != $data['cmdp']){
            return redirect("change_password")
                ->withFail('Erreur les Entr�es du nouveau mot de passe diff�rent');
        }
        $updateusers = User::where('id', Auth::user()->id)->update([
            'password' => password_hash($data['nmdp'], PASSWORD_DEFAULT)
        ]);
        return redirect("change_password")->withSuccess("Mot de passe Modifier avec Succ�s");


    }
}

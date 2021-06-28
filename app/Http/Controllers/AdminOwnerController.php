<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminOwnerController extends Controller
{
    public function index(){
        return view('ao-pages.index');
    }

    public function login(){
        return view('ao-pages.login');
    }

    public function checkCredentials(Request $request){
        /* return $request; */
        $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        $user = DB::table('users')->where('username', $request->username)->first();
        if ($user) {
            if($user->account_status == 1){
                if(Hash::check($request->password, $user->password)){
                    $request->session()->put('authID', $user->id);
                    //return $user->user_role;
                    return $this->userRole($user->user_role);
                    /* return 'Success'; */
                }else{
                    return back()->with('fail', 'Invalid Password!');
                }
            }else{
                return back()->with('fail', 'Your account was disabled. Please contact the administrator.');
            }
        }else{
            return back()->with('fail', 'Username '.$request->username.' not found.');
        }
    }

    public function userRole($role){
        switch ($role) {
            case 'admin':
                return redirect()->route('ao.admin-dashboard');
                break;
            case 'establishment':
                return redirect()->route('estab.dashboard');
                break;
            default:
                return redirect()->route('ao.login');
                break;
        }
    }

    public function logout(){
        if(session()->has('authID')){
            session()->pull('authID');
            return redirect()->route('ao.login');
        }
    }

    public function register(){
        return view('ao-pages.registration-page');
    }

    public function estabSaveRegister(Request $request){
       
        /* return Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s').' ---- '.Carbon::now()->format('Y-m-d H:i:s'); */
        $unameprepend = DB::table('users')->count();
 
        $unameprepend += 1;
        $userName = Str::lower($request->estab_name).'_'.$unameprepend.rand($unameprepend, $unameprepend + 3);
        $userName = preg_replace('/\s+/', '_',$userName);
        /* return $userName; */
        $nameOfFolder = preg_replace('/\s+/', '-',Str::lower($request->estab_name));

        /* New File Name */
        $newFileNameBP = uniqid() . '-' . time() . 'business-permit.'.$request->file('business_permit')->extension();
        $newFileNameVID = uniqid() . '-' . time() . 'valid-id.'.$request->file('valid_id')->extension();
        $newFileNameTID = uniqid() . '-' . time() . 'tax-id.'.$request->file('tax_id')->extension();
        /* Move file in the public directory */
       /*  $request->file('business_permit')->move(public_path('uploads/'.$nameOfFolder), $newFileNameBP);
        $request->file('valid_id')->move(public_path('uploads/'.$nameOfFolder), $newFileNameVID);
        $request->file('tax_id')->move(public_path('uploads/'.$nameOfFolder), $newFileNameTID); */
        $destinationPath = 'public/uploads/'.$nameOfFolder;
        /* To storage folder */
        $request->file('business_permit')->storeAs($destinationPath, $newFileNameBP);
        $request->file('valid_id')->storeAs($destinationPath, $newFileNameVID);
        $request->file('tax_id')->storeAs($destinationPath, $newFileNameTID);

        $newFileNameBPSave = 'uploads/'.$nameOfFolder.'/'.$newFileNameBP;
        $newFileNameVIDSave = 'uploads/'.$nameOfFolder.'/'.$newFileNameVID;
        $newFileNameTIDSave = 'uploads/'.$nameOfFolder.'/'.$newFileNameTID;
        /* Save in User table */
        $userId = DB::table('users')->insertGetId([
            'last_name'         => Str::upper($request->last_name),
            'first_name'        => Str::upper($request->first_name),
            'middle_name'       => Str::upper($request->middle_name),
            'username'          => $userName,
            'person_contactnum' => $request->pi_mobile_number,
            'password'          => Hash::make($userName),
            'user_role'         => 'establishment',
            'account_status'    => 1,
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $eui_id = DB::table('establishment_user_infos')->insertGetId([
            'establishment_name'        => Str::upper($request->estab_name),
            'establishment_phonenum'    => $request->estab_phone_num,
            'establishment_mobilenum'   => $request->estab_mobile_number,
            'establishment_email'       => $request->estab_email,
            'establishment_website'     => $request->estab_website,
            'establishment_fb_account'  => $request->estab_fb,
            'historical_description'    => '',
            'business_permit_path'      => $newFileNameBPSave,
            'valid_id_path'             => $newFileNameVIDSave,
            'tax_id_path'               => $newFileNameTIDSave,
            'ua_id'                     => $userId,
            'created_at'                => Carbon::now()
        ]);
        DB::table('establishment_addresses')->insert([
            'frbs'          => Str::upper($request->frbs),
            'barangay'      => Str::upper($request->estab_barangay),
            'municipality'  => 'LA TRINIDAD',
            'province'      => 'BENGUET',
            'zip'           => 2601,
            'eui_id'        => $eui_id,
            'created_at'    => Carbon::now()
        ]);
        
        return back()->with('message', 'Registration saved, get your login credentials in the office of the tourism.');
    }

    

    
}

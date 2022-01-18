<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EstablishmentController extends Controller
{
    public function estabDashboard(){
        $user = DB::table('users')->where('id', session('authID'))->first();
        $headCount = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->whereMonth('visitor_users.created_at', Carbon::now()->month)
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->sum(DB::raw("visitor_users.people_with_you_male + visitor_users.people_with_you_female + visitor_users.people_with_you_lgbtq"));
        /* dd($headCount); */
        $logsCount = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->whereMonth('visitor_users.created_at', Carbon::now()->month)
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->count();
        $headCountAll = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->sum(DB::raw("visitor_users.people_with_you_male + visitor_users.people_with_you_female + visitor_users.people_with_you_lgbtq"));;
        $logsCountAll = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->count();
        
        $data = [
            'loggedUserInfo'    => $user,
            'headCount'         => $headCount,
            'logsCount'         => $logsCount,
            'headCountAll'      => $headCountAll,
            'logsCountAll'      => $logsCountAll
        ];
        return view('ao-pages.establishment-pages.estab-dashboard', $data);
    }

    /* View visitors by month */
    public function viewVisitorByMonth(){
        $user = DB::table('users')->where('id', session('authID'))->first();
        $headCount = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->whereMonth('visitor_users.created_at', Carbon::now()->month)
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->sum('people_with_you_male') + sum('people_with_you_female') + sum('people_with_you_lgbtq');
        $logsCount = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->whereMonth('visitor_users.created_at', Carbon::now()->month)
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->count();
        
        $visitorsInfo = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->whereMonth('visitor_users.created_at', Carbon::now()->month)
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->paginate(1);

        $data = [
            'loggedUserInfo'    => $user,
            'headCount'         => $headCount,
            'logsCount'         => $logsCount,
            'visitorsInfo'      => $visitorsInfo
        ];
        return view('ao-pages.establishment-pages.dashboard-visitorby-month', $data);
    }

    /* View all visitors */
    public function viewAllVisitors(){
        $user = DB::table('users')->where('id', session('authID'))->first();
        $headCount = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->sum('people_with_you_male') + sum('people_with_you_female') + sum('people_with_you_lgbtq');
        $logsCount = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->count();
        
        $visitorsInfo = DB::table('establishment_user_infos')
                ->join('visitor_users', 'establishment_user_infos.id', '=', 'visitor_users.eui_id')
                ->where('establishment_user_infos.ua_id', session('authID'))
                ->paginate(1);

        $data = [
            'loggedUserInfo'    => $user,
            'headCount'         => $headCount,
            'logsCount'         => $logsCount,
            'visitorsInfo'      => $visitorsInfo
        ];
        return view('ao-pages.establishment-pages.dashboard-viewall-visitors', $data);
    }

    /* Change Account Settings */
    public function changeAccount(Request $request){
        $request->validate([
            'username'          => 'required|min:6',
            'password'          => 'required|min:6|max:24',
            'confirm_password'  => 'required|same:password'
        ]);
        //return session('authID');
        $uname = DB::table('users')
                    ->where([
                        ['username', $request->username],
                        ['id', session('authID')]
                        ])->count();
        if($uname > 0){
            return back()->with('fail', "You cannot use the same username assigned to you!");
        }
        if(DB::table('users')->where('username', $request->username)->count() > 0){
            return back()->with('fail',"Username is already taken.");
        }
        $update = DB::table('users')->where('id', session('authID'))->update([
                    'username'      => $request->username,
                    'password'      => Hash::make($request->password),
                    'updated_at'    => Carbon::now()
                ]);
        return redirect()->route('ao.login')->with('message', 'Successfully changed. You may now use your new login credentials.');
    }

    /* Save Photos */
    public function savePhotos(Request $request){
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);
        /* dd($request->file('photo')->getClientOriginalName()); */
        $estabName = DB::table('establishment_user_infos')
                    ->select('establishment_name')
                    ->where('ua_id', session('authID'))->first();
        /* dd($folderName->establishment_name); */
        /* Folder Name */
        $folderName = preg_replace('/\s+/', '-', Str::lower($estabName->establishment_name));
        /* New File Name */
        $imageNewName = uniqid() . '-' . time() .'.'.$request->file('photo')->extension();
        
        $destinationPath = 'public/uploads/'.$folderName;
        
        /* Move file in the public directory */
        /* $request->file('photo')->move(public_path('uploads/'.$folderName), $imageNewName); */
        $request->file('photo')->storeAs($destinationPath, $imageNewName);
        /* New file name to be save in the database */
        $imageFileNameDBSave = 'uploads/'.$folderName.'/'.$imageNewName;
        /* get id */
        $eui_id = DB::table('establishment_user_infos')
                ->select('id')
                ->where('ua_id', session('authID'))->first();
        DB::table('establishment_photos')->insert([
            'img_caption'       => $request->caption,
            'image_path'        => $imageFileNameDBSave,
            'eui_id'            => $eui_id->id,
            'is_main'            => 0,
            'created_at'        => Carbon::now()
        ]);
        return back()->with('image_created', 'Image successfully created!');
    }

    public function createQrCode(){
        
        $estabName = DB::table('establishment_user_infos')
                    ->select('establishment_name', 'id')
                    ->where('ua_id', session('authID'))->first();
        /* dd(route('visitor-logform', $estabName->id)); */
        /* Folder Name */
        $folderName = preg_replace('/\s+/', '-', Str::lower($estabName->establishment_name));
        if (!file_exists(public_path('storage/uploads/'.$folderName.'/'.$folderName.'.png'))) {
            QrCode::size(500)
              ->format('png')
              ->generate(route('visitor-logform', $estabName->id), public_path('storage/uploads/'.$folderName.'/'.$folderName.'.png'));
            return back()->with('qr_created', 'QR Code created successfully!');
        }
        return back();
    }

    public function dlQrCode($filename){
        /* dd($filename); */
        $file_path = public_path('storage/uploads/'.Str::lower($filename).'/'.Str::lower($filename).'.png');
        return Response::download($file_path);
    }

    /* Show visitor log form */
    public function visitorLogForm(Request $request){
        /* dd($request->estabid); */
        $data = DB::table('establishment_user_infos')->where('id', $request->estabid)->first();
        /* dd($data); */
        return view('visitor-logform', compact('data'));
    }

    public function visitorLogFormSubmit(Request $request){
       
        $request->validate([
            'full_name'                 => 'required',
            'contact_number'            => 'required|min:11|numeric',
            'municipality_or_city'      => 'required',
            'province'                  => 'required',
            'gender'                    => 'required',
            'temperature'               => 'required|numeric',
            
        ]);
        
        if($request->people_with_you_male == null && $request->people_with_you_female == null && $request->people_with_you_lgbtq == null )  
            return back()->withErrors(['fails' => 'You need to fill atleast one from these input.'])->withInput();
        if($request->people_with_you_male == 0 && $request->people_with_you_female == 0 && $request->people_with_you_lgbtq == 0 ) 
            return back()->withErrors(['fails' => 'There would be atleast one person with you and include yourself in the counting.'])->withInput();

        DB::table('visitor_users')->insert([
            'full_name'                 => strip_tags(Str::of(Str::upper($request->full_name))->trim()),
            'contact_number'            => $request->contact_number,
            'city_municipality'         => $request->municipality_or_city,
            'province'                  => $request->province,
            'gender'                    => $request->gender,
            'temperature'               => $request->temperature,
            'people_with_you_male'      => $request->people_with_you_male ?? 0,
            'people_with_you_female'    => $request->people_with_you_female ?? 0,
            'people_with_you_lgbtq'     => $request->people_with_you_lgbtq ?? 0,
            'eui_id'                    => $request->estab_id,
            'created_at'                => Carbon::now()
        ]);
        /* return back()->with('success', 'Information saved successfully!'); */
        return redirect()->route('homepage')->with('success', 'Information saved successfully!');
        
    }

    /* Show Establishment Profile */
    public function establishmentProfileShow(){
        $user = DB::table('users')->where('id', session('authID'))->first();
        
        $data = [
            'loggedUserInfo'    => $user,
        ];
        return view('ao-pages.establishment-pages.estab-show-profile', $data);
        
    }

    /* Show Personal Profile */
    public function personalProfileShow(){
        $user = DB::table('users')->where('id', session('authID'))->first();
        
        $data = [
            'loggedUserInfo'    => $user,
        ];
        return view('ao-pages.establishment-pages.personal-profile-show', $data);
    }
}

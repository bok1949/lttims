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
    
    /* 
    DB::table('establishment_user_infos')
            ->select('establishment_user_infos.*',
                DB::raw("(SELECT SUM(people_with_you_male) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwym"),
                DB::raw("(SELECT SUM(people_with_you_female) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwyf"),
                DB::raw("(SELECT SUM(people_with_you_lgbtq) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwylgbtq"),

                DB::raw("(SELECT SUM(people_with_you_male) FROM visitor_users) as totalmale"),
                DB::raw("(SELECT SUM(people_with_you_female) FROM visitor_users) as totalfemale"),
                DB::raw("(SELECT SUM(people_with_you_lgbtq) FROM visitor_users) as totallgbtq"),

                DB::raw("(SELECT (SUM(people_with_you_male)+SUM(people_with_you_female)+SUM(people_with_you_lgbtq)) FROM visitor_users) as totalvisitors")
            
                )
            ->whereMonth('created_at', $value)
            ->orWhereYear('created_at', $value)
            ->orderBy('establishment_user_infos.created_at', 'asc')
            ->get();    

            DB::table('establishment_user_infos')
            ->select('establishment_user_infos.*',
                DB::raw("(SELECT SUM(people_with_you_male) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwym"),
                DB::raw("(SELECT SUM(people_with_you_female) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwyf"),
                DB::raw("(SELECT SUM(people_with_you_lgbtq) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwylgbtq"),

                DB::raw("(SELECT SUM(people_with_you_male) FROM visitor_users) as totalmale"),
                DB::raw("(SELECT SUM(people_with_you_female) FROM visitor_users) as totalfemale"),
                DB::raw("(SELECT SUM(people_with_you_lgbtq) FROM visitor_users) as totallgbtq"),

                DB::raw("(SELECT (SUM(people_with_you_male)+SUM(people_with_you_female)+SUM(people_with_you_lgbtq)) FROM visitor_users) as totalvisitors")
            
                )
            ->whereMonth('created_at', Carbon::now()->month)
            ->orderBy('establishment_user_infos.created_at', 'asc')
            ->get();

            DB::raw("(SELECT SUM(people_with_you_male) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwym"),
                DB::raw("(SELECT SUM(people_with_you_female) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwyf"),
                DB::raw("(SELECT SUM(people_with_you_lgbtq) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwylgbtq"),
    */
    /* Number of visitors per month */
    public function numberOfVisitorsPerMonth($userid){
        return DB::table('establishment_user_infos')
            ->select('establishment_user_infos.ua_id',
                
                 DB::raw("(SELECT SUM(people_with_you_male) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as totalpwym"),
                DB::raw("(SELECT SUM(people_with_you_female) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as totalpwyf"),
                DB::raw("(SELECT SUM(people_with_you_lgbtq) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as totalpwylgbtq"),
                DB::raw("(SELECT (SUM(people_with_you_male)+SUM(people_with_you_female)+SUM(people_with_you_lgbtq)) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as totalmonth")
                )
            ->join('visitor_users', 'visitor_users.eui_id', '=', 'establishment_user_infos.id')
            ->whereMonth('visitor_users.created_at', Carbon::now()->month)
            ->where('establishment_user_infos.ua_id', $userid)
            ->first();
    }
    /* Number of Visitors Per year */
    public function numberOfVisitorsPerYear($userid){
        return DB::table('establishment_user_infos')
            ->select('establishment_user_infos.ua_id',
                
                 DB::raw("(SELECT SUM(people_with_you_male) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as totalyearmale"),
                DB::raw("(SELECT SUM(people_with_you_female) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as totalyearfemale"),
                DB::raw("(SELECT SUM(people_with_you_lgbtq) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as totalyearlgbtq"),
                DB::raw("(SELECT (SUM(people_with_you_male)+SUM(people_with_you_female)+SUM(people_with_you_lgbtq)) 
                FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as totalyear")
                )
            ->join('visitor_users', 'visitor_users.eui_id', '=', 'establishment_user_infos.id')
            ->whereYear('visitor_users.created_at', Carbon::now()->year)
            ->where('establishment_user_infos.ua_id', $userid)
            ->first();
    }
    /* Establishment Dahsboard */
    public function estabDashboard(){
        $loggedUserInfo = DB::table('users')
            ->select('users.*', 'establishment_user_infos.establishment_name', 'establishment_user_infos.created_at')
            ->join('establishment_user_infos', 'establishment_user_infos.ua_id', '=', 'users.id')
            ->where('users.id', session('authID'))->first();
            /* return $user->id; */
        $numVisitorMonth = $this->numberOfVisitorsPerMonth($loggedUserInfo->id);
        $numVisitorYear = $this->numberOfVisitorsPerYear($loggedUserInfo->id);
       
        return view('ao-pages.establishment-pages.estab-dashboard', compact('loggedUserInfo', 'numVisitorMonth','numVisitorYear'));
    }

    /* Show Reports */
    public function specificEstabReport(){
          $loggedUserInfo = DB::table('users')
            ->select('users.*', 'establishment_user_infos.establishment_name', 'establishment_user_infos.created_at')
            ->join('establishment_user_infos', 'establishment_user_infos.ua_id', '=', 'users.id')
            ->where('users.id', session('authID'))->first();
        $numVisitorMonth = $this->getVisitorsWithSumMonth($loggedUserInfo->id);
        //$numVisitorYear = $this->numberOfVisitorsPerYear($loggedUserInfo->id);
        /* dd($numVisitorMonth); */
        return view('ao-pages.establishment-pages.specific-estab-report', compact('loggedUserInfo','numVisitorMonth'));
    }
    /* show visitors */
    public function getVisitorsWithSumMonth($userid){
        return DB::table('establishment_user_infos')
            ->select('establishment_user_infos.ua_id', 'visitor_users.*')
            ->join('visitor_users', 'visitor_users.eui_id', '=', 'establishment_user_infos.id')
            ->whereMonth('visitor_users.created_at', Carbon::now()->month)
            ->where('establishment_user_infos.ua_id', $userid)
            ->orderBy('visitor_users.created_at', 'asc')
            ->paginate(15);
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

    public function dlQrCode($filename){
        /* dd($filename); */
        $file_path = public_path('storage/'.Str::lower($filename).'/'.Str::lower($filename).'.png');
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
        $loggedUserInfo = DB::table('users')
            ->select('users.*', 'establishment_user_infos.establishment_name', 'establishment_user_infos.created_at')
            ->join('establishment_user_infos', 'establishment_user_infos.ua_id', '=', 'users.id')
            ->where('users.id', session('authID'))->first();
        
        return view('ao-pages.establishment-pages.personal-profile-show', compact('loggedUserInfo'));
    }
}

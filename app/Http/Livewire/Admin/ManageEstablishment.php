<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ManageEstablishment extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $viewModal = false;
    public /* $estab_id, */ $estabName, $estabphone, $estabmobile, 
        $estabemail, $estabwebsite, $estabfb, $piLastName, $piFirstName, $piMiddleName,
        $piUsername, $piPw, $piMobileNum, $address, $bp_path, $vid_path, $tid_path, $accountStatus,
        $userId;
    /* protected $listeners = ['showModal' => 'viewEstab']; */

    public $searchTerm;

    public $approved=true;
    public $needsapproval=false;

    public function showApproval($approval){
        if ($approval == 'approved') {
            $this->approved = true;
            $this->needsapproval = false;
        }elseif($approval == 'needsapproval'){
            $this->needsapproval = true;
            $this->approved = false;
        }
    }

    public function mount(){
        
        $newUser = DB::table('users')->where('account_status','=',0)->count();
       
        if ($newUser > 0) {
            $this->approved = false;
            $this->needsapproval = true;
        }
    }

    public function render()
    {
        if ($this->approved) {

            $searchTerm = '%'.$this->searchTerm.'%';
        
            $data = DB::table('establishment_user_infos')
                ->join('users', 'establishment_user_infos.ua_id', '=', 'users.id')
                ->where('users.account_status', '=', 1)
                ->where('establishment_user_infos.establishment_name', 'LIKE', "{$searchTerm}") 
                ->orderBy('establishment_user_infos.created_at', 'asc')->paginate(15);
            return view('livewire.admin.manage-establishment', ['data'=>$data, 'ctrData'=>DB::table('users')->where('account_status', '=', 0)->count()]);
        }
        if($this->needsapproval){
            //return $this->needsapproval;
            $searchTerm = '%'.$this->searchTerm.'%';
        
            $data1 = DB::table('establishment_user_infos')
                ->join('users', 'establishment_user_infos.ua_id', '=', 'users.id')
                ->select('users.last_name', 'users.first_name', 'users.middle_name', 
                'users.username', 'users.person_contactnum', 'users.account_status', 
                'establishment_user_infos.*')
                ->where('users.account_status', '=', 0)
                ->where('establishment_user_infos.establishment_name', 'LIKE', "{$searchTerm}")  
                ->orderBy('establishment_user_infos.created_at', 'asc')->paginate(15);
            return view('livewire.admin.manage-establishment', ['data'=>$data1, 'ctrData'=>DB::table('users')->where('account_status', '=', 0)->count()]);
        }
       
    }

    public function viewEstab($id){
        $this->viewModal = true;
        /* $this->estab_id = $id; */
        
        $estabInfo = DB::table('establishment_user_infos')
                        ->join('users', 'establishment_user_infos.ua_id', '=', 'users.id')
                        ->join('establishment_addresses', 'establishment_user_infos.id', '=', 'establishment_addresses.eui_id')
                        ->where('users.id', $id)->first();
        /* dd($estabInfo->last_name); */
        $this->estabName        = $estabInfo->establishment_name;
        $this->estabphone       = $estabInfo->establishment_phonenum;
        $this->estabmobile      = $estabInfo->establishment_mobilenum;
        $this->estabemail       = $estabInfo->establishment_email;
        $this->estabwebsite     = $estabInfo->establishment_website;
        $this->estabfb          = $estabInfo->establishment_fb_account;
        $this->piLastName       = $estabInfo->last_name;
        $this->piFirstName      = $estabInfo->first_name;
        $this->piMiddleName     = $estabInfo->middle_name;
        $this->piUsername       = $estabInfo->username;
        $this->piPw             = $estabInfo->username;
        $this->accountStatus    = $estabInfo->account_status;
        $this->piMobileNum      = $estabInfo->person_contactnum;
        $this->address          = $estabInfo->frbs .', '. $estabInfo->barangay.', '.$estabInfo->municipality.', '.$estabInfo->province;
        $this->bp_path          = $estabInfo->business_permit_path;
        $this->vid_path         = $estabInfo->valid_id_path;
        $this->tid_path         = $estabInfo->tax_id_path;
        $this->userId           = $estabInfo->ua_id;
        
        /* $this->establishment_id = $eui_id; */
    }

    public function resetViewFields(){
        $this->estabName        = "";
        $this->estabphone       = "";
        $this->estabmobile      = "";
        $this->estabemail       = "";
        $this->estabwebsite     = "";
        $this->estabfb          = "";
        $this->piLastName       = "";
        $this->piFirstName      = "";
        $this->accountStatus    = "";
        $this->piMiddleName     = "";
        $this->piUsername       = "";
        $this->piPw             = "";
        $this->piMobileNum      = "";
        $this->address          = "";
        $this->bp_path          = "";
        $this->vid_path         = "";
        $this->tid_path         = "";
        $this->userId           = "";
        /* $this->establishment_id = ""; */
    }

    public function deactiveAccount($id){
        DB::table('users')
            ->where('id', $id)
            ->update(['account_status' => 0]);
        $this->accountStatus =0;
    }

    public function activateAccount($id){
        DB::table('users')
            ->where('id', $id)
            ->update(['account_status' => 1]);
        $this->accountStatus =1;
    }
    
    public function accountRemoval($id, $ename){
        
        $nameOfFolder = preg_replace('/\s+/', '-',Str::lower($ename));
        
        DB::table('users')->where('id', $id)->delete();
        Storage::deleteDirectory('public/'.$nameOfFolder);
        session()->flash('remove_account', 'Account removed!');
        
    }

    public function resetPassword($id){
        $newpass=strtolower(Str::random(6));
        DB::table('users')->where('id', $id)
        ->update(['password'=>Hash::make($newpass)]);
        session()->flash('resetpass', 'Your new password is: '. $newpass);
    }

    public function cancel(){
        $this->viewModal = false;
        $this->resetViewFields();
    }

    public function accountApproval($id){
        DB::table('users')->where('id', $id)->update(['account_status' => 1]);
        $this->generateQrCode($id);
        session()->flash('account_approved', 'Your Account is approved!');
    }

    public function generateQrCode($uaid){
        $estabName = DB::table('establishment_user_infos')->select('establishment_name', 'id')->where('ua_id', $uaid)->first();
        $folderName = preg_replace('/\s+/', '-', Str::lower($estabName->establishment_name));
        if (!file_exists(public_path('storage/'.$folderName.'/'.$folderName.'.png'))) {
            QrCode::size(500)
              ->format('png')
              ->generate(route('visitor-logform', $estabName->id), public_path('storage/'.$folderName.'/'.$folderName.'.png'));
        }
    }

    
}

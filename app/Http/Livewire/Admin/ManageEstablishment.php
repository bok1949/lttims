<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

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

    public function render()
    {
        /* $data = DB::table('establishment_user_infos')->orderBy('created_at', 'asc')->simplePaginate(1); */
         $searchTerm = '%'.$this->searchTerm.'%';
        
        /* $data = DB::table('establishment_user_infos')
                ->join('users', 'establishment_user_infos.ua_id', '=', 'users.id')
                ->where('establishment_user_infos.establishment_name', 'LIKE', "{$searchTerm}") 
                ->orWhere('establishment_user_infos.establishment_email', 'LIKE', "{$searchTerm}") 
                ->orderBy('establishment_user_infos.created_at', 'asc')->paginate(1); */
        $data = DB::table('establishment_user_infos')
                ->where('establishment_user_infos.establishment_name', 'LIKE', "{$searchTerm}") 
                ->orWhere('establishment_user_infos.establishment_email', 'LIKE', "{$searchTerm}") 
                ->orderBy('establishment_user_infos.created_at', 'asc')->paginate(1);
        return view('livewire.admin.manage-establishment', ['data'=>$data]);
    }

    public function viewEstab($id){
        $this->viewModal = true;
        /* $this->estab_id = $id; */
        
        $estabInfo = DB::table('establishment_user_infos')
                        ->join('users', 'establishment_user_infos.ua_id', '=', 'users.id')
                        ->join('establishment_addresses', 'establishment_user_infos.id', '=', 'establishment_addresses.eui_id')
                        ->where('establishment_user_infos.id', $id)->first();
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

    public function cancel(){
        $this->viewModal = false;
        $this->resetViewFields();
    }
}

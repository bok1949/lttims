<?php

namespace App\Http\Livewire\Establishment;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShowProfile extends Component
{
    
    public $pn='d-none', $mn='d-none', $eadd='d-none', $estabfb='d-none', $estabwebsite='d-none', $estaboverview='d-none';
    public $phone_number, $seven_digit_mobile_number;
    public $mobile_number_prefix, $tel_prefix=array();
    public $establishment_email, $establishment_facebook, $establishment_website, $overview_value;
    protected $listeners = [
            'can' => 'cancel',
        ];
    public $showQr='d-none';
    public $message = "Sample message";

    /* public function generateQRCode(){
        $this->showQr = 'd-block';
        QrCode::size(500)
              ->format('png')
              ->generate('This is Sample Product Name', public_path('images/qrcode.png'));
    } */
        
    public function getMobilePrefix($val){
        $this->mobile_number_prefix = $val;
    }
    public function netWorkPrefixes($value, $show){
        $this->mn=$show;
        switch ($value) {
            case 'globe':
                 $this->tel_prefix = ['0817', '0905', '0906', '0915', '0916', '0917', '0926', '0927', '0935', '0936', 
                '0937', '0945', '0953', '0954', '0955', '0956', '0965', '0966', '0967', '0975', 
                '0976', '0977', '0978', '0979', '0994', '0995', '0996', '0997']; 
                break;
            case 'smart':
                $this->tel_prefix = [
                '0813', '0907', '0908', '0909', '0910', '0911', '0912', '0913', '0914', '0918', 
                '0919', '0920', '0921', '0928', '0929', '0930', '0938', '0939', '0946', '0947', 
                '0948', '0949', '0950', '0951', '0961', '0963', '0968', '0970', '0981', '0989',  
                '0992', '0998', '0999'];
                break;
            case 'sun':
                $this->tel_prefix =  [
                '0922', '0923', '0924', '0925', '0931', '0932', '0933', '0934', 
                '0940', '0941', '0942', '0943', '0944', '0973', '0974' ];
                break;
            case 'dito':
                 $this->tel_prefix = ['0991', '0992', '0993', '0994', '0895', '0896', '0897', '0898'];
                break;
            default:
                $this->tel_prefix=[];
                break;
        }
    }

    public function ePhoneNumber($value){
       
        $this->pn = $value;
        $this->validate([
            'phone_number' => 'required|min:7|integer'
        ]);
        
        DB::table('establishment_user_infos')
            ->where('ua_id', session('authID'))
            ->update([
                'establishment_phonenum' => '074'.''.$this->phone_number,
                'updated_at'    => Carbon::now()
                ]);
        session()->flash('phone_num_mess', 'Phone Number successfully updated.');
    }

    public function saveMobileNumber($value){
        $this->mn = $value;
        $this->validate([
            'seven_digit_mobile_number' => 'required|min:7|integer',
            'mobile_number_prefix'   => 'required'
        ]);
        DB::table('establishment_user_infos')
            ->where('ua_id', session('authID'))
            ->update([
                'establishment_mobilenum' => $this->mobile_number_prefix.$this->seven_digit_mobile_number,
                'updated_at'    => Carbon::now()
                ]);
        session()->flash('mobile_num_mess', 'Mobile Number successfully updated.');
    }
    
    public function saveEmailAdd($value){
        $this->eadd = $value;
        $this->validate([ 
            'establishment_email'   => 'required|email',
        ]);
        DB::table('establishment_user_infos')
            ->where('ua_id', session('authID'))
            ->update([
                'establishment_email' => $this->establishment_email,
                'updated_at'    => Carbon::now()
                ]);
        session()->flash('email_add_mess', 'Email Address successfully updated.');
    }

    public function saveEstabFacebook($value){
        $this->estabfb = $value;
        $this->validate([ 
            'establishment_facebook'   => 'required',
        ]);
        DB::table('establishment_user_infos')
            ->where('ua_id', session('authID'))
            ->update([
                'establishment_fb_account' => $this->establishment_facebook,
                'updated_at'    => Carbon::now()
                ]);
        session()->flash('estab_fb_mess', 'Facebook account successfully updated.');
    }

    public function saveEstabWebsite($value){
        $this->estabwebsite = $value;
        $this->validate([ 
            'establishment_website'   => 'required',
        ]);
        DB::table('establishment_user_infos')
            ->where('ua_id', session('authID'))
            ->update([
                'establishment_website' => $this->establishment_website,
                'updated_at'    => Carbon::now()
                ]);
        session()->flash('estab_website_mess', 'Website successfully updated.');
    }

    public function saveOverview($value){
        $this->estaboverview = $value;
        $this->validate([ 
            'overview_value'   => 'required',
        ]);
        DB::table('establishment_user_infos')
            ->where('ua_id', session('authID'))
            ->update([
                'historical_description' => $this->overview_value,
                'updated_at'    => Carbon::now()
                ]);
        session()->flash('estab_overview_mess', 'Brief Overview of Establishment is successfully updated.');
    }

    public function show($val){
        $this->$val = 'd-block';
    }

    public function cancel($value){
                
        $this->clear();
        $this->resetErrorBag();
        $this->$value = 'd-none';
        
    }

    public function clear(){
        $this->estab_phone_num = '';
        $this->seven_digit_mobile_number = '';
        $this->mobile_number_prefix = '';
        $this->estab_email = '';
        $this->estab_fb_val = '';
        $this->estab_website_val='';
        $this->overview_value='';
        $this->tel_prefix=[];
    }

    public function render()
    {
        
        /* dd(session('authID')); */
        $estab = DB::table('establishment_user_infos')->where('ua_id', session('authID'))->first();
        /* dd($estab->id); */
        $countPhoto = DB::table('establishment_photos')->where('eui_id', $estab->id)->count();
        $folderName = preg_replace('/\s+/', '-', $estab->establishment_name);
        $estabInfo = [
            'estabInfo'         => $estab,
            'photoCount'        => $countPhoto,
            'folderName'        => $folderName 
        ];

        /* dd($data['estabInfo']->establishment_name); */
        return view('livewire.establishment.show-profile', $estabInfo);
    }
}

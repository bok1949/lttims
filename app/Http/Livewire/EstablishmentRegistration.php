<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EstablishmentRegistration extends Component
{
    use WithFileUploads;
    public $establishment_name,
    $type_of_establishment,
    $establishment_email,
    $establishment_mobile_number,
    $establishment_phone_number,
    $establishment_website,
    $establishment_fb_account,
    $room_number_street,
    $barangay,
    $first_name,
    $last_name,
    $middle_name,
    $person_mobile_number,
    $business_permit,
    $valid_id,
    $tax_id;

    public $totalSteps = 4;
    public $currentStep = 1;

    public $counter;

    public function mount(){
        $this->currentStep = 1;
    }
    
    private function checkPrefix($prefix){
        $networkPrefixes = [
                '0813', '0918',	'0940', '0970', '0907', '0919', '0946', '0981',
                '0908', '0920',	'0947', '0989', '0909', '0921',	'0948', '0992',
                '0910', '0928',	'0949', '0998', '0911', '0929',	'0950', '0999',
                '0912', '0930',	'0951', '0963', '0913', '0938',	'0961', '0914', 
                '0939', '0968', '0817', '0927',	'0955', '0977', '0905', '0935',	
                '0956', '0978', '0906', '0936',	'0965', '0979', '0915', '0937',	
                '0966', '0994', '0916', '0945',	'0967', '0995', '0917', '0953',	
                '0973', '0996', '0926', '0954',	'0975', '0997', '0922', '0933',	
                '0944', '0923', '0934', '0973', '0924', '0940',	'0974', '0925', 
                '0941', '0931', '0942', '0932', '0943'
                ];
        /* return Str::of($networkPrefixes)->conatins($prefix); */
        /* dd(Str::of($networkPrefixes)->conatins($prefix)); */
        return in_array($prefix, $networkPrefixes);
    }

    public function render()
    {
        return view('livewire.establishment-registration');
    }

    public function decreaseStep(){
        $this->currentStep--;
        if($this->currentStep < 1){
            $this->currentStep = 1;
        }
    }

    public function increaseStep(){
        $this->resetErrorBag();
        $this->validateData();
        if ($this->currentStep == 1) {
            $prefix_estab = Str::of($this->establishment_mobile_number)->substr(0, 4);
            if ($this->checkPrefix($prefix_estab) == false) {
                $this->addError('establishment_mobile_number', 'Invalid Cell Phone Number');
            }else{
                $this->currentStep++;
            }
        }elseif($this->currentStep == 3){
            $prefix_pi = Str::of($this->person_mobile_number)->substr(0, 4);
            if ($this->checkPrefix($prefix_pi) == false) {
                $this->addError('person_mobile_number', 'Invalid Cell Phone Number');
            }else{
                $this->currentStep++;
            }
        }else{
            $this->currentStep++;
        }
        
        if($this->currentStep > $this->totalSteps){
            $this->currentStep = $this->totalSteps;
        }
    }

    public function validateData(){
        
        if($this->currentStep == 1){
            $this->validate([
                'establishment_name'            => 'required',
                'type_of_establishment'         => 'required',
                'establishment_email'           => 'required|email',
                'establishment_mobile_number'   => 'required|numeric|min:11'
            ]);
            
        }elseif ($this->currentStep == 2) {
            $this->validate([
                'room_number_street'    => 'required',
                'barangay'              => 'required'
            ]);
        }elseif ($this->currentStep == 3) {
            $this->validate([
                'first_name'            => 'required|min:2|max:45',
                'last_name'             => 'required|min:2|max:45',
                'person_mobile_number'  => 'required|numeric|min:11'
            ]);
            
        }
        
    }

    /* public function removeItem($item){
        if ($item == 'business_permit') {
            $this->business_permit = '';
        }elseif($item == 'valid_id'){
            $this->valid_id = '';
        }elseif ($item == 'tax_id') {
            $this->tax_id = '';
        }
    } */

    public function register(){
        $this->resetErrorBag();
        if($this->currentStep == 4){
            
            $this->validate([
                'business_permit'   => 'required|image|mimes:jpg,jpeg,png|max:5120',
                'valid_id'          => 'required|image|mimes:jpg,jpeg,png|max:5120',
                'tax_id'            => 'required|image|mimes:jpg,jpeg,png|max:5120'
            ]);
        }
        /* dd($this->business_permit); */
       /*  dd($this->business_permit->extension().'--'.uniqid().' bp'.time());
        dd($this->business_permit->file('business_permit')); */
        
        /* dd($this->business_permit->getClientOriginalName());
        dd('save into the DB'); */
        /* establishment_name */
        /* $this->business_permit->store($nameOfFolder,'public'); */
        $unameprepend = DB::table('users')->count();
        $unameprepend += 1;
        $userName1 = Str::lower($this->establishment_name).'_'.$unameprepend.rand($unameprepend, $unameprepend + 3);
        $userName2 = preg_replace('/\s+/', '_',$userName1);
        $nameOfFolder = preg_replace('/\s+/', '-',Str::lower($this->establishment_name));
        
        
        $userId = DB::table('users')->insertGetId([
            'last_name'         => Str::upper($this->last_name),
            'first_name'        => Str::upper($this->first_name),
            'middle_name'       => Str::upper($this->middle_name),
            'username'          => $userName2,
            'person_contactnum' => $this->person_mobile_number,
            'password'          => Hash::make($userName2),
            'user_role'         => 'establishment',
            'account_status'    => 0,
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $bs = $this->business_permit->store($nameOfFolder,'public');
        $validid=$this->valid_id->store($nameOfFolder,'public');
        $taxid=$this->tax_id->store($nameOfFolder,'public');
        $eui_id = DB::table('establishment_user_infos')->insertGetId([
            'establishment_name'        => $this->establishment_name,
            'type_of_establishment'     => $this->type_of_establishment,
            'establishment_phonenum'    => $this->establishment_phone_number,
            'establishment_mobilenum'   => $this->establishment_mobile_number,
            'establishment_email'       => $this->establishment_email,
            'establishment_website'     => $this->establishment_website,
            'establishment_fb_account'  => $this->establishment_fb_account,
            'historical_description'    => '',
            'business_permit_path'      => $bs,
            'valid_id_path'             => $validid,
            'tax_id_path'               => $taxid,
            'ua_id'                     => $userId,
            /* 'unreadNotifications'       => '', */
            'created_at'                => Carbon::now()
        ]);
        
        DB::table('establishment_addresses')->insert([
            'frbs'          => Str::upper($this->room_number_street),
            'barangay'      => Str::upper($this->barangay),
            'municipality'  => 'LA TRINIDAD',
            'province'      => 'BENGUET',
            'zip'           => 2601,
            'eui_id'        => $eui_id,
            'created_at'    => Carbon::now()
        ]);
        $this->cleanUpTempFiles();
        session()->flash('message', 'You have registered successfully!!');
        /* $this->emit('countNoti'); */
        /* $this->dispatchBrowserEvent('countNoti'); */
        return redirect()->to('ao/register');
    }

    public function cleanUpTempFiles(){
        $oldFiles = Storage::files('livewire-tmp');
        /* dd($oldFiles); */
        foreach ($oldFiles as $file) {
            Storage::delete($file);
        }
    }
}

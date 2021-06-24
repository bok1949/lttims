<?php

namespace App\Http\Livewire\Establishment;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ShowPersonalProfile extends Component
{
    public $lnamehs='d-none', $fnamehs='d-none', $mnamehs='d-none', $contactnumhs='d-none', $usernamehs='d-none', $pwhs='d-none';
    public $last_name_input, $first_name_input, $middle_name_input, $contact_number_input, $username_input, $password_input, $retype_password;
    

    public function saveLastName($dflex){
        $this->lnamehs = $dflex;
        $this->validate([
            'last_name_input' => 'required|min:2'
        ]);
        
        $this->updateDatabase('last_name', Str::of($this->last_name_input)->upper());
        session()->flash('lastname', 'Last Name successfully updated.');
        return redirect(route('personal.showInfo'));
    }

    public function saveFirstName($dflex){
        $this->fnamehs = $dflex;
        $this->validate([
            'first_name_input' => 'required|min:2'
        ]);
        $this->updateDatabase('first_name', Str::of($this->first_name_input)->upper());
        
        session()->flash('firstname', 'First Name successfully updated.');
        return redirect(route('personal.showInfo'));
    }

    public function saveMiddleName($dflex){
        $this->mnamehs = $dflex;
        $this->updateDatabase('middle_name', Str::of($this->middle_name_input)->upper());
        
        session()->flash('middlename', 'Middle Name successfully updated.');
        return redirect(route('personal.showInfo'));
    }

    public function saveContactNumber($dflex){
        $this->contactnumhs = $dflex;
        $this->validate([
            'contact_number_input' => 'required|numeric'
        ]);
        $this->updateDatabase('person_contactnum', $this->contact_number_input);
        
        session()->flash('contactnumber', 'Contact Number successfully updated.');
        return redirect(route('personal.showInfo'));
    }

    public function saveUsername($dflex){
        $this->usernamehs = $dflex;
        $this->validate([
            'username_input' => 'required|min:6'
        ]);
       
        
        $countUname = DB::table('users')->where('username', $this->username_input)->count();
        if($countUname > 0){
            session()->flash('error_uname', 'Username '.$this->username_input.' is already taken.');
        }else{
            $this->updateDatabase('username', Str::of($this->username_input)->trim());
            session()->put('message', 'Username successfully changed.');
            return redirect(route('ao.logout'));
        }
        
    }

    public function savePassword($dflex){
        $this->pwhs = $dflex;
        $this->validate([
            'password_input'    => 'required|min:6|max:24',
            'retype_password'   => 'required|same:password_input'
        ]);
        $this->updateDatabase('password', Hash::make($this->password_input));
        session()->put('message', 'Password successfully changed.');
        return redirect(route('ao.logout'));
    }

    public function updateDatabase($col, $val){
        DB::table('users')
            ->where('id', session('authID'))
            ->update([
                $col => $val,
                'updated_at'    => Carbon::now()
        ]);
    }

    public function show($varshow){
        $this->$varshow = 'd-flex';
    }

    public function cancel($value){
                
        $this->clear();
        $this->resetErrorBag();
        $this->$value = 'd-none';
        
    }

    public function clear(){
        $this->last_name_input = '';
        $this->first_name_input = '';
        $this->middle_name_input = '';
        $this->contact_number_input = '';
    }

    public function render()
    {
        
        $user = DB::table('users')->where('id', session('authID'))->first();
        $data = [
            'userInfo' => $user
        ];
        return view('livewire.establishment.show-personal-profile', $data);
    }
}

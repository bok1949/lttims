<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class NewRegistrationNotification extends Component
{
    /* protected $listeners = ['countNoti' => 'render']; */

    public function readNotifications(){
        DB::table('establishment_user_infos')
        ->where('unreadNotifications','=',null)
        ->update(['unreadNotifications'=>Carbon::now()]);
    }

    public function render()
    {
        
        $newUser = DB::table('establishment_user_infos')->where('unreadNotifications','=',null)->count();
        /* dd($newUser); */
        return view('livewire.new-registration-notification', ['ctr'=>$newUser]);
    }
}

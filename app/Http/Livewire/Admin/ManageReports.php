<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ManageReports extends Component
{
    public $loe = true;
    public $mva = false;

    public function showPages($value){
        if($value == 'loe'){
            $this->loe = true;
            $this->mva = false;
        }elseif ($value == 'mva') {
            $this->loe = false;
            $this->mva = true;
        }
    }

    public function render()
    {
        return view('livewire.admin.manage-reports');
    }
}

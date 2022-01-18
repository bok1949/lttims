<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;

class EstablishmentListReports extends Component
{
    
     use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function generateEstablishmentPDF(){
        $estabData = DB::table('establishment_user_infos')
                ->orderBy('establishment_user_infos.created_at', 'asc')
                ->get();
        $pdf = PDF::loadView('ao-pages.admin-pages.pdf-generate.estabMasterlistReport', ['estabData'=>$estabData])->output();
        /* dd(response($pdf)); */
        return response()->streamDownload(
            fn()=>print($pdf), Carbon::now()."-establishments.pdf"
        );
    }

    public function render()
    {
        $data = DB::table('establishment_user_infos')
                ->orderBy('establishment_user_infos.created_at', 'asc')
                ->paginate(3);
        return view('livewire.admin.establishment-list-reports', ['data'=>$data]);
    }
}

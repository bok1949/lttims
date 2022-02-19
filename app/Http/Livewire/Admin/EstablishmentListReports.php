<?php

namespace App\Http\Livewire\Admin;

use PDF;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class EstablishmentListReports extends Component
{
    
     use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $showEstabReport = false;
    public $establishmentList=true;
    public $establishmentVisitors = false;
    public $sortYear, $sortMonth, $monthTextual;
    private $dataCollection="";
    protected $listeners = ['sortData' => 'sortEstablishmentVisitor'];

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

    public function navListVisitor($navdata){
        $this->establishmentList = ($navdata=='establist')?true:false;
        $this->establishmentVisitors = ($navdata=='visitorNumber')?true:false;
    }

    public function printEstablishmentVisitor(){
                
        $estabData = DB::table('establishment_user_infos')
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
        
        /* dd($estabData); */
        $pdf = PDF::loadView('ao-pages.admin-pages.pdf-generate.estabNumberOfVisitors', ['estabData'=>$estabData])->output();
        /* dd(response($pdf)); */
        return response()->streamDownload(
            fn()=>print($pdf), Carbon::now()."-establishmentsvisitors.pdf"
        );
    }

    public function sortEstablishmentVisitor($val){
        /* dd(Str::of($val)->substr(8));
        dd($val); */
        
        if ($val != null) {
            $sortData = Str::of($val)->split('/-/');
            if (count($sortData) > 1) {
                $this->sortYear="";
                $this->sortMonth=$sortData[1];
                //dd($sortData[1]);
                $this->dataCollection = DB::table('establishment_user_infos')
                ->select('establishment_user_infos.*',
                    DB::raw("(SELECT SUM(people_with_you_male) 
                    FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwym"),
                    DB::raw("(SELECT SUM(people_with_you_female) 
                    FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwyf"),
                    DB::raw("(SELECT SUM(people_with_you_lgbtq) 
                    FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwylgbtq")
                    )
                ->whereMonth('created_at', '=',  $sortData[1])
                ->orderBy('establishment_user_infos.created_at', 'asc')
                ->paginate(15);
            }else{
                $this->sortMonth="";
                $this->sortYear= $sortData[0];
                $this->dataCollection = DB::table('establishment_user_infos')
                    ->select('establishment_user_infos.*',
                        DB::raw("(SELECT SUM(people_with_you_male) 
                        FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwym"),
                        DB::raw("(SELECT SUM(people_with_you_female) 
                        FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwyf"),
                        DB::raw("(SELECT SUM(people_with_you_lgbtq) 
                        FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwylgbtq")
                        )
                    ->whereYear('created_at',  $sortData[0])
                    ->orderBy('establishment_user_infos.created_at', 'asc')
                    ->paginate(15);
            }
        }else{
            $this->resetErrorBag();
            $this->addError('novalue', 'Sort value must not be empty!!');
        }
        
    }

    public function render()
    {
        $this->monthTextual=Carbon::parse()->now()->format('F');
        if ($this->establishmentVisitors) {
            if ($this->dataCollection != null) {
                if(count($this->dataCollection) > 0){
                    return view('livewire.admin.establishment-list-reports', ['data'=>$this->dataCollection]);
                }else{
                    $this->resetErrorBag();
                    !empty($this->sortYear)?$this->addError('nodata', 'No available data on '.$this->sortYear):'';
                    !empty($this->sortMonth)? $this->addError('nodata', 'No available data on '.Carbon::createFromFormat('m', $this->sortMonth)->format('F')):'';
                }
            }
            $data1 = DB::table('establishment_user_infos')
                ->select('establishment_user_infos.*',
                    DB::raw("(SELECT SUM(people_with_you_male) 
                    FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwym"),
                    DB::raw("(SELECT SUM(people_with_you_female) 
                    FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwyf"),
                    DB::raw("(SELECT SUM(people_with_you_lgbtq) 
                    FROM visitor_users WHERE visitor_users.eui_id=establishment_user_infos.id) as pwylgbtq")
                    )
                ->whereMonth('created_at', Carbon::now()->month)
                ->orderBy('establishment_user_infos.created_at', 'asc')
                ->paginate(15);
           /*  dd($data1); */
            return view('livewire.admin.establishment-list-reports', ['data'=>$data1]);
        }
        $data = DB::table('establishment_user_infos')
                ->orderBy('establishment_user_infos.created_at', 'asc')
                ->paginate(15);
        return view('livewire.admin.establishment-list-reports', ['data'=>$data]);
    }

    public function viewEstabReport($id){

    }
}

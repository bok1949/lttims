<?php

namespace App\Http\Livewire\Establishment;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\File;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class EstablishmentUploadedImage extends Component
{
    use WithFileUploads;
    public $photo, $pid;


    public function selectedMainPhoto($id, $eui_id){
        /* dd($id); */
        DB::table('establishment_photos')
              ->where('eui_id', $eui_id)
              ->update(['is_main' => 0]);
        DB::table('establishment_photos')
              ->where('id', $id)
              ->update(['is_main' => 1]);
    }

    public function deselectMainPhoto($id){
        DB::table('establishment_photos')
              ->where('id', $id)
              ->update(['is_main' => 0]);
    }

    public function removePhoto($id){
        $getpath = DB::table('establishment_photos')
            ->where('id', $id)->first();
        DB::table('establishment_photos')
            ->where('id', $id)->delete();
        unlink(public_path($getpath->image_path));
        /* if(File::exists(public_path($getpath->image_path))){
            
        }else{
            dd('File does not exists.');
        } */
    }

    public function render()
    {
        $ephotots = DB::table('establishment_user_infos')
                    
                    ->join('establishment_photos', 'establishment_user_infos.id', '=','establishment_photos.eui_id')
                    ->select(
                        'establishment_photos.id',
                        'establishment_photos.img_caption', 
                        'establishment_photos.image_path',
                        'establishment_photos.is_main',
                        'establishment_photos.eui_id',
                        )
                    ->where('establishment_user_infos.ua_id', session('authID'))->get();
        $data = [
            'estabPhotos' => $ephotots
        ];
        return view('livewire.establishment.establishment-uploaded-image', $data);
    }
}

<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
trait UploadThumbTrait
{
    public function uploadThumbTrait($thumb,$path){
            //nome pro arquivo que sera salvo
            $thumb_name = time().'-mentoria'.'.'.$thumb->getClientOriginalExtension();
            return $thumb->storeAs($path,$thumb_name,'public');
    }

    public function updateUploadThumbTrait($thumb,$path,$old_thumb=null){

            if(!is_null($old_thumb)){
                if(Storage::disk('public')->exists($old_thumb)){
                    Storage::disk('public')->delete($old_thumb);
                }
            }

            return $this->uploadThumbTrait($thumb,$path);
    }
}

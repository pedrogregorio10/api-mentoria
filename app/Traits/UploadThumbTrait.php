<?php

namespace App\Traits;

trait UploadThumbTrait
{
    public function uploadThumbTrait($thumb,$path){
            //nome pro arquivo que sera salvo
            $thumb_name = time().'-mentoria'.'.'.$thumb->getClientOriginalExtension();
            
            return $thumb->storeAs($path,$thumb_name,'public');
            
    }
}

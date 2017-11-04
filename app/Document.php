<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use File;
use URL;

class Document extends Model
{
    protected $fillable = ['title', 'description', 'content', 'is_public', 'user_id', 'typedoc_id', 'create_at'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function typeDoc() {
        return $this->belongsTo('App\TypeDocument', 'typedoc_id');
    }

    public function totalDeleteFile(){
        $file_location = 'public/documents/'.$this->content;

        if ($file_location!= null){
            $hi = $file_location;
          
            if (File::exists($hi)){
                File::delete($hi);
                return 1;
            }
        }

        return -1;
    }
    
}

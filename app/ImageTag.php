<?php

namespace App;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class ImageTag extends Model
{
    
    protected $fillable = [
        'tag_id','image_id'
    ];

    public function tags(){
        return $this->hasOne('App\Tag');
    }

    public function image(){
        return $this->hasOne('App\Image');
    }

}

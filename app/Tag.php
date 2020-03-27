<?php

namespace App;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Tag extends Model
{
    
    protected $fillable = [
        'tag_name'
    ];


    public function images(){
        return $this->hasMany('App\ImageTag','tag_id');
    }
    /**
     * @param $tag_name string
     * @return Tag
     */
    public static function saveRecord($tag_name)
    {
        return self::create([
            'tag_name'=>$tag_name,
        ]);
    }
}

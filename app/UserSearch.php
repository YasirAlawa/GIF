<?php

namespace App;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class UserSearch extends Model
{
    protected $table = 'user_search';
    protected $fillable = [
        'user_id'
    ];


    public function user(){
        return $this->hasOne('App\User','tag_id');
    }

    public function tags(){
        return $this->hasMany('App\SearchTags','user_search_id');
    }

    public function getTagsAsString()
    {
        $res = '';
        $i = 0;
        foreach($this->tags as $ta)
        {
            if($i>0)
                $res .= ',';
            $res .= $ta->tag->tag_name;
            $i++;
        }
        return $res;
    }

}

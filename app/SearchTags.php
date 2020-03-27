<?php

namespace App;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SearchTags extends Model
{
    protected $table = 'search_tags';
    protected $fillable = [
        'user_search_id','tag_id'
    ];


    public function search(){
        return $this->hasOne('App\UserSearch','id','user_search_id');
    }

    public function tag(){
        return $this->hasOne('App\Tag','id','tag_id');
    }
    /**
     * @param $q string
     */
    public static function saveSearch($q='')
    {
        $ar = explode(',',$q);
        $tag_ids = [];
        foreach($ar as $a)
        {
            $tag = Tag::where('tag_name','=',$a)->first();
            if(!$tag)
            {
                
                $tag = Tag::saveRecord($a);
            }
            $tag_ids[] = $tag->id;
        }

        $searchOperation = UserSearch::create([
                'user_id'=>Auth::user()->id
        ]);
        foreach($tag_ids as $t)
        {
            $searchOperation->tags()->create([
                'tag_id'=>$t
            ]);
        }
    }
}

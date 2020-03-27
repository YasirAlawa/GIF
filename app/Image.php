<?php

namespace App;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Image extends Model
{
    
    protected $fillable = [
        'path','origin_name','user_id'
    ];

    /**
     * @param $origin_name
     * @param $path
     * @param $tags
     * @return Image
     */
    public static function saveRecord($origin_name,$path,$tags)
    {
        $pic  = self::create([
            'origin_name'=>$origin_name,
            'path'=>$path,
            'user_id'=>Auth::user()->id,
        
        ]);
        if($pic && $tags)
        {
            $ar = explode(',',$tags);
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

            foreach($tag_ids as $t)
            {
                $pic->tags()->create([
                    'tag_id'=>$t
                ]);
            }
        }
        return $pic;
    }

    /**
     * @param Request $request
     * @return Picture
     */
    public static function uploadimage(Request $request)
    {
        $home_pic = null;
        $path = 'total_images';
        $base_path = 'image';
        $filename = date('Y_m_d_His_').(rand()*time()).'_';
        if ($request->hasFile('picture') && $request->picture) {
            $origin_name = $request->picture->getClientOriginalName();
            $ext = pathinfo($request->picture->getClientOriginalName(), PATHINFO_EXTENSION);
            $path = $request->file('picture')->storeAs(
                $path, $filename  . '.' . $ext, 'public_img');
            $home_pic = Image::saveRecord($origin_name,$path,$request['tags']);
        }
        
        return $home_pic;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        $path = URL::to('/').'/image/'.$this->path;
        return $path;
    }


    public function tags(){
        return $this->hasMany('App\ImageTag','image_id');
    }
    /**
     * @param $q string
     * @param $page int
     */
    public static function searchByTags($q='',$page=1){
        try
        {
            $pageSize = 3;
            $offset = ($page-1);
            SearchTags::saveSearch($q);
            $ar = explode(',',$q);
            
            $query = Tag::where('id','<',0);//dummy condition
            foreach($ar as $a)
            {
                $query->orwhere('tag_name',$a);
            }
            $tags = $query->get();
            $tags_ar = [];
            foreach($tags as $tag)
            {
                $tags_ar[] = $tag['id'];
            }
            
            if(count($tags_ar)<=0)
                throw new \Exception('no related tags');
            $query = Image::join('image_tags','image_tags.image_id','=','images.id');
            $query->where('tag_id',$tags_ar);
            $images = $query->skip($offset)->take($pageSize)->get();
            $final_data = [];
            /** Image[] */
            foreach($images as $image)
            {
                $final_data[] =[
                    'id'=>$image->id,
                    'name'=>$image->origin_name,
                    'image_path'=>$image->getPath()
                ];
            }
        
            return $final_data;
        }
        catch(\Throwable $e)
        {
           
            return [];
        }
    }

}

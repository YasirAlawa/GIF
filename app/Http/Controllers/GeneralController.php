<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //
    public function dashboard(){
        $users = User::count();
        $articles = Article::where('deleted',0)->count();
        $category = Category::count();
        return response()->json(['status' => 'success', 'data' => ['users' => $users, 'articles' => $articles ,'category' => $category, 'message' => 'count success']], 200);
    }
    public function index($id = null){
        $arr['article'] ='';
            return view('index',$arr);
    }
    /**
     * @param string $q 
     * @param int $page 
     * @return string
     */
    public function search($q='',$page=1){
        $images = Image::searchByTags($q,$page);
        return response()->json(['status' => 'success', 'data' => ['images' => $images ]], 200);
    }
}

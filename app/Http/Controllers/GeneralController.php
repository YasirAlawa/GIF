<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index($id = null){
            return view('index');
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

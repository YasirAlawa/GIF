<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Image;

class PictureController extends Controller
{
    public function uploadImage(Request $request)
    {
        try
        {
            /** @var Image $picture */
            $picture = Image::uploadimage($request);
            if ($picture) {
                return response()->json(['status' => 'success', 'data' => ['picture_id' => $picture->id], 'message' => 'Image uploaded successfully'], 200);
            } else {
                return response()->json(['status' => 'error', 'message' =>'Operation Failed'], 500);
            }
        }
        catch (\Throwable $e)
        {
            return response()->json(['status' => 'error', 'message' =>$e->getMessage()], 500);
        }
    }

}
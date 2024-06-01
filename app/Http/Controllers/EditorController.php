<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function uploadMedia(Request $request){
        if ($image = $request->file('upload')) {
            $destinationPath = 'images/';
            $fileName = $image->getClientOriginalName();
            $extension = pathinfo($fileName,PATHINFO_FILENAME);
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $url = asset('images/'.$profileImage);

            return response()->json(["filename" => $fileName, "uploaded" => 1,"url" => $url]);
        }
    }
}

<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UtilController extends Controller
{
    //
     public function setSideBarBackgroundColor (Request $request)
    {
    	if(isset($request -> sidebar_back_color)){
    		session()->put('sidebar_back_color', $request -> sidebar_back_color);
    		return response()->json(['success'=>'done']);
    	}
    	return response()->json(['error'=>'sidebar back color is not set']);
    }

    public function setSideBarForegroundColor (Request $request)
    {
    	if(isset($request -> sidebar_fore_color)){
    		session()->put('sidebar_fore_color', $request -> sidebar_fore_color);
    		return response()->json(['success'=>'done']);
    	}
    	return response()->json(['error'=>'sidebar fore color is not set']);
    }
}

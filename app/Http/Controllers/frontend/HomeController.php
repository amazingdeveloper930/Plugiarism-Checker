<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\DocumentFile;
use App\Computers;
use App\Membership;
use App\User;


class HomeController extends Controller
{
    public function index(Request $request)
    {
    	$user_token = session()->get('user_token', function () {
		    return Str::random(30);
		});
		session()->put('user_token', $user_token);

        // session()->forget('current_file_id');
        
        session()->forget('demo_user');

    	$uploaded_files = DocumentFile::where('user_token', $user_token) -> get();

    	$ip = $request->getClientIp();
        $entry = Computers::where('ip_address', $ip)->first();
        $visit_once = false;
        if(isset($entry))
        {
            if(date('Y-m-d', strtotime(now())) == date('Y-m-d', strtotime($entry->checked_at)))
                $visit_once = true;
        }
        $return_data = ['user_token' => $user_token, 'uploaded_files' => $uploaded_files,'visit_once' => $visit_once];
        return view('frontend.home.index', $return_data);
        
    }
	
}

<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Reports;
use App\DocumentFile;
use App\User;
use App\Membership;
use Auth;



class ProcessController extends Controller
{
    //
    public function index(Request $request)
    {
    	if(true){
    		 $user_token = session()->get('user_token');
    		 $id = session()->get('current_file_id');
    		
        	if(isset($user_token) && $user_token != null){
	            $file = DocumentFile::where('id', $id)
	                    -> where('user_token', $user_token)
	                    -> first();
                if(isset($file))
                {
                    if(!(Auth::check())){
                        $entry = null;
                        if(isset($file -> report_id))
                        {
                            $entry = Reports::where('report_id', $file->report_id)->first();
                        }
                        if(! isset($entry))
                    	$entry = Reports::create([
                            'report_id' => Str::random(30),
                            'file_name' => $file['file_name'],
                            'file_type' => $file['file_format'],
                            'owner' => $user_token,
                            'email' => $file['email'],
                            'status' => 2,
                            'word_count' => $file['text_size']
                        ]);
                        $entry -> save();
                        $file->report_id = $entry -> report_id;
                        $file->save();
                        //This is for payment
                        /*
                        if($file->ispaid != 1)
                        {
                            return Redirect::route('user.payment', ['id' => $entry -> report_id]);
                        }
                        */
                        session()->forget('current_file_id');
                        
                        
                        $file->status = 1;
                        $file->save();
                        return Redirect::route('user.report', ['id' => $entry -> report_id]);
                    }
                    else
                    {
                        session()->forget('current_file_id');
                        $user_entry = auth() -> user();
                        if($user_entry -> membership ->  current_count > 0)
                        {
                            $entry = Reports::create([
                                'report_id' => Str::random(30),
                                'file_name' => $file['file_name'],
                                'file_type' => $file['file_format'],
                                'owner' => $user_token,
                                'email' => $user_entry -> email,
                                'status' => 2,
                                'word_count' => $file['text_size']
                            ]);
                            $temp_membership = $user_entry -> membership;
                            $temp_membership -> current_count -= 1;
                            $temp_membership -> save();
                            $user_entry -> save();
                            $entry -> save();
                            $file->ispaid = 1;
                            $file->status = 1;
                            $file->report_id = $entry -> report_id;
                            $file->save();
                            return Redirect::route('user.report', ['id' => $entry -> report_id]);
                        }
                        return Redirect::route('home');
                    }
                }
                else
                {
                    session()->forget('current_file_id');
                	return Redirect::route('home');
                }
                session()->forget('current_file_id');
                return Redirect::route('home');
            }
            else
            {
            	return Redirect::route('home');
            }
    	}
    	else
    	{
    		session()->forget('current_file_id');
    		return Redirect::route('home');
    	}
    }
}

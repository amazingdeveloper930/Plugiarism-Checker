<?php

namespace App\Http\Controllers\backend;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Services\FileUtil;
use App\DocumentFile;
use App\Membership;

use Storage;
use Session;
use App\Reports;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function index()
    {
        if(Auth::check())
    	   return view('backend.user.pages.index');
        else
           return redirect('login');
    }

    

    public function logout()
    {
        Auth::logout(); // log the user out of our application
        return redirect('login'); // redirect the user to the login screen
    }

    public function newsearch()
    {
    	$user_token = session()->get('user_token', function () {
		    return Str::random(30);
		});
		session()->put('user_token', $user_token);
        $uploaded_files = DocumentFile::where('user_token', $user_token) -> get();
    	return view('backend.user.pages.newsearch',['uploaded_files' => $uploaded_files]);
    }

    public function price()
    {
    	return view('backend.user.pages.price');
    }

    public function reports()
    {
    	
		// $reports = Reports::where('owner', $user_token)->pluck('report_id', 'file_name', 'email', 'status', 'search_type', 'score', 'report_file_url', 'made_at');
		$user_token = session()->get('user_token', function () {
		    return Str::random(30);
		});
		session()->put('user_token', $user_token);
        $reports = null;
        if(!(Auth::check()))
		  $reports = Reports::where('owner', $user_token)->get();
        else
            $reports = Reports::where('email', auth()->user()->email)->get();
		//status 0: progress 1: done
    	return view('backend.user.pages.reports', ['report_list' => $reports]);
    }

    public function report($id)
    {
    	$user_token = session()->get('user_token', function () {
		    return Str::random(30);
		});
		session()->put('user_token', $user_token);

    	$report = Reports::where('report_id', $id)
    	-> first();
    	if(isset($report))
    	{
            $document_entry = DocumentFile::where('report_id', $id) -> first();
            //This is for payment ;
          /*  if(isset($document_entry) && $document_entry -> ispaid == 1 || !(isset($document_entry)))
                return view('backend.user.pages.report', ['status' => $report -> status, 'report_id' => $report -> report_id, 'file_name' => $report -> file_name]);
            else {
                # code...
                return Redirect::route('user.payment', ['id' => $report -> report_id]);
            }
            */
            return view('backend.user.pages.report', ['status' => $report -> status, 'report_id' => $report -> report_id, 'file_name' => $report -> file_name]);
    	}
    	else
    	{
    		return Redirect::route('user.newsearch');
    	}
    }

    public function payforsupport($report_id)
    {
        return view('backend.user.pages.payforsupport', ['report_id' => $report_id]);
    }

    public function self()
    {
        $data = array();
        $data['me'] = auth()->user();
        $data['my_membership'] = auth()->user()->membership;
        $data['my_child'] = User::where('parent_id', auth()->user() -> id)->get();
        $data['my_child_membership'] = array();
        foreach ($data['my_child'] as $value) {
            # code...
            $entry = User::where('id', $value['id']) -> first();
            $data['my_child_membership'][]=$entry->membership;
        }
        return response()->json(['data' => $data]);
    }

    public function help()
    {
    	return view('backend.user.pages.help');
    	// echo Storage::url('WP93nC9oLhAOVz6fbK0eAaPxuNWz5Jarturas plagiarism web.docx');
    	 // echo FileUtil::read_docx('WP93nC9oLhAOVz6fbK0eAaPxuNWz5Jarturas plagiarism web.docx');
    }

    public function save_self(Request $request)
    {
        $entry = auth()->user();
        $entry -> name = $request -> self_name;
        $entry -> email = $request -> self_email;
        if(isset($request-> self_password))
        {
            $entry -> password = Hash::make($request -> self_password);
        }
        $entry -> save();
        return response()->json(['status' => 'done']);
        
    }

    public function delete(Request $request)
    {
        $id = $request -> id;
        $entry = User::where('id', $id)->first();
        $membership = $entry -> membership;
        auth() -> user() ->membership -> current_count += $membership -> current_count;
        $membership -> delete();
        $entry -> delete();
        auth() -> user() ->membership -> save();
        return response()->json(['status' => 'done']);
    }

    public function save(Request $request)
    {
        $entry = User::where('email', $request -> user_email)->first();
        if(isset($entry))
        {
            $membership_entry = $entry->membership;
            $membership_entry -> month_count = $request -> terms;
            $membership_entry -> document_count += $request -> user_chance;
            $membership_entry -> current_count += $request -> user_chance;
            $membership_entry -> save();
            if($request -> user_password != '')
            $entry -> password = Hash::make($request -> user_password);
            $entry -> name = $request -> user_name;
            $entry -> save();
            auth()->user() -> membership -> current_count -= $request -> user_chance;
            auth()->user() -> membership -> save();
            return response()->json(['status' => 'done']);
        }
        else
        {
            if($request -> mode == 1)//create
            {
                $entry = new User();
                $entry -> name = $request -> user_name;
               
                $entry -> password = Hash::make($request -> user_password);
                if(auth() -> user() -> role == 1)
                    $entry -> role = 2;
                if(auth() -> user() -> role == 4)
                     $entry -> role = 1;
                $entry -> parent_id = auth()->user() -> id;
                $entry -> is_active = 1;
                $entry -> email = $request -> user_email;
                $entry -> save();
                $membership_entry = new Membership();
                $membership_entry -> user_id = $entry -> id;
                $membership_entry -> document_count = $request -> user_chance;
                $membership_entry -> month_count = $request -> terms;
                $membership_entry -> current_count = $request -> user_chance;
                $membership_entry -> is_active = 1;
                $membership_entry -> start_date = now();
                $membership_entry -> save();
                $self_membership_entry = auth()->user()->membership;
                $self_membership_entry -> current_count -= $request -> user_chance;
                $self_membership_entry -> save();
                return response()->json(['status' => 'done']);
            }
            if($request -> mode == 2)//edit
            {
                $entry = User::where('id', $request -> id)->first();

                $membership_entry = $entry->membership;
                if(auth()->user() -> membership -> current_count > 0){
                    $membership_entry -> month_count = $request -> terms;
                    $membership_entry -> document_count += $request -> user_chance;
                    $membership_entry -> current_count += $request -> user_chance;
                    $membership_entry -> save();
                }
                if($request -> user_password != '')
                    $entry -> password = Hash::make($request -> user_password);
                $entry -> name = $request -> user_name;
                $entry -> save();
                if(auth()->user() -> membership -> current_count > 0){
                    auth()->user() -> membership -> current_count -= $request -> user_chance;
                    auth()->user() -> membership -> save();
                }
                return response()->json(['status' => 'done']);

            }
        }


    }

    public function payment($id)
    {
        if(isset($id))
            return view('backend.user.pages.payment', ['report_id' => $id, 'amount' => '9']);  
    }
	
}

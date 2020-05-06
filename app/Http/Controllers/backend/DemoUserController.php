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

class DemoUserController extends Controller
{
    //
    public $DEMO_SUBMITION = 1000;

    public function index()
    {
        if(! Session::has('demo_amount'))
        {
            session()->put('demo_amount', $this -> DEMO_SUBMITION);
        }
    }

    public function viewDemo()
    {
        session()->put('demo_user', true);
        if(! Session::has('demo_amount'))
        {
            session()->put('demo_amount', $this -> DEMO_SUBMITION);
        }
        return view('backend.user.pages.demouser');
    }

    public function self()
    {
        if(! Session::has('demo_amount'))
        {
            session()->put('demo_amount', $this -> DEMO_SUBMITION);
        }
        $data = array();
        $data['submission_amount'] = session('demo_amount');
        $data['demo_child'] = array();
        if(Session::has('demo_child'))
        {
            $data['demo_child'] = session('demo_child');
        }
       
        return response()->json(['data' => $data]);
    }

    public function save(Request $request)
    {
        $email = $request -> user_email;
        $children_entry = array();
        if(Session::has('demo_child'))
        {
            $children_entry = session('demo_child');
        }
        $flag = false;
        for($index = 0; $index < count($children_entry); $index ++){
            # code...
            if($children_entry[$index]['email'] == $request -> user_email)
            {
                $flag = true;
                $children_entry[$index]['name'] = $request -> user_name;
                $children_entry[$index]['password'] = $request -> user_password;
                $children_entry[$index]['terms'] = $request -> terms;
                $children_entry[$index]['chance'] += $request -> user_chance;
            }
        }
        if($flag == false)
        {
            $entry = array();
            $entry['email'] = $request -> user_email;
            $entry['name'] = $request -> user_name;
            $entry['password'] = $request -> user_password;
            $entry['terms'] = $request -> terms;
            $entry['chance'] = $request -> user_chance;
            $children_entry []= $entry;
        }
        session()->put('demo_amount', session('demo_amount') - $request -> user_chance);
        
        session()->put('demo_child', $children_entry);
        return response()->json(['status' => 'done']);
    }

    public function delete(Request $request)
    {
        $email = $request -> email;
        $children_entry = array();
        if(Session::has('demo_child'))
        {
            $children_entry = session('demo_child');
        }
        for($index = 0; $index < count($children_entry); $index ++){
            if($children_entry[$index]['email'] == $email)
            {
                session()->put('demo_amount', session('demo_amount') + $children_entry[$index]['chance']);
                array_splice($children_entry, $index, 1);
                session()->put('demo_child', $children_entry);
                return response()->json(['status' => 'done']);
            }
        }
        return response()->json(['status' => 'done']);
        
    }
}

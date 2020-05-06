<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Payment;
use App\Reports;
use App\DocumentFile;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {

          if(auth()->user()->is_active == false)
            {
                Auth::logout();
                return redirect('login');
            }
            if(auth()->user()->role == 0)
                return view('backend.admin.pages.index');
            
            if(auth()->user()->role >= 1)
            {
                return redirect() -> route('user.dashboard');
            }


    }
    public function orderlist()
    {
        if(auth()->user()->is_active == false)
        {
            Auth::logout();
            return redirect('login');
        }
        if(auth()->user()->role == 0){
            // $document_list = DocumentFile::whereNotNull('email') -> where('ispaid', 0) -> get();
            $report_list = Reports::all();
            
            return view('backend.admin.pages.orderlist', ['report_list' => $report_list]);
        }
            
        
        if(auth()->user()->role >= 1)
        {
            Auth::logout();
            return redirect('login');
        }
    }

    public function paymentlist()
    {
        if(auth()->user()->is_active == false)
        {
            Auth::logout();
            return redirect('login');
        }
        if(auth()->user()->role == 0){
            $payment_list = Payment::all();
            return view('backend.admin.pages.paymentlist', ['payment_list' => $payment_list]);
        }
           
        
        if(auth()->user()->role >= 1)
        {
            Auth::logout();
            return redirect('login');
        }
    }
    public function settings()
    {
        if(auth()->user()->is_active == false)
        {
            Auth::logout();
            return redirect('login');
        }
        if(auth()->user()->role == 0)
            return view('backend.admin.pages.settings');
        
        if(auth()->user()->role >= 1)
        {
            Auth::logout();
            return redirect('login');
        }
        
    }

    public function logout()
    {
    	Auth::logout(); // log the user out of our application
        return redirect('login'); // redirect the user to the login screen
    }

    // public function showLogin()
    // {
    //     // show the form
    //     return view('backend.admin.pages.login');
    // }

    public function doLogin()
    {

        $rules = array(
            'email'    => 'required|email', 
            'password' => 'required|string' 
        );
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return redirect() -> route('admin.showlogin')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // if(auth()->user()->isactive == false)
                // {
                //     Auth::logout();

                // }
                // if(auth()->user()->role == 0)
                //     redirect() -> route('admin.dashboard');
                // if(auth()->user()->role >= 1)
                // {
                //     redirect() -> route('user.dashboard');
                // }



            } else {        

                // validation not successful, send back to form 
                return redirect() -> route('admin.showlogin');

            }

        }

    }
}

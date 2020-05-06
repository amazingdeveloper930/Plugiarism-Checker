<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use App\Country;
use App\User;
use App\Membership;
use Illuminate\Support\Str;


class ContactController extends Controller
{
/*
page_count: page_count,
               terms:terms,
               country:country,
               institution_name:institution_name,
               institution_website:institution_website,
               institution_email:institution_email,
               additional_comments:additional_comments,
               price:price,
*/

    public function test1()
    {
    	
    }
	public function send_email_university(Request $request){
		$data = [
		'page_count'=>$request->page_count,
		'terms'=>$request->terms,
		'country'=>$request->country,
		'institution_name'=>$request->institution_name,
		'institution_website'=>$request->institution_website,
		'institution_email'=>$request->institution_email,
		'additional_comments'=>$request->additional_comments,
		'price'=>$request->amount,
		];




		// Mail::send('email.contact_university',$data, function ($message) use($request)
		// 		{
		// 			$message->from('noreply@plagiarismchecker.com', 'Plagiarismchecker.eu');
		// 			$message->to(env("App_CONTACT_EMAIL"));
		// 			$message->subject('New Inquiry from '.$request->institution_name);
		// 		});


		// 		Mail::send('email.contact_userinfo',['data'=>$password], function ($message) use($request)
		// 		{
		// 			$message->from('noreply@plagiarismchecker.com', 'Plagiarismchecker.eu');
		// 			$message->to($entry -> email);
		// 			$message->subject('Plagiarimchecker');
		// 		});


		if($request->institution_email)
		{
			Mail::send('email.contact_university',$data, function ($message) use($request)
			{
				$message->from('noreply@plagiarismchecker.com', 'Plagiarismchecker.eu');
				$message->to(env("App_CONTACT_EMAIL"));
				$message->subject('New Inquiry from '.$request->institution_name);
			});
			

			$entry = User::where('email', $data['institution_email'])->first();

			if(!isset($entry))
			{

				$entry = new User();
				$entry -> name = $data['institution_name'];
				$entry -> email = $data['institution_email'];
				$entry -> role = 1;
				$entry -> is_active = 1;
				$password = Str::random(10);
				$entry -> password = Hash::make($password);

				$entry -> save();

				$membership_entry = new Membership();
				$membership_entry -> document_count = $request->page_count;
				$membership_entry -> month_count = $request->terms;
				$membership_entry -> current_count = $request->terms;
				$membership_entry -> start_date = now();
				$membership_entry -> is_active = 1;
				$membership_entry -> user_id = $entry ->id;
				$membership_entry -> save();
				// return view('email.contact_userinfo', ['data' => $password]);

				Mail::send('email.contact_university',$data, function ($message) use($request)
				{
					$message->from('noreply@plagiarismchecker.com', 'Plagiarismchecker.eu');
					$message->to(env("App_CONTACT_EMAIL"));
					$message->subject('New Inquiry from '.$request->institution_name);
				});

				$email_data = array();
				$email_data['data'] = $password;
				Mail::send('email.contact_userinfo', $email_data, function ($message) use($request)
				{
					$message->from('noreply@plagiarismchecker.com', 'Plagiarismchecker.eu');
					$message->to( $request -> institution_email);
					$message->subject('Plagiarimchecker');
				});

				

				return response()->json(['status'=>'done', 'result'=>'0']);


			}
			else
			{
				$membership_entry = $entry->membership;
				$membership_entry -> document_count += $request->page_count;
				$membership_entry -> month_count += $request->terms;
				$membership_entry -> current_count += $request->terms;
				$membership_entry -> save();
				return response()->json(['status'=>'done', 'result'=>'1']);
			}




			
		
		}
		return response()->json(['status'=>'error']);

		
	}


    //
    public function send_email(Request $request){
		$data = [
		'form_type'=>$request->form_type,
		'email'=>$request->email,
		'name'=>$request->name,
		'txt_message'=>$request->massage

		];

			
		if($request->email)
		{
		Mail::send('email.contact',$data, function ($message) use($request)
		{
			$message->from('noreply@plagiarismchecker.com', 'Plagiarismchecker.eu');
			$message->to(env("App_CONTACT_EMAIL"));
			$message->subject('New Inquiry from '.$request->name);
		});
		
		return back()->with("data","1");
		
		}
	}

	public function send_email_partner(Request $request){

		$this->validate($request, [
            'email'     => 'required|email',
            'form_type'  => 'required',
            'company_name' => 'required',
            'market' => 'required',
            'message' => 'required'

        ]);
		$data = [
		'form_type'=>$request->form_type,
		'company_name' => $request->company_name,
		'market' => $request->market,
		'email'=>$request->email,
		'txt_message'=>$request->message
		];
		$data['country'] = '';

		if(isset( Country::find($request->company_country)->country))
		$data['country'] = Country::find($request->company_country)->country;
			
		if($request->email)
		{

			$partner = new User();
			$partner -> email = $request -> email;
			$partner -> name = $request->company_name;
			$partner -> role = 4;
			$partner -> is_active = 1;
			$password = Str::random(10);
			$partner -> password = Hash::make($password);
			$partner -> save();
			$membership = new Membership();
			$membership -> user_id = $partner -> id;
			$membership -> document_count = 0;
			$membership -> month_count = 0;
			$membership -> current_count = 0;
			$membership -> start_date = now();
			$membership -> is_active = 1;
			$membership -> save();


			Mail::send('email.contact_partner', $data, function ($message) use($request)
			{
			 	$message->from('noreply@plagiarismchecker.com', 'Plagiarismchecker.eu');
			 	$message->to(env("App_CONTACT_EMAIL"));
			 	$message->subject('New Inquiry from '.$request->name);
			 });	

			$email_data = array();
			$email_data['data'] = $password;
			Mail::send('email.contact_userinfo', $email_data, function ($message) use($request)
			{
				$message->from('noreply@plagiarismchecker.com', 'Plagiarismchecker.eu');
				$message->to($request -> email);
				$message->subject('Partner '.$request->company_name);
			});	

			return back()->with("data","done");	
		
		}
		return back()->with("data","1");
	// return view('email.contact_partner', $data);
	}

	public function site_map()
    {
        return response()->view('sitemap')->header('Content-Type', 'text/xml');;
    }
}

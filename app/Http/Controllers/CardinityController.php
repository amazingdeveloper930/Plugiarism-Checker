<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Cardinity\Client;
use Cardinity\Exception;
use Cardinity\Method\Payment;
use Session;
use Redirect;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use App\User;
use App\Membership;
use App\Payment as CardinityPayment;
use App\Reports;
use App\DocumentFile;
use App\Country;
use Illuminate\Support\Str;


class CardinityController extends Controller
{


    //payment mode : 1: individual file 2: university
    public $client;
    public $config;
    public function __construct(){

        $this->client = Client::create([
            'consumerKey' => 'test_cf6mph7jr9cuxzusknajcxmjvdneyo',
            'consumerSecret' => 'jbm1gem1hm6b7zdbb2ks0mwbtf0zb6j9aamt7zr2h0nh7sauhf',
        ]);

        $this->config = [
            'currency' => 'USD',
            'settle' => false,
            'country' => 'LT'
        ];

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function makePayment(Request $request){
        $user_email = null;
        if(Auth::check())
            $user_email = Auth::user()->email;

        $mode = $request->get('mode');
        if(date('Y') > $request->get('cc-expiration-year') || (date('Y') == $request->get('cc-expiration-year') && date('m') > $request->get('cc-expiration-month'))){

            $payment = new CardinityPayment;
            $payment->mode = $mode;
            $payment->trans_id = 0;
            $payment->method = "Cardinity Payment API";
            $payment->amount = $request->get('amount');
            $payment->paid=0;
            $payment->status="Payment Initiated";
            $payment->created_at=date('Y-m-d H:i:s');
            $payment->currency=$this->config['currency'];
            $payment->save();

            $payment->status = 'Payment declined';
            $payment->paid = 2;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = (string)$payment->id;
            if(date('Y') > $request->get('cc-expiration-year'))
                $payment->decline_reason = "Invalid year of expiry or the card is already expired";
            else
                $payment->decline_reason = "Invalid month of expiry or the card is already expired";
            $payment->save();
            Session::flash('errors','Invalid year of expiry, please check and try again');
            if($mode == "1")
                return Redirect::route('user.payment', ['id' => $request -> report_id]);
            else {
                # code...
                return Redirect::route('user.dashboard');
            }
        }

        $payment = new CardinityPayment;
        if($mode == "1")
        {
            $report_id = $request -> report_id;
            $payment->user_email = Reports::where('report_id', $report_id)->first()->email;
        }
        else {
            # code...            
            $payment->user_email = $user_email;
        }
        
        $payment->trans_id = 0;
        $payment->mode = $mode;
        $payment->method = "Cardinity Payment API";
        $payment->amount = $request->get('amount');
        $payment->paid=0;
        $payment->status="Payment Initiated";
        $payment->created_at=date('Y-m-d H:i:s');
        $payment->save();

        try {
            $method = new Payment\Create([
                'amount' => (float) $request->get('amount'),
                'currency' => $this->config['currency'],
                'settle' => $this->config['settle'],
                'description' => $request->get('description') ?$request->get('description'):'Plagiarismchecker Paper',
                'order_id' => "10" . ((string) $payment->id), // Set Order ID
                'country' => $this->config['country'],
                'payment_method' => Payment\Create::CARD,
                'payment_instrument' => [
                    'pan' => (string) $request->get('cc-number'), //'4111111111111111',
                    'exp_year' => (integer)$request->get('cc-expiration-year'), //2016,
                    'exp_month' => (integer)$request->get('cc-expiration-month'), //12,
                    'cvc' => (string)$request->get('cc-cvv'), //456,
                    'holder' => (string)$request->get('cc-name'), //'Mike Dough'
                ],
            ]);
            $paymentAPI = $this->client->call($method);
        } catch (Declined $exception) {
            $paymentAPI = $exception->getResult();
        }


        if($paymentAPI->getStatus() === 'approved'){

            $payment->status = 'Payment Approved';
            $payment->paid = 1;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = $paymentAPI->getId();
            $payment->updated_at=date('Y-m-d H:i:s');
            $payment->save();

            if($mode == "1" || $mode == "5")
            {
                $report_id = $request -> report_id;
                $entry = DocumentFile::where('report_id', $report_id)->first();
                if(isset($entry)){
                    $entry -> ispaid = 1;
                    $entry -> save();
                }
                if($mode == 1)
                    return Redirect::route('process.index');
                if($mode == 5)
                    return Redirect::route('user.report', $report_id);
            }

            else {
                # code...
                Session::flash('done','Successfully Purchased');
                return Redirect::route('user.dashboard');
            }

           
        }
        if($paymentAPI->getStatus() === 'pending'){
            $payment->status = 'Payment pending';
            $payment->paid = 2;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = $paymentAPI->getId();
            $payment->updated_at=date('Y-m-d H:i:s');
            $payment->save();
            Session::flash('errors','Payment failed please try later!');
            if($mode == "1")
            return Redirect::route('user.payment', ['id' => $request -> report_id]);
            else {
                # code...
                return Redirect::route('user.dashboard');
            }
        }
        if($paymentAPI->getStatus() === 'declined'){
            $payment->status = 'Payment declined';
            $payment->paid = 3;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = $paymentAPI->getId();
            $payment->decline_reason = $paymentAPI->getErrorsAsString();
            $payment->save();
            Session::flash('errors','Payment failed please try later!');
            if($mode == "1")
                return Redirect::route('user.payment', ['id' => $request -> report_id]);
            else {
                # code...
                return Redirect::route('user.dashboard');
            }
        }

    }

    public function makeUniversityPayment(Request $request)
    {
        $mode = "2";
        if(date('Y') > $request->get('cc-expiration-year') || (date('Y') == $request->get('cc-expiration-year') && date('m') > $request->get('cc-expiration-month'))){
            $payment = new CardinityPayment;
            $payment->mode = "2";
            $payment->trans_id = 0;
            $payment->method = "Cardinity Payment API";
            $payment->amount = $request->get('amount');
            $payment->paid=0;
            $payment->status="Payment Initiated";
            $payment->created_at=date('Y-m-d H:i:s');
            $payment->currency=$this->config['currency'];
            $payment->save();

            $payment->status = 'Payment declined';
            $payment->paid = 2;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = (string)$payment->id;
            if(date('Y') > $request->get('cc-expiration-year'))
                $payment->decline_reason = "Invalid year of expiry or the card is already expired";
            else
                $payment->decline_reason = "Invalid month of expiry or the card is already expired";
            $payment->save();
            Session::flash('errors','Invalid year of expiry, please check and try again');
            return Redirect::route('pages.calc_universities');
        }

        $payment = new CardinityPayment;
        $user_email = $request -> institution_email;
        $payment->user_email = $user_email;
        
        $payment->trans_id = 0;
        $payment->mode = $mode;
        $payment->method = "Cardinity Payment API";
        $payment->amount = $request->get('amount');
        $payment->paid=0;
        $payment->status="Payment Initiated";
        $payment->created_at=date('Y-m-d H:i:s');
        $payment->save();

        try {
            $method = new Payment\Create([
                'amount' => (float) $request->get('amount'),
                'currency' => $this->config['currency'],
                'settle' => $this->config['settle'],
                'description' => $request->get('description') ?$request->get('description'):'Plagiarismchecker university account',
                'order_id' => "10" . ((string) $payment->id), // Set Order ID
                'country' => $this->config['country'],
                'payment_method' => Payment\Create::CARD,
                'payment_instrument' => [
                    'pan' => (string) $request->get('cc-number'), //'4111111111111111',
                    'exp_year' => (integer)$request->get('cc-expiration-year'), //2016,
                    'exp_month' => (integer)$request->get('cc-expiration-month'), //12,
                    'cvc' => (string)$request->get('cc-cvv'), //456,
                    'holder' => (string)$request->get('cc-name'), //'Mike Dough'
                ],
            ]);
            $paymentAPI = $this->client->call($method);
        } catch (Declined $exception) {
            $paymentAPI = $exception->getResult();
        }


        if($paymentAPI->getStatus() === 'approved'){

            $payment->status = 'Payment Approved';
            $payment->paid = 1;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = $paymentAPI->getId();
            $payment->updated_at=date('Y-m-d H:i:s');
            $payment->save();

            // Process
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

				$email_data = array();
				$email_data['data'] = $password;
				Mail::send('email.contact_userinfo', $email_data, function ($message) use($request)
				{
					$message->from('noreply@plagiarismchecker.com', 'Plagiarismchecker.eu');
					$message->to( $request -> institution_email);
					$message->subject('Plagiarimchecker');
				});

				Session::flash('success','Success! You will receive instructions and login data into your email very soon');
                return Redirect::route('pages.calc_universities');
			}
			else
			{
				$membership_entry = $entry->membership;
				$membership_entry -> document_count += $request->page_count;
				$membership_entry -> month_count += $request->terms;
				$membership_entry -> current_count += $request->page_count;
				$membership_entry -> save();
				Session::flash('success','successfully updated');
                return Redirect::route('pages.calc_universities');
			}

            //End

           
        }
        if($paymentAPI->getStatus() === 'pending'){
            $payment->status = 'Payment pending';
            $payment->paid = 1;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = $paymentAPI->getId();
            $payment->updated_at=date('Y-m-d H:i:s');
            $payment->save();
            Session::flash('errors','Payment failed please try later!');
            return Redirect::route('pages.calc_universities');
        }
        if($paymentAPI->getStatus() === 'declined'){
            $payment->status = 'Payment declined';
            $payment->paid = 2;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = $paymentAPI->getId();
            $payment->decline_reason = $paymentAPI->getErrorsAsString();
            $payment->save();
            Session::flash('errors','Payment failed please try later!');
            return Redirect::route('pages.calc_universities');
        }

    }

    public function makeUserPayment(Request $request)
    {
        $mode = "3";
        if(date('Y') > $request->get('cc-expiration-year') || (date('Y') == $request->get('cc-expiration-year') && date('m') > $request->get('cc-expiration-month'))){
            $payment = new CardinityPayment;
            $payment->mode = $mode;
            $payment->trans_id = 0;
            $payment->method = "Cardinity Payment API";
            $payment->amount = $request->get('amount');
            $payment->paid=0;
            $payment->status="Payment Initiated";
            $payment->created_at=date('Y-m-d H:i:s');
            $payment->currency=$this->config['currency'];
            $payment->save();

            $payment->status = 'Payment declined';
            $payment->paid = 2;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = (string)$payment->id;
            if(date('Y') > $request->get('cc-expiration-year'))
                $payment->decline_reason = "Invalid year of expiry or the card is already expired";
            else
                $payment->decline_reason = "Invalid month of expiry or the card is already expired";
            $payment->save();
            Session::flash('errors','Invalid year of expiry, please check and try again');
            return Redirect::route('pages.calc_universities');
        }

        $payment = new CardinityPayment;
        $user_email = Auth::user()->email;
        $payment->user_email = $user_email;
        
        $payment->trans_id = 0;
        $payment->mode = $mode;
        $payment->method = "Cardinity Payment API";
        $payment->amount = $request->get('amount');
        $payment->paid=0;
        $payment->status="Payment Initiated";
        $payment->created_at=date('Y-m-d H:i:s');
        $payment->save();

        try {
            $method = new Payment\Create([
                'amount' => (float) $request->get('amount'),
                'currency' => $this->config['currency'],
                'settle' => $this->config['settle'],
                'description' => $request->get('description') ?$request->get('description'):'Plagiarismchecker university account',
                'order_id' => "10" . ((string) $payment->id), // Set Order ID
                'country' => $this->config['country'],
                'payment_method' => Payment\Create::CARD,
                'payment_instrument' => [
                    'pan' => (string) $request->get('cc-number'), //'4111111111111111',
                    'exp_year' => (integer)$request->get('cc-expiration-year'), //2016,
                    'exp_month' => (integer)$request->get('cc-expiration-month'), //12,
                    'cvc' => (string)$request->get('cc-cvv'), //456,
                    'holder' => (string)$request->get('cc-name'), //'Mike Dough'
                ],
            ]);
            
            $paymentAPI = $this->client->call($method);
        } catch (Declined $exception) {
            $paymentAPI = $exception->getResult();
        }

        if($paymentAPI->getStatus() === 'approved'){

            $payment->status = 'Payment Approved';
            $payment->paid = 1;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = $paymentAPI->getId();
            $payment->updated_at=date('Y-m-d H:i:s');
            $payment->save();

            // Process
            $document_count = $request -> purchase_document_count;
            $terms_count = $request -> purchase_terms_count;
            $amount = $request -> amount;
            $membership_entry = Auth::user()->membership;
            $membership_entry -> document_count += $document_count;
            $membership_entry -> month_count += $terms_count;
            $membership_entry -> current_count += $document_count;
            $membership_entry -> save();

            //End
            Session::flash('done','successfully purchased');
            return Redirect::route('user.dashboard');

           
        }
        if($paymentAPI->getStatus() === 'pending'){
            $payment->status = 'Payment pending';
            $payment->paid = 1;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = $paymentAPI->getId();
            $payment->updated_at=date('Y-m-d H:i:s');
            $payment->save();
            Session::flash('errors','Payment failed please try later!');
            return Redirect::route('user.dashboard');
        }
        if($paymentAPI->getStatus() === 'declined'){
            $payment->status = 'Payment declined';
            $payment->paid = 2;
            $payment->currency = $this->config['currency'];
            $payment->trans_id = $paymentAPI->getId();
            $payment->decline_reason = $paymentAPI->getErrorsAsString();
            $payment->save();
            Session::flash('errors','Payment failed please try later!');
            return Redirect::route('user.dashboard');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

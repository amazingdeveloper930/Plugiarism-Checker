<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Counter;
use App\CounterModel;
use App\VisitedUser;
use DB;
use App\CounterDay;
use DateTime;

class ServicesController extends Controller
{
    public function index()
    {
    	return view('frontend.services.index');
    }

    public function industry()
    {
    	return view('frontend.services.industry');
    }
   
    public function click_counter()
    {
        return  view('frontend.services.click_counter');
    }
    public function get_code(Request $request)
    {
        $method = $request['id'];
        $randstr = Str::random(4) . $method . Str::random(4) . $method . Str::random(10);
        $key = $randstr . "_" . $method;
        
        $token = Hash::make($method);
        return response()->json(['index' => $key, 'token' => $token, 'link' => route('service.counter_data', ['id' =>$randstr])]);
    }

    public function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    public function counter_script($str)
    {
        $str_list = explode('_',$str);
        if(count($str_list) < 2)
        {
            return "error";
        }    
        else {
            # code...
            $index = $str_list[0];
            $model = $str_list[1];
            if(strlen($index) != 20)
            {
                return "error";
            }
            if((substr($index,4, 1) == $model) && (substr($index,9, 1) == $model))
            {
                $entry = Counter::where(['token' => $index, 'model' => intval($model)]) -> first();
                if(isset($entry))
                {
                    $entry -> visit_count += 1;
                }
                else {
                    # code...
                    $entry = new Counter();
                    $entry -> token = $index;
                    $entry -> model = $model;
                    $entry -> visit_count = 1;
                    
                }
                $entry -> save();
                $user_entry = VisitedUser::where(['counter_id' => $entry -> id, 'ip' => $this -> getUserIpAddr()]) -> first();
                if(isset($user_entry))
                {
                    $user_entry -> visit_count += 1;
                }
                else {
                    # code...
                    $user_entry = new VisitedUser();
                    $user_entry -> counter_id = $entry -> id;
                    $user_entry -> ip = $this -> getUserIpAddr();
                    $user_entry -> visit_count = 1;

                    //$res = file_get_contents('https://www.iplocate.io/api/lookup/' . $user_entry -> ip);
                    $res = file_get_contents('https://www.iplocate.io/api/lookup/17.253.0.0');
                    $res = json_decode($res);
                    $user_entry -> country = $res -> country;
                    $user_entry -> city = $res -> city;
                }
                $user_entry -> save();


                $count_str = "" . $entry -> visit_count;
                $img_str = "";
                
                if(strlen($count_str) < 4)
                {
                    for($i = 0; $i < 4 - strlen($count_str); $i ++)
                    {
                        $img_str .= "<img width=50px src='" . asset('number/' . $entry -> counterModel -> folder_path . "/0." . $entry -> counterModel -> format) . "'>";
                    }
                }
                for($i = 0; $i < strlen($count_str); $i ++)
                    {
                        $img_str .= "<img width=50px src='" . asset('number/' . $entry -> counterModel -> folder_path . "/" . substr($count_str,$i, 1) . "." . $entry -> counterModel -> format) . "'>";
                    }
                // return $img_str;

                $counter_day_entry = CounterDay::where(['counter' => $entry -> id]) -> first();
                if(isset($counter_day_entry))
                {
                    if($counter_day_entry -> date !=  Date('Y-m-d'))
                    {
                        $counter_day_entry -> date =  Date('Y-m-d');
                        $counter_day_entry -> visit_count = 0;
                    }
                }
                else {
                    # code...
                    $counter_day_entry = new CounterDay();
                    $counter_day_entry -> counter = $entry -> id;
                    $counter_day_entry -> visit_count = 0;
                    $counter_day_entry -> date =  Date('Y-m-d');
                    
                }
                $counter_day_entry -> visit_count += 1;
                $counter_day_entry -> save();

                return "document.getElementById('main_" . $str . "').innerHTML = \"" . $img_str . "\"";
            }
            else {
                # code...
                return "error";
            }
        }
    }

    
    public function counter_data($id)
    {
        $entry = Counter::where('token', $id) -> first();
        $users = VisitedUser::where('counter_id', $entry -> id) -> get();
        $country_data = VisitedUser::select('country', DB::raw('SUM(visit_count) as visit_per_country')) -> where('counter_id', $entry -> id) 
        ->groupBy('country') 
        ->orderBy('visit_per_country', 'desc')
        ->limit(5) ->get();
        $today_data = CounterDay::where(['counter' => $entry -> id, 'date' => Date('Y-m-d')]) -> first();
        return view('frontend.services.counter_data', ["data" => $entry, "users" => $users, "country_data" => $country_data, 'today_data' => $today_data]);
        //var_dump($country_data);
    }
	
}

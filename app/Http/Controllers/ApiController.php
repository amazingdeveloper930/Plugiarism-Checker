<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Payment;
use App\Reports;
use App\Counter;
use App\CounterModel;
use App\VisitedUser;


class ApiController extends Controller
{
    //
    public function payment_list(Request $request)
    {
        //     $validator = Validator::make($request->all(), [ 
        //         'name' => 'required', 
        //     ]);
        // if ($validator->fails()) { 
        //             return response()->json(['error'=>$validator->errors()], 401);          
        //     }
        $count = 10;
        if(isset($request -> list_count))
            $count = $request -> list_count;
        $payment_entry = Payment::select('trans_id', 'method', 'user_email as email', 'amount', 'currency', 'status', 'decline_reason', 'updated_at')
                        -> orderBy('updated_at', 'DESC')
                        -> limit(10)
                        -> get();
        return response()->json([
            'entry' => $payment_entry
        ]);
    }

    public function activity_list(Request $request)
    {
        $activity_entry = DB::select("select DATE(`created_at`) as dateData, count(*) as checkCount from `reports` where DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= created_at GROUP BY `dateData` ORDER BY `dateData`");
        return response()->json([
            'entry' => $activity_entry
        ]);

    }

    public function counter_list(Request $request)
    {
        $counter_entry = Counter::all();
        return response()->json([
            'entry' => $counter_entry
        ]);
    }


}

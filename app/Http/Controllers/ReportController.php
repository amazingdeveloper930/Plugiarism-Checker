<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Services\FileUtil;
use App\Reports;
use App\User;
use Exception;
use App\DocumentFile;
use Storage;
use PDF;
use Response;
use File;
use App\Computers;
use App\Test;
use Hash;
use App\Membership;

class ReportController extends Controller
{
    //
	public function test()
	{
		$password = "sdfa";
		return view('email.contact_userinfo', ['data' => $password]);
	}


    public function getRawFileData(Request $request)
    {
    	$user_token = session()->get('user_token');
    	$report_id = $request -> report_id;
    	$report = Reports::where('report_id', $report_id) 
    	-> first();
    	if( isset($report) > 0 )
    	{
    		$data = FileUtil::read_docx($user_token . $report -> file_name);
    		return response()->json(['status'=>'success', 'data' => $data]);
    	}
    	else
    		return response()->json(['status'=>'error', 'reason' => "There is no such report"]);
    }

    public function getSavedReportData(Request $request)
    {
    	$user_token = session()->get('user_token');
    	$report_id = $request -> report_id;
    	$report = Reports::where('report_id', $report_id) 
    	-> first();
    	if(isset($report))
    	{
    		// return response()->json(['status'=>'success', 'data' => $result_raw_text_array, 'score' => $iverciai['score'], 'references' => $references]);
    		if($report -> status == 0)
    			return response()->json(['status'=>'error', 'reason' => "That report is processing now"]);
			else{
				return response()->json(['status'=>'success', 'data' =>  unserialize($report -> data), 'score' => $report -> score, 'references' =>  unserialize($report -> match_url), 'pdf_url' => route('report.download', ['filename' => $report -> report_file_url])]);
			} 

    	}
    	else
    	{
    		return response()->json(['status'=>'error', 'reason' => "There is no so report"]); 
    	}
    }

    public function doAnalysis(Request $request)
    {
		set_time_limit(3600);
    	$user_token = session()->get('user_token');
    	$report_id = $request -> report_id;
    	$report = Reports::where('report_id', $report_id) 
    	-> first();
    	if( isset($report) )
    	{
			
    		if($report -> status == 0)
    		{
    			return response()->json(['status'=>'error', 'reason' => "There is progressing now"]);
    		}
    		

    		$report -> status = 0;
    		$report -> save();

    		$file_data = FileUtil::read_docx($user_token . $report -> file_name);
    		// here is process
    		$text = explode(' ',$file_data);
				// Define id

				$id = date('YmdHis');

				// Upload your text
				$postfields = array(
				    'controller' => 'plagapi',
				    'action' => 'upload',
				    'apikey' => env('PLAGIARISM_APIKEY'),
				    'id' => $id,
				    'text' => $text,
				);
				

				try {
				    $result = FileUtil::sendRequest(env('PLAGIARISM_APIURL'), $postfields);
				} catch (\Exception $e) {
				    // echo 'ERROR '.$e->getMessage()."\n";
				    // echo "<br/>";

				    die("upload error\n");
				}

				$token = $result;
				$result = false;

				// Now wait for results (do not query more frequent than every 5 seconds because you will crash the server)
				// IMPORTANT: add sleep for 5 seconds (better)

				for($i = 0; $i < 100000; $i++) :
				    $postfields = array(
				        'controller' => 'plagapi',
				        'action' => 'getresults',
				        'apikey' => env('PLAGIARISM_APIKEY'),
				        'id' => $id,
				        'full' => true,
				    );

				    try {
				        $result = FileUtil::sendRequest(env('PLAGIARISM_APIURL'), $postfields);
				    } catch (\Exception $e) {
				        // echo $token.' ERROR '.$e->getMessage()."\n";
				        // echo "<br/>";
				    }

				    if($result) :

				        $data = $result;

				        $mergedclusters = $data['clusters'];
				        $markedtiles = $data['text'];
				        $references = $data['references'];

				        $postfields = array(
				            'controller' => 'plagapi',
				            'action' => 'getscores',
				            'apikey' => env('PLAGIARISM_APIKEY'),
				            'id' => $id,
				        );

				        try {
				            $result = FileUtil::sendRequest(env('PLAGIARISM_APIURL'), $postfields);
				        } catch (\Exception $e) {
				            // echo 'ERROR '.$e->getMessage()."\n";
				            // echo "<br/>";
				        }

				        $iverciai = array(
				            'similarities' => $result['matches'],
				            'paraphrasing' => $result['paraphrasing'],
				            'score' => $result['score'],
				            'score_strict' => $result['strict'],
				            'score_citing' => $result['citing'],
				            'score_bad_citing' => $result['badciting'],
				            'longest_cluster' => $result['maxclusterlen'],
				            'concentration' => $result['concentration'],
				        );


				        $result_raw_text_array = array();
				        $temp_string = '';
				        $temp_cluster_id = -1;
				        $index = 0;
				        for(; $index < count($markedtiles) ; $index ++)
				        {
				        	$temp_word = $markedtiles[$index];
				        	$cluster_id = -1;
				        	// $temp_string = $temp_word['word'];
				        	if(array_key_exists("clusterid", $temp_word))
				        	{
				        		$cluster_id = (int)($temp_word['clusterid']);
				        	}
				        	if($index == 0)
				        	{
				        		$temp_cluster_id = $cluster_id;
				        	}

				        	if($cluster_id != $temp_cluster_id)
				        	{
				        		$temp_array = array();
				        		$temp_array['text'] = $temp_string;
				        		$temp_array['clusterid'] = $temp_cluster_id;
				        		$result_raw_text_array []= $temp_array;
				        		$temp_string = $temp_word['word'];
				        		$temp_cluster_id = $cluster_id;
				        	}
				        	else
				        	{
				        		if($temp_string == '')
				        			$temp_string = $temp_word['word'];
				        		else
				        			$temp_string .= " " . $temp_word['word'];
				        	}
				        }

				        if($index > 0)
				        {
				        	$temp_array = array();
			        		$temp_array['text'] = $temp_string;
			        		$temp_array['clusterid'] = $temp_cluster_id;
			        		$result_raw_text_array [] = $temp_array;
				        }

				        $report -> status = 1;
				        $report -> score = $iverciai['score'];
				        $report -> data = serialize($result_raw_text_array);
				        $report -> match_url = serialize($references);


				        //This is for pdf

						$pdf = PDF::loadView('backend.pdf.report', ['result_raw_text_array' => $result_raw_text_array, 'references' => $references, 'score' => $report -> score,  'file_name' => $report -> file_name]);
						$pdf_filename = $report_id . ".pdf";
						// $pdf->save(Storage::disk('local')->path("public/".$pdf_filename));
				        //End for pdf
				        $pdf->save(public_path() . '/uploads/'.$pdf_filename);

						$report -> report_file_url = $pdf_filename;


    					$report -> save();
    					$file_entry = DocumentFile::where('report_id', $report -> report_id)->first();
    					if(isset($file_entry))
    					{
    						// $file_entry -> status = 2;
    						// $file_entry -> save();
    						Storage::delete($file_entry->file_path);
    						$file_entry -> delete();

						}
						
    				/*	$email_data = route('user.report', ['id' => $report -> report_id]);
    					Mail::to($report -> email)->send(new SendMail($email_data));
						*/


				        return response()->json(['status'=>'success', 'data' => $result_raw_text_array, 'score' => $iverciai['score'], 'references' => $references, 'pdf_url' => route('report.download', ['filename' => $report -> report_file_url])]);

				        // echo "Progress: 100. Packet checking done.\n";
				        // echo "<br/>";


				        // echo "--------------------------------------------------------------------\n";
				        // echo "<br/>";
				        // echo "                           TILES\n";
				        // echo "<br/>";
				        // echo "--------------------------------------------------------------------\n";
				        // echo "<br/>";
				        // print_r($markedtiles);
				        // echo "<br/>";

				        // echo "--------------------------------------------------------------------\n";
				        // echo "<br/>";
				        // echo "                         REFERENCES\n";
				        // echo "<br/>";
				        // echo "--------------------------------------------------------------------\n";
				        // echo "<br/>";
				        // print_r($references);
				        // echo "<br/>";

				        // echo "--------------------------------------------------------------------\n";
				        // echo "<br/>";
				        // echo "                           SCORES\n";
				        // echo "<br/>";
				        // echo "--------------------------------------------------------------------\n";
				        // echo "<br/>";
				        // print_r($iverciai);
				        // echo "<br/>";
				        // echo "--------------------------------------------------------------------\n";
				        // echo "<br/>";
				        // print_r($data);

				        break;
				    endif;

				    sleep(5); // <- Important to add
				endfor;


    		// end process

			return '';
    		// return response()->json(['status'=>'success', 'data' => $data]);
    	}
    	else
    		return response()->json(['status'=>'error', 'reason' => "There is no such report"]);
    }

    public function delete(Request $request)
    {
    	$report_id = $request -> report_id;
    	$report = Reports::where('report_id', $report_id) 
    	-> first();

    	if(isset($report))
    	{
			// Storage::delete("public/". $report->report_id . ".pdf");
    		File::delete(public_path() . '/uploads/'.$report->report_file_url);
			$entry = DocumentFile::where('report_id', $report_id) -> first();
			if(isset($entry))
			{
				$entry -> delete();
			}
			$report -> delete();
			
    		return response()->json(['status'=>'success', 'data' => 'Your Report Successfully Deleted']);
    	}
    	else
    	{
    		return response()->json(['status'=>'error', 'data' => "There is no such report"]);
    	}
	}

    public function download($file_name)
    {
    	$file= public_path(). "/uploads/" . $file_name;

	    $headers = array(
	              'Content-Type: application/pdf',
	            );

	    return Response::download($file, 'report.pdf', $headers);
    }

    public function checkSampleData(Request $request)
    {
    	$user_token = session()->get('user_token', function () {
		    return Str::random(30);
		});
		session()->put('user_token', $user_token);

    	$ip = $request->getClientIp();
    	$entry = Computers::where('ip_address', $ip)->first();
    	if(isset($entry))
    	{
    		// echo date('Y-m-d', strtotime($entry->checked_at));
    		if(date('Y-m-d', strtotime(now())) == date('Y-m-d', strtotime($entry->checked_at)))
    		{

    			return redirect() -> route('home');
    		}
    		else
    		{
    			$entry -> checked_at = now();
    			$entry -> save();
    			return view('backend.user.pages.samplereport', ['raw_data' => $request -> sampletext]);
    		}

    	}
    	else
    	{
    		Computers::create(['ip_address' => $ip, 'checked_at' => now()]);
    		return view('backend.user.pages.samplereport', ['raw_data' => $request -> sampletext]);
    	}
    }

    public function doAnalysis_text(Request $request)
    {

    	$user_token = session()->get('user_token');

		$text_data = $request -> text_data;
		// here is process
		$text = explode(' ',$text_data);
			// Define id

			$id = date('YmdHis');


			// Upload your text
			$postfields = array(
			    'controller' => 'plagapi',
			    'action' => 'upload',
			    'apikey' => env('PLAGIARISM_APIKEY'),
			    'id' => $id,
			    'text' => $text,
			);

			try {
			    $result = FileUtil::sendRequest(env('PLAGIARISM_APIURL'), $postfields);
			} catch (\Exception $e) {
			    // echo 'ERROR '.$e->getMessage()."\n";
			    // echo "<br/>";

			    die("upload error\n");
			}
			$token = $result;
			$result = false;

			// Now wait for results (do not query more frequent than every 5 seconds because you will crash the server)
			// IMPORTANT: add sleep for 5 seconds (better)

			for($i = 0; $i < 100000; $i++) :
			    $postfields = array(
			        'controller' => 'plagapi',
			        'action' => 'getresults',
			        'apikey' => env('PLAGIARISM_APIKEY'),
			        'id' => $id,
			        'full' => true,
			    );

			    try {
			        $result = FileUtil::sendRequest(env('PLAGIARISM_APIURL'), $postfields);
			    } catch (\Exception $e) {
			        // echo $token.' ERROR '.$e->getMessage()."\n";
			        // echo "<br/>";
			    }

			    if($result) :

			        $data = $result;

			        $mergedclusters = $data['clusters'];
			        $markedtiles = $data['text'];
			        $references = $data['references'];

			        $postfields = array(
			            'controller' => 'plagapi',
			            'action' => 'getscores',
			            'apikey' => env('PLAGIARISM_APIKEY'),
			            'id' => $id,
			        );

			        try {
			            $result = FileUtil::sendRequest(env('PLAGIARISM_APIURL'), $postfields);
			        } catch (\Exception $e) {
			            // echo 'ERROR '.$e->getMessage()."\n";
			            // echo "<br/>";
			        }

			        $iverciai = array(
			            'similarities' => $result['matches'],
			            'paraphrasing' => $result['paraphrasing'],
			            'score' => $result['score'],
			            'score_strict' => $result['strict'],
			            'score_citing' => $result['citing'],
			            'score_bad_citing' => $result['badciting'],
			            'longest_cluster' => $result['maxclusterlen'],
			            'concentration' => $result['concentration'],
			        );


			        $result_raw_text_array = array();
			        $temp_string = '';
			        $temp_cluster_id = -1;
			        $index = 0;
			        for(; $index < count($markedtiles) ; $index ++)
			        {
			        	$temp_word = $markedtiles[$index];
			        	$cluster_id = -1;
			        	// $temp_string = $temp_word['word'];
			        	if(array_key_exists("clusterid", $temp_word))
			        	{
			        		$cluster_id = (int)($temp_word['clusterid']);
			        	}
			        	if($index == 0)
			        	{
			        		$temp_cluster_id = $cluster_id;
			        	}

			        	if($cluster_id != $temp_cluster_id)
			        	{
			        		$temp_array = array();
			        		$temp_array['text'] = $temp_string;
			        		$temp_array['clusterid'] = $temp_cluster_id;
			        		$result_raw_text_array []= $temp_array;
			        		$temp_string = $temp_word['word'];
			        		$temp_cluster_id = $cluster_id;
			        	}
			        	else
			        	{
			        		if($temp_string == '')
			        			$temp_string = $temp_word['word'];
			        		else
			        			$temp_string .= " " . $temp_word['word'];
			        	}
			        }
			        if($index > 0)
			        {
			        	$temp_array = array();
		        		$temp_array['text'] = $temp_string;
		        		$temp_array['clusterid'] = $temp_cluster_id;
		        		$result_raw_text_array [] = $temp_array;
			        }
			        return response()->json(['status'=>'success', 'data' => $result_raw_text_array, 'score' => $iverciai['score'], 'references' => $references]);
			        break;
			    endif;

			    sleep(5); // <- Important to add
			endfor;
		return '';
    }
    

}

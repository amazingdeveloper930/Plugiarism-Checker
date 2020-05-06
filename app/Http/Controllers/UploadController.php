<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Test;
use App\DocumentFile;
use Storage;
use App\Services\FileUtil;

class UploadController extends Controller
{
    //
    public function file_upload()
    {
    	Test::create([
            'data' 	        => "This is for test1"
        ]);
        return view('upload_form');
    }

    public function index()
    {
    	Test::create([
            'data' 	        => "This is for test1"
        ]);
    }
    
    public function upload(Request $request){
        Test::create([
            'data'          => "This is for test1"
        ]);
    	$files = $request->file('file');
        
        if(!empty($files)){
            $returndata = array();
        	foreach ($files as $file) {
        		# code...
                $user_token = session()->get('user_token', function () {
                    return Str::random(30);
                });
        		Storage::put($user_token . $file->getClientOriginalName(), file_get_contents($file));
                $file_format = $file->getClientOriginalExtension();
                $file_name = $file->getClientOriginalName();
                $file_path = $user_token . $file_name;
                $status = 0;
                $file_size = $file->getSize();
                // if($file_format)
                $file_data = '';
                if($file_format == 'docx')
                $file_data = FileUtil::read_docx($user_token . $file->getClientOriginalName());
                $text_size = str_word_count($file_data);
                //This should be changed;

                $price = 0.1 * $text_size;
                $available_time_sec = 300;
                $data = array(
                    'user_token' => $user_token,
                    'file_format' => $file_format,
                    'file_name' => $file_name,
                    'file_path' => $file_path,
                    'status' => $status,
                    'file_size' => $file_size,
                    'text_size' => $text_size,
                    'price' => $price,
                    'available_time_sec' => $available_time_sec
                );
                $returndata = DocumentFile::create($data);
                
        	}
            // $returndata = DocumentFile::where('user_token', $user_token) -> get();
            return response()->json(['success'=>'done', 'data' => $returndata]);
        }
        return response()->json(['error'=>'not file']);
        
    }

    public function destroy($id)
    {
        $user_token = session()->get('user_token');
        if(isset($user_token) && $user_token != null){
            $del = DocumentFile::where('id', $id)
                    -> where('user_token', $user_token)
                    -> first();
            if(isset($del)){
                Storage::delete($del->file_path);
                $del->delete();
                return response()->json(['success'=>'done', 'data' => 'file successfully deleted']);
            }
            else
                return response()->json(['error'=>'there is no such file']);
        }
        else
            return response()->json(['error'=>'User didn`t upload file']);
    }

    public function email_set($id, Request $request)
    {
        $user_token = session()->get('user_token');
        if(isset($user_token) && $user_token != null){
            $file = DocumentFile::where('id', $id)
                    -> where('user_token', $user_token)
                    -> first();

            if(isset($file)){
                $file->email = $request->email;
                $file->save();
                session()->put('current_file_id', $id);
                
                return response()->json(['success'=>'done', 'data' => 'email successfully updated']);
            }
            else
                return response()->json(['error'=>'there is no such file']);
        }
        else
            return response()->json(['error'=>'User didn`t upload file']);
    }
}


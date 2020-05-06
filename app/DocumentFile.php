<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentFile extends Model
{
    //
    protected $fillable = [
        'user_token', 'file_name', 'file_path', 'email', 'report_url', 'file_format', 'ispaid', 'status', 'file_size', 'text_size', 'price', 'available_time_sec'
    ];
}

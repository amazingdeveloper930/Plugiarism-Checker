<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
	protected $table = 'reports';
    //
    protected $fillable = [
        'report_id', 'file_name', 'file_type', 'owner', 'email', 'status', 'word_count', 'sentence_count', 'search_type', 'matching_sentence_count', 'score', 'reportfile_url', 'temp_file_url', 'match_url', 'data', 'made_at'];

    protected $casts = [
        'email_verified_at' => 'made_at',
    ];
}

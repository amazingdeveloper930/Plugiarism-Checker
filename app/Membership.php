<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    //
    protected $table = 'membership';
    protected $fillable = ['user_id', 'document_count', 'month_count', 'current_count', 'start_date', 'end_date', 'is_active'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computers extends Model
{
    //
    protected $table = 'computers';
    //
    protected $fillable = ['ip_address', 'checked_at'];

    public $timestamps = false;
}

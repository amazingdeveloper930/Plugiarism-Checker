<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    //
    protected $table = 'counter';
    public function counterModel()
    {
        return $this -> belongsTo('App\CounterModel', 'model');
    }

    public function visitedUsers()
    {
        return $this -> hasMany('App\VisitedUser', 'counter_id');
    }

}

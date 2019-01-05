<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function country(){
        return $this->belongsTo(Country::class);
    }
}

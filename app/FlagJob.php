<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlagJob extends Model
{
    protected $guarded = [];

    public function job(){
        return $this->belongsTo(Job::class);
    }
}

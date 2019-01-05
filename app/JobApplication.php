<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $guarded = [];

    public function getResumeUrlAttribute(){
        return asset('storage/uploads/resume/'.$this->resume);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }
}

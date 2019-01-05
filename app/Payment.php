<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function addJobBalance(){
        $user = User::find($this->user_id);
        $user->premium_jobs_balance = $user->premium_jobs_balance + $this->premium_job;
        $user->save();
    }

    public function scopeSuccess($query){
        return $query->where('status', '=', 'success');
    }

}

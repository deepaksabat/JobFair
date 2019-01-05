<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function active_jobs(){
        return $this->hasMany(Job::class)->whereStatus(1)->where('deadline', '>=', date('Y-m-d').' 00:00:00');
    }


    public function getCategoryNameAttribute($value){
        $last_cached = (int) get_option('category_count_cached');
        $refresh_time = $last_cached + (60*60);
        if ($refresh_time < time()){
            $this->job_count = $this->active_jobs->count();
            $this->save();

            update_option('category_count_cached', time());
        }


        return $value;
    }



    /*
        public function job_count(){
            return $this->hasMany(Job::class)->whereStatus(1)->count();
        }*/
}

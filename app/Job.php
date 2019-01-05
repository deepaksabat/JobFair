<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    protected $guarded = [];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'deadline',
    ];

    public function employer(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function application(){
        return $this->hasMany(JobApplication::class);
    }

    public function scopePending($query){
        return $query->where('status', '=', 0);
    }
    public function scopeApproved($query){
        return $query->where('status', '=', 1);
    }
    public function scopeActive($query){
        return $query->where('status', '=', 1)->where('deadline', '>=', date('Y-m-d').' 00:00:00');
    }
    public function scopeBlocked($query){
        return $query->where('status', '=', 2);
    }
    public function scopePremium($query){
        return $query->whereIsPremium(1);
    }

    public function nl2ulformat($string = null){
        if ( ! $string){
            return '';
        }
        $array = explode("\n", $string);
        $output = '';
        if(is_array($array) && count($array)) {
            $output .= '<ul>';
            foreach ($array as $item){
                $output .= '<li class="mb-2">'.$item.'</li>';
            }
            $output .= '</ul>';
        }
        return $output;
    }

    public function is_active(){
        return $this->status == 1;
    }

    public function is_pending(){
        return $this->status == 0;
    }

    public function can_edit(){
        $viewable = false;

        if (Auth::check()){
            $user = Auth::user();
            if ( $user->is_admin() || $user->id == $this->user_id){
                $viewable = true;
            }
        }

        return $viewable;
    }

    public function status_context(){
        $status = $this->status;
        $html = '';
        switch ($status){
            case 0:
                $html = '<span class="text-muted">'.trans('app.pending').'</span>';
                break;
            case 1:
                $html = '<span class="text-success">'.trans('app.published').'</span>';
                break;
            case 2:
                $html = '<span class="text-warning">'.trans('app.blocked').'</span>';
                break;
        }
        return $html;
    }

}

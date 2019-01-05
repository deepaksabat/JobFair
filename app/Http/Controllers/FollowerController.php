<?php

namespace App\Http\Controllers;

use App\User;
use App\UserFollowingEmployer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function followUnfollow(Request $request){
        $employer_id = $request->employer_id;

        if ( ! Auth::check()){
            session()->flash('error', __('app.login_required_to_follow_msg'));
            return ['success' => false, 'login_url' => route('login')];
        }

        $user = Auth::user();

        $isFollowed = UserFollowingEmployer::whereUserId($user->id)->whereEmployerId($employer_id)->first();
        $employer = User::find($employer_id);
        if ($isFollowed){
            //Already following, unfollow now
            $btn_text =  '<i class="la la-plus-circle"></i> '.__('app.follow').' '.$employer->company;
            $isFollowed->delete();
            return ['success' => true, 'btn_text' => $btn_text];
        }else{
            UserFollowingEmployer::create(['user_id' => $user->id, 'employer_id' => $employer_id]);

            $btn_text =  '<i class="la la-minus-circle"></i> '.__('app.unfollow').' '.$employer->company;
            return ['success' => true, 'btn_text' => $btn_text];
        }

    }
}

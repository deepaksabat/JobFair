<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getStatesOption(Request $request){
        $states = State::whereCountryId($request->country_id)->get();

        //Get the states from country
        $option = "<option value=''>Select a state</option>";
        if ($states->count()){
            foreach ($states as $state){
                $option .= "<option value='{$state->id}'>{$state->state_name}</option>";
            }
        }

        return ['success' => true, 'state_options' => $option];
    }
}

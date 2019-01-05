<?php

namespace App\Http\Controllers;

use App\Option;
use App\Pricing;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function GeneralSettings(){
        $title = trans('app.general_settings');
        return view('admin.settings-general', compact('title'));
    }

    public function GatewaySettings(){
        $title = trans('app.gateway_settings');
        return view('admin.settings-gateways', compact('title'));
    }

    public function PricingSettings(){
        $title = trans('app.pricing_settings');
        return view('admin.settings-pricing', compact('title'));
    }
    public function PricingSave(Request $request){
        foreach ($request->package as $id => $input){
            $package = Pricing::firstOrCreate(['id' => $id]);
            $package->update($input);
        }

        return back()->with('success', __('app.operation_success'));
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $inputs = array_except($request->input(), ['_token']);

        foreach($inputs as $key => $value) {
            $option = Option::firstOrCreate(['option_key' => $key]);
            $option -> option_value = $value;
            $option->save();
        }
        //check is request comes via ajax?
        if ($request->ajax()){
            return ['success'=>1, 'msg'=>trans('app.settings_saved_msg')];
        }
        return redirect()->back()->with('success', trans('app.settings_saved_msg'));
    }


}

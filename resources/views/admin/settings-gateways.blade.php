@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-10">

            <div class="settings-panel ajax-updating">

                <form method="post" action="" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group row {{ $errors->has('enable_paypal')? 'has-error':'' }}">
                        <label class="col-md-4 control-label">@lang('app.enable_disable') </label>
                        <div class="col-md-8">
                            <label for="enable_paypal" class="checkbox-inline">
                                <input type="checkbox" value="1" id="enable_paypal" name="enable_paypal" {{ get_option('enable_paypal') == 1 ? 'checked="checked"': '' }}>
                                @lang('app.enable_paypal')
                            </label>

                            {!! $errors->has('type')? '<p class="help-block">'.$errors->first('type').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('enable_stripe')? 'has-error':'' }}">
                        <label class="col-md-4 control-label">@lang('app.enable_disable') </label>
                        <div class="col-md-8">
                            <label for="enable_stripe" class="checkbox-inline">
                                <input type="checkbox" value="1" id="enable_stripe" name="enable_stripe" {{ get_option('enable_stripe') == 1 ? 'checked="checked"': '' }}>
                                @lang('app.enable_stripe')
                            </label>

                            {!! $errors->has('type')? '<p class="help-block">'.$errors->first('type').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('enable_bank_transfer')? 'has-error':'' }}">
                        <label class="col-md-4 control-label">@lang('app.enable_disable') </label>
                        <div class="col-md-8">
                            <label for="enable_bank_transfer" class="checkbox-inline">
                                <input type="checkbox" value="1" id="enable_bank_transfer" name="enable_bank_transfer" {{ get_option('enable_bank_transfer') == 1 ? 'checked="checked"': '' }}>
                                @lang('app.enable_bank_transfer')
                            </label>

                            {!! $errors->has('type')? '<p class="help-block">'.$errors->first('type').'</p>':'' !!}
                        </div>
                    </div>

                    <div id="paypal_settings_wrap" style="display: {{ get_option('enable_paypal') == 1 ? 'block' : 'none' }}">
                        <hr />

                        <legend>@lang('app.paypal_settings')</legend>
                        <div class="form-group row {{ $errors->has('enable_paypal_sandbox')? 'has-error':'' }}">
                            <label class="col-md-4 control-label">@lang('app.enable_paypal_sandbox') </label>
                            <div class="col-md-8">
                                <label for="enable_paypal_sandbox" class="checkbox-inline">
                                    <input type="checkbox" value="1" id="enable_paypal_sandbox" name="enable_paypal_sandbox" {{ get_option('enable_paypal_sandbox') == 1 ? 'checked="checked"': '' }}>
                                    @lang('app.enable_paypal_sandbox')
                                </label>

                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('paypal_receiver_email')? 'has-error':'' }}">
                            <label for="paypal_receiver_email" class="col-sm-4 control-label">@lang('app.paypal_receiver_email')</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="paypal_receiver_email" value="{{ old('paypal_receiver_email')? old('paypal_receiver_email') : get_option('paypal_receiver_email') }}" name="paypal_receiver_email" placeholder="@lang('app.test_secret_key')">
                                {!! $errors->has('paypal_receiver_email')? '<p class="help-block">'.$errors->first('paypal_receiver_email').'</p>':'' !!}
                                <p class="text-info">@lang('app.paypal_receiver_email_help_text')</p>
                            </div>
                        </div>

                    </div>

                    <div id="stripe_settings_wrap" style="display: {{ get_option('enable_stripe') == 1 ? 'block' : 'none' }}">
                        <hr />

                        <legend>@lang('app.stripe_settings')</legend>
                        <div class="form-group row {{ $errors->has('stripe_test_mode')? 'has-error':'' }}">
                            <label class="col-md-4 control-label">@lang('app.test_mode') </label>
                            <div class="col-md-8">
                                <label for="stripe_test_mode" class="checkbox-inline">
                                    <input type="checkbox" value="1" id="stripe_test_mode" name="stripe_test_mode" {{ get_option('stripe_test_mode') == 1 ? 'checked="checked"': '' }}>
                                    @lang('app.enable_test_mode')
                                </label>

                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('stripe_test_secret_key')? 'has-error':'' }}">
                            <label for="stripe_test_secret_key" class="col-sm-4 control-label">@lang('app.test_secret_key')</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="stripe_test_secret_key" value="{{ old('stripe_test_secret_key')? old('stripe_test_secret_key') : get_option('stripe_test_secret_key') }}" name="stripe_test_secret_key" placeholder="@lang('app.test_secret_key')">
                                {!! $errors->has('stripe_test_secret_key')? '<p class="help-block">'.$errors->first('stripe_test_secret_key').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('stripe_test_publishable_key')? 'has-error':'' }}">
                            <label for="stripe_test_publishable_key" class="col-sm-4 control-label">@lang('app.test_publishable_key')</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="stripe_test_publishable_key" value="{{ old('stripe_test_publishable_key')? old('stripe_test_publishable_key') : get_option('stripe_test_publishable_key') }}" name="stripe_test_publishable_key" placeholder="@lang('app.test_publishable_key')">
                                {!! $errors->has('stripe_test_publishable_key')? '<p class="help-block">'.$errors->first('stripe_test_publishable_key').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('stripe_live_secret_key')? 'has-error':'' }}">
                            <label for="stripe_live_secret_key" class="col-sm-4 control-label">@lang('app.live_secret_key')</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="stripe_live_secret_key" value="{{ old('stripe_live_secret_key')? old('stripe_live_secret_key') : get_option('stripe_live_secret_key') }}" name="stripe_live_secret_key" placeholder="@lang('app.live_secret_key')">
                                {!! $errors->has('stripe_live_secret_key')? '<p class="help-block">'.$errors->first('stripe_live_secret_key').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('stripe_live_publishable_key')? 'has-error':'' }}">
                            <label for="stripe_live_publishable_key" class="col-sm-4 control-label">@lang('app.live_publishable_key')</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="stripe_live_publishable_key" value="{{ old('stripe_live_publishable_key')? old('stripe_live_publishable_key') : get_option('stripe_live_publishable_key') }}" name="stripe_live_publishable_key" placeholder="@lang('app.live_publishable_key')">
                                {!! $errors->has('stripe_live_publishable_key')? '<p class="help-block">'.$errors->first('stripe_live_publishable_key').'</p>':'' !!}
                            </div>
                        </div>


                    </div>



                    <div class="bankPaymetWrap" style="display: {{ get_option('enable_bank_transfer') == 1 ? 'block' : 'none' }}">

                        <hr />

                        <legend>@lang('app.bank_transfer_settings')</legend>

                        <div class="form-group row {{ $errors->has('bank_swift_code')? 'has-error':'' }}">
                            <label for="bank_swift_code" class="col-sm-4 control-label">@lang('app.bank_swift_code') <span class="field-required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="bank_swift_code" value="{{ get_option('bank_swift_code') }}" name="bank_swift_code" placeholder="@lang('app.bank_swift_code')">
                                {!! $errors->has('bank_swift_code')? '<p class="help-block">'.$errors->first('bank_swift_code').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('account_number')? 'has-error':'' }}">
                            <label for="account_number" class="col-sm-4 control-label">@lang('app.account_number') <span class="field-required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="account_number" value="{{ get_option('account_number') }}" name="account_number" placeholder="@lang('app.account_number')">
                                {!! $errors->has('account_number')? '<p class="help-block">'.$errors->first('account_number').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('branch_name')? 'has-error':'' }}">
                            <label for="branch_name" class="col-sm-4 control-label">@lang('app.branch_name') <span class="field-required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="branch_name" value="{{ get_option('branch_name') }}" name="branch_name" placeholder="@lang('app.branch_name')">
                                {!! $errors->has('branch_name')? '<p class="help-block">'.$errors->first('branch_name').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('branch_address')? 'has-error':'' }}">
                            <label for="branch_address" class="col-sm-4 control-label">@lang('app.branch_address') <span class="field-required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="branch_address" value="{{ get_option('branch_address') }}" name="branch_address" placeholder="@lang('app.branch_address')">
                                {!! $errors->has('branch_address')? '<p class="help-block">'.$errors->first('branch_address').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('account_name')? 'has-error':'' }}">
                            <label for="account_name" class="col-sm-4 control-label">@lang('app.account_name') <span class="field-required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="account_name" value="{{ get_option('account_name') }}" name="account_name" placeholder="@lang('app.account_name')">
                                {!! $errors->has('account_name')? '<p class="help-block">'.$errors->first('account_name').'</p>':'' !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('iban')? 'has-error':'' }}">
                            <label for="iban" class="col-sm-4 control-label">@lang('app.iban') <span class="field-required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="iban" value="{{ get_option('iban') }}" name="iban" placeholder="@lang('app.iban')">
                                {!! $errors->has('iban')? '<p class="help-block">'.$errors->first('iban').'</p>':'' !!}
                            </div>
                        </div>

                    </div>


                    <div class="form-group row row">
                        <label class="col-sm-4"></label>
                        <div class="col-sm-8">
                            <button type="submit" id="settings_save_btn" class="btn btn-primary"> <i class="la la-save"></i> @lang('app.save_settings')</button>
                        </div>
                    </div>
                </form>


            </div>


        </div>
    </div>



@endsection
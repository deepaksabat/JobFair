@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-10">

            <div class="settings-panel ajax-updating">

                <form method="post" action="" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row {{ $errors->has('site_name')? 'has-error':'' }}">
                        <label for="site_name" class="col-sm-4 control-label">@lang('app.site_name')</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="site_name" value="{{ old('site_name')? old('site_name') : get_option('site_name') }}" name="site_name" placeholder="@lang('app.site_name')">
                            {!! $errors->has('site_name')? '<p class="help-block">'.$errors->first('site_name').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('site_title')? 'has-error':'' }}">
                        <label for="site_title" class="col-sm-4 control-label">@lang('app.site_title')</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="site_title" value="{{ old('site_title')? old('site_title') : get_option('site_title') }}" name="site_title" placeholder="@lang('app.site_title')">
                            {!! $errors->has('site_title')? '<p class="help-block">'.$errors->first('site_title').'</p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('email_address')? 'has-error':'' }}">
                        <label for="email_address" class="col-sm-4 control-label">@lang('app.email_address')</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="email_address" value="{{ old('email_address')? old('email_address') : get_option('email_address') }}" name="email_address" placeholder="@lang('app.email_address')">
                            {!! $errors->has('email_address')? '<p class="help-block">'.$errors->first('email_address').'</p>':'' !!}
                            <p class="text-info"> @lang('app.email_address_help_text')</p>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="default_timezone" class="col-sm-4 control-label">
                            @lang('app.default_timezone')
                        </label>
                        <div class="col-sm-8 {{ $errors->has('default_timezone')? 'has-error':'' }}">
                            <select class="form-control select2" name="default_timezone" id="default_timezone">
                                @php $saved_timezone = get_option('default_timezone'); @endphp
                                @foreach(timezone_identifiers_list() as $key=>$value)
                                    <option value="{{ $value }}" {{ $saved_timezone == $value? 'selected':'' }}>{{ $value }}</option>
                                @endforeach

                            </select>


                            {!! $errors->has('default_timezone')? '<p class="help-block">'.$errors->first('default_timezone').'</p>':'' !!}
                            <p class="text-info">@lang('app.default_timezone_help_text')</p>
                        </div>
                    </div>



                    <div class="form-group row {{ $errors->has('date_format')? 'has-error':'' }}">
                        <label for="email_address" class="col-sm-4 control-label">@lang('app.date_format')</label>
                        <div class="col-sm-8">
                            <fieldset>
                                @php $saved_date_format = get_option('date_format'); @endphp

                                <label><input type="radio" value="F j, Y" name="date_format" {{ $saved_date_format == 'F j, Y'? 'checked':'' }}> {{ date('F j, Y') }}<code>F j, Y</code></label> <br />
                                <label><input type="radio" value="Y-m-d" name="date_format" {{ $saved_date_format == 'Y-m-d'? 'checked':'' }}> {{ date('Y-m-d') }}<code>Y-m-d</code></label> <br />

                                <label><input type="radio" value="m/d/Y" name="date_format" {{ $saved_date_format == 'm/d/Y'? 'checked':'' }}> {{ date('m/d/Y') }}<code>m/d/Y</code></label> <br />

                                <label><input type="radio" value="d/m/Y" name="date_format" {{ $saved_date_format == 'd/m/Y'? 'checked':'' }}> {{ date('d/m/Y') }}<code>d/m/Y</code></label> <br />

                                <label><input type="radio" value="custom" name="date_format" {{ $saved_date_format == 'custom'? 'checked':'' }}> Custom:</label>
                                <input type="text" value="{{ get_option('date_format_custom') }}" id="date_format_custom" name="date_format_custom" />
                                <span>example: {{ date(get_option('date_format_custom')) }}</span>
                            </fieldset>
                            <p class="text-info"> @lang('app.date_format_help_text')</p>
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('time_format')? 'has-error':'' }}">
                        <label for="email_address" class="col-sm-4 control-label">@lang('app.time_format')</label>
                        <div class="col-sm-8">
                            <fieldset>
                                <label><input type="radio" value="g:i a" name="time_format" {{ get_option('time_format') == 'g:i a'? 'checked':'' }}> {{ date('g:i a') }}<code>g:i a</code></label> <br />
                                <label><input type="radio" value="g:i A" name="time_format" {{ get_option('time_format') == 'g:i A'? 'checked':'' }}> {{ date('g:i A') }}<code>g:i A</code></label> <br />

                                <label><input type="radio" value="H:i" name="time_format" {{ get_option('time_format') == 'H:i'? 'checked':'' }}> {{ date('H:i') }}<code>H:i</code></label> <br />

                                <label><input type="radio" value="custom" name="time_format" {{ get_option('time_format') == 'custom'? 'checked':'' }}> Custom:</label>
                                <input type="text" value="{{ get_option('time_format_custom') }}" id="time_format_custom" name="time_format_custom" />
                                <span>example: {{ date(get_option('time_format_custom')) }}</span>
                            </fieldset>
                            <p><a href="http://php.net/manual/en/function.date.php" target="_blank">@lang('app.date_time_read_more')</a> </p>
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('currency_sign')? 'has-error':'' }}">
                        <label for="currency_sign" class="col-sm-4 control-label">@lang('app.currency_sign')</label>
                        <div class="col-sm-8">

                            <?php $current_currency = get_option('currency_sign'); ?>
                            <select name="currency_sign" class="form-control select2">
                                @foreach(get_currencies() as $code => $name)
                                    <option value="{{ $code }}"  {{ $current_currency == $code? 'selected':'' }}> {{ $code }} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('currency_position')? 'has-error':'' }}">
                        <label for="currency_position" class="col-sm-4 control-label">@lang('app.currency_position')</label>
                        <div class="col-sm-8">
                            <?php $currency_position = get_option('currency_position'); ?>
                            <select name="currency_position" class="form-control select2">
                                <option value="left" @if($currency_position == 'left') selected="selected" @endif >@lang('app.left')</option>
                                <option value="right" @if($currency_position == 'right') selected="selected" @endif >@lang('app.right')</option>
                            </select>
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
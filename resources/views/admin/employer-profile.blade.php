@extends('layouts.dashboard')

@section('page-css')
    <link href="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10">

            <form method="post" action="" enctype="multipart/form-data">
                @csrf

                <div class="form-group row {{ $errors->has('company')? 'has-error':'' }}">
                    <label for="company" class="col-sm-4 control-label"> @lang('app.company')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{e_form_invalid_class('company', $errors)}}" id="company" value="{{ $user->company }}" name="company" placeholder="@lang('app.company')" disabled="disabled">

                        {!! e_form_error('company', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('company_size')? 'has-error':'' }}">
                    <label for="company_size" class="col-sm-4 control-label">@lang('app.company_size') (@lang('app.employees'))</label>
                    <div class="col-sm-8">
                        <select class="form-control {{e_form_invalid_class('company_size', $errors)}}" name="company_size" id="company_size">
                            @foreach(company_size() as $size => $size_name)
                                <option value="{{$size}}" {{selected($size, $user->company_size)}} >{{$size_name}}</option>
                            @endforeach
                        </select>

                        {!! e_form_error('company_size', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('country')? 'has-error':'' }}">
                    <label for="country" class="col-md-4 control-label">{{ __('app.country') }} </label>
                    <div class="col-md-8">
                        <select name="country" class="form-control {{e_form_invalid_class('country', $errors)}} country_to_state">
                            <option value="">@lang('app.select_a_country')</option>
                            @foreach($countries as $country)
                                <option value="{!! $country->id !!}" {{selected($country->id, $user->country_id)}}  >{!! $country->country_name !!}</option>
                            @endforeach
                        </select>

                        {!! e_form_error('country', $errors) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="state" class="col-md-4 control-label">{{ __('app.state') }} </label>
                    <div class="col-md-8">
                        <select name="state" class="form-control {{e_form_invalid_class('state', $errors)}} state_options">
                            <option value="">Select a state</option>

                            @if($old_country)
                                @foreach($old_country->states as $state)
                                    <option value="{{$state->id}}" {{selected($state->id, $user->state_id)}}>{!! $state->state_name !!}</option>
                                @endforeach
                            @endif

                        </select>
                        {!! e_form_error('state', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('city')? 'has-error':'' }}">
                    <label for="city" class="col-sm-4 control-label"> @lang('app.city')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{e_form_invalid_class('city', $errors)}}" id="city" value="{{$user->city}}" name="city" placeholder="@lang('app.city')">

                        {!! e_form_error('city', $errors) !!}
                    </div>
                </div>


                <div class="form-group row">
                    <label for="address" class="col-sm-4 col-form-label">{{ __('app.address') }} </label>
                    <div class="col-sm-8">
                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{$user->address}}" >

                        {!! e_form_error('address', $errors) !!}
                    </div>
                </div>


                <div class="form-group row">
                    <label for="address_2" class="col-sm-4 col-form-label">{{ __('app.address_2') }}</label>
                    <div class="col-sm-8">
                        <input id="address_2" type="text" class="form-control{{ $errors->has('address_2') ? ' is-invalid' : '' }}" name="address_2" value="{{$user->address_2}}">

                        {!! e_form_error('address_2', $errors) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label">{{ __('app.phone') }} </label>
                    <div class="col-md-8">
                        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{$user->phone}}" >

                        {!! e_form_error('phone', $errors) !!}
                    </div>
                </div>


                <div class="form-group row">
                    <label for="about_company" class="col-md-4 col-form-label">{{ __('app.about_company') }} </label>
                    <div class="col-md-8">
                        <textarea name="about_company" class="form-control" rows="5">{!! $user->about_company !!}</textarea>
                        {!! e_form_error('about_company', $errors) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="website" class="col-md-4 col-form-label">{{ __('app.website') }} </label>
                    <div class="col-md-8">
                        <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{$user->website}}" >
                        {!! e_form_error('website', $errors) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="logo" class="col-md-4 col-form-label">{{ __('app.logo') }} </label>
                    <div class="col-md-8">

                        <div class="company-logo mb-3" style="max-width: 100px;">
                            <img src="{{$user->logo_url}}" class="img-fluid" />
                        </div>


                        <input type="file" name="logo" class="form-control">

                        <p class="text-muted">Logo will be resize at (256X256), make sure your logo image is square</p>
                        {!! e_form_error('logo', $errors) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4"></label>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary"> <i class="la la-refresh"></i> @lang('app.update_employer_profile')</button>
                    </div>
                </div>
            </form>



        </div>
    </div>



@endsection




@section('page-js')
    <script src="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js')}}" defer></script>
@endsection
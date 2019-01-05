@extends('layouts.dashboard')


@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="" method="post">
                @csrf

                <div class="form-group row {{ $errors->has('old_password')? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label" for="old_password">@lang('app.old_password') *</label>
                    <div class="col-sm-9">
                        <input type="password" name="old_password" id="old_password" class="form-control" value="" autocomplete="off" placeholder="@lang('app.old_password') " />
                        {!! e_form_error('old_password', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('new_password')? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label" for="new_password">@lang('app.new_password') *</label>
                    <div class="col-sm-9">
                        <input type="password" name="new_password" id="new_password" class="form-control" value="" autocomplete="off" placeholder="@lang('app.new_password')" />
                        {!! e_form_error('new_password', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('new_password_confirmation')? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label" for="new_password_confirmation">@lang('app.old_password_confirmation') *</label>
                    <div class="col-sm-9">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" value="" autocomplete="off" placeholder="@lang('app.old_password_confirmation')" />
                        {!! e_form_error('new_password_confirmation', $errors) !!}
                    </div>
                </div>


                <div class="form-group row">
                    <div class="offset-md-3 col-md-9">
                        <button type="submit" class="btn btn-success">@lang('app.change_password')</button>
                    </div>
                </div>
            </form>


        </div>
    </div>



@endsection
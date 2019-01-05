@extends('layouts.dashboard')


@section('content')
    <div class="row">
        <div class="col-md-12">


            <form action="" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group row {{ $errors->has('name')? 'has-error':'' }}">
                    <label for="name" class="col-sm-4 control-label">@lang('app.name')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" value="{{ old('name')? old('name') : $user->name }}" name="name" placeholder="@lang('app.name')">
                        {!! e_form_error('name', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('email')? 'has-error':'' }}">
                    <label for="email" class="col-sm-4 control-label">@lang('app.email')</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" value="{{ old('email')? old('email') : $user->email }}" name="email" placeholder="@lang('app.email')">
                        {!! e_form_error('email', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('gender')? 'has-error':'' }}">
                    <label for="gender" class="col-sm-4 control-label">@lang('app.gender')</label>
                    <div class="col-sm-8">
                        <select id="gender" name="gender" class="form-control select2">
                            <option value="">Select Gender</option>
                            <option value="male" {{ $user->gender == 'male'?'selected':'' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female'?'selected':'' }}>Fe-Male</option>
                            <option value="third_gender" {{ $user->gender == 'third_gender'?'selected':'' }}>Third Gender</option>
                        </select>
                        {!! e_form_error('gender', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('phone')? 'has-error':'' }}">
                    <label for="phone" class="col-sm-4 control-label">@lang('app.phone')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="phone" value="{{ old('phone')? old('phone') : $user->phone }}" name="phone" placeholder="@lang('app.phone')">
                        {!! e_form_error('phone', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('country_id')? 'has-error':'' }}">
                    <label for="phone" class="col-sm-4 control-label">@lang('app.country')</label>
                    <div class="col-sm-8">
                        <select id="country_id" name="country_id" class="form-control select2">
                            <option value="">@lang('app.select_a_country')</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' :'' }}>{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                        {!! e_form_error('country_id', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('address')? 'has-error':'' }}">
                    <label for="address" class="col-sm-4 control-label">@lang('app.address')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" value="{{ old('address')? old('address') : $user->address }}" name="address" placeholder="@lang('app.address')">
                        {!! e_form_error('address', $errors) !!}
                    </div>
                </div>


                <hr />

                <div class="form-group row">
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-primary">@lang('app.edit')</button>
                    </div>
                </div>


            </form>



        </div>
    </div>



@endsection
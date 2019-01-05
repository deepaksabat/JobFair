@extends('layouts.theme')

@section('content')
    <div class="blog-single-page bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="blog-single-title mt-5">
                        <h1>@lang('app.contact_us')</h1>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="blog-single-content pt-3 pb-5">


                        @include('admin.flash_msg')
                        <form method="POST" action="">
                            @csrf

                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">@lang('app.name') <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control {{e_form_invalid_class('name', $errors)}}" name="name" value="{{ old('name') }}">
                                    {!! e_form_error('name', $errors) !!}
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">@lang('app.email_address')  <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control {{e_form_invalid_class('email', $errors)}}" name="email" value="{{ old('email') }}" >
                                    {!! e_form_error('email', $errors) !!}
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('subject') ? ' has-error' : '' }}">
                                <label for="subject" class="col-md-4 control-label">@lang('app.subject')  <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="subject" type="text" class="form-control {{e_form_invalid_class('subject', $errors)}}" name="subject" value="{{ old('subject') }}" >
                                    {!! e_form_error('subject', $errors) !!}
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('message') ? ' has-error' : '' }}">
                                <label for="message" class="col-md-4 control-label">@lang('app.message')</label>
                                <div class="col-md-6">
                                    <textarea name="message" class="form-control {{e_form_invalid_class('message', $errors)}}" rows="7">{{ old('message') }}</textarea>
                                    {!! e_form_error('message', $errors) !!}
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        <i class="la la-envelope-o"></i> @lang('app.send_feedback')
                                    </button>
                                </div>
                            </div>
                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
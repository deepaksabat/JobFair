@extends('layouts.theme')

@section('content')
    <div class="checkout-page  bg-{{!empty($type)? $type : 'warning'}} py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1><i class="la la-warning"></i> @lang('app.notice')</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="checkout-page bg-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">


                    <h1 class="mb-4">{{$title}}</h1>
                    <h4 class="mb-4">{{$msg}}</h4>


                    <a href="" class="btn btn-outline-secondary btn-lg"> <i class="la la-home"></i> @lang('app.go_to_home')</a>

                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.theme')

@section('content')
    <div class="blog-single-page bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="blog-single-title mt-5">
                        <h1>{{$page->title}}</h1>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="blog-single-content pt-3 pb-5">
                        {!! $page->post_content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.theme')

@section('content')
    <div class="blog-single-page bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="blog-single-title mt-5">
                        <h1>{{$post->title}}</h1>
                    </div>

                    <div class="blog-single-meta pt-3 mt-3">
                        <span><i class="la la-user"></i> {{$post->author->name}} </span>
                        <span><i class="la la-clock-o"></i> {{$post->created_at->diffForHumans()}} </span>
                        <span><i class="la la-eye"></i> {{$post->views}} </span>
                    </div>
                </div>
            </div>
        </div>

        @if($post->feature_image)
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-single-title mt-5">

                            <img src="{{$post->feature_image_uri}}" title="{{$post->title}}" alt="{{$post->title}}" class="img-fluid" />

                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="blog-single-content py-5">
                        {!! $post->post_content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
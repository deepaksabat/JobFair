@extends('layouts.theme')

@section('content')

    <div class="blog-listing-page ">

        <div class="blog-listing-header ">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                        <h1>{!! get_option('site_name') !!} @lang('app.blog')</h1>
                        <p>Get the latest updates from {!! get_option('site_name') !!}</p>

                        <div class="blog-search-wrap py-3">
                            <form method="get" class="form-inline justify-content-center">
                                <input type="text" name="q" value="{{request('q')}}" class="form-control mb-2" size="50" placeholder="Search blog">
                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <div class="blog-listing-content py-5">
                        @foreach($posts as $post)
                            <div class="blog-single-listing-wrap bg-white p-3 mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="blog-single-listing-img">
                                            <a href="{{route('blog_post_single', $post->slug)}}">
                                                <img src="{{$post->feature_image_thumb_uri}}" class="card-img" />
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="blog-single-listing-content">
                                            <a href="{{route('blog_post_single', $post->slug)}}">
                                                <h4>{{$post->title}}</h4>
                                            </a>

                                            <div class="blog-single-listing-footer text-muted mb-2">
                                                <span><i class="la la-user"></i> {{$post->author->name}} </span>
                                                <span><i class="la la-clock-o"></i> {{$post->created_at->diffForHumans()}} </span>
                                                <span><i class="la la-eye"></i> {{$post->views}} </span>
                                            </div>
                                            <p class="blog-card-text-preview mb-2">{!! limit_words($post->post_content, 20) !!}</p>
                                            <a href="{{route('blog_post_single', $post->slug)}}"> <i class="la la-book"></i> Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {!! $posts->appends(['q' => request('q')])->links() !!}

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
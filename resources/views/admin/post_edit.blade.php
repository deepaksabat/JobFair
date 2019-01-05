@extends('layouts.dashboard')

@section('title_action_btn_gorup')
    <a href="{{route('posts')}}" class="btn btn-primary"><i class="la la-th-list"></i> @lang('app.posts')</a>
    <a href="{{route('add_post')}}" class="btn btn-primary"><i class="la la-plus-circle"></i> @lang('app.add_post')</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('title')? 'has-error':'' }}">
                    <div class="col-sm-12">
                        <input type="text" class="form-control {{e_form_invalid_class('title', $errors)}}" id="title" value="{{$post->title}}" name="title" placeholder="@lang('app.title')">
                        {!! e_form_error('title', $errors) !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('post_content')? 'has-error':'' }}">
                    <div class="col-sm-12">
                        <textarea name="post_content" id="post_content" class="form-control {{e_form_invalid_class('post_content', $errors)}}" rows="8">{{$post->post_content}}</textarea>
                        {!! e_form_error('post_content', $errors) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <p>@lang('app.feature_image')</p>
                        @if($post->feature_image_thumb_uri)
                            <div class="post-feature-image-preview-wrap mb-3 mt-3">
                                <img src="{{$post->feature_image_thumb_uri}}" />
                            </div>
                        @endif
                        <input type="file" name="feature_image">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">@lang('app.update_page')</button>
                    </div>
                </div>

            </form>



        </div>
    </div>



@endsection


@section('page-js')
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}" defer></script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            CKEDITOR.replace( 'post_content' );
        });
    </script>
@endsection
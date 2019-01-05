@extends('layouts.dashboard')

@section('title_action_btn_gorup')
    <a href="{{route('add_post')}}" class="btn btn-primary"><i class="la la-plus-circle"></i> @lang('app.add_post')</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if($posts->count())

                <table class="table table-bordered">

                    <tr>
                        <th>@lang('app.title')</th>
                        <th>@lang('app.thumb')</th>
                        <th>#</th>
                    </tr>

                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td width="80">
                                <img src="{{$post->feature_image_thumb_uri}}" class="card-img" />
                            </td>
                            <td>
                                <a href="{{route('post_edit', $post->id)}}" class="btn btn-primary"><i class="la la-pencil-square"></i> @lang('app.edit')</a>
                            </td>
                        </tr>
                    @endforeach

                </table>

                {!! $posts->links() !!}
            @endif

        </div>
    </div>



@endsection
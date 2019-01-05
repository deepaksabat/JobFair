@extends('layouts.dashboard')

@section('title_action_btn_gorup')
    <a href="{{route('add_page')}}" class="btn btn-primary"><i class="la la-plus-circle"></i> @lang('app.add_page')</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if($pages->count())

                <table class="table table-bordered">

                    <tr>
                        <th>@lang('app.title')</th>
                        <th>#</th>
                    </tr>

                    @foreach($pages as $page)
                        <tr>
                            <td>{{$page->title}}</td>
                            <td>
                                <a href="{{route('page_edit', $page->id)}}" class="btn btn-primary"><i class="la la-pencil-square"></i> @lang('app.edit')</a>
                            </td>
                        </tr>
                    @endforeach

                </table>

                {!! $pages->links() !!}
            @endif

        </div>
    </div>



@endsection
@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-10">


            <form method="post" action="">
                @csrf

                <div class="form-group row {{ $errors->has('category_name')? 'has-error':'' }}">
                    <label for="category_name" class="col-sm-4 control-label">@lang('app.category_name')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{e_form_invalid_class('category_name', $errors)}}" id="category_name" value="{{ old('category_name') }}" name="category_name" placeholder="@lang('app.category_name')">

                        {!! e_form_error('category_name', $errors) !!}
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">@lang('app.save_new_category')</button>
                    </div>
                </div>

            </form>

        </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <th>@lang('app.category_name')</th>
                    <th>#</th>
                </tr>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            {{ $category->category_name }}
                        </td>
                        <td>
                            <a href="{{ route('edit_categories', $category->id) }}" class="btn btn-info"><i class="la la-pencil"></i> </a>
                            <a href="javascript:;" class="btn btn-danger category_delete" data-id="{{ $category->id }}"><i class="la la-trash"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>



@endsection
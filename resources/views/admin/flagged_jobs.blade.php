@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered">

                <tr>
                    <th>@lang('app.job_title')</th>
                    <th>@lang('app.message')</th>
                    <th>@lang('app.job_action')</th>
                </tr>

                @foreach($flagged as $flag)
                    <tr>
                        <td>
                            <a href="{{route('job_view', $flag->job->job_slug)}}" target="_blank">{{$flag->job->job_title}}</a>
                            <p class="text-muted">{{$flag->email}}</p>
                            <p class="text-muted">
                                {{$flag->created_at->format(get_option('date_format'))}} {{$flag->created_at->format(get_option('time_format'))}}
                            </p>
                        </td>
                        <td> {!! nl2br($flag->message) !!} </td>
                        <td>

                            <p>
                            <a href="{{route('job_view', $flag->job->job_slug)}}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip" title="@lang('app.view')"><i class="la la-eye"></i> </a>
                            <a href="{{route('edit_job', $flag->job->id)}}" class="btn btn-secondary btn-sm"><i class="la la-edit" data-toggle="tooltip" title="@lang('app.edit')"></i> </a>
                            </p>

                            @if($flag->job->status != 1)
                                <a href="{{route('job_status_change', [$flag->job->id, 'approve'])}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="@lang('app.approve')"><i class="la la-check-circle-o"></i> </a>
                            @endif

                            @if($flag->job->status != 2)
                                <a href="{{route('job_status_change', [$flag->job->id, 'block'])}}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="@lang('app.block')"><i class="la la-ban"></i> </a>
                            @endif

                            <a href="{{route('job_status_change', [$flag->job->id, 'delete'])}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="@lang('app.delete')"><i class="la la-trash-o"></i> </a>
                            
                            
                        </td>
                    </tr>
                @endforeach

            </table>


            {!! $flagged->links() !!}

        </div>
    </div>



@endsection
@extends('layouts.dashboard')


@section('content')
    <div class="row">
        <div class="col-md-12">

            @if($jobs->count())
                <table class="table table-bordered">

                    <tr>
                        <th>@lang('app.job_title')</th>
                        <th>@lang('app.status')</th>
                        <th>@lang('app.employer')</th>
                        <th>#</th>
                    </tr>

                    @foreach($jobs as $job)
                        <tr>
                            <td>{{$job->job_title}}
                                <p class="text-muted">@lang('app.deadline') {{$job->deadline->format(get_option('date_format'))}} </p>
                                <p class="text-muted"> <a href="{{route('job_applicants', $job->id)}}">@lang('app.applicant') ({{$job->application->count()}}) </a>  </p>

                            </td>
                            <td>
                                {!! $job->status_context() !!}
                                @if($job->is_premium)
                                    <p class="alert alert-success" data-toggle="tooltip" title="@lang('app.premium')"><i class="la la-bookmark-o"></i>@lang('app.premium')</p>
                                @endif
                            </td>
                            <td>{{$job->employer->company}}</td>
                            <td>
                                <a href="{{route('job_view', $job->job_slug)}}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip" title="@lang('app.view')"><i class="la la-eye"></i> </a>
                                <a href="{{route('edit_job', $job->id)}}" class="btn btn-secondary btn-sm"><i class="la la-edit" data-toggle="tooltip" title="@lang('app.edit')"></i> </a>

                                @if(!$job->is_premium)
                                    <a href="{{route('job_status_change', [$job->id, 'premium'])}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="@lang('app.mark_premium')"><i class="la la-bookmark-o"></i> </a>
                                @endif

                                @if(auth()->user()->is_admin())
                                    @if($job->status != 1)
                                        <a href="{{route('job_status_change', [$job->id, 'approve'])}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="@lang('app.approve')"><i class="la la-check-circle-o"></i> </a>
                                    @endif

                                    @if($job->status != 2)
                                        <a href="{{route('job_status_change', [$job->id, 'block'])}}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="@lang('app.block')"><i class="la la-ban"></i> </a>
                                    @endif

                                    <a href="{{route('job_status_change', [$job->id, 'delete'])}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="@lang('app.delete')"><i class="la la-trash-o"></i> </a>
                                @endif


                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $jobs->links() !!}
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="no data-wrap py-5 my-5 text-center">
                            <h1 class="display-1"><i class="la la-frown-o"></i> </h1>
                            <h1>No Data available here</h1>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>



@endsection
@extends('layouts.theme')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="employer-job-listing mt-4">


                    @if($employer->jobs->count())


                        @foreach($employer->jobs as $job)
                            <div class="employer-job-listing-single box-shadow bg-white mb-4 p-3">

                                <h5><a href="{{route('job_view', $job->job_slug)}}">{!! $job->job_title !!}</a> </h5>

                                <p class="text-muted">
                                    <i class="la la-briefcase"></i> @lang('app.'.$job->job_type)

                                    <i class="la la-map-marker"></i>
                                    @if($job->city_name)
                                        {!! $job->city_name !!},
                                    @endif
                                    @if($job->state_name)
                                        {!! $job->state_name !!},
                                    @endif
                                    @if($job->country_name)
                                        {!! $job->country_name !!}
                                    @endif

                                    <i class="la la-clock-o"></i> @lang('app.posted') {{$job->created_at->diffForHumans()}}

                                    <i class="la la-calendar-times-o"></i> @lang('app.deadline') : {{$job->deadline->format(get_option('date_format'))}} <span class="text-small text-muted">{{$job->deadline->diffForHumans()}}</span>
                                </p>




                            </div>

                        @endforeach


                    @endif


                </div>

            </div>
        </div>
    </div>

@endsection
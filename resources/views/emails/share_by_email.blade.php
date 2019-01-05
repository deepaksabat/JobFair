@component('mail::message')
# {{$data->your_name}} Shared a job post with you

<p>Dear {{$data->receiver_name}},</p>
<p>Your friend {{$data->your_name}} recommended the following job for you.</p>

<p>
Job URL <a href="{{route('job_view', $job->job_slug)}}">{{route('job_view', $job->job_slug)}}</a>
</p>


## <span style="color: #68AA47;font-size: 16px">{{$job->job_title}}</span>


@if($job->description)
### @lang('app.description')
<p>{!! nl2br($job->description) !!}</p>
@endif

@if($job->responsibilities)
### @lang('app.responsibilities')
{!! $job->nl2ulformat($job->responsibilities) !!}
@endif

@if($job->educational_requirements)
### @lang('app.educational_requirements')
{!! $job->nl2ulformat($job->educational_requirements) !!}
@endif

@if($job->experience_requirements)
### @lang('app.experience_requirements')
{!! $job->nl2ulformat($job->experience_requirements) !!}
@endif

@if($job->additional_requirements)
### @lang('app.additional_requirements')
{!! $job->nl2ulformat($job->additional_requirements) !!}
@endif

@if($job->benefits)
### @lang('app.benefits')
{!! $job->nl2ulformat($job->benefits) !!}
@endif



@component('mail::button', ['url' => route('job_view', $job->job_slug)])
View Job
@endcomponent

Thanks,<br>
{{ get_option('site_name') }}
@endcomponent

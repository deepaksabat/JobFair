@extends('layouts.theme')

@section('content')


    <div class="blog-listing-header ">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <h1>@lang('app.search_jobs')</h1>
                    <h5>Filter from the left sidebar to find your desired job</h5>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row">

            <div class="col-md-4">


                <div class="jobs-filter-form-wrap bg-white p-4 mt-4 mb-4">

                    <h4 class="mb-4">@lang('app.filter_jobs')</h4>

                    <form action="" method="get">

                        <div class="form-group">
                            <p class="text-muted mb-1">@lang('app.keywords')</p>
                            <input type="text" name="q" value="{{request('q')}}" class="form-control" style="min-width: 300px;" placeholder="@lang('app.job_title_placeholder')">
                        </div>

                        <div class="form-group">
                            <p class="text-muted mb-1">@lang('app.gender')</p>

                            <select class="form-control" name="gender" id="gender">
                                <option value="">@lang('app.select_gender')</option>
                                <option value="any" {{ request('gender') == 'any' ? 'selected':'' }}>@lang('app.any')</option>
                                <option value="male" {{ request('gender') == 'male' ? 'selected':'' }}>@lang('app.male')</option>
                                <option value="female" {{ request('gender') == 'female' ? 'selected':'' }}>@lang('app.female')</option>
                                <option value="transgender" {{ request('gender') == 'transgender' ? 'selected':'' }}>@lang('app.transgender')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <p class="text-muted mb-1">@lang('app.exp_level')</p>

                            <select class="form-control" name="exp_level" id="exp_level">
                                <option value="" >@lang('app.select_exp_level')</option>
                                <option value="mid" {{ request('exp_level') == 'mid' ? 'selected':'' }}>@lang('app.mid')</option>
                                <option value="entry" {{ request('exp_level') == 'entry' ? 'selected':'' }}>@lang('app.entry')</option>
                                <option value="senior" {{ request('exp_level') == 'senior' ? 'selected':'' }}>@lang('app.senior')</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <p class="text-muted mb-1">@lang('app.job_type')</p>

                            <select class="form-control" name="job_type" id="job_type">
                                <option value="">@lang('app.select_job_type')</option>
                                <option value="full_time" {{ request('job_type') == 'full_time' ? 'selected':'' }}>@lang('app.full_time')</option>
                                <option value="internship" {{ request('job_type') == 'internship' ? 'selected':'' }}>@lang('app.internship')</option>
                                <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected':'' }}>@lang('app.part_time')</option>
                                <option value="contract" {{ request('job_type') == 'contract' ? 'selected':'' }}>@lang('app.contract')</option>
                                <option value="temporary" {{ request('job_type') == 'temporary' ? 'selected':'' }}>@lang('app.temporary')</option>
                                <option value="commission" {{ request('job_type') == 'commission' ? 'selected':'' }}>@lang('app.commission')</option>
                                <option value="internship" {{ request('job_type') == 'internship' ? 'selected':'' }}>@lang('app.internship')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <p class="text-muted mb-1">@lang('app.category')</p>

                            <select class="form-control" name="category" id="category">
                                <option value="">@lang('app.select_category')</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{selected($category->id, request('category'))}} >{{$category->category_name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <p class="text-muted mb-1">@lang('app.country')</p>

                            <select name="country" class="form-control {{e_form_invalid_class('country', $errors)}} country_to_state">
                                <option value="">@lang('app.select_a_country')</option>
                                @foreach($countries as $country)
                                    <option value="{!! $country->id !!}" @if(request('country') && $country->id == request('country')) selected="selected" @endif  >{!! $country->country_name !!}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <p class="text-muted mb-1">@lang('app.state')</p>

                            <select name="state" class="form-control {{e_form_invalid_class('state', $errors)}} state_options">
                                <option value="">Select a state</option>

                                @if($old_country)
                                    @foreach($old_country->states as $state)
                                        <option value="{{$state->id}}" @if(request('state') && $state->id == request('state')) selected="selected" @endif >{!! $state->state_name !!}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <p class="text-muted mb-1">@lang('app.location')</p>
                            <input type="text" name="location" value="{{request('location')}}" class="form-control" style="min-width: 300px;"  placeholder="@lang('app.job_location_placeholder')">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="la la-search"></i> @lang('app.filter_jobs')</button>
                            <a href="{{route('jobs_listing')}}" class="btn btn-info text-white"><i class="la la-eraser"></i> @lang('app.clear_filter')</a>
                        </div>
                    </form>

                </div>

            </div>

            <div class="col-md-8">

                <div class="employer-job-listing mt-4">

                    @if($jobs->count())

                        <div class="job-search-stats bg-white mb-3 p-4">
                            {!! sprintf(__('app.job_search_stats'), '<strong>', $jobs->total(), '</strong>') !!}
                        </div>

                        @foreach($jobs as $job)
                            <div class="employer-job-listing-single {{$job->is_premium? ' premium-job ' : '' }} box-shadow bg-white mb-3 p-3">

                                @if($job->is_premium)
                                    <div class="job-listing-company-logo">
                                        <a href="{{route('job_view', $job->job_slug)}}">
                                            <img src="{{$job->employer->logo_url}}" class="img-fluid" />
                                        </a>
                                    </div>
                                @endif

                                <div class="listing-job-info">

                                    <h5><a href="{{route('job_view', $job->job_slug)}}">{!! $job->job_title !!}</a> </h5>
                                    <p class="text-muted mb-1 mt-1">

                                        <i class="la la-clock-o"></i> @lang('app.posted') {{$job->created_at->diffForHumans()}}

                                        <i class="la la-calendar-times-o"></i> @lang('app.deadline') : {{$job->deadline->format(get_option('date_format'))}} <span class="text-small text-muted">{{$job->deadline->diffForHumans()}}</span>
                                    </p>

                                    @if($job->is_premium)
                                        <p class="text-muted mb-1 mt-1">
                                            <i class="la la-money"></i> {!! get_amount($job->salary, $job->salary_currency) !!} @if($job->salary_upto) - {!! get_amount($job->salary_upto, $job->salary_currency) !!} @endif / @lang('app.'.$job->salary_cycle),
                                            <i class="la la-th-list"></i> @lang('app.exp_level') : @lang('app.'.$job->exp_level)
                                        </p>




                                    @endif


                                    <p class="text-muted">
                                        <i class="la la-building-o"></i> {{$job->employer->company}}
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
                                    </p>

                                </div>


                            </div>

                        @endforeach



                    @else


                        <div class="no-search-results-wrap text-center">

                            <p class="p-4">
                                <img src="{{asset('assets/images/no-search.png')}}" />
                            </p>

                            <h3>Whoops, no mathces</h3>
                            <h5 class="text-muted">We couldn't find any search results. </h5>
                            <h5 class="text-muted">Give it another try</h5>

                        </div>

                    @endif

                    {!! $jobs->links() !!}

                </div>

            </div>
        </div>
    </div>

@endsection
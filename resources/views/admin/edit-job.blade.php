@extends('layouts.dashboard')


@section('page-css')
    <link href="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10">

            <form method="post" action="">
                @csrf

                <div class="form-group row {{ $errors->has('job_title')? 'has-error':'' }}">
                    <label for="job_title" class="col-sm-4 control-label"> @lang('app.job_title')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{e_form_invalid_class('job_title', $errors)}}" id="job_title" value="{{ $job->job_title }}" name="job_title" placeholder="@lang('app.job_title')">

                        {!! e_form_error('job_title', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('position')? 'has-error':'' }}">
                    <label for="position" class="col-sm-4 control-label"> @lang('app.position')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{e_form_invalid_class('position', $errors)}}" id="position" value="{{$job->position}}" name="position" placeholder="@lang('app.position')">

                        {!! e_form_error('position', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('category')? 'has-error':'' }}">
                    <label for="category" class="col-sm-4 control-label">@lang('app.category')</label>
                    <div class="col-sm-8">
                        <select class="form-control {{e_form_invalid_class('category', $errors)}}" name="category" id="category">
                            <option value="">@lang('app.select_category')</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{selected($category->id, $job->category_id)}} >{{$category->category_name}}</option>
                            @endforeach
                        </select>

                        {!! e_form_error('category', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('salary_cycle')? 'has-error':'' }}">
                    <label for="salary_cycle" class="col-sm-4 control-label">@lang('app.salary_cycle')</label>
                    <div class="col-sm-8">

                        <div class="price_input_group">

                            <select class="form-control {{e_form_invalid_class('salary_cycle', $errors)}}" name="salary_cycle">
                                <option value="monthly"  {{selected('monthly', $job->salary_cycle)}}>@lang('app.monthly')</option>
                                <option value="yearly" {{selected('yearly', $job->salary_cycle)}}>@lang('app.yearly')</option>
                                <option value="weekly" {{selected('weekly', $job->salary_cycle)}}>@lang('app.weekly')</option>
                                <option value="daily" {{selected('daily', $job->salary_cycle)}}>@lang('app.daily')</option>
                                <option value="hourly" {{selected('hourly', $job->salary_cycle)}}>@lang('app.hourly')</option>

                            </select>

                            {!! e_form_error('salary_cycle', $errors) !!}
                        </div>
                    </div>
                </div>


                <div class="form-group row {{ $errors->has('salary')? 'has-error':'' }}">
                    <label for="salary" class="col-sm-4 control-label"> @lang('app.salary')</label>
                    <div class="col-sm-8">


                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="number" class="form-control {{e_form_invalid_class('salary', $errors)}}" id="salary" value="{{ $job->salary }}" name="salary" placeholder="@lang('app.salary')">
                            </div>
                            <div class="col-md-6">
                                <label> <input type="checkbox" name="is_negotiable" value="1" {{checked('1', $job->is_negotiable)}}> @lang('app.is_negotiable')</label>
                            </div>
                        </div>

                        {!! e_form_error('salary', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('salary_upto')? 'has-error':'' }}">
                    <label for="salary_upto" class="col-sm-4 control-label"> @lang('app.salary_upto')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{e_form_invalid_class('salary_upto', $errors)}}" id="salary_upto" value="{{$job->salary_upto}}" name="salary_upto" placeholder="@lang('app.salary_upto')">

                        <p class="text-info">@lang('app.salary_upto_desc')</p>
                        {!! e_form_error('salary_upto', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('salary_currency')? 'has-error':'' }}">
                    <label for="salary_currency" class="col-sm-4 control-label">@lang('app.salary_currency')</label>
                    <div class="col-sm-8">

                        <div class="price_input_group">

                            <select class="form-control {{e_form_invalid_class('salary_currency', $errors)}}" name="salary_currency">
                                @foreach(get_currencies() as $currency => $currency_name)
                                    <option value="{{$currency}}" {{selected($currency, $job->salary_currency)}}>{{$currency}} | {{$currency_name}}</option>
                                @endforeach
                            </select>

                            {!! e_form_error('salary_currency', $errors) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('vacancy')? 'has-error':'' }}">
                    <label for="vacancy" class="col-sm-4 control-label"> @lang('app.vacancy')</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control {{e_form_invalid_class('vacancy', $errors)}}" id="vacancy" value="{{$job->vacancy}}" name="vacancy" placeholder="@lang('app.vacancy')">

                        {!! e_form_error('vacancy', $errors) !!}
                    </div>
                </div>


                <div class="form-group row {{ $errors->has('gender')? 'has-error':'' }}">
                    <label for="gender" class="col-sm-4 control-label">@lang('app.gender')</label>
                    <div class="col-sm-8">
                        <select class="form-control {{e_form_invalid_class('gender', $errors)}}" name="gender" id="gender">
                            <option value="any" {{selected('any', $job->gender)}}>@lang('app.any')</option>
                            <option value="male" {{selected('male', $job->gender)}}>@lang('app.male')</option>
                            <option value="female" {{selected('female', $job->gender)}}>@lang('app.female')</option>
                            <option value="transgender" {{selected('transgender', $job->gender)}}>@lang('app.transgender')</option>
                        </select>

                        {!! e_form_error('gender', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('exp_level')? 'has-error':'' }}">
                    <label for="exp_level" class="col-sm-4 control-label">@lang('app.exp_level')</label>
                    <div class="col-sm-8">
                        <select class="form-control {{e_form_invalid_class('exp_level', $errors)}}" name="exp_level" id="exp_level">
                            <option value="mid" {{selected('mid', $job->exp_level)}}>@lang('app.mid')</option>
                            <option value="entry" {{selected('entry', $job->exp_level)}}>@lang('app.entry')</option>
                            <option value="senior" {{selected('senior', $job->exp_level)}}>@lang('app.senior')</option>
                        </select>

                        {!! e_form_error('exp_level', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('job_type')? 'has-error':'' }}">
                    <label for="job_type" class="col-sm-4 control-label">@lang('app.job_type')</label>
                    <div class="col-sm-8">
                        <select class="form-control {{e_form_invalid_class('job_type', $errors)}}" name="job_type" id="job_type">
                            <option value="full_time" {{selected('full_time', $job->job_type)}}>@lang('app.full_time')</option>
                            <option value="internship" {{selected('internship', $job->job_type)}}>@lang('app.internship')</option>
                            <option value="part_time" {{selected('part_time', $job->job_type)}}>@lang('app.part_time')</option>
                            <option value="contract" {{selected('contract', $job->job_type)}}>@lang('app.contract')</option>
                            <option value="temporary" {{selected('temporary', $job->job_type)}}>@lang('app.temporary')</option>
                            <option value="commission" {{selected('commission', $job->job_type)}}>@lang('app.commission')</option>
                            <option value="internship" {{selected('internship', $job->job_type)}}>@lang('app.internship')</option>
                        </select>

                        {!! e_form_error('job_type', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('experience_required_years')? 'has-error':'' }}">
                    <label for="experience_required_years" class="col-sm-4 control-label"> @lang('app.experience_required_years')</label>
                    <div class="col-sm-8">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="number" class="form-control {{e_form_invalid_class('experience_required_years', $errors)}}" id="experience_required_years" value="{{$job->experience_required_years}}" name="experience_required_years" placeholder="@lang('app.experience_required_years')">
                            </div>
                            <div class="col-md-6">
                                <label> <input type="checkbox" name="experience_plus" value="1" {{checked('1', $job->experience_plus)}}> @lang('app.plus')</label>
                            </div>
                        </div>

                        {!! e_form_error('experience_required_years', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('deadline')? 'has-error':'' }}">
                    <label for="deadline" class="col-sm-4 control-label"> @lang('app.deadline')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{e_form_invalid_class('deadline', $errors)}} date_picker" id="deadline" value="{{$job->deadline->format('Y-m-d')}}" name="deadline" placeholder="@lang('app.deadline')">

                        {!! e_form_error('deadline', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('description')? 'has-error':'' }}">
                    <label class="col-sm-4 control-label"> @lang('app.description')</label>
                    <div class="col-sm-8">
                        <textarea name="description" class="form-control {{e_form_invalid_class('description', $errors)}}" rows="5">{!! $job->description !!}</textarea>
                        {!! $errors->has('description')? '<p class="help-block">'.$errors->first('description').'</p>':'' !!}
                        <p class="text-info"> @lang('app.description_info_text')</p>
                    </div>
                </div>


                <div class="form-group row {{ $errors->has('skills')? 'has-error':'' }}">
                    <label class="col-sm-4 control-label"> @lang('app.skills')</label>
                    <div class="col-sm-8">
                        <textarea name="skills" class="form-control {{e_form_invalid_class('skills', $errors)}}" rows="2">{!! $job->skills !!}</textarea>
                        {!! $errors->has('skills')? '<p class="help-block">'.$errors->first('skills').'</p>':'' !!}
                        <p class="text-info"> @lang('app.skills_info_text')</p>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('responsibilities')? 'has-error':'' }}">
                    <label class="col-sm-4 control-label"> @lang('app.responsibilities')</label>
                    <div class="col-sm-8">
                        <textarea name="responsibilities" class="form-control {{e_form_invalid_class('responsibilities', $errors)}}" rows="3">{!! $job->responsibilities !!}</textarea>
                        {!! $errors->has('responsibilities')? '<p class="help-block">'.$errors->first('responsibilities').'</p>':'' !!}
                        <p class="text-info"> @lang('app.responsibilities_info_text')</p>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('educational_requirements')? 'has-error':'' }}">
                    <label class="col-sm-4 control-label"> @lang('app.educational_requirements')</label>
                    <div class="col-sm-8">
                        <textarea name="educational_requirements" class="form-control {{e_form_invalid_class('educational_requirements', $errors)}}" rows="3">{!! $job->educational_requirements !!}</textarea>
                        {!! $errors->has('educational_requirements')? '<p class="help-block">'.$errors->first('educational_requirements').'</p>':'' !!}
                        <p class="text-info"> @lang('app.educational_requirements_info_text')</p>
                    </div>
                </div>


                <div class="form-group row {{ $errors->has('experience_requirements')? 'has-error':'' }}">
                    <label class="col-sm-4 control-label"> @lang('app.experience_requirements')</label>
                    <div class="col-sm-8">
                        <textarea name="experience_requirements" class="form-control {{e_form_invalid_class('experience_requirements', $errors)}}" rows="3">{!! $job->experience_requirements !!}</textarea>
                        {!! $errors->has('experience_requirements')? '<p class="help-block">'.$errors->first('experience_requirements').'</p>':'' !!}
                        <p class="text-info"> @lang('app.experience_requirements_info_text')</p>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('additional_requirements')? 'has-error':'' }}">
                    <label class="col-sm-4 control-label"> @lang('app.additional_requirements')</label>
                    <div class="col-sm-8">
                        <textarea name="additional_requirements" class="form-control {{e_form_invalid_class('additional_requirements', $errors)}}" rows="3">{!! $job->additional_requirements !!}</textarea>
                        {!! $errors->has('additional_requirements')? '<p class="help-block">'.$errors->first('additional_requirements').'</p>':'' !!}
                        <p class="text-info"> @lang('app.additional_requirements_info_text')</p>
                    </div>
                </div>


                <div class="form-group row {{ $errors->has('benefits')? 'has-error':'' }}">
                    <label class="col-sm-4 control-label"> @lang('app.benefits')</label>
                    <div class="col-sm-8">
                        <textarea name="benefits" class="form-control {{e_form_invalid_class('benefits', $errors)}}" rows="3">{!! $job->benefits !!}</textarea>
                        {!! $errors->has('benefits')? '<p class="help-block">'.$errors->first('benefits').'</p>':'' !!}
                        <p class="text-info"> @lang('app.benefits_info_text')</p>
                    </div>
                </div>


                <div class="form-group row {{ $errors->has('apply_instruction')? 'has-error':'' }}">
                    <label class="col-sm-4 control-label"> @lang('app.apply_instruction')</label>
                    <div class="col-sm-8">
                        <textarea name="apply_instruction" class="form-control {{e_form_invalid_class('apply_instruction', $errors)}}" rows="3">{!! $job->apply_instruction !!}</textarea>
                        {!! $errors->has('apply_instruction')? '<p class="help-block">'.$errors->first('apply_instruction').'</p>':'' !!}
                        <p class="text-info"> @lang('app.apply_instruction_info_text')</p>
                    </div>
                </div>

                <legend>@lang('app.job_location')</legend>


                <div class="form-group row {{ $errors->has('is_any_where')? 'has-error':'' }}">
                    <label for="is_any_where" class="col-md-4 control-label">{{ __('app.is_any_where') }} </label>
                    <div class="col-md-8">
                        <label> <input type="checkbox" name="is_any_where" value="1" {{checked('1', $job->is_any_where)}} > @lang('app.location_anywhere') </label>
                        {!! e_form_error('is_any_where', $errors) !!}
                    </div>
                </div>


                <div class="form-group row {{ $errors->has('country')? 'has-error':'' }}">
                    <label for="country" class="col-md-4 control-label">{{ __('app.country') }} <span class="mendatory-mark">*</span></label>
                    <div class="col-md-8">
                        <select name="country" class="form-control {{e_form_invalid_class('country', $errors)}} country_to_state">
                            <option value="">@lang('app.select_a_country')</option>
                            @foreach($countries as $country)
                                <option value="{!! $country->id !!}" {{selected($country->id, $job->country_id)}}  >{!! $country->country_name !!}</option>
                            @endforeach
                        </select>

                        {!! e_form_error('country', $errors) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="state" class="col-md-4 control-label">{{ __('app.state') }} </label>
                    <div class="col-md-8">
                        <select name="state" class="form-control {{e_form_invalid_class('state', $errors)}} state_options">
                            <option value="">Select a state</option>

                            @if($old_country)
                                @foreach($old_country->states as $state)
                                    <option value="{{$state->id}}" {{selected($state->id, $job->state_id)}}>{!! $state->state_name !!}</option>
                                @endforeach
                            @endif

                        </select>
                        {!! e_form_error('state', $errors) !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('city_name')? 'has-error':'' }}">
                    <label for="city_name" class="col-sm-4 control-label"> @lang('app.city_name')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{e_form_invalid_class('city_name', $errors)}}" id="city_name" value="{{$job->city_name}}" name="city_name" placeholder="@lang('app.city_name')">

                        {!! e_form_error('city_name', $errors) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4"></label>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">@lang('app.post_new_job')</button>
                    </div>
                </div>
            </form>



        </div>
    </div>



@endsection




@section('page-js')
    <script src="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js')}}" defer></script>
@endsection
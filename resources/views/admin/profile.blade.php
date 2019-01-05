@extends('layouts.dashboard')


@section('content')
    <div class="row">
        <div class="col-md-12">

            @if($user->is_employer() || $user->is_agent())
                <div class="profile-company-logo mb-3">
                    <img src="{{$user->logo_url}}" class="img-fluid" style="max-width: 100px;" />
                </div>
            @endif

            <table class="table table-bordered table-striped mb-4">

                <tr>
                    <th>@lang('app.name')</th>
                    <td>{{ $user->name }}</td>
                </tr>

                <tr>
                    <th>@lang('app.email')</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>@lang('app.gender')</th>
                    <td>{{ ucfirst($user->gender) }}</td>
                </tr>
                <tr>
                    <th>@lang('app.phone')</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th>@lang('app.address')</th>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <th>@lang('app.country')</th>
                    <td>
                        @if($user->country)
                            {{ $user->country->name }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('app.created_at')</th>
                    <td>{{ $user->signed_up_datetime() }}</td>
                </tr>
                <tr>
                    <th>@lang('app.status')</th>
                    <td>{{ $user->status_context() }}</td>
                </tr>
            </table>




            @if($user->is_employer() || $user->is_agent())
                    <h3 class="mb-4">About Company</h3>

                    <table class="table table-bordered table-striped">
                    <tr>
                        <th>@lang('app.state')</th>
                        <td>{{ $user->state_name }}</td>
                    </tr>
                    <tr>
                        <th>@lang('app.city')</th>
                        <td>{{ $user->city }}</td>
                    </tr>

                    <tr>
                        <th>@lang('app.website')</th>
                        <td>{{ $user->website }}</td>
                    </tr>
                    <tr>
                        <th>@lang('app.company')</th>
                        <td>{{ $user->company }}</td>
                    </tr>
                    <tr>
                        <th>@lang('app.company_size')</th>
                        <td>{{company_size($user->company_size)}}</td>
                    </tr>
                    <tr>
                        <th>@lang('app.about_company')</th>
                        <td>{{ $user->about_company }}</td>
                    </tr>
                    <tr>
                        <th>@lang('app.premium_jobs_balance')</th>
                        <td>{{ $user->premium_jobs_balance }}</td>
                    </tr>
                </table>
            @endif


            @if( ! empty($is_user_id_view))
                <a href="{{route('users_edit', $user->id)}}"><i class="la la-pencil-square-o"></i> @lang('app.edit') </a>
            @else
                <a href="{{ route('profile_edit') }}"><i class="la la-pencil-square-o"></i> @lang('app.edit') </a>
            @endif


        </div>
    </div>



@endsection
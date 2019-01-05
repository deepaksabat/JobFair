<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! !empty($title) ? $title : 'JobFair' !!}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" {{ ! request()->is('payment*')? 'defer' : ''}}></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <script type='text/javascript'>
        /* <![CDATA[ */
        var page_data = {!! pageJsonData() !!};
        /* ]]> */
    </script>

</head>
<body class="{{request()->routeIs('home') ? ' home ' : ''}} {{request()->routeIs('job_view') ? ' job-view-page ' : ''}}">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel {{request()->routeIs('home') ? 'transparent-navbar' : ''}}">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('assets/images/logo.png')}}" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}"><i class="la la-home"></i> @lang('app.home')</a> </li>

                    <?php
                    $header_menu_pages = config('header_menu_pages');
                    ?>
                    @if($header_menu_pages->count() > 0)
                        @foreach($header_menu_pages as $page)
                            <li class="nav-item"><a class="nav-link" href="{{ route('single_page', $page->slug) }}"><i class="la la-link"></i>{{ $page->title }} </a></li>
                        @endforeach
                    @endif


                    <li class="nav-item"><a class="nav-link" href="{{route('pricing')}}"><i class="la la-dollar"></i> @lang('app.pricing')</a> </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('jobs_listing')}}"><i class="la la-briefcase"></i> @lang('app.jobs')</a> </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('blog_index')}}"><i class="la la-file-o"></i> @lang('app.blog')</a> </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}"><i class="la la-envelope-o"></i> @lang('app.contact_us')</a> </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link btn btn-success text-white" href="{{route('post_new_job')}}"><i class="la la-save"></i>{{__('app.post_new_job')}} </a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="la la-sign-in"></i> {{ __('app.login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('new_register'))
                                <a class="nav-link" href="{{ route('new_register') }}"><i class="la la-user-plus"></i> {{ __('app.register') }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="la la-user"></i> {{ Auth::user()->name }}
                                <span class="badge badge-warning"><i class="la la-briefcase"></i>{{auth()->user()->premium_jobs_balance}}</span>
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('dashboard')}}">{{__('app.dashboard')}} </a>


                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-container">
        @yield('content')
    </div>

    <div id="main-footer" class="main-footer bg-dark py-5">

        <div class="container">
            <div class="row">
                <div class="col-md-4">

                    <div class="footer-logo-wrap mb-3">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{asset('assets/images/logo-alt.png')}}" />
                        </a>
                    </div>

                    <div class="footer-menu-wrap">
                        <ul class="list-unstyled">
                            <?php
                            $show_in_footer_menu = config('footer_menu_pages');
                            ?>
                            @if($show_in_footer_menu->count() > 0)
                                @foreach($show_in_footer_menu as $page)
                                    <li><a href="{{ route('single_page', $page->slug) }}">{{ $page->title }} </a></li>
                                @endforeach
                            @endif
                            <li><a href="{{route('contact_us')}}">@lang('app.contact_us')</a> </li>
                        </ul>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="footer-menu-wrap mt-2">
                        <h4 class="mb-3">@lang('app.job_seeker')</h4>

                        <ul class="list-unstyled">
                            <li><a href="{{route('register_job_seeker')}}">@lang('app.create_account')</a> </li>
                            <li><a href="{{route('jobs_listing')}}">@lang('app.search_jobs')</a> </li>
                            <li><a href="{{route('applied_jobs')}}">@lang('app.applied_jobs')</a> </li>
                        </ul>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="footer-menu-wrap  mt-2">
                        <h4 class="mb-3">@lang('app.employer')</h4>

                        <ul class="list-unstyled">
                            <li><a href="{{route('register_employer')}}">@lang('app.create_account')</a> </li>
                            <li><a href="{{route('post_new_job')}}">@lang('app.post_new_job')</a> </li>
                            <li><a href="{{route('pricing')}}">@lang('app.buy_premium_package')</a> </li>
                        </ul>

                    </div>

                </div>


            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="footer-copyright-text-wrap text-center mt-4">
                        <p>{!! get_text_tpl(get_option('copyright_text')) !!}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>


</div>



<!-- Scripts -->
@yield('page-js')
<script src="{{ asset('assets/js/main.js') }}" defer></script>

</body>
</html>

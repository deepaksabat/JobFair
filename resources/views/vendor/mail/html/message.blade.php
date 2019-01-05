@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => route('home')])
            {{ get_option('site_name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ get_option('site_name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent

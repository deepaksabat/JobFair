@component('mail::message')

Hi {{$data->name}},

We've received your message and let us thanks to you for contacting with us. Please find your information you have send.

##Name

{{$data->name}}

##Subject

{{$data->subject}}

## Message

{{$data->message}}

Thanks,<br>
{{ get_option('site_name') }}
@endcomponent

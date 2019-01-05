@component('mail::message')

A contact query has been placed by {{$data->name}}

##Name

{{$data->name}}

##Subject

{{$data->subject}}

## Message

{{$data->message}}


Thanks,<br>
{{ get_option('site_name') }}
@endcomponent

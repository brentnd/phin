@component('mail::message')
# Dear {{$name}},

This is an email from {{ config('site.name') }}.

@component('mail::button', ['url' => config('url')])
Click Here
@endcomponent

Thanks,
{{ config('site.name') }}
@endcomponent

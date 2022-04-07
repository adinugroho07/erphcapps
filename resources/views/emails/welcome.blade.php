@component('mail::message')
# Introduction

This Is Welcoming Message.

@component('mail::button', ['url' => config('app.url')])
Back To Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

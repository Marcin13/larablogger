@component('mail::message')
# Hi {{ $user->name }}!

Thank you for registering on our blog!

You have now access to all premium content on
@component('mail::button', ['url' => url('/')])
LaraBlogger
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

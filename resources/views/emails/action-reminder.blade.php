@component('mail::message')
# Action Reminder - {{$action->action_title}}

{{$action->action_description}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

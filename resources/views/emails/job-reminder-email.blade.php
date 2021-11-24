@component('mail::message')
# Job Reminder - {{$job->job_title}}

{{$job->job_description}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Activity Ended: {{$activity->activity_name}} for Mob {{$mob->mob_id}}

<h3>Mob </h3>
<p>Mob {{$mob->mob_id}}</p>

<h3>Activity Name</h3>
<p>{{$activity->activity_name}}</p>

<h3>Activity Type</h3>
<p>{{$activity->activity_type}}</p>

<h3>Start Date</h3>
<p>{{$activity->start_date}}</p>

<h3>End Date</h3>
<p>{{$activity->end_date}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

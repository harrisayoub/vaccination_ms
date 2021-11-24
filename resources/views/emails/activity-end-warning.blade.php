@component('mail::message')
# Activity About To End: {{$activity->activity_name}} for Mob {{$mob->mob_id}}

<h3>Mob </h3>
<p>Mob {{$mob->mob_id}}</p>

<h3>Activity Name</h3>
<p>{{$activity->activity_name}}</p>

<h3>Activity Type</h3>
<p>{{$activity->activity_type}}</p>

<h3>End Date</h3>
<p>{{$activity->end_date}}</p>

@component('mail::button', ['url' => 'http://178.128.90.11/mobs/'.$mob->mob_id.'/activities/'.$activity->activity_id])
View Activity
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Action Reminder: Mark the Lambs for Mob {{$mob->mob_id}}

<h3>Mob </h3>
<p>Mob {{$mob->mob_id}}</p>


<h3>Action Description</h3>

<p>
  Mob taken to yards and lambs drafted off the mob.
</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent

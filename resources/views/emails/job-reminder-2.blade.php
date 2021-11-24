@component('mail::message')
# Action Reminder: Take Rams Out for Mob {{$mob->mob_id}}

<h3>Mob </h3>
<p>Mob {{$mob->mob_id}}</p>

<h3>Action Description</h3>
<p>
  Joined Mob is taken to Yards and the Rams Drafted out.
</p>



Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Action Reminder: Drafting for Mob {{$mob->mob_id}}

<h3>Mob </h3>
<p>Mob {{$mob->mob_id}}</p>

<h3>Action Description</h3>
<p>
  Make sure the Mob required for joining
  is fully formed. This may require bringing Sheep into the yards and Drafting them. Bring Ram team either to yard or paddock and
  join with the ewe mob. Leave the rams in the mob for the specific time required.
</p>



Thanks,<br>
{{ config('app.name') }}
@endcomponent

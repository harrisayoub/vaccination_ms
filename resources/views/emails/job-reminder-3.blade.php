@component('mail::message')
# Action Reminder: Pregnancy Scanning Preparation for Mob {{$mob->mob_id}}

<h3>Mob </h3>
<p>Mob {{$mob->mob_id}}</p>
<h3>Action Description</h3>

<p>
  Mob taken to yards for Pregnancy
  Scanning. Yards need to be set up Single, Twins(multiple) and Dry(not pregnant) ewes marked with colour spray paint. Dry Ewes to be sold
  or join another mob for joining again
</p>



Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Action Reminder: Pre-Lambing Innoculations for Mob {{$mob->mob_id}}

<h3>Mob </h3>
<p>Mob {{$mob->mob_id}}</p>


<h3>Action Description</h3>

<p>
  Mob taken to yards and give pre-lambing innoculations. The adminstering of 3in1, 5in1, 6in1 vaccines and a Long Acting internal parasite treatment recommended. Mob returned to paddock for lambing.
</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent

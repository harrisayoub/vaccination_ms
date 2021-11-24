@component('mail::message')
# Supply Reminder 2 for Mob {{$mob->mob_id}}


<p>Purchase sufficient quantities of innoculant and Long Acting drench.</p>

@component('mail::button', ['url' => url('http://178.128.90.11/mobs/'.$mob->mob_id)])
View Mob
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

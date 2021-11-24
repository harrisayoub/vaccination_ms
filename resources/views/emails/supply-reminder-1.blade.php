@component('mail::message')
# Supply Reminder 1 for Mob {{$mob->mob_id}}

<h1>Procurement Advice</h1>

<p>Check stock of spray paints for marking. At least three seperate colours required. Purchase as required.</p>

@component('mail::button', ['url' => url('http://178.128.90.11/mobs/'.$mob->mob_id)])
View Mob
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

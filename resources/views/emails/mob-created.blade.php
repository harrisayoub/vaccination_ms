@component('mail::message')
# New Mob Created: Mob {{$mob->mob_id}}

<h3>Mob Breed</h3>
<p>{{$mob->mob_breed}}</p>

<h3>Description</h3>
<p>{{$mob->description}}</p>

<h3>No of Animals</h3>
<p>{{$mob->no_animals}}</p>

<h3>Tag Color</h3>
<p>{{$mob->tag_color}}</p>

@component('mail::button', ['url' => url('http://178.128.90.11/mobs/')])
View Mobs
@endcomponent

Thanks and Goodluck!,<br>
{{ config('app.name') }}
@endcomponent

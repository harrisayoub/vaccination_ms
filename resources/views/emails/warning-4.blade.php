@component('mail::message')
  # Warning 4 - WARNING for Mob {{$mob->mob_id}}


  <p>This mob is no longer protected from worms. Check mob for parasite burden and treat if required. Consider a worm fecal egg count
  to establish if a siginficant worm burden exists.</p>

  @component('mail::button', ['url' => url('http://178.128.90.11/mobs/'.$mob->mob_id)])
  View Mob
  @endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

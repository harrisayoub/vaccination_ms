@component('mail::message')
  # Warning 3 - Reminder Advice for Mob {{$mob->mob_id}}


  <p>If lambs are given innoculations then witholding periods must be noted by the system as the animals cannot be salughtered for human
  consumption or exported during the witholding period. All husbandry treatments have varying restrictions and the correct recording of
  treatments, brand names, class of chemical, and witholding periods MUST be made</p>

  @component('mail::button', ['url' => url('http://178.128.90.11/mobs/'.$mob->mob_id)])
  View Mob
  @endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

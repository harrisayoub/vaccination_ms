@component('mail::message')
  # Warning 1 - Reminder Advice for Mob {{$mob->mob_id}}


  <p>Contact Pregnancy Scanning Contractor for appointment no earlier than {{$mob->created_at->addDays(77)}} and no later than day {{$mob->created_at->addDays(91)}}</p>

  @component('mail::button', ['url' => url('http://178.128.90.11/mobs/'.$mob->mob_id)])
  View Mob
  @endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
  # Supply Reminder 3 for Mob {{$mob->mob_id}}

<p>It is important to check the inventory on ear tags that there will sufficient for the upcoming marking.
    If not order more tags. It normally takes two weeks to get the tags from the branding company.
    Innoculants, elastrators and oral drench for the lambs first drench will be required. Purchase as neccessary. </p>

  @component('mail::button', ['url' => url('http://178.128.90.11/mobs/'.$mob->mob_id)])
  View Mob
  @endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

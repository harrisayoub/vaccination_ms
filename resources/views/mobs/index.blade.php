
@extends('layout.app')



@section('content')
  <a href="/mobs/create" class="btn btn-primary" role="button">Create Mob</a><br><br>

  <h1>Scheduler</h1>
  @if (count($mobs) > 0)
    @foreach ($mobs as $mob)
            <div class="well">
              <h2>Mob {{$mob->mob_id}} &nbsp;<a href="/mobs/{{$mob->mob_id}}/edit" class="btn btn-secondary btn-sm">Edit</a></h2>

              <div class="">
                <strong>No of Animals:</strong> {{$mob->no_animals}} &nbsp;&nbsp; <strong>Breed:</strong> {{$mob->mob_breed}} &nbsp;&nbsp;
                <strong>Tag Color:</strong>{{$mob->tag_color}}
              </div>


              @if ($mob->activities->count()>0)
                <div class="well">


                  <div class="panel-body">
                    <table class="table table-striped">
                      <tr>
                        <th>Activity</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                      </tr>

                      @foreach ($mob->activities as $activity)
                        @foreach ($activity->actions()->get() as $action)
                            @foreach ($action->stocks()->get() as $stock)
                              @if ($stock->stock_type == 'Chemical' && $stock->retreatment_interval != NULL && Carbon\Carbon::now() < Carbon\Carbon::parse($stock->pivot->created_at)->addDays($stock->retreatment_interval))
                                <div class="alert alert-danger" role="alert">
                                  Retreatement Interval (avoid retreating) until {{Carbon\Carbon::parse(date('jS F Y', strtotime($stock->pivot->created_at)))->addDays($stock->retreatment_interval)}}
                                </div>
                              @endif

                              @if ($stock->stock_type == 'Chemical' && $stock->meat_whp != NULL && Carbon\Carbon::now() < Carbon\Carbon::parse($stock->pivot->created_at)->addDays($stock->meat_whp))
                                <div class="alert alert-danger" role="alert">
                                  Do not sell or slaughter Animals for Domestic Market (MEAT Withholding Period until {{Carbon\Carbon::parse(date('jS F Y', strtotime($stock->pivot->created_at)))->addDays($stock->meat_whp)}}
                                </div>
                              @endif

                              @if ($stock->stock_type == 'Chemical' && $stock->milk_whp != NULL && Carbon\Carbon::now() < Carbon\Carbon::parse($stock->pivot->created_at)->addDays($stock->milk_whp))
                                <div class="alert alert-info" role="alert">
                                  Milk Withholding Period until {{Carbon\Carbon::parse(date('jS F Y', strtotime($stock->pivot->created_at)))->addDays($stock->milk_whp)}}
                                </div>
                              @endif

                              @if ($stock->stock_type == 'Chemical' && $stock->esi_whp != NULL && Carbon\Carbon::now() < Carbon\Carbon::parse($stock->pivot->created_at)->addDays($stock->esi_whp))
                                <div class="alert alert-warning" role="alert">
                                  DO NOT Sell or Slaughter Animals for the International Market ( Export Slaughter Interval Esi until {{Carbon\Carbon::parse(date('jS F Y', strtotime($stock->pivot->created_at)))->addDays($stock->esi_whp)}})
                                </div>
                              @endif
                            @endforeach
                          @endforeach

                        @if (Carbon\Carbon::now() < $activity->end_date)
                          <tr>
                            <td><a href="mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}" >{{$activity->activity_name}}</a></td>
                            <td>{{$activity->activity_type}}</td>
                            <td>{{date('jS F Y', strtotime($activity->start_date))}}</td>
                            <td>{{date('jS F Y', strtotime($activity->end_date))}}</td>
                            <td><a href="mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}" class="btn btn-secondary btn-sm">Pending</a></td>
                          </tr>
                        @else
                          <tr>
                          <td><a href="mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}" >{{$activity->activity_name}}</a></td>
                          <td>{{$activity->activity_type}}</td>
                          <td>{{date('jS F Y', strtotime($activity->start_date))}}</td>
                          <td>{{date('jS F Y', strtotime($activity->end_date))}}</td>
                          <td><a href="mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}" class="btn btn-success btn-sm">Completed</a></td>
                        </tr>
                        @endif
                      @endforeach
                    </table>
                  </div>



                </div>
              @else
                <h5>No activities found</h5>
              @endif


              <small>Created at {{date('jS F Y', strtotime($mob->created_at))}}</small>
            </div>
            <br>
    @endforeach
  @else
    <p>No mobs found</p>
  @endif


@endsection

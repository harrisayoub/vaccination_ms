@extends('layout.app')

@section('content')
  <h2>Mob {{$mob->mob_id}}</h2>


    <div class="" style="margin-bottom:30px; width:60%;">
      <strong>No of Animals:</strong> {{$mob->no_animals}} &nbsp;&nbsp; <strong>Breed:</strong> {{$mob->mob_breed}} &nbsp;&nbsp;
      <strong>Tag Color:</strong>{{$mob->tag_color}}<br>
      <strong>Description:</strong> {{$mob->description}}<br>
    </div>


    <h3>Activity {{$activity->activity_name}}</h3>

    <div class="" style="margin-bottom:30px; width:60%;">
      <strong>Name:</strong> {{$activity->activity_name}} &nbsp;&nbsp; <strong>Type:</strong> {{$activity->activity_type}}<br>
      <strong>Start Date:</strong>{{date('jS F Y', strtotime($activity->start_date))}}<br>
      <strong>Start End:</strong> {{date('jS F Y', strtotime($activity->end_date))}}<br>
    </div>



  <h4>Activity Actions</h4>

  <div class="" style="width:85%;">
    @if (count($activity->actions) > 0)
      <table class="table">
        <tr>
          <th>Action Title</th>
          <th>Description</th>
          <th>Recommended Action Date</th>
          <th></th>
        </tr>
      @foreach ($activity->actions as $action)
        <tr>
          <td style="width:15%;">{{$action->action_title}}</td>
          <td style="width:65%;">{{$action->action_description}}</td>
          <td style="width:20%;">{{date('jS F Y', strtotime($action->action_date)) }}</td>
          @if(Carbon\Carbon::now() >= $activity->start_date && Carbon\Carbon::now() < Carbon\Carbon::parse($activity->end_date))
          <td style="width:20%;"><a href="/mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}/actions/{{$action->action_id}}" class="btn btn-primary btn-sm" role="button">Perform Action</button></td>
          @else
          <td style="width:20%;"><a href="" class="btn btn-secondary btn-sm disabled" role="button" aria-disabled="true">Perform Action</button></td>
          @endif
        </tr>
      @endforeach
      </table>


      <div class="" style="width:100%;">

      <h4>Items/Treatments Used</h4>
        @if (count($action->stocks()->get()) > 0)
          <table class="table table-striped">
            <tr>
              <th>Name</th>
              <th>Quantity Used</th>
              <th>Type</th>
              <th>Date Added/Treated</th>
              <th>Batch no</th>
              <th>Lot no</th>
              <th>Expiry Date</th>
              <th>RSI</th>
              <th>Meat WHP</th>
              <th>Milk WHP</th>
              <th>ESI WHP</th>
              <th></th>
            </tr>


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


              <tr>
                <td>{{$stock->stock_name}}</td>
                <td>{{$stock->pivot->quantity_used}}</td>
                <td>{{$stock->stock_type}}</td>
                <td>{{date('jS F Y', strtotime($stock->pivot->created_at))}}</td>
                <td>{{$stock->batch_no}}</td>
                <td>{{$stock->lot_no}}</td>
                <td>{{date('jS F Y', strtotime($stock->expiry_date))}}</td>
                <td>{{$stock->retreatment_interval}}</td>
                <td>{{$stock->meat_whp}}</td>
                <td>{{$stock->milk_whp}}</td>
                <td>{{$stock->esi_whp}}</td>
                <td><a href="/mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}/actions/{{$action->action_id}}/{{$stock->stock_id}}/delete" class="btn btn-danger btn-sm">Delete</a></td>
              </tr>
            @endforeach

          </table>

        @else
          Nothing found
        @endif

      </div>


    @else
      <div class="alert alert-info">
        No actions found
    @endif

    </div>

    <div class="" style="margin-top:30px;">
      <a href="/mobs" class="btn btn-primary">Back</a>
    </div>




@endsection

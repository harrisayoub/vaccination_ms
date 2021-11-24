
@extends('layout.app')


@section('content')
  @if ($action->action_title == 'Take Rams Out')
    <div class="" style="width:40%;">
      <form class="" action="/mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}/actions/{{$action->action_id}}/updateAnimals" method="POST">
        {{method_field('PATCH')}}

        {{ csrf_field() }}

        <div class="form-group">
          <h4>No of rams taken out</h4>
          <input type="number" name="no_of_animals" value="" class="form-control" placeholder="No of rams">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Submit</button>
        </div>
      </form>
    </div>
  @elseif ($action->action_title == 'Pregnancy Scanning Preparation')

    <h4>Add Items used for Scanning Preparation</h4>

    <div class="" style="width:50%;">
      <form class="" action="/mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}/actions/{{$action->action_id}}/updateTreatments" method="POST">
        {{method_field('PATCH')}}

        {{ csrf_field() }}

        @if(count($stock)>0)
          <div class="form-group">
          <label>Item</label>
          <select class="" name="items">
            @foreach ($stock as $onestock)
              @if ($onestock->stock_type == 'Non-Chemical')
                <option value="{{$onestock->stock_id}}">{{$onestock->stock_name}}</option>
              @endif
            @endforeach
          </select>

          <label>Quantity</label>
          <input type="number" name="quantity" value="" style="width:10%;">

          <button type="submit" class="btn btn-dark">Add</button>
        </div>

        @endif
        </form>
      </div>


    <div class="" style="width:50%;">
      <form class="" action="/mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}/actions/{{$action->action_id}}/updateAnimals" method="POST">
        {{method_field('PATCH')}}

        {{ csrf_field() }}

        <div class="form-group">
          <h4>No of dry ewes</h4>
          <input type="number" name="no_of_animals" value="" class="form-control" placeholder="No of ewes">
        </div>

        <button type="submit" class="btn btn-dark">Submit</button>
      </form>
    </div>

  @elseif ($action->action_title == 'Pre-Lambing Innoculations')

    <div class="">
      <h4>Add Treatments for {{$action->action_title}}</h4>

      <form class="" action="/mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}/actions/{{$action->action_id}}/updateTreatments" method="POST">
        {{method_field('PATCH')}}

        {{ csrf_field() }}

        @if(count($stock)>0)
          <div class="form-group">
          <label>Item</label>
          <select class="" name="items">
            @foreach ($stock as $onestock)
              @if ($onestock->stock_type == 'Chemical')
                <option value="{{$onestock->stock_id}}">{{$onestock->stock_name}}</option>
              @endif
            @endforeach
          </select>

          <label>Quantity</label>
          <input type="number" name="quantity" value="" style="width:10%;">

          <button type="submit" class="btn btn-dark">Add</button>
        </div>

        @endif
        </form>
    </div>

  @elseif ($action->action_title == 'Mark the Lambs')
    <div class="">
      <h4>Add Items/Treatments for {{$action->action_title}}</h4>

      <form class="" action="/mobs/{{$mob->mob_id}}/activities/{{$activity->activity_id}}/actions/{{$action->action_id}}/updateTreatments" method="POST">
        {{method_field('PATCH')}}

        {{ csrf_field() }}

        @if(count($stock)>0)
          <div class="form-group">
          <label>Item</label>
          <select class="" name="items">
            @foreach ($stock as $onestock)
                <option value="{{$onestock->stock_id}}">{{$onestock->stock_name}}</option>
            @endforeach
          </select>

          <label>Quantity</label>
          <input type="number" name="quantity" value="" style="width:10%;">

          <button type="submit" class="btn btn-dark">Add</button>
        </div>

        @endif
        </form>
    </div>

  @endif

  <div class="" style="margin-top:30px;">
    <a href="../" class="btn btn-primary">Back</a>
  </div>

@endsection

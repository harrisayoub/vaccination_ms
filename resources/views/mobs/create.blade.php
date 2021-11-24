
@extends('layout.app')


@section('content')
  <h1>Create Mob</h1>
  <form class="" action="{{action('MobsController@store')}}" method="POST">

    {{ csrf_field() }}

    <div class="form-group">
      <label>Breed</label>
      <input type="text" name="breed" value="" class="form-control" placeholder="Breed">
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea name="description" value="" class="form-control" placeholder="Description" rows="5"></textarea>
    </div>

    <div class="form-group">
      <label>No of animals</label>
      <input type="number" name="no_animals" value="" class="form-control" placeholder="No of animals">
    </div>

    <div class="form-group">
      <label>Tag Color</label> <br>
      <input type="radio" name="tag_color" value="red" > Red <br>
      <input type="radio" name="tag_color" value="blue" > Blue <br>
      <input type="radio" name="tag_color" value="green" > Green <br>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
@endsection

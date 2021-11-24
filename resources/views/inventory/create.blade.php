@extends('layout.app')
@section('content')
  <h1> Insert Inventory Record </h1>

  <br>
  <form class="" action="{{action('StockController@store')}}" method="POST">

    {{ csrf_field() }}

    <div class="form-group">
      <label>Stock Name</label>
      <input type="text" name="stock_name" value="" class="form-control" placeholder="Ex: Green Spraypaint">
    </div>

    <div class="form-group">
      <label>Stock Quantity</label>
      <input type="number" name="stock_amount" value="" class="form-control" placeholder="Ex: 210">
    </div>

    <div class="form-group">
      <label>Type of stock</label> <br>
      <input type="radio" name="stock_type" value="Chemical" > Chemical <br>
      <input type="radio" name="stock_type" value="Non-Chemical" checked> Non-Chemical <br>
    </div>

    <div class="form-group">
      <label>Batch Number</label>
      <input type="text" name="batch_no" value="" class="form-control" placeholder="Ex: B5672">
    </div>

    <div class="form-group">
      <label>Lot Number</label>
      <input type="number" name="lot_no" value="" class="form-control" placeholder="Ex: 9">
    </div>

    <div class="form-group">
      <label>Expiry Date</label>
      <input type="date" name="expiry_date" value="" class="form-control" placeholder="Select appropriate date of expiry">
    </div>

    <div class="form-group">
      <label>Retreatement Interval</label>
      <input type="number" name="retreatment_interval" value="" class="form-control" placeholder="">
    </div>

    <div class="form-group">
      <label>Meat WHP</label>
      <input type="number" name="meat_whp" value="" class="form-control" placeholder="">
    </div>

    <div class="form-group">
      <label>Milk WHP</label>
      <input type="number" name="milk_whp" value="" class="form-control" placeholder="">
    </div>

    <div class="form-group">
      <label>ESI WHP</label>
      <input type="number" name="esi_whp" value="" class="form-control" placeholder="">
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
@endsection

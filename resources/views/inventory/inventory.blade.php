@extends('layout.app')
@section('content')
  <h1>Inventory Manager </h1>
      <button type="button" class="btn btn-default" onClick="document.location.href='inventory/create'">Add Inventory Item</button>
      <p> </p>



      @if(count($stocks) > 0)
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="table-editable">
          <thead>
            <tr>
              <th scope="col">Stock ID</th>
              <th scope="col">Stock Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Stock Type</th>
              <th scope="col">Batch no</th>
              <th scope="col">Lot no</th>
              <th scope="col">Expiry Date</th>
              <th scope="col">RSI</th>
              <th scope="col">Meat WHP</th>
              <th scope="col">Milk WHP</th>
              <th scope="col">ESI WHP</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody>

        @foreach ($stocks as $stock)
        @if($stock->stock_amount > 0)
        @if($stock->stock_amount < 4)
          <tr bgcolor="#FFFFE0">
          @else
            <tr>
          @endif
                <td>{{$stock->stock_id}}</td>
                <td>{{$stock->stock_name}}</td>
                <td>{{$stock->stock_amount}}</td>
                <td>{{$stock->stock_type}}</td>
                @if($stock->stock_type == 'Chemical')
                <td>{{$stock->batch_no}}</td>
                <td>{{$stock->lot_no}}</td>
                <td>{{date('jS F Y', strtotime($stock->expiry_date))}}</td>
                <td>{{$stock->retreatment_interval}}</td>
                <td>{{$stock->meat_whp}}</td>
                <td>{{$stock->milk_whp}}</td>
                <td>{{$stock->esi_whp}}</td>

              @else
                <td><i>-</i></td>
                <td><i>-</i></td>
                <td><i>-</i></td>
                <td><i>-</i></td>
                <td><i>-</i></td>
                <td><i>-</i></td>
                <td><i>-</i></td>
              @endif
                <td class="text-right">
                <a class="edit btn btn-sm btn-warning" href="inventory/{{$stock->stock_id}}/edit">
                  <i>Edit</i>
                </a>
                <a href="inventory/{{$stock->stock_id}}/delete" class="btn btn-danger btn-sm">Delete</a>
              </td>
          </tr>
        @endif
        @endforeach

      </tbody>
    </table>
  </div>
      @else
        <p> No Records Found </p>
      @endif
@endsection

@extends('layout.app')
@section('content')
  <h1> Finance Manager </h1>
      <button type="button" class="btn btn-default" onClick="document.location.href='finance/create'">Record Finances</button>
      <p> </p>
      @if(count($finances) > 0)
        <div class="well">
          <table class="table">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Purchase Date</th>
                <th>Recorded Date</th>
              </tr>
            </thead>
              <tbody>
                @foreach ($finances as $finances)
                <tr>
                  <td>{{$finances->item_name}}</td>
                  <td>{{$finances->quantity}}</td>
                  <td>${{$finances->price}}</td>
                  <td>{{$finances->purchase_date}}</td>
                  <td>{{$finances->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      @else
        <p> No Records Found </p>
      @endif
            <a href="{{route('export')}}" class="btn btn-default" type="button">Export to XLSX</a>
            <a href="{{route('exportcsv')}}" class="btn btn-default" type="button">Export to CSV</a>
            <a href="/finance/clear" class="btn btn-default" type="button">Clear All Records</a>

@endsection

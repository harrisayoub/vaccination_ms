@extends('layout.app')
@section('content')
  <h1> Insert Financial Record </h1>
  {!! Form::open(['action' => 'FinanceController@store', 'method' => 'POST']) !!}

    <div class="form-group">
      {{Form::label('item_name', 'Item Name')}}
      {{Form::text('item_name', '', ['class' => 'form-control', 'placeholder' => 'Ex: Fertilizer'])}}
    </div>

    <div class="form-group">
      {{Form::label('quantity', 'Quantity')}}
      {{Form::number('quantity', '', ['class' => 'form-control', 'placeholder' => 'Ex: 3'])}}
    </div>

    <div class="form-group">
      {{Form::label('price', 'Price')}}
      {{Form::number('price', '', ['class' => 'form-control', 'placeholder' => '$', 'step' => '0.01'])}}
    </div>

    <div class="form-group">
      {{Form::label('purchase_date', 'Purchase Date')}}
      {{Form::date('purchase_date', '', ['class' => 'form-control', 'placeholder' => 'XX/XX/XXX'])}}
    </div>

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}﻿
@endsection

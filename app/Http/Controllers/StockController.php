<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class StockController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $stocks = Stock::where('user_id', auth()->id())->get();
      return view('inventory.inventory')->with('stocks', $stocks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'stock_name' => 'required|min:1|max:56',
        'stock_amount' => 'required|numeric|min:1',
        'stock_type' => 'required',
        'batch_no' => 'nullable|max:10',
        'expiry_date' => 'nullable|date_format:Y-m-d',
        'lot_no' => 'nullable|numeric|min:1',
        'retreatment_interval' => 'nullable|numeric|min:1',
        'meat_whp' => 'nullable|numeric|min:1',
        'milk_whp' => 'nullable|numeric|min:1',
        'esi_whp' => 'nullable|numeric|min:1',
      ]);


      $stocks = new Stock;
      $stocks->stock_name = $request->input('stock_name');
      $stocks->stock_amount = $request->input('stock_amount');
      $stocks->stock_type = $request->input('stock_type');
      $stocks->batch_no = $request->input('batch_no');
      $stocks->lot_no = $request->input('lot_no');
      $stocks->expiry_date = $request->input('expiry_date');
      $stocks->retreatment_interval = $request->input('retreatment_interval');
      $stocks->meat_whp = $request->input('meat_whp');
      $stocks->milk_whp = $request->input('milk_whp');
      $stocks->esi_whp = $request->input('esi_whp');
      $stocks->user_id = auth()->user()->user_id;
      $stocks->save();
      return redirect('/inventory')->with('success', 'Record Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stocks)
    {
      return redirect('/inventory')->with('success', 'Success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
      $stock = Stock::find($stock->stock_id);
      return view('inventory.edit')->with('stock', $stock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {

      $this->validate($request, [
        'stock_name' => 'required|min:1|max:56',
        'stock_amount' => 'required|numeric|min:1',
        'stock_type' => 'required',
        'expiry_date' => 'nullable|date_format:Y-m-d',
        'lot_no' => 'nullable|numeric|min:1',
        'retreatment_interval' => 'nullable|numeric|min:1',
        'meat_whp' => 'nullable|numeric|min:1',
        'milk_whp' => 'nullable|numeric|min:1',
        'esi_whp' => 'nullable|numeric|min:1',
      ]);

      $stock = Stock::find($stock->stock_id);
      $stock->stock_name = $request->input('stock_name');
      $stock->stock_amount = $request->input('stock_amount');
      $stock->stock_type = $request->input('stock_type');
      $stock->batch_no = $request->input('batch_no');
      $stock->lot_no = $request->input('lot_no');
      $stock->expiry_date = $request->input('expiry_date');
      $stock->retreatment_interval = $request->input('retreatment_interval');
      $stock->meat_whp = $request->input('meat_whp');
      $stock->milk_whp = $request->input('milk_whp');
      $stock->esi_whp = $request->input('esi_whp');
      $stock->save();

      return redirect('/inventory')->with('success', 'Stock Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
      $stock = Stock::find($stock->stock_id);
      $stock->delete();

      return redirect('/inventory');
    }

}

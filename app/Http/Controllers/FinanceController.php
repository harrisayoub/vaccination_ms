<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Finance;
use App\Exports\FinanceExport;
use DB;

class FinanceController extends Controller
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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view ('finance.create');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

    $finances = Finance::where('user_id', auth()->id())->get();
    return view('finance.index')->with('finances', $finances); //view

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
      'item_name' => 'required|max:255',
      'quantity' => 'required|max:255',
      'price' => 'required|max:255',
      'purchase_date' => 'required'
    ]);

    //Create Financial Record

    $post = new Finance;
    $post->item_name = $request->input('item_name');
    $post->quantity = $request->input('quantity');
    $post->price = $request->input('price');
    $post->purchase_date = $request->input('purchase_date');
    $post->user_id = auth()->user()->user_id;
    $post->save();

    return redirect('/finance')->with('success', 'Record Added');

  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Mob  $mob
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    Finance::truncate();
    return redirect('/finance')->with('success', 'Cleared All Records');
  }

  /**
   * Export finances as xlsx
   *
   * @return Maatwebsite\Excel\Facades\Excel
   */
  public function export()
  {
    return Excel::download(new FinanceExport(), 'finances.xlsx');
  }

  /**
   * Export finances as csv
   *
   * @return Maatwebsite\Excel\Facades\Excel
   */
  public function exportcsv()
  {
    return Excel::download(new FinanceExport(), 'finances.csv');
  }

}

<?php

namespace App\Http\Controllers;

use App\Mob;
use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

use App\Mail\MobCreated;

class MobsController extends Controller
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
        $mobs = Mob::where('user_id', auth()->id())->with('activities')->get();
        return view('mobs.index')->with('mobs', $mobs); //view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mobs.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $userid = auth()->user()->user_id;
      $userEmail = auth()->user()->email;

      $this->validate($request, [
        'breed' => 'required',
        'no_animals' => 'required|integer|between:5,1000',
        'tag_color' => 'required',
      ]);


      $mob = new Mob;
      $mob->mob_breed = $request->input('breed');
      $mob->description = $request->input('description');
      $mob->no_animals = $request->input('no_animals');
      $mob->tag_color = $request->input('tag_color');
      $mob->user_id = $userid;
      $mob->save();

      return redirect()->action('MobsActivitiesController@create', $mob);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mob  $mob
     * @return \Illuminate\Http\Response
     */
    public function edit(Mob $mob)
    {
        $mob = Mob::find($mob->mob_id);
        return view('mobs.edit')->with('mob', $mob);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mob  $mob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mob $mob)
    {
      $this->validate($request, [
        'breed' => 'required',
        'no_animals' => 'required',
        'tag_color' => 'required',
      ]);

      $mob = Mob::find($mob->mob_id);
      $mob->mob_breed = $request->input('breed');
      $mob->description = $request->input('description');
      $mob->no_animals = $request->input('no_animals');
      $mob->tag_color = $request->input('tag_color');
      $mob->save();

      return redirect('/mobs')->with('success', 'Mob Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mob  $mob
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mob $mob)
    {
      $mob = Mob::find($mob->mob_id);
      $mob->delete();

      return redirect('/mobs');
    }


}

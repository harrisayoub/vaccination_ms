<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mob;
use App\Activity;
use App\Action;
use App\Stock;
use Carbon\Carbon;

class ActivityActionsController extends Controller
{
    /**
     * Creating a new resource.
     * @param  \App\Mob  $mob
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function create(Mob $mob, Activity $activity)
    {

      foreach($mob->activities as $activity){
        $userEmail = auth()->user()->email;

          if($activity->activity_name == 'Joining'){
            $action1 = new Action(['activity_id' => $activity->activity_id, 'action_title' => 'Drafting', 'action_description' => 'Make sure the Mob required for joining
                    is fully formed. This may require bringing Sheep into the yards and Drafting them. Bring Ram team either to yard or paddock and
                     join with the ewe mob. Leave the rams in the mob for the specific time required.', 'action_date' => $activity->start_date]);

            $activity->actions()->save($action1);

            $action2 = new Action(['activity_id' => $activity->activity_id, 'action_title' => 'Take Rams Out', 'action_description' => 'Joined Mob is taken to Yards and
                    the Rams Drafted out.', 'action_date' => $activity->end_date]);

            $activity->actions()->save($action2);
          }

          else if($activity->activity_name == 'Scanning'){
            $action3 = new Action(['activity_id' => $activity->activity_id, 'action_title' => 'Pregnancy Scanning Preparation', 'action_description' => 'Mob taken to yards for Pregnancy
                     Scanning. Yards need to be set up Single, Twins(multiple) and Dry(not pregnant) ewes marked with colour spray paint. Dry Ewes to be sold
                     or join another mob for joining again', 'action_date' => $activity->start_date]);
            $activity->actions()->save($action3);
          }

          else if($activity->activity_name == 'Innoculation'){
            $action4 = new Action(['activity_id' => $activity->activity_id, 'action_title' => 'Pre-Lambing Innoculations', 'action_description' => 'Mob taken to yards and give pre-lambing
                     innoculations. The adminstring of 3/5/6 in 1 and a Long Acting internal parasite treatment recommended. Mob returned to paddock for lambing.', 'action_date' => $activity->start_date]);

            $activity->actions()->save($action4);

          }

          else if($activity->activity_name == 'Mark Lambs'){
            $action5 = new Action(['activity_id' => $activity->activity_id, 'action_title' => 'Mark the Lambs', 'action_description' => 'Mob taken to yards and lambs drafted off the mob. The lambs are marked which will include innoculations with
            3/4/6 in 1 innoculant, tail will be docked using (done with elasticator ring, NLIS ear tag which is the appropriate color for that year of birth, has the brand on it, often the owners name as an individual number.)', 'action_date' => $activity->start_date]);
            $activity->actions()->save($action5);
          }
      }

      return redirect('/mobs');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Mob  $mob
     * @param  \App\Activity  $activity
     * @param  \App\Action $action
     * @return \Illuminate\Http\Response
     */
    public function show(Mob $mob, Activity $activity, Action $action)
    {
      $stock = Stock::all();
      $action = Action::find($action->action_id);


      if($action->action_title == 'Drafting'){
        return redirect()->action('MobsActivitiesController@show', [$mob, $activity]);
      }
      else{
        return view('actions.show')->with(['mob' => $mob, 'activity' => $activity, 'action' => $action, 'stock' => $stock]);
      }

    }

    /**
     * Update animals method in order to reduce unwanted animals from mob
     *
     * @param  \App\Mob  $mob
     * @param  \App\Activity  $activity
     * @param  \App\Action $action
     * @return \Illuminate\Http\Response
     */
    public function updateAnimals(Request $request, Mob $mob, Activity $activity, Action $action)
    {
      $mob = Mob::find($mob->mob_id);
      $action = Action::find($action->action_id);

      $this->validate($request, [
        'no_of_animals' => 'required',
      ]);

        if($request->input('no_of_animals') < $mob->no_animals){
          $mob->no_animals = $mob->no_animals - $request->input('no_of_animals');
          $mob->save();
          return redirect()->action('MobsActivitiesController@show', [$mob, $activity])->with('success', 'Animals removed from mob');
        }
        else{
          return redirect()->action('ActivityActionsController@show', [$mob, $activity, $action])->with('error', 'Animals to remove higher than total animals');
        }

    }

    /**
     * Update treatments method to add treaments in activities of mob
     *
     * @param  \App\Mob  $mob
     * @param  \App\Activity  $activity
     * @param  \App\Action $action
     * @return \Illuminate\Http\Response
     */
    public function updateTreatments(Request $request, Mob $mob, Activity $activity, Action $action)
    {

      $mob = Mob::find($mob->mob_id);
      $action = Action::find($action->action_id);

      $this->validate($request, [
        'items' => 'required',
        'quantity' => 'required',
      ]);

      $stock = Stock::find($request->input('items'));

      if($request->input('quantity') < $stock->stock_amount){
        $action->stocks()->attach($request->input('items'),  ['quantity_used' => $request->input('quantity'), 'created_at' => Carbon::now()]);

        $stock->stock_amount = $stock->stock_amount - $request->input('quantity');
        $stock->save();

        return redirect()->action('ActivityActionsController@show', [$mob, $activity, $action])->with('success', 'Item used from inventory');
      }
      else{
        return redirect()->action('ActivityActionsController@show', [$mob, $activity, $action])->with('error', 'Insufficient quantity in inventory');
      }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mob  $mob
     * @param  \App\Activity  $activity
     * @param  \App\Action $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mob $mob, Activity $activity, Action $action, Stock $stock)
    {
        $action->stocks()->detach($stock->stock_id);

        return redirect()->action('MobsActivitiesController@show', [$mob, $activity]);
    }
}

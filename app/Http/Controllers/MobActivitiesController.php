<?php

namespace App\Http\Controllers;

use App\Mob;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Mail\ActivityStarted;
use App\Mail\ActivityEnded;
use App\Mail\ActivityEndWarning;




class MobsActivitiesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Mob $mob)
    {
      $mob = Mob::find($mob->mob_id);

      $mob->activities()->createMany([
        [
          'mob_mob_id' => $mob->mob_id, 'activity_type' => 'Non-Pharmaceutical', 'activity_name' => 'Joining', 'no_of_days' => 35, 'start_day' => 1, 'end_day' => 35,
        ],
        [
          'mob_mob_id' => $mob->mob_id, 'activity_type' => 'Non-Pharmaceutical', 'activity_name' => 'Scanning', 'no_of_days' => 14, 'start_day' => 77, 'end_day' => 91,
        ],
        [
          'mob_mob_id' => $mob->mob_id, 'activity_type' => 'Pharmaceutical', 'activity_name' => 'Innoculation', 'no_of_days' => 5, 'start_day' => 115, 'end_day' => 120,
        ],
        [
          'mob_mob_id' => $mob->mob_id, 'activity_type' => 'Non-Pharmaceutical', 'activity_name' => 'Lambing', 'no_of_days' => 35, 'start_day' => 147, 'end_day' => 182,
        ],
        [
          'mob_mob_id' => $mob->mob_id, 'activity_type' => 'Pharmaceutical', 'activity_name' => 'Mark Lambs', 'no_of_days' => 1, 'start_day' => 196, 'end_day' => 196,
        ],
      ]);


      return redirect()->action('MobsActivitiesController@scheduleDates', $mob);
    }


    /**
     * Schedule acitivity dates of mob
     * @param  \App\Mob  $mob
     * @return \Illuminate\Http\Response
     */
    public function scheduleDates(Mob $mob){

      $mob = Mob::find($mob->mob_id);
      $userEmail = auth()->user()->email;


      foreach ($mob->activities as $activity) {
        $start_date = Carbon::now()->addDays($activity->start_day - 1);
        $end_date = Carbon::now()->addDays($activity->start_day - 1 + $activity->no_of_days);

        $activity->start_date = $start_date;
        $activity->end_date = $end_date;

        $activity->save();

        $whenActivityStart = $activity->start_date;
        $whenActivityEnd = $activity->end_date;


        \Mail::to($userEmail)->later($whenActivityStart, new ActivityStarted($mob, $activity));
        \Mail::to($userEmail)->later($whenActivityEnd, new ActivityEndWarning($mob, $activity));
        \Mail::to($userEmail)->later($whenActivityEnd, new ActivityEnded($mob, $activity));

      }

      foreach ($mob->activities as $activity) {
        return redirect()->action('ActivityActionsController@create', [$mob, $activity]);
      }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Mob  $mob
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Mob $mob, Activity $activity)
    {
      $activity = Activity::find($activity->activity_id);
      return view('activities.show')->with(['mob' => $mob, 'activity' => $activity]);
    }

}

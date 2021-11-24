<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Mail\MobCreated;
use App\Mail\SupplyReminder1;
use App\Mail\SupplyReminder2;
use App\Mail\SupplyReminder3;

use App\Mail\Warning1;
use App\Mail\Warning2;
use App\Mail\Warning3;
use App\Mail\Warning4;

use App\Mail\JobReminder1;
use App\Mail\JobReminder2;
use App\Mail\JobReminder3;
use App\Mail\JobReminder4;
use App\Mail\JobReminder5;

class Mob extends Model
{
  // Table names
   protected $table = 'mobs';

   //Primary Key
   public $primaryKey = 'mob_id';

   //Timestamps
   public $timestamps = true;

   //relationship
   public function user(){
     return $this->belongsTo('App\User');
   }

   //relationship
   public function activities(){
     return $this->hasMany('App\Activity');
   }

   public static function boot(){
     parent::boot();

     static::created(function($mob) {
      $userEmail = auth()->user()->email;
      $whenMobCreated = $mob->created_at;

      $whenSupplyReminder1 = $mob->created_at->addDays(49);
      $whenSupplyReminder2 = $mob->created_at->addDays(108);
      $whenSupplyReminder3 = $mob->created_at->addDays(178);

      $whenWarning1 = $mob->created_at->addDays(49);
      $whenWarning2 = $mob->created_at->addDays(115);
      $whenWarning3 = $mob->created_at->addDays(196);
      $whenWarning4 = $mob->created_at->addDays(236);

      $whenAction1 = $mob->created_at;
      $whenAction2 = $mob->created_at->addDays(35);
      $whenAction3 = $mob->created_at->addDays(77);
      $whenAction4 = $mob->created_at->addDays(115);
      $whenAction5 = $mob->created_at->addDays(196);



      \Mail::to($userEmail)->later($whenMobCreated, new MobCreated($mob));

      \Mail::to($userEmail)->later($whenSupplyReminder1, new SupplyReminder1($mob));
      \Mail::to($userEmail)->later($whenSupplyReminder2, new SupplyReminder2($mob));
      \Mail::to($userEmail)->later($whenSupplyReminder3, new SupplyReminder3($mob));

      \Mail::to($userEmail)->later($whenWarning1, new Warning1($mob));
      \Mail::to($userEmail)->later($whenWarning2, new Warning2($mob));
      \Mail::to($userEmail)->later($whenWarning3, new Warning3($mob));
      \Mail::to($userEmail)->later($whenWarning4, new Warning4($mob));

      \Mail::to($userEmail)->later($whenAction1, new JobReminder1($mob));
      \Mail::to($userEmail)->later($whenAction2, new JobReminder2($mob));
      \Mail::to($userEmail)->later($whenAction3, new JobReminder3($mob));
      \Mail::to($userEmail)->later($whenAction4, new JobReminder4($mob));
      \Mail::to($userEmail)->later($whenAction5, new JobReminder5($mob));

     });

     static::deleting(function($mobs) {
         foreach ($mobs->activities()->get() as $activity) {
            $activity->delete();
         }
      });
   }


}

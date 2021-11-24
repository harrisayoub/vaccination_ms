<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

  // Table names
   protected $table = 'activities';

   //Primary Key
   public $primaryKey = 'activity_id';

   protected $fillable = ['activity_type','activity_name','no_of_days', 'start_day', 'end_day', 'start_date', 'end_date'];

  //relationship
  public function mob(){
    return $this->belongsTo('App\Mob');
  }

  //relationship
  public function actions(){
    return $this->hasMany('App\Action');
  }

  //relationship
  public function stocks(){
    return $this->hasMany('App\Stock');
  }

  public static function boot(){
    parent::boot();

    static::deleting(function($activities) {
        foreach ($activities->actions()->get() as $action) {
           $action->delete();
        }
     });
  }
}

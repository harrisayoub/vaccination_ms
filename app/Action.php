<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Mail\ActionReminder;

class Action extends Model
{
  // Table names
   protected $table = 'actions';

   //Primary Key
   public $primaryKey = 'action_id';

   protected $fillable = ['action_title', 'action_description', 'action_date', 'status'];

   //Timestamps
   public $timestamps = true;


  //relationship
  public function activity(){
    return $this->belongsTo('App\Activity');
  }

  public function stocks(){
    return $this->belongsToMany('App\Stock')->withPivot('quantity_used', 'created_at');
  }

  public static function boot(){
    parent::boot();

    static::deleting(function($action) {
           $action->stocks()->detach();
     });
  }
}

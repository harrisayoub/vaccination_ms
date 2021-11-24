<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{

  // Table names
  protected $table = 'stock';

  //Primary Key
  public $primaryKey = 'stock_id';

  public $timestamps = true;
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function activity()
  {
    return $this->belongsTo('App\Activity');
  }

  public function actions(){
    return $this->belongsToMany('App\Action');
  }
}

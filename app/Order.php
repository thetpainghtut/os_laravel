<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'orderdate', 'voucherno', 'total', 'note', 'status', 'user_id',
  ];

  public function items()
  {
  	return $this->belongsToMany('App\Item')
		    	->withPivot('qty')
		    	->withTimestamps();
  }
}

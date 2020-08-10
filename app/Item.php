<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codeno', 'name', 'photo', 'price', 'discount', 'description', 'subcategory_id', 'brand_id',
    ];

    public function orders()
    {
    	return $this->belongsToMany('App\Order')
			    	->withPivot('qty')
			    	->withTimestamps();
    }

    public function brand($value='')
    {
    	# code...
    }

    public function subcategory($value='')
    {
    	# code...
    }
}

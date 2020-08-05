<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'name', 'category_id',
    ];

    public function category($value='')
    {
    	# code...
    }

    public function items($value='')
    {
    	# code...
    }
}

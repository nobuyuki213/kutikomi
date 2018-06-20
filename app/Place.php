<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
    protected $fillable = [
    	'city_id', 'name', 'description',
    ];

    public function city()
    {
    	return $this->belongsTo(City::class);
    }
}

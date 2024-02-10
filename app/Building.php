<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable=[
        'name','location_details','monthly_consumption'
    ];

    public function images(){
        return $this->hasMany(BuildingImage::class);
    }
}

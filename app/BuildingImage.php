<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingImage extends Model
{
    protected $fillable=[
        'building_id','image_name'
    ];

    public function building(){
        return $this->belongsTo(Building::class);
    }
}

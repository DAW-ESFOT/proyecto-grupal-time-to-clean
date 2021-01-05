<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $fillable = ['license_plate', 'type', 'working'];

    public function neighborhoods(){
        return $this->hasMany('App\Models\Neighborhoods');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

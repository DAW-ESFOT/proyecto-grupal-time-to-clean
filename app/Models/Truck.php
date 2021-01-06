<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Truck extends Model
{
    use HasFactory;
    protected $fillable = ['license_plate', 'type', 'working'];

    public static function boot(){
        parent::boot();
        static::creating(function ($truck) {
            $truck->user_id = Auth::id();
        });
    }

    public function neighborhoods(){
        return $this->hasMany('App\Models\Neighborhoods');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

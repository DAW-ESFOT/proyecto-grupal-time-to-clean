<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Neighborhood extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_time',
        'end_time',
        'days',
        'link',
        'name',
    ];

    public static function boot(){
        parent::boot();
        static::creating(function ($neighborhood) {
            $neighborhood->truck_id = Auth::id();
        });
    }

    public function complaints(){
        return $this->hasMany('App\Models\Complaint');
    }

    public function truck(){
        return $this->belongsTo('App\Models\Truck');
    }
}
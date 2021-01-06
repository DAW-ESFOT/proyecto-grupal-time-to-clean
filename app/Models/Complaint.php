<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'complaint',
        'username',
        'email',
        'state',
        'observation'
    ];

    public static function boot(){
        parent::boot();
        static::creating(function ($complaint) {
            $complaint->neighborhood_id = Auth::id();
        });
    }

    public function neighborhood(){
        return $this->belongsTo('App\Models\Neighborhoods');
    }
}

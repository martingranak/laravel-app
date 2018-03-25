<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Location extends Model
{
    use Notifiable;

    protected $fillable = [
        'longtitude', 'latitude', 'speed', 'satellite',
    ];

    public function devices()
    {
        return $this->belongsTo('Device');
    }
}

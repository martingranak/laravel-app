<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Device extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsTo('User');
    }

    public function types()
    {
        return $this->belongsTo('Type');
    }

    public function locations()
    {
        return $this->hasMany('Location');
    }
}

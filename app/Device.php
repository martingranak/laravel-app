<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

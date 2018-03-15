<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Notifiable;

    protected $fillable = [
        'name', 'picture',
    ];

    public function devices()
    {
        return $this->hasMany('Device');
    }
}

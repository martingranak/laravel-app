<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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

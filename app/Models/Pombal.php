<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pombal extends Model
{
    protected $table = 'pombal';

    public function pombos()
    {
        return $this->hasMany('App\Models\Pombo');
    }
}

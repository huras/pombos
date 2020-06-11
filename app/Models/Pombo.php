<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pombo extends Model
{
    protected $table = 'pombo';
    public $fillable = [
        'anilha',
        'nome',
        'nascimento',
        'macho',
        'foto',
        'obs',
        'pai_id',
        'mae_id',
        'cor',
        'pombal',
        'morto',
        'temp_pai',
        'temp_mae',
    ];

    public function pai()
    {
        return $this->belongsTo('App\Models\Pombo', 'pai_id');
    }

    public function mae()
    {
        return $this->belongsTo('App\Models\Pombo', 'mae_id');
    }

    public function pombal()
    {
        return $this->belongsTo('App\Models\Pombal', 'pombal_id');
    }
}

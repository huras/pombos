<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users';
    public $fillable = [
        'name', 
        'type', 
        'email', 
        'password'        
    ];
}

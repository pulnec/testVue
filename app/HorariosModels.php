<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorariosModels extends Model
{
    //
    protected $fillable = [
        'hora_usuario',
        'hora_back',
        'status'
     ]; 
}


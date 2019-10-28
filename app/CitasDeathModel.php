<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitasDeathModel extends Model
{

    protected $fillable = [
       'correo',
       'fecha',
       'hora'
    ]; 
}

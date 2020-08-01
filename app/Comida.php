<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comida extends Model
{
    protected $table = 'comidas';
    protected $primaryKey = 'id_comida';
    public $timestamps = false;
}

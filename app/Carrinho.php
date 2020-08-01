<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $table = "carrinho";
    protected $primaryKey = "id_carrinho";
    public $timestamps = false;

    // Relação de cardinalidade entre o Carrinho e a Comida
    public function comida() {
        return $this->belongsTo("App\Comida", "id_comida", "id_comida");
    }
}

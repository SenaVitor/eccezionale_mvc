<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model
{
    protected $table = "delivery_item";
    protected $primaryKey = "id_delivery_item";
    public $timestamps = false;
}

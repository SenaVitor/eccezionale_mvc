<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class ContactEmail extends Model
{
    public $primaryKey = "id_email_contato";
    public $fillable = ['name','email','message'];
    public $timestamps = false;
}

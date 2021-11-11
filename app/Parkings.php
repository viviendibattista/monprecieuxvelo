<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parkings extends Model
{
    protected $table = 'parkings';
    protected $connexion = 'mysql';
    public $timestamps = false;
}

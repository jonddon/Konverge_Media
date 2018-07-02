<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bounce extends Model
{
   public $fillable =[
   'event', 'recipient','domain'
];
}

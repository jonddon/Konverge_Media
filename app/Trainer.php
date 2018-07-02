<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    public $fillable = [
       'company_id', 'name', 'email',
    ];

	public function setNameAttribute($value) {
    $this->attributes['name'] = strtoupper($value);
	}
}

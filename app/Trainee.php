<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    public $fillable = [
        'name', 'email', 'batch_id', 'phone', 'added_by'
    ];

	public function setNameAttribute($value) {
    $this->attributes['name'] = strtoupper($value);
	}
}

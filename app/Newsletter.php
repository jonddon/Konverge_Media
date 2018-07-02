<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    public $fillable = [
        'first_name', 'last_name', 'middle_name', 'email', 'business_sector', 'state', 'batch_id', 'phone', 'added_by', 'gender'
    ];

	public function setNameAttribute($value) {
    $this->attributes['last_name'] = strtoupper($value);
	}
}

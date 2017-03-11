<?php

namespace App;

use App\Attempt;
use App\User;
use Illuminate\Database\Eloquent\Model;

class MasterKey extends Model
{

	protected $fillable = [
		'user_id',
		'sequence',
		'name',
	];

	protected $casts = [
		'sequence' => 'array',
	];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function attempts()
    {
    	return $this->hasMany(Attempt::class);
    }
}

<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = [
    	'user_id',
    	'master_key_id',
    	'sequence', 
    	'rating',
        'passing',
    ];

    protected $casts = [
    	'sequence' => 'array',
    ];

    public function masterKey()
    {
    	return $this->belongsTo(MasterKey::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

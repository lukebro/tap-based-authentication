<?php

namespace App;

use App\Attempt;
use App\MasterKey;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    protected $appends = [
        'hasMasterKey',
        'hasAttempt',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    public function masterKeys()
    {
        return $this->hasMany(MasterKey::class);
    }

    public function key()
    {
        return $this->masterKeys()->latest()->first();
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    public function getHasAttemptAttribute()
    {
        return $this->attempts()->count() > 0;
    }

    public function getHasMasterKeyAttribute()
    {
        return $this->masterKeys()->count() > 0;
    }

    public function getStatisticsAttribute()
    {
        $statistics = new \stdClass();

        $statistics->accepted = $this->attempts()->whereColumn('rating', '>=', 'passing')->count();
        $statistics->rejected = $this->attempts()->whereColumn('rating', '<', 'passing')->count();
        $statistics->total = $this->attempts()->count();
        $statistics->frr = round($statistics->rejected / $statistics->total * 100, 2);

        return $statistics;
    }
}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use Auth;

class Admin extends Authenticatable
{
	protected $guard = 'admin';

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function pesan()
    {
        // return $this->belongTo(Pesan::class);
        return $this->belongsToMany(Pesan::class)->withPivot(['tgl_pesan'])->withTimeStamps();
    }
}

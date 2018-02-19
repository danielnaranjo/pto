<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable;
use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug','ipAddress','status','verified','avatar','dni',
		'birthdate',
		'gender',
		'city',
		'province',
        'country',
        'provider',
        'provider_id',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

protected $casts = [
		'dni' => 'int',
        'country' => 'int'
	];

	protected $dates = [
		'created_at',
'updated_at',
        'birthdate'
	];

}

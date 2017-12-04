<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $address
 * @property string $token
 * @property \Carbon\Carbon $registered
 * @property string $verified
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $table = 'user';
	public $timestamps = false;

	protected $dates = [
		'registered'
	];

	protected $hidden = [
		'password',
		'token'
	];

	protected $fillable = [
		'name',
		'lastname',
		'email',
		'password',
		'phone',
		'address',
		'token',
		'registered',
		'verified'
	];
}

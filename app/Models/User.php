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
	protected $table = 'users';
	public $timestamps = false;

    protected $casts = [
		'dni' => 'int',
        'country' => 'int'
	];

	protected $dates = [
		'registered',
        'birthdate'
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
		'verified',
        'dni',
		'birthdate',
		'gender',
		'city',
		'province',
        'country'
	];

    public function image()
    {
        return $this->hasOne('App\Models\Image','user_id');
    }
    public function docs()
    {
        return $this->hasOne('App\Models\UserImage','user_id');
    }
    public function comment()
    {
        return $this->hasOne('App\Models\Comment','user_id');
    }
    public function from()
    {
        return $this->hasOne('App\Models\Comment','from_id');
    }
    public function message()
    {
        return $this->hasOne('App\Models\Message','user_id');
    }
    public function package()
    {
        return $this->hasOne('App\Models\Package','user_id');
    }
    public function vote()
    {
        return $this->hasOne('App\Models\Vote','user_id');
    }
    public function withdraw()
    {
        return $this->hasOne('App\Models\Withdraw','user_id');
    }
}

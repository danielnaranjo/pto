<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

use Reliese\Database\Eloquent\Model as Eloquent;
// /https://es.stackoverflow.com/questions/8491/argument-1-passed-to-illuminate-auth-eloquentuserprovidervalidatecredentials
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Eloquent implements AuthenticatableContract
{
	protected $table = 'users';
	public $timestamps = false;
    use Searchable;
    use Authenticatable;
    use Notifiable;

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
		'remember_token'
	];

	protected $fillable = [
		'name',
		'lastname',
		'email',
		'password',
		'phone',
		'address',
		'remember_token',
		'registered',
		'verified',
        'dni',
		'birthdate',
		'gender',
		'city',
		'province',
        'country',
        'provider',
        'provider_id',
        'avatar'
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
        return $this->hasMany('App\Models\Message','user_id');
    }
    public function package()
    {
        return $this->hasMany('App\Models\Package','user_id');
    }
    public function travel()
    {
        return $this->hasMany('App\Models\Travel','user_id');
    }
    public function vote()
    {
        return $this->hasOne('App\Models\Vote','user_id');
    }
    public function withdraw()
    {
        return $this->hasMany('App\Models\Withdraw','user_id');
    }
    public function location()
    {
        return $this->hasOne('App\Models\Country','country_id','country');
    }
    public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
}

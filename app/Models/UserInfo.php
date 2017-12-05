<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserInfo
 *
 * @property int $user_info_id
 * @property int $dni
 * @property \Carbon\Carbon $birthdate
 * @property string $gender
 * @property string $city
 * @property string $province
 * @property string $country
 *
 * @package App\Models
 */
class UserInfo extends Eloquent
{
	protected $table = 'user_info';
	protected $primaryKey = 'user_info_id';
	public $timestamps = false;

	protected $casts = [
		'dni' => 'int'
	];

	protected $dates = [
		'birthdate'
	];

	protected $fillable = [
		'dni',
		'birthdate',
		'gender',
		'city',
		'province',
		'country'
	];
    public function info()
    {
        return $this->belongsTo('App\Models\User');
    }
}

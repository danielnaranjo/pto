<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserDatum
 * 
 * @property int $user_id
 * @property int $user_info_id
 *
 * @package App\Models
 */
class UserDatum extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'user_info_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'user_info_id'
	];
}

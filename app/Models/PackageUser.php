<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PackageUser
 * 
 * @property int $package_id
 * @property int $user_id
 *
 * @package App\Models
 */
class PackageUser extends Eloquent
{
	protected $table = 'package_user';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'package_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'package_id',
		'user_id'
	];
}

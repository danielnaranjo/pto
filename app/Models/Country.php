<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Country
 * 
 * @property string $code
 * @property int $lat
 * @property int $lng
 * @property string $name
 * @property string $status
 *
 * @package App\Models
 */
class Country extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lat' => 'int',
		'lng' => 'int'
	];

	protected $fillable = [
		'code',
		'lat',
		'lng',
		'name',
		'status'
	];
}

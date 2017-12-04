<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ImageUri
 * 
 * @property int $image_id
 * @property boolean $uri
 *
 * @package App\Models
 */
class ImageUri extends Eloquent
{
	protected $table = 'image_uri';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'image_id' => 'int',
		'uri' => 'boolean'
	];

	protected $fillable = [
		'image_id',
		'uri'
	];
}

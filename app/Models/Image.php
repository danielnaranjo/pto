<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Image
 * 
 * @property int $image_id
 * @property string $name
 * @property string $path
 * @property \Carbon\Carbon $created
 *
 * @package App\Models
 */
class Image extends Eloquent
{
	protected $table = 'image';
	protected $primaryKey = 'image_id';
	public $timestamps = false;

	protected $dates = [
		'created'
	];

	protected $fillable = [
		'name',
		'path',
		'created'
	];
}

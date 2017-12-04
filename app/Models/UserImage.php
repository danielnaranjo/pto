<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserImage
 * 
 * @property int $user_id
 * @property int $image_id
 *
 * @package App\Models
 */
class UserImage extends Eloquent
{
	protected $table = 'user_image';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'image_id' => 'int'
	];
}

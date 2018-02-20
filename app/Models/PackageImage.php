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
class PackageImage extends Eloquent
{
	protected $table = 'package_image';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'package_id' => 'int',
		'image_id' => 'int'
	];

	protected $fillable = [
		'package_id',
		'image_id'
	];

    public function package()
    {
        return $this->belongsTo('App\Models\package','package_id');
    }
    public function image()
    {
        return $this->hasOne('App\Models\Image','image_id','image_id');
    }
}

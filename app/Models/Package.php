<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Dec 2017 13:12:57 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Package
 *
 * @property int $package_id
 * @property int $user_id
 * @property string $origin
 * @property string $destination
 * @property int $service_id
 * @property string $tracking
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $created
 * @property \Carbon\Carbon $delivery
 * @property string $auction
 * @property float $price
 * @property string $status
 *
 * @package App\Models
 */
class Package extends Eloquent
{
	protected $table = 'package';
	protected $primaryKey = 'package_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'service_id' => 'int',
		'price' => 'float'
	];

	protected $dates = [
		'created',
		'delivery'
	];

	protected $fillable = [
		'user_id',
		'origin',
		'destination',
		'service_id',
		'tracking',
		'title',
		'description',
		'created',
		'delivery',
		'auction',
		'price',
		'status'
	];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service','service_id');
    }
}
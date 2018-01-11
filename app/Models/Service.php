<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Laravel\Scout\Searchable;

/**
 * Class Service
 *
 * @property int $service_id
 * @property string $type
 * @property string $text
 * @property int $price
 * @property int $rate
 *
 * @package App\Models
 */
class Service extends Eloquent
{
	protected $table = 'service';
	protected $primaryKey = 'service_id';
	public $timestamps = false;
    use Searchable;

	protected $casts = [
		'price' => 'int',
		'rate' => 'int'
	];

	protected $fillable = [
		'type',
		'text',
		'price',
		'rate'
	];
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
}

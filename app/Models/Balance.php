<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Balance
 *
 * @property int $balance_id
 * @property int $package_id
 * @property int $user_id
 * @property string $amount
 * @property \Carbon\Carbon $created
 *
 * @package App\Models
 */
class Balance extends Eloquent
{
	protected $table = 'balance';
	protected $primaryKey = 'balance_id';
	public $timestamps = false;

	protected $casts = [
		'package_id' => 'int',
		'user_id' => 'int'
	];

	protected $dates = [
		'created'
	];

	protected $fillable = [
		'package_id',
		'user_id',
		'amount',
		'created'
	];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }
}

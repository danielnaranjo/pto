<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Withdraw
 *
 * @property int $withdraw_id
 * @property int $user_id
 * @property int $package_id
 * @property string $amount
 * @property string $email
 * @property int $status
 * @property \Carbon\Carbon $requested
 *
 * @package App\Models
 */
class Withdraw extends Eloquent
{
	protected $table = 'withdraw';
	protected $primaryKey = 'withdraw_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'package_id' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'requested'
	];

	protected $fillable = [
		'user_id',
		'package_id',
		'amount',
		'email',
		'status',
		'requested'
	];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

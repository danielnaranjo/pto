<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BalanceWithdraw
 * 
 * @property int $balance_id
 * @property int $withdraw_id
 *
 * @package App\Models
 */
class BalanceWithdraw extends Eloquent
{
	protected $table = 'balance_withdraw';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'balance_id' => 'int',
		'withdraw_id' => 'int'
	];

	protected $fillable = [
		'balance_id',
		'withdraw_id'
	];
}

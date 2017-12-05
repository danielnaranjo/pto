<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Message
 *
 * @property int $message_id
 * @property int $user_id
 * @property int $to_id
 * @property string $comment
 * @property \Carbon\Carbon $createdAt
 * @property string $status
 *
 * @package App\Models
 */
class Message extends Eloquent
{
	protected $table = 'message';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'message_id' => 'int',
		'user_id' => 'int',
		'to_id' => 'int'
	];

	protected $dates = [
		'createdAt'
	];

	protected $fillable = [
		'message_id',
		'user_id',
		'to_id',
		'comment',
		'createdAt',
		'status'
	];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

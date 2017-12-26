<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Comment
 *
 * @property int $comment_id
 * @property int $user_id
 * @property int $from_id
 * @property string $comment
 * @property \Carbon\Carbon $createdAt
 * @property string $status
 *
 * @package App\Models
 */
class Comment extends Eloquent
{
	protected $table = 'comment';
	protected $primaryKey = 'comment_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'from_id' => 'int'
	];

	protected $dates = [
		'createdAt'
	];

	protected $fillable = [
		'user_id',
		'from_id',
		'comment',
		'createdAt',
		'status'
	];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function from()
    {
        return $this->belongsTo('App\Models\User');
    }
}

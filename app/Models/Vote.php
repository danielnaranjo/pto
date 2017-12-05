<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 19:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Vote
 *
 * @property int $vote_id
 * @property int $user_id
 * @property string $downvotes
 * @property string $upvotes
 * @property \Carbon\Carbon $createdAt
 *
 * @package App\Models
 */
class Vote extends Eloquent
{
	protected $table = 'vote';
	protected $primaryKey = 'vote_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $dates = [
		'createdAt'
	];

	protected $fillable = [
		'user_id',
		'downvotes',
		'upvotes',
		'createdAt'
	];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

class Referral extends Eloquent
{
    protected $table = 'referral';
	protected $primaryKey = 'referral_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
	];

	protected $fillable = [
		'name',
		'email'

	];
    public function referer()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}

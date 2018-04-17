<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

class Social extends Eloquent
{
    protected $table = 'social';
	protected $primaryKey = 'social_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
	];

	protected $fillable = [
		'name',
		'url'

	];
    public function rrss()
    {
        return $this->belongsTo('App\User');
    }
}

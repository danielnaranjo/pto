<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

class Travel extends Eloquent
{
    protected $table = 'travel';
	protected $primaryKey = 'travel_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
        'origin' => 'int',
		'destination' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'user_id',
        'origin',
		'destination',
		'type',
		'date',
        'title',
        'dimensions',
        'weight',
		'restrictions'
	];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function from()
    {
        return $this->hasOne('App\Models\Country','country_id','origin');
    }
    public function to()
    {
        return $this->hasOne('App\Models\Country','country_id','destination');
    }
}

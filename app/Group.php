<?php

namespace App;

// use App\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
	protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function hasUser($user_id)
    {
        foreach ($this->users as $user) {
            if($user->id == $user_id) {
                return true;
            }
        }
    }
}

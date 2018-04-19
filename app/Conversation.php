<?php

namespace App;
// use App\Group;
// use App\User;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';
	protected $primaryKey = 'id';

    protected $fillable = ['message', 'user_id', 'group_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }
}

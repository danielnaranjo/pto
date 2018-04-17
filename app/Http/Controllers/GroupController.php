<?php

namespace App\Http\Controllers;
use App\Group;

use App\Events\GroupCreated;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Session;
use Log;
use Validator;
use MessageBag;
use Carbon\Carbon;
use Date;

class GroupController extends Controller
{
    public function store()
    {
        $group = Group::create(['name' => request('name')]);
        $users = collect(request('users'));
        $users->push(auth()->user()->id);
        $group->users()->attach($users);
        broadcast(new GroupCreated($group))->toOthers();
        return $group;
    }
}

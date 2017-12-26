<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Package;

#use Illuminate\Http\Request;
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
use Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['results']   = User::all();
        $data['titulo'] = "Mi Perfil";
        // $data['mailgun'] = ['total'=>100, 'sent'=>80, 'opened'=>15,'bounced'=>5];// TODO, viene de Mailgun
        // Date::setLocale('es');
        // $data['todayis'] = Date::now()->format('l j F Y');
        return view('pages.listado', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['_id'] = '';
        $data['_controller'] = 'UserController';
        $data['titulo'] = "Nuevo";
        $data['ruta'] = 'users';
        $data['results'] = DB::table('users')
            ->select('id','name', 'email')
            ->limit(1)
            ->get();
        return view('pages.autoform', $data );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Request::all();
        //
        $forms = DB::table('users')
            ->select('id','name', 'email')
            ->limit(1)
            ->get();
        foreach ($forms[0] as $key => $value) {
            if (preg_match("/name/i", $key) || preg_match("/email/i", $key)) { // Customizar
                $label = $key; //substr ( $key, 4, strlen($key) );
                $fields[$label] = 'required';
            }
        }
        $mgs = [ 'required' => ':attribute es requerido.' ];
        $validator = Validator::make(Request::all(), $fields, $mgs);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        User::create($input);
        return redirect()->action('UserController@index')->with('status', 'Información actualizada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data['titulo'] = "Mi Perfil";
        $data['results'] = User::find($user);//->user;
        // $data['comment'] = Comment::where('user_id', $user);//->user;
        // $data['message'] = Message::where('user_id', $user);//->user;
        // $data['package'] = Package::where('user_id', $user);//->user;
        //return $response;
        return view('pages.profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['_id'] = $user->id;
        $data['_controller'] = 'UserController';
        $data['id'] = $user->id;
        $data['titulo'] = "Editar";
        $data['ruta'] = 'users';
        $data['results'] = DB::table('users')
            ->select('name','email','address','phone')
            ->where('id', '=', $user->id)
            ->get();
        return view('pages.autoform', $data );
        //return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data= User::findOrFail($user->id);
        $input = Request::all();
        $data->update($input);
        return redirect()->action('UserController@index')->with('status', 'Información actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $data = User::findOrFail($user);
        $data->delete();
        return redirect()->action('UserController@index')->with('status', 'Información actualizada!');
    }
}

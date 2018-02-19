<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Date;
use Mail;
use Mailgun;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Date::setLocale('es');
        $fecha = Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d H:s:i');
        $slug = snake_case($data['name'].Date::now()->timestamp);
 
	$inside = array(
		'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
		'nombre' => $data['name'],
		'email' => $data['email'],
		'password' => $data['password'],
		'slug' => $slug, 
	);
	Mailgun::send('emails.passwords', $inside, function ($message) use ($inside){
		$message->from("no-responder@paqueto.com.ve", "Diego @ Paqueto");
		$message->subject("Hola ".$inside['nombre'].", bienvenido a Paqueto");
		$message->tag(['bienvenida', 'usuarios', 'registrado']);
		$message->to($inside['email']);
	});
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'slug' => $slug,
            'verified' => 0,
            'status' => 0,
            'ipAddress' => request()->ip(),
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'avatar' => ''
        ]);
    }
}

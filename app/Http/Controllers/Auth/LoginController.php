<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Image;
use App\Models\UserImage;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\Authenticatable;
use Auth;
use Socialite;
use Date;
use Mail;
use Mailgun;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        \Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($user, $provider)
    {
        //https://scotch.io/tutorials/laravel-social-authentication-with-socialite
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            $data = User::find($authUser->id);
            $data->name = $user->name;
            $data->email = $user->email;
            $data->ipAddress = request()->ip();
            $data->updated_at = Date::now()->format('Y-m-d H:s:i');
            $data->status = 1;
            if($authUser->slug==''){
                $data->slug = snake_case( $user->getNickname() ).Date::now()->timestamp;
            }
            if($authUser->created_at==''){
                $data->created_at = Date::now()->format('Y-m-d H:s:i');
            }
            if($authUser->avatar==''){
                $data->avatar = $user->getAvatar();
            }
            $data->save();
            //
            // $img = Image::updateOrCreate(['name' => $user->id, 'path' => $user->getAvatar() ], ['name' => $user->id] );
            // if($img){
            //     $uim = UserImage::firstOrCreate(['user_id' => $data->id, 'image_id' => $img->image_id, 'type' => '0' ]);
            // }
            return $authUser;
        }
        $fecha = Date::now()->format('Y-m-d H:s:i');
        $dip = request()->ip();
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'password' => bcrypt($user->email),
            'slug' => snake_case($user->getNickname()),
            'verified' => 1,
            'status' => 1,
            'ipAddress' => $dip,
            'created_at' => $fecha,
            'updated_at' => $fecha,
            'avatar' => $user->getAvatar()
        ]);
    	//
	Date::setLocale('es');
	$fecha = Date::now('America/Argentina/Buenos_Aires')->format('l j F Y');
	$inside = array(
		'fecha' => $fecha,
		'nombre' => $user->name,
		'email' => $user->email,
	);
	Mailgun::send('emails.bienvenida', $inside, function ($message) use ($inside){
		$message->from("no-responder@paqueto.com.ve", "Diego @ Paqueto");
		$message->subject("Hola ".$inside['nombre'].", bienvenido a Paqueto");
		$message->tag(['bienvenida', 'usuarios', 'socialite']);
		$message->to($inside['email']);
	});
	//
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\User;
use App\Group;
use App\Models\Package;
use App\Models\Service;
use App\Models\Travel;
use App\Models\Comment;
use App\Models\Message;

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
use Mail;
use Mailgun;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['results'] = User::paginate(6);
        $data['package'] = Package::inRandomOrder()->first();
        $data['travel'] = Travel::inRandomOrder()->first();
        $data['titulo'] = "Hola ";
        $data['mailgun'] = ['total'=>100, 'sent'=>80, 'opened'=>15,'bounced'=>5];// TODO, viene de Mailgun
        Date::setLocale('es');
        $data['todayis'] = Date::now()->format('l j F Y');
        return view('dashboard.principal', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function keepalive()
    {
        Date::setLocale('es');
        $data = Date::now();
        return response()->json($data);
    }
    public function resultados()
    {
        $query = $_GET['query'];
        $data['query'] = $query;
        // ALGOLIA
        $data['countries']  = Country::search( $query )->get();
        $data['users']  = User::search( $query )->get();
        $data['packages']  = Package::search( $query )->get();
        $data['services']  = Service::search( $query )->get();
        $data['travellers'] = Travel::search( $query )->get();
        return view('pages.quick_search', $data);
    }
    public function home()
    {
        //https://pusher.com/tutorials/group-chat-laravel/
        //https://github.com/viraj-khatavkar/group-chat-app-laravel-pusher/
        $data['user'] = Auth::user();
        // Log::info('user > '. $data['user']->id);
        $data['groups'] = auth()->user()->groups; ///Group::where('user_id','=',Auth::user()->id);
        // Log::info('groups > '. json_encode( $data['groups'] ));
        $data['users'] = User::where('id', '<>', Auth::user()->id)->get();
        //Log::info('users > '. json_encode($data['users']));
        $data['results'] = [];
        $data['titulo'] = "Conversaciones";
        return view('pages.chats', $data);
        return response()->json($data);
    }
    public function salir() {
        Auth::logout();
        redirect('/login');
    }
}

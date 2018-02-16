<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use App\Models\Package;
use App\Models\Service;
use App\Models\Travel;
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

use App\Models\Comment;
use App\Models\Message;

class PublicController extends Controller
{
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
    public function demo(){
        /*
        Date::setLocale('es');
        $data['date'] = Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d H:i:s');
        // $data['comentarios'] = Comment::where('createdAt', '=', Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d') )->limit(10);
        // $data['mensajes'] = Message::where('createdAt', '=', Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d') )->limit(10);
        // $data['usuarios'] = User::where('created_at', '>=', Date::now('America/Argentina/Buenos_Aires')->sub('15 minutes')->format('Y-m-d H:i:s') )->get();
        // $data['paquetes'] = Package::where('created_at', '=', Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d') )->limit(10);
        // $data['viajeros'] = Travel::where('created_at', '=', Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d') )->limit(10);
        $data['latest'] = Date::now('America/Argentina/Buenos_Aires')->sub('15 minutes')->format('Y-m-d H:i:s');
        $data['usuarios'] = User::where('created_at', '>=', Date::now('America/Argentina/Buenos_Aires')->sub('60 minutes')->format('Y-m-d H:i:s') )->get();
        $data['total'] = count($data['usuarios']);
        if(count($data['usuarios']) > 0){
            foreach ($data['usuarios'] as $usuario){
                $inside = array(
                    'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
                    'nombre' => $usuario->name,
                    'email' => $usuario->email,
                );
                Mail::send('emails.bienvenida', $inside, function ($message) use ($inside){
                    $message->from("info@paqueto.com.ve", "Diego @ Paqueto");
                    $message->subject($inside['nombre'].", gracias por registrarte en Paqueto");
                    //$message->tag(['tareas', 'bienvenida']);
                    $message->to($inside['email']);
                });
            }
            //$this->info('[tasks] tareas:bienvenida');
        }
        return response()->json($data);
        */
        $data['title'] = "hola";
        $data['titulo'] = "hola";
        Date::setLocale('es');
        $tiempo = "30 days";
        $diaria = Date::now('America/Argentina/Buenos_Aires')->sub($tiempo)->format('Y-m-d H:i:s');
        $data['comentarios'] = Comment::where('createdAt', '>=', $diaria )->get();
        $data['mensajes'] = Message::where('createdAt', '>=', $diaria )->get();
        $data['usuarios'] = User::where('created_at', '>=', $diaria )->get();
        $data['paquetes'] = Package::where('created', '>=', $diaria )->get();
        $data['viajeros'] = Travel::where('created_at', '>=', $diaria )->get();
        $data['fecha'] = Date::now('America/Argentina/Buenos_Aires')->format('l j F Y');
        return view('emails.actividad', $data);
    }

    public function actividad(){
        Date::setLocale('es');
        $tiempo = "7 days";
        $diaria = Date::now('America/Argentina/Buenos_Aires')->sub($tiempo)->format('Y-m-d H:i:s');
        // $data['comentarios'] = Comment::where('createdAt', '>=', $diaria )->get();
        // $data['mensajes'] = Message::where('createdAt', '>=', $diaria )->get();
        // $data['usuarios'] = User::where('created_at', '>=', $diaria )->get();
        // $data['paquetes'] = Package::where('created', '>=', $diaria )->get();
        // $data['viajeros'] = Travel::where('created_at', '>=', $diaria )->get();
        // $data['fecha'] = Date::now('America/Argentina/Buenos_Aires')->format('l j F Y');
        $comentarios = Comment::where('createdAt', '>=', $diaria )->get();
        $mensajes = Message::where('createdAt', '>=', $diaria )->get();
        $usuarios = User::where('created_at', '>=', $diaria )->get();
        $paquetes = Package::where('created', '>=', $diaria )->get();
        $viajeros = Travel::where('created_at', '>=', $diaria )->get();
        $fecha = Date::now('America/Argentina/Buenos_Aires')->format('l j F Y');
        $inside = array(
            'fecha' => $fecha,
            'comentarios' => $comentarios,
            'mensajes' => $mensajes,
            'usuarios' =>  $usuarios,
            'paquetes' =>  $paquetes,
            'viajeros' =>  $viajeros,
        );
        $data['inside'] = $inside;

        Mailgun::send('emails.actividad', $inside, function ($message) use ($inside){
            $message->from("info@paqueto.com.ve", "Mr. Pepper @ Operaciones");
            $message->subject("[paqueto] Actividad diaria: ".$inside['fecha']);
            $message->tag(['tareas', 'diarias', 'administrativas']);
            $message->to("daniel@loultimoenlaweb.com");
        });
        //return view('emails.actividad', $data);
        //return response()->json($data);
    }
}

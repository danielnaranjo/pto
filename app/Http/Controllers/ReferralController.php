<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\User;
use Request;
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

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referral $referral)
    {
        //
    }
    public function enviar(Request $request){
        $input = Request::all();
        $user_id = $input['_id'];
        $token = $input['_token'];
        $fecha = Date::now('America/Argentina/Buenos_Aires')->format('l j F Y');
        $usuario = User::find($user_id);

        $inputs = $input['emails'];
        $destinatarios = explode(",", $inputs);
        $response = [];
        for($i=0; $i<count($destinatarios);$i++){
            if(trim($destinatarios[$i])!=""){
                array_push($response, array('email' => trim($destinatarios[$i])) );
            }
        }

        foreach ($response as $res) {
            if(is_array($res)){
                $persona = $res['email'];
            } else {
                $persona = $res->pro_email;
            }
            // if(Helper::isValidEmail($persona)==1){
                $inside = array(
                    'fecha' => $fecha,
                    'nombre' => $persona,
                    'email' => $persona,
                    'usuario' => $usuario->name,
                    'correo' => $usuario->email,
                );
                Mailgun::send('emails.referidos', $inside, function ($message) use ($inside){
                    $message->from('referidos@paqueto.com.ve', $inside['usuario']);//TODO
                    $message->subject('Un amigo te ha invitado a Paqueto');
                    $message->replyTo('info@paqueto.com.ve', 'Daniel @ Paqueto');
                    $message->tag(['invitacion', 'referidos']);
                    $message->to($inside['email'], $inside['email']);
                });
            // }
            $flight = new Referral();
            $flight->name = "";
            $flight->email = $persona;
            $flight->user_id = $usuario->id;
            $flight->save();
        }
        //
        return $response;
    }
}

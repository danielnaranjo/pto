<?php

namespace App\Http\Controllers;
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

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['titulo'] = "";
        $data['_id'] = '';
        $data['results']  = DB::table('message')
            ->select('message.message_id','message.comment', 'message.createdAt')
            ->leftJoin('users','message.user_id','=','users.id')
            ->orderBy('message.createdAt','DESC')
            ->paginate(15);
        return view('pages.general', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['_id'] = '';
        $data['id'] = 0;
        $data['_controller'] = 'InmobiliariaController';
        $data['titulo'] = "Nueva administración";
        $data['ruta'] = 'inmobiliarias';
        $data['results'] = DB::table('inmobiliaria')
            ->select('inm_id','inm_nombre','inm_responsable','inm_telefono as inm_teléfono','inm_direccion as inm_dirección','inm_email','inm_asunto','inm_cuerpo','inm_firma','inm_usuario','inm_password','inm_emailresp','inm_logo','inm_web')
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
}

<?php

namespace App\Http\Controllers;
use App\Models\Travel;
use App\Models\Service;
use App\Models\Country;
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

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['titulo'] = "Explorar por destinos";
        //$data['results'] = Travel::groupBy('destination')->paginate(16);
        $data['results']   = DB::table('travel')
            //->select(DB::raw('travel.*', 'countries.name as country'))
            ->select(DB::raw('countries.name as country,countries.code, users.name, users.slug,travel.*, count(travel.destination) as viajeros, users.avatar'))
            ->leftJoin('countries','countries.country_id','=','travel.destination')
            ->leftJoin('users','travel.user_id','=','users.id')
            ->groupBy('travel.destination')
            ->paginate(16);
        Date::setLocale('es');
        return view('pages.cities', $data);
        //return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['_id'] = '';
        $data['_controller'] = 'TravelController';
        $data['titulo'] = "Nuevo viaje";
        $data['ruta'] = 'travel';

        $data['results'] = DB::table('travel')
            ->select('origin', 'destination', 'date', 'transportation', 'title', 'dimensions', 'weight', 'restrictions')
            ->limit(1)
            ->get();
        $data['origin'] = Country::select('country_id','name')->get();
        $data['destination'] = Country::select('country_id','name')->get();
        $data['required'] = [];
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
        $data = new Travel;
        $data->user_id = $request->user_id;
        $data->type = 'No especificado';
        $data->origin = $request->origin;
        $data->destination = $request->destination;
        $data->date = Date::parse($request->delivery)->format('Y-m-d H:s:i');
        $data->title = $request->title;
        $data->dimensions = $request->dimensions;
        $data->weight = $request->weight;
        $data->restrictions = $request->restrictions;
        $data->transportation = $request->transportation;
        $data->save();
        // Get ID
        $travel_id = $data->travel_id;
        $added = Travel::find($travel_id);

        Date::setLocale('es');
        $fecha = Date::now('America/Argentina/Buenos_Aires')->format('l j F Y');
        $inside = array(
            'usuario' => $added->user->name,
            'email' => $added->user->email,
            'fecha' => Date::parse($added->date)->format('d/m/Y H:s'),
            'origen' => $added->from->name,
            'destino' => $added->to->name,
            'peso' => $added->weight,
            'dimensiones' => $added->dimensions,
            'restricciones' => $added->restrictions,
        );
        Mailgun::send('emails.viaje', $inside, function ($message) use ($inside){
            $message->from("info@paqueto.com.ve", "Daniel @ Paqueto");
            $message->subject("Has publicado un viaje a ".$inside['destino']." en Paqueto");
            $message->tag(['usuarios', 'viajero']);
            $message->to($inside['email']);
        });

        return redirect()->action('TravelController@edit',['travel_id'=> $data ])->with('status', 'Información actualizada!');
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
        $data['_id'] = $id;
        $data['id'] = $id;
        $data['_controller'] = 'TravelController';
        $data['titulo'] = "Editar viaje";
        $data['ruta'] = 'travel';
        $data['results'] = DB::table('travel')
            ->select('date', 'transportation', 'title', 'dimensions', 'weight', 'restrictions')
            ->where('travel_id',$id)
            ->get();
        // $data['origin'] = Country::select('country_id','name')->get();
        // $data['destination'] = Country::select('country_id','name')->get();
        $data['required'] = [];
        return view('pages.autoform', $data );
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
        $data = Travel::find($id);
        $data->date = Date::parse($request->delivery)->format('Y-m-d H:s:i');
        $data->title = $request->title;
        $data->dimensions = $request->dimensions;
        $data->weight = $request->weight;
        $data->restrictions = $request->restrictions;
        $data->transportation = $request->transportation;
        $data->save();
        return redirect()->action('TravelController@edit',['travel_id'=> $data ])->with('status', 'Información actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id>10){
            $data = Travel::where('travel_id', $id)->update(['user_id' => 0]);
        } else {
            $data = Travel::findOrFail($id);
            $data->delete();
        }
    }
    public function pais($pais=null,$id=null)
    {
        Date::setLocale('es');
        $data['results'] = Travel::where('origin','=',$id)
            ->orWhere('destination','=',$id)
            ->paginate(16);
        $data['titulo'] = $data['results'][0]->to->name;//"Explorando ".
        return view('pages.explorer', $data);
        //return response()->json($data);
    }
    public function usuario($id)
    {
        $data['titulo'] = "Mis Viajes";
        $data['results'] = Travel::where('user_id',$id)->paginate(16);
        return view('pages.tableTravel', $data);
        return response()->json($data);
    }
}

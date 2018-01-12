<?php

namespace App\Http\Controllers;
use App\Models\Travel;
use App\Models\Service;
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
}

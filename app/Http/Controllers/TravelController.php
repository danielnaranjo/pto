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
        $data['results'] = Travel::groupBy('destination')->paginate(16);
        // $data['results']   = DB::table('travel')
        //     //->select(DB::raw('travel.*', 'countries.name as country'))
        //     ->leftJoin('countries','countries.country_id','=','travel.destination')
        //     ->groupBy('travel.destination')
        //     ->paginate(16);
        Date::setLocale('es');
        return view('pages.cities', $data);
        return response()->json($data);
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
        $data['titulo'] = "Explorar ".$pais;
        // $data['results'] = DB::table('package')
        //     ->select('package.*','service.*','users.*')
        //     ->leftJoin('service','package.service_id','=','service.service_id')
        //     ->leftJoin('users','package.user_id','=','users.id')
        //     ->where('package.origin','=',$pais)
        //     ->whereOr('package.destination','=',$pais)
        //     ->paginate(15);
        //$country = Country::where('code','=',$pais)->get();
        //$data['results'] = Package::where('origin','=',$country[0]->country_id)->whereOr('destination','=',$country[0]->country_id)->paginate(16);
        $data['results'] = Travel::where('origin','=',$id)
            ->orWhere('destination','=',$id)
            ->paginate(16);
        //return view('pages.grids', $data);
        return response()->json($data);
    }
}
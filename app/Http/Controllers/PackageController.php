<?php

namespace App\Http\Controllers;

use App\Models\Package;
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

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['titulo'] = "Envios";
        // $data['results'] = DB::table('package')
        //     ->select('package.*','service.*','users.*','countries.code as country')
        //     ->leftJoin('service','package.service_id','=','service.service_id')
        //     ->leftJoin('users','package.user_id','=','users.id')
        //     ->leftJoin('countries','package.destination','=','countries.country_id')
        //     ->paginate(16);
        $data['results'] = Package::paginate(16);
        return view('pages.grids', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['_id'] = '';
        $data['_controller'] = 'PackageController';
        $data['titulo'] = "Nuevo Paqueto Envio";
        $data['ruta'] = 'package';
        $data['results'] = DB::table('package')
            ->select('origin','destination','title','description','price')
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
        $forms = DB::table('package')
            ->select('origin','destination','title','description','price')
            ->limit(1)
            ->get();
        foreach ($forms[0] as $key => $value) {
            if (preg_match("/nombre/i", $key) || preg_match("/tipo/i", $key)){
                $label = $key;
                $fields[$label] = 'required';
            }
        }
        $mgs = [ 'required' => ':attribute es requerido.' ];
        $validator = Validator::make(Request::all(), $fields, $mgs);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        Package::create($input);
        return redirect()->action('PackageController@index')->with('status', 'Nuevo servicio agregado!');
        //return redirect('/propietarios/utiles/'.$input['uti_consorcio'])->with('status', 'Información actualizada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = Package::where('tracking','=',$id)->first();
        $id = $res->package_id;
        // $data['_id'] = $id->;
        // $data['_controller'] = 'PackageController';
        // $data['id'] = $id;
        // $data['ruta'] = 'package';
        $data['taken'] = DB::table('package_user')
            ->select('package.package_id', 'users.id')
            ->leftJoin('users','package_user.user_id','=','users.id')
            ->leftJoin('package','package_user.package_id','=','package.package_id')
            ->where('package_user.user_id', '=', Auth::user()->id)
            ->where('package_user.package_id', '=', $id)
            ->get();

        $data['results'] = Package::find($id);
        $data['images'] = DB::table('package_image')
            ->select('image.*')
            ->leftJoin('package','package.package_id','=','package_image.package_id')
            ->leftJoin('image','package_image.image_id','=','image.image_id')
            ->where('package.package_id', '=', $id)
            ->get();
        $data['titulo'] = $data['results']->title;
        Date::setLocale('es');

        $first = Carbon::parse($data['results']->delivery);
        $second = Carbon::parse('0000-00-00 00:00:00');
        $data['disponible']=$first->eq($second);
        //Date::parse($results->delivery)->eqDate::parse('0000-00-00')
        return view('pages.single', $data );
        //return response()->json($data);

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
        $data['_controller'] = 'PackageController';
        $data['id'] = $id;
        $data['titulo'] = "Editar";
        $data['ruta'] = 'package';
        $data['results'] = DB::table('package')
            ->select('origin','destination','title','description','price')
            ->where('package_id', '=', $id)
            ->get();
        return view('pages.autoform', $data );
        //return response()->json($data);
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
        $data= Package::findOrFail($package->id);
        $input = Request::all();
        $data->update($input);
        return redirect()->action('PackageController@index')->with('status', 'Información actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Package::findOrFail($id);
        $data->delete();
        return redirect()->action('PackageController@index')->with('status', 'Información actualizada!');
    }

    public function categorias($categoria=null)
    {
        $data['titulo'] = "Explorar";
        $category = Service::where('type','=',$categoria)->get();
        $data['results'] = Package::where('service_id','=',$category[0]->service_id)->paginate(16);
        //return response()->json($data);
        return view('pages.grids', $data);
    }
    public function pais($pais=null,$id=null)
    {
        $data['titulo'] = "Explorar ".$pais;
        $data['results'] = Package::where('origin','=',$id)
            ->orWhere('destination','=',$id)
            ->paginate(16);
        return view('pages.grids', $data);
        //return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Service;
use App\Models\Country;
use App\Models\PackageImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cookie;
use Session;
use Log;
use Validator;
use MessageBag;
use Carbon\Carbon;
use Date;
use Uuid;
use File;
use Mail;
use Mailgun;

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
        $data['results'] = Package::orderBy('package_id','desc')->paginate(16);
        return view('pages.grids', $data);
        // $data['results'] = Package::find(16)->image;
        // return response()->json($data);
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
        $data['countries'] = Country::select('country_id','name')->get();
        $data['services'] = Service::select('service_id','type')->get();
        $data['results'] = DB::table('package')
            ->select('*')
            ->limit(1)
            ->get();
        return view('forms.package', $data );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = Request::all();
        // $forms = DB::table('package')
        //     ->select('origin','destination','title','description','price')
        //     ->limit(1)
        //     ->get();
        // foreach ($forms[0] as $key => $value) {
        //     if (preg_match("/nombre/i", $key) || preg_match("/tipo/i", $key)){
        //         $label = $key;
        //         $fields[$label] = 'required';
        //     }
        // }
        // $mgs = [ 'required' => ':attribute es requerido.' ];
        // $validator = Validator::make(Request::all(), $fields, $mgs);
        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        //

        //Package::create($input);
        $data = new Package; //Package::find($id);
        $data->user_id = $request->user_id;
        $data->origin = $request->origin;
        $data->destination = $request->destination;
        $data->service_id = $request->service_id;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->tracking = $request->tracking;
        $data->delivery = Date::parse($request->delivery)->format('Y-m-d H:s:i');
        $data->auction = $request->auction;
        $data->currency = $request->currency;
        $data->price = $request->price;
        $data->status = 0;
        $data->save();

        // Get ID
        $package_id = $data->package_id;
        $added = Package::find($package_id);

        Date::setLocale('es');
        $fecha = Date::now('America/Argentina/Buenos_Aires')->format('l j F Y');
        $inside = array(
            'usuario' => $added->user->name,
            'email' => $added->user->email,
            'fecha' => $fecha,
            'origen' => $added->from->name,
            'destino' => $added->to->name,
            'servicio' => $added->service->type,
            'tracking' => $added->tracking,
            'entrega' => Date::parse($added->delivery)->format('d/m/Y'),
            'titulo' => $added->title,
            'contenido' => $added->description,
        );
        Mailgun::send('emails.paquete', $inside, function ($message) use ($inside){
            $message->from("no-responder@paqueto.com.ve", "Daniel @ Paqueto");
            $message->subject("Has publicado un paquete con destino ".$inside['destino']." en Paqueto");
            $message->tag(['usuarios', 'package',$inside['destino']]);
            $message->to($inside['email']);
            $message->cc($inside['email']);
        });

        return redirect()->action('PackageController@edit',['package_id'=> $data ])->with('status', 'Información actualizada!');
        //return response()->json($inside);
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
            // $data['images'] =  DB::table('package_image')
            //     ->select('image.name','image.path')
            //     ->leftJoin('image','package_image.image_id','=','image.image_id')
            //     ->where('package_image.package_id', $id)
            //     ->get();

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
        $data['titulo'] = "Editar Paqueto Envio";
        $data['ruta'] = 'package';
        // $data['service'] =  DB::table('service')->select('service_id','type')->get(); //Agrega el combo al formulario
        // $data['origin'] =  DB::table('countries')->select('country_id','name')->get(); //Agrega el combo al formulario
        // $data['destination'] =  DB::table('countries')->select('country_id','name')->get(); //Agrega el combo al formulario
        // $data['results'] = DB::table('package')
        //     ->select('package_id', 'service_id', 'origin', 'destination', 'title', 'description', 'currency', 'price', 'auction', 'delivery')
        //     ->where('package_id', '=', $id)
        //     ->get();
        //return view('pages.autoform', $data );
        //return response()->json($data);
        $data['results'] = Package::find($id);
        $data['countries'] = Country::select('country_id','name')->get();
        $data['services'] = Service::select('service_id','type')->get();
        return view('forms.package', $data );
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
        // $data= Package::findOrFail($package->id);
        // $input = Request::all();
        // $data->update($input);
        $data = Package::find($id);
        // $data->user_id = $request->user_id;
        $data->origin = $request->origin;
        $data->destination = $request->destination;
        $data->service_id = $request->service_id;
        $data->title = $request->title;
        $data->description = $request->description;
        // $data->tracking = $request->tracking;
        $data->delivery = Date::parse($request->delivery)->format('Y-m-d H:s:i');
        $data->auction = $request->auction;
        $data->currency = $request->currency;
        $data->price = $request->price;
        // $data->status = 0;
        $data->save();

        $added = Package::find($id);
        Date::setLocale('es');
        $fecha = Date::now('America/Argentina/Buenos_Aires')->format('l j F Y');
        $inside = array(
            'usuario' => $added->user->name,
            'email' => $added->user->email,
            'fecha' => $fecha,
            'origen' => $added->from->name,
            'destino' => $added->to->name,
            'servicio' => $added->service->type,
            'tracking' => $added->tracking,
            'entrega' => Date::parse($added->delivery)->format('d/m/Y'),
            'titulo' => $added->title,
            'contenido' => $added->description,
        );
        Mailgun::send('emails.paquete', $inside, function ($message) use ($inside){
            $message->from("no-responder@paqueto.com.ve", "Daniel @ Paqueto");
            $message->subject("Has actualizado tu paquete: ".$inside['titulo']." con destino ".$inside['destino']." en Paqueto");
            $message->tag(['usuarios', 'package', $inside['destino'], 'actualizado']);
            $message->to($inside['email']);
            $message->cc('info@paqueto.com.ve', 'Seguridad');
        });

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
        if(Auth::user()->id>10){
            $data = Package::where('package_id', $id)->update(['user_id' => 0]);
        } else {
            $data = Package::findOrFail($id);
            $data->delete();
        }
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
    public function uploadFile(Request $request, $id){
        //http://www.expertphp.in/article/laravel-5-cloudinary-upload-file-and-images-with-example
        $file = $request->file('file');
        $fecha = time();
        $destinationPath =  public_path('/pack');//base_path().'/public/uploads/';
        $path = $file->path(); // ej.
        $extension = $file->extension(); // ej.jpg
        //$id=date('Y_m_d');
        $filename = 'p_'.$id.'_'.$fecha.'.'.$extension;
        $file->move($destinationPath, $filename);
        $data['uploaded'] = $file;

        if(Auth::check()){
            $user = Auth::user()->id;
        } else {
            $user = 0;
        }

        if(File::exists('pack/'.$filename)){
            \Cloudder::upload('pack/'.$filename,'p_'.$id.'_'.$fecha, array(''), array('paqueto_package', 'uploaded_'.date('Y_m_d'), 'user_'.$id, 'package_'));
            $data['c']=\Cloudder::getResult();
            $data['uploaded']=true;
            $data['path']=$destinationPath.'pack/'.$filename;
            $data['img'] = DB::table('image')->insertGetId(['name' => $filename, 'path' => $data['c']['url'], 'package_id' => $id]);
            if($data['img']){
                $data['uim'] = DB::table('user_image')->insertGetId([ 'user_id' => $user, 'image_id' => $data['img'], 'type' => '1' ]);
                $data['oim'] = DB::table('package_image')->insertGetId([ 'package_id' => $id, 'image_id' => $data['img']]);
            }
        }
        $data['filename']=$filename;
        return response()->json($data);
    }
    public function usuario($id)
    {
        $data['titulo'] = "Mis Envios";
        $data['_id'] = $id;
        $data['ID'] = $id;
        $data['results'] = Package::where('user_id',$id)->paginate(16);
        return view('pages.tables', $data);
        return response()->json($data);
    }
    public function demo()
    {
        $id = 16;
        $data['results'] = Package::find($id);
        $data['images'] =  DB::table('package_image')
            ->select('image.name','image.path')
            ->leftJoin('image','package_image.image_id','=','image.image_id')
            ->where('package_image.package_id', $id)
            ->get();
        return response()->json($data);
    }
    //
}

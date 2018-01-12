<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Message;
use App\Models\Package;
use App\Models\Travel;
use App\Models\Image;
use App\Models\UserImage;

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
//use Request;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data['results']   = User::all();
        $data['results']   = DB::table('users')
            ->select('users.id','users.name','users.verified','countries.name as country','users.city','vote.upvotes','users.avatar')
            ->leftJoin('countries','countries.country_id','=','users.country')
            ->leftJoin('vote','users.id','=','vote.user_id')
            ->paginate(16);
        $data['titulo'] = "Viajeros";
        // $data['mailgun'] = ['total'=>100, 'sent'=>80, 'opened'=>15,'bounced'=>5];// TODO, viene de Mailgun
        // Date::setLocale('es');
        // $data['todayis'] = Date::now()->format('l j F Y');
        return view('pages.listado', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['_id'] = '';
        $data['_controller'] = 'UserController';
        $data['titulo'] = "Nuevo";
        $data['ruta'] = 'users';
        $data['results'] = DB::table('users')
            ->select('*')
            ->where('id', '=', $user->id)
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
        //
        $forms = DB::table('users')
            ->select('id','name', 'email')
            ->limit(1)
            ->get();
        foreach ($forms[0] as $key => $value) {
            if (preg_match("/name/i", $key) || preg_match("/email/i", $key)) { // Customizar
                $label = $key; //substr ( $key, 4, strlen($key) );
                $fields[$label] = 'required';
            }
        }
        $mgs = [ 'required' => ':attribute es requerido.' ];
        $validator = Validator::make(Request::all(), $fields, $mgs);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        User::create($input);
        return redirect()->action('UserController@index')->with('status', 'Información actualizada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //$data = DB::table('users')->select('id')->where('slug','=', $user)->toSql();
        // $id = $res->id;
        //Post::where('slug','=', $slug)->firstOrFail();
        Date::setLocale('es');
        $data['results'] = User::find($user);
        $data['comments'] = Comment::where('user_id', $user->id)->get();
        $data['travel'] = Travel::where('user_id', $user->id)->get();
        $data['packages'] = Package::where('user_id', $user->id)->get();
        $data['titulo'] = $data['results'][0]->name;
        return view('pages.profile', $data);
        //return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['_id'] = $user->id;
        $data['_controller'] = 'UserController';
        $data['id'] = $user->id;
        $data['ruta'] = 'users';
        $data['countries'] = Country::select('country_id','name')->get();
        $data['results'] = User::findOrFail($user->id);
        $data['titulo'] = "Editando ".$data['results']->name;
        Date::setLocale('es');
        return view('forms.profile', $data );
        //return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $input = Request::all();
        // $data= User::findOrFail($user->id);
        //
        // $forms = DB::table('users')
        //     ->select('id','name', 'email', 'city', 'phone')
        //     ->limit(1)
        //     ->get();
        // foreach ($forms[0] as $key => $value) {
        //     if (preg_match("/name/i", $key) || preg_match("/email/i", $key) || preg_match("/phone/i", $key)  || preg_match("/city/i", $key)) { // Customizar
        //         $label = $key;//substr ( $key, 4, strlen($key) );
        //         $fields[$label] = 'required';
        //     }
        // }
        // $mgs = [ 'required' => ':attribute es requerido.' ];
        // $validator = Validator::make(Request::all(), $fields, $mgs);
        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        // return redirect()->action('PackageController@index')->with('status', 'Información actualizada!');
        // $data->update($input);
        //
        $data = User::find($user->id); //Package::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->slug = $request->slug;
        $data->dni = $request->dni;
        $data->birthdate = Date::parse($request->birthdate)->format('Y-m-d');
        $data->updated_at = Date::now()->format('Y-m-d H:s:i');
        $data->gender = $request->gender;
        $data->city = $request->city;
        $data->province = $request->province;
        $data->country = $request->country;
        $data->save();

        return redirect('/user/'.$user->id.'/edit')->with('status', 'Información actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $data = User::findOrFail($user);
        $data->delete();
        return redirect()->action('UserController@index')->with('status', 'Información actualizada!');
    }
    public function slug($slug, $format=null)
    {
        //$id = DB::select("select * from users where slug ='".$slug."' ");
        //$id = $user->id;

        Date::setLocale('es');
        $data['results'] = User::where('slug', $slug)->first(); //User::find($id->);
        $data['comments'] = [];// Comment::where('user_id', $user->id)->get();
        $data['travel'] = [];// Travel::where('user_id', $user->id)->get();
        $data['packages'] = [];// Package::where('user_id', $user->id)->get();
        if(!$format) {
            $data['titulo'] = $data['results']->name;
            return view('pages.profile', $data);
        } else {
            return response()->json($data);
        }
    }
    public function mes()
    {
        $data = DB::table('users')
            ->select('users.id','users.name','users.verified','countries.name as country','users.city','vote.upvotes','users.slug','users.avatar')
            ->leftJoin('countries','countries.country_id','=','users.country')
            ->leftJoin('vote','users.id','=','vote.user_id')
            ->whereYear('created_at', Date::now()->format('Y') )
            ->whereMonth('created_at', Date::now()->format('m') )
            ->orderBy('users.id', 'desc')
            ->get();
        return response()->json($data);
    }
    public function semana()
    {
        $data = DB::table('users')
            ->select('users.id','users.name','users.verified','countries.name as country','users.city','vote.upvotes','users.slug','users.avatar')
            ->leftJoin('countries','countries.country_id','=','users.country')
            ->leftJoin('vote','users.id','=','vote.user_id')
            ->whereDate('created_at', Date::now()->format('Y-m-d') )
            ->get();
        return response()->json($data);
    }
    public function uploadFile(Request $request, $id){
        //http://www.expertphp.in/article/laravel-5-cloudinary-upload-file-and-images-with-example
        $file = $request->file('file');
        $fecha = time();
        $destinationPath =  public_path('/pic');//base_path().'/public/uploads/';
        $path = $file->path(); // ej.
        $extension = $file->extension(); // ej.jpg

        $filename = 'u_'.$id.'_'.$fecha.'.'.$extension;
        $file->move($destinationPath, $filename);
        $data['uploaded'] = $file;

        if(File::exists('pic/'.$filename)){
            \Cloudder::upload('pic/'.$filename,'u_'.$id.'_'.$fecha, array(''), array('paqueto_users', 'uploaded_'.date('Y_m_d'), 'user_'.$id));
            $data['c']=\Cloudder::getResult();
            $data['uploaded']=true;
            $data['path']=$destinationPath.'pic/'.$filename;

            $data['img'] = DB::table('image')->insertGetId(['name' => $filename, 'path' => $data['c']['url']]);

            if($data['img']){
                $data['uim'] = DB::table('user_image')->insertGetId([ 'user_id' => $id, 'image_id' => $data['img'], 'type' => '0' ]);
            }
        }
        $data['filename']=$filename;
        return response()->json($data);
    }
    /*
    public function upload(Request $request, $id, $campo, $tabla){

        function clean($nombre){
            $replace = array(' '=>'');
            return strtolower( strtr( $nombre, $replace) );
        }
        if($id==''){
            $id = Session::get('inmobiliaria')->inm_id;
        }
        if($tabla=='docmas'){
            $tabla = 'documentos_masivos';
        }
        if($tabla=='inmobiliarias'){
            $tabla = 'inmobiliaria';
        }

        //$file = Request::all();
        $file = $request->file('file');
        $_id = substr ( $tabla, 0, 3)."_id"; // ej. env_id
        $destinationPath =  public_path('/uploads');//base_path().'/public/uploads/';
        $path = $file->path(); // ej.
        $extension = $file->extension(); // ej.jpg

        $this->validate($request, [
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xls,xlsx|max:2048',
        ]);
        $fecha = time();
        $nombreArchivo = $id.'_'.$fecha.'.'.$extension; //ej. 300_123456.jpg //$file->getClientOriginalName();
        $file->move($destinationPath, $nombreArchivo);

        $data = DB::update('update '.$tabla.' set '.$campo.' = "'.clean($nombreArchivo).'" where '.$_id.' = ?', [$id]); // ej. update envios set env_archivo1="300_123456.jpg" where env_id=300
        $res['filename']=$nombreArchivo;
        $res['field']=$campo;
        return $res;
    }
    */
}

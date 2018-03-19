<?php
namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Message;
use App\Models\Package;
use App\Models\Travel;
use App\Models\User;

#namespace App\Http\Controllers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use Mailgun;
use Log;
#use Helper;
use Date;

class Informacion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tareas:informacion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[paqueto] Verificacion de usuarios con datos pendientes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        Date::setLocale('es');
        $usuarios = DB::table('users')
            ->select('id', 'email', 'name as nombre', 'dni as Identificación', 'birthdate as Cumpleaños', 'address as Dirección', 'phone as Teléfono', 'city as Ciudad', 'province as Estado', 'country as País', 'gender as Genero', 'avatar as Fotografia', 'slug as URL')
            ->get();
        foreach ($usuarios[0] as $key => $value) :
            $fields[] = $key;
        endforeach;
        $user = [];
        foreach ($usuarios as $usuario) :
            $user[$usuario->id] = array('id'=>$usuario->id, 'name'=>$usuario->nombre, 'email'=>$usuario->email, 'faltantes'=>array());
            foreach ($fields as $f) :
                if(!$usuario->$f) {
                    array_push($user[$usuario->id]['faltantes'],$f);
                    //Log::info('Usuarios: '. $usuario->id.' : '.$f );
                }
            endforeach;
            if(count($user[$usuario->id]['faltantes'])==0){
                unset($user[$usuario->id]);
            }
        endforeach;

        if(count($user) > 0){
            foreach ($user as $usuario){
                $inside = array(
                    'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
                    'nombre' => $usuario['name'],
                    'email' => $usuario['email'],
                    'faltantes' => $usuario['faltantes'],
                );
                Mailgun::send('emails.informacion', $inside, function ($message) use ($inside){
                    $message->from("info@paqueto.com.ve", "Daniel @ Paqueto");
                    $message->subject($inside['nombre'].", tenemos algunas cosas importantes que decirte..");
                    $message->tag(['tareas', 'info pendiente','usuarios']);
                    $message->to($inside['email']);
                });
            }
            Log::info('**************');
            Log::info('Informacion: '.Date::now('America/Argentina/Buenos_Aires')->format('l j F Y H:m') );
            Log::info('Usuarios con documentacion faltante: '. count($user) );
            Log::info('**************');
        }
    }
}

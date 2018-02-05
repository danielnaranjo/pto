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

class Actividad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tareas:actividad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de actividad diaria';

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
        $comentarios = Comment::where('createdAt', '=', Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d') );
        $mensajes = Message::where('createdAt', '=', Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d') );
        $usuarios = User::where('created_at', '=', Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d') );
        $paquetes = Package::where('created_at', '=', Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d') );
        $viajeros = Travel::where('created_at', '=', Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d') );

        $inside = array(
            'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
            'comentarios' => $comentarios,
            'mensajes' => $mensajes,
            'usuarios' => $usuarios,
            'paquetes' => $paquetes,
            'viajeros' => $viajeros
        );
        Mail::send('emails.actividad', $inside, function ($message) use ($inside){
            $message->from("no-responder@paqueto.com.ve", "Rob @ Operaciones");
            $message->subject("[paqueto] Actividad diaria");
            //$message->tag(['tareas', 'diarias', 'administrativas']);
            $message->to("info@paqueto.com.ve");
        });

        $this->info('[tasks] tareas:actividad');
    }
}

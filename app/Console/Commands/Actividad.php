<?php
namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Message;
use App\Models\Package;
use App\Models\Travel;
use App\User;

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
    protected $description = '[paqueto] Envio de actividad diaria';

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
        $tiempo = "3 days";
        $diaria = Date::now('America/Argentina/Buenos_Aires')->sub($tiempo)->format('Y-m-d H:i:s');
        $comentarios = Comment::where('createdAt', '>=', $diaria )->get();
        $mensajes = Message::where('createdAt', '>=', $diaria )->get();
        $usuarios = User::where('created_at', '>=', $diaria )->get();
        $paquetes = Package::where('created', '>=', $diaria )->get();
        $viajeros = Travel::where('created_at', '>=', $diaria )->get();

        $inside = array(
            'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
            'comentarios' => $comentarios,
            'mensajes' => $mensajes,
            'usuarios' => $usuarios,
            'paquetes' => $paquetes,
            'viajeros' => $viajeros
        );
        Mailgun::send('emails.actividad', $inside, function ($message) use ($inside){
            $message->from("no-responder@paqueto.com.ve", "Rob @ Operaciones");
            $message->subject("[paqueto] Actividad diaria");
            $message->tag(['tareas', 'diarias', 'administrativas']);
            $message->to("info@paqueto.com.ve");
        });

        $this->info('[tasks] tareas:actividad');
    }
}

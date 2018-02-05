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

class Bienvenida extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tareas:bienvenida';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de bienvenida a usuarios';

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
        $data['usuarios'] = User::where('created_at', '>=', Date::now('America/Argentina/Buenos_Aires')->sub('60 minutes')->format('Y-m-d H:i:s') )->get();
        $data['total'] = count($data['usuarios']);
        if(count($data['usuarios']) > 0){
            foreach ($data['usuarios'] as $usuario){
                $inside = array(
                    'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
                    'nombre' => $usuario->name,
                    'email' => $usuario->email,
                );
                Mailgun::send('emails.bienvenida', $inside, function ($message) use ($inside){
                    $message->from("info@paqueto.com.ve", "Diego @ Paqueto");
                    $message->subject($inside['nombre'].", gracias por registrarte en Paqueto");
                    $message->tag(['tareas', 'bienvenida','usuarios']);
                    $message->to($inside['email']);
                });
            }
            $this->info('[tasks] tareas:bienvenida');
        }
    }
}

<?php

namespace App\Console\Commands;
use App\Models\User;
use App\Models\Travel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use Mailgun;
use Log;
#use Helper;
use Date;

class Viajeros extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'viajeros:destino';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[paqueto] Viajeros con destinos relacionados';

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
    public function handle()
    {
        Date::setLocale('es');
        $viaje = Date::now('America/Argentina/Buenos_Aires')->format('Y-m-d H:i:s');//
        $users = User::all();
        if(count($users)>0):
            foreach ($users as $user) :
                //Log::info(' @ '. $user->id);
                $viajeros = Travel::where('date','>=', $viaje)
                    ->where('destination', $user->country)
                    ->where('user_id', '!=', $user->id)
                    ->where('status', 0)
                    ->get();
                if(count($viajeros)>0):
                    //Log::info(' @@ '. $user->id .'@@'. $user->country .'@@'. $viajeros[0]->destination);
                    $inside = array(
                        'usuario' => $user->name,
                        'email' => $user->email,
                        'viajeros' => $viajeros,
                        'destino' => $user->location->name,
                    );
                    Mailgun::send('emails.viajeros', $inside, function ($message) use ($inside){
                        $message->from("no-responder@paqueto.com.ve", "Daniel @ Paqueto");
                        $message->subject($inside['usuario']." hemos encontrado algunos viajeros que van a ".$inside['destino']);
                        $message->tag(['viajeros', 'destinos', 'usuarios',$inside['destino']]);
                        $message->to($inside['email']);
                    });
                    //Log::info(' @ '. json_encode($inside) );
                endif;
            endforeach;
        endif;
        Log::info('************** ');
        Log::info('Viajeros:destinos: '.Date::now('America/Argentina/Buenos_Aires')->format('l j F Y H:m') );
        Log::info('************** ');
    }
}

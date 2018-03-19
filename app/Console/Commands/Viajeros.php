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
        $travellers = Travel::where('date','>=', $viaje)->groupBy('destination')->get();

        if(count($travellers)>0) :
            foreach ($travellers as $travel) :
                $users = User::select('name','email')->where('country', $travel->destination)->get();
                if(count($users)>0):
                    //$data['travel'][] = array('destino'=>$travel, 'users'=> $users);
                    foreach ($users as $user) :
                        $inside = array(
                            'usuario' => $user->name,
                            'email' => $user->email,
                            'travel' => $travel,
                            'destino' => $travel->to->name,
                        );
                        Mail::send('emails.viajeros', $inside, function ($message) use ($inside){
                            $message->from("no-responder@paqueto.com.ve", "Carol @ Paqueto");
                            $message->subject("Hemos encontrado algunos viajeros que van a ".$inside['destino']." ".$inside['usuario']);
                            //$message->tag(['chats', 'hora', 'usuarios']);
                            $message->to($inside['email']);
                        });
                        Log::info('************** '. json_encode($inside));
                    endforeach;
                endif;
            endforeach;
        endif;
    }
}

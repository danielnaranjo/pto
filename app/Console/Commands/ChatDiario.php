<?php

namespace App\Console\Commands;
use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use Mailgun;
use Log;
#use Helper;
use Date;

class ChatDiario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:diario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[paqueto] Envio de resumen del dia';

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
        $tiempo = "1 days";
        $diaria = Date::now('America/Argentina/Buenos_Aires')->sub($tiempo)->format('Y-m-d H:i:s');//
        $mensajes = Message::where('createdAt','>=',$diaria)->get();
        $total = Message::where('createdAt','>=', $diaria )->count();

        if($total>0) :
            foreach ($mensajes as $mensaje) :
                $usuario = $mensaje->user->name;
                $messages = json_encode($mensaje);
                $inside = array(
                    'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
                    'usuario' => $usuario,
                    'mensajes' => $messages,
                );
                // Mail::send('emails.resumen', $inside, function ($message) use ($inside){
                //     $message->from("no-responder@paqueto.com.ve", "Carol @ Paqueto");
                //     $message->subject("[paqueto] Resumen de conversaciones de ".$inside['fecha']);
                //     //$message->tag(['chats', 'resumen', 'usuarios']);
                //     $message->to("info@paqueto.com.ve");
                // });
            endforeach;

            Log::info('************** ');
            Log::info('Chat:resumen: '.Date::now('America/Argentina/Buenos_Aires')->format('l j F Y H:m') );
            Log::info('Conversaciones: '. $total );
            Log::info('************** ');
        endif;
    }
}

<?php

namespace App\Console\Commands;
use App\Models\Message;
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

class ChatHora extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:resumen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de resumen de la ultima hora';

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
        $tiempo = "3 days";
        $diaria = Date::now('America/Argentina/Buenos_Aires')->sub($tiempo)->format('Y-m-d H:i:s');
        $mensajes = Message::where('createdAt', '>=', $diaria )->get();

        // $inside = array(
        //     'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
        //     'mensajes' => $mensajes,
        // );
        // Mail::send('emails.chats', $inside, function ($message) use ($inside){
        //     $message->from("no-responder@paqueto.com.ve", "Carol @ Paqueto");
        //     $message->subject("[paqueto] Has recibido mensajes en el chat");
        //     //$message->tag(['chats', 'hora', 'usuarios']);
        //     $message->to("info@paqueto.com.ve");
        // });

        Log::info('**************');
        Log::info('Chat:hora '.Date::now('America/Argentina/Buenos_Aires')->format('l j F Y H:m') );
        Log::info('Conversaciones: '. count($user) );
        Log::info('**************');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ChatDiario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $diaria = Date::now('America/Argentina/Buenos_Aires')->sub($tiempo)->format('Y-m-d H:i:s');
        $mensajes = Message::where('createdAt', '>=', $diaria )->get();

        // $inside = array(
        //     'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
        //     'mensajes' => $mensajes,
        // );
        // Mail::send('emails.resumen', $inside, function ($message) use ($inside){
        //     $message->from("no-responder@paqueto.com.ve", "Carol @ Paqueto");
        //     $message->subject("[paqueto] Resumen de conversaciones de ".$inside['fecha']);
        //     //$message->tag(['chats', 'resumen', 'usuarios']);
        //     $message->to("info@paqueto.com.ve");
        // });

        Log::info('**************');
        Log::info('Chat:resumen: '.Date::now('America/Argentina/Buenos_Aires')->format('l j F Y H:m') );
        Log::info('Conversaciones: '. count($user) );
        Log::info('**************');
    }
}

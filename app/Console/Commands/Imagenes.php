<?php
namespace App\Console\Commands;

use App\Models\Image;

#namespace App\Http\Controllers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use Mailgun;
use Log;
#use Helper;
use Date;

class Imagenes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tareas:imagenes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de imagenes cargadas del dia';

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
        $tiempo = "10 days";
        $diaria = Date::now('America/Argentina/Buenos_Aires')->sub($tiempo)->format('Y-m-d H:i:s');
        $imagenes = Image::where('created', '>=', $diaria )->get();

        $inside = array(
            'fecha' => Date::now('America/Argentina/Buenos_Aires')->format('l j F Y'),
            'imagenes' => $imagenes
        );

        Mail::send('emails.imagenes', $inside, function ($message) use ($inside){
            $message->from("no-responder@paqueto.com.ve", "Rob @ Operaciones");
            $message->subject("[paqueto] Imagenes diarias");
            //$message->tag(['tareas', 'diarias', 'imagenes']);
            $message->to("info@paqueto.com.ve");
        });

        $this->info('[tasks] tareas:imagenes');
    }
}

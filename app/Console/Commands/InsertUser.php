<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class InsertUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::create([
            'username' => 'emilio_reyes',
            'code'=>'testcode',
            'cedula'=>'0922435631',
            'email' => 'estodo@mail.com',
            'password' => bcrypt('Aleatorio123!') ,
            'id_role' => 1,  
            'status' => 1,  

          ]);
        
          $this->info('EL COMANDO INSERTO EL USUARIO!');
    }
     //para ejecutar -> abre una consola y escribe
    // php artisan app:insert-user 
}

<?php

namespace App\Console\Commands;

use App\Models\Rol;
use Illuminate\Console\Command;

class InsertRols extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-rols';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'INSERTA ROLES INICALES';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $rol = Rol::create(['role_name' => 'ADMIN','status'=>1]);
        $rol = Rol::create(['role_name' => 'SELLER','status'=>1]);
        $this->info('EL COMANDO INSERTO LOS ROLES!');
    }

    //para ejecutar -> abre una consola y escribe
    // php artisan app:insert-rols                          

}

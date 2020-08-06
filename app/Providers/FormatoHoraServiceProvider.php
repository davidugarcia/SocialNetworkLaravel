<?php
// se creo en la consola con el comando php artisan provider FormatoHoraServiceProvider
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormatoHoraServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //se coloca el path del helpers a utilizar Helpers/FormatoHora.php
        require_once app_path() . '/Helpers/FormatoHora.php';
        /*nota: luego se debe ir ala carpeta config/app.php para realizar ajustes
        en la parte de providers se coloca App\Providers\FormatoHoraServiceProvider::class,
        luego en la aliases se coloca 'FormatoHora' => App\Helpers\FormatoHora::class,
        luego se dirige uno ala view donde se usara el helpers en este caso en home.blade.php y detalle.blade.php
        de esta manera se llama ala clase y luego el metodo relacionado con el metodo de index con el foreach de la vista 
        {{' | '.\FormatoHora::LongTimeFilter($imagen->created_at)}}
        */
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

documentacion de cosas no comunes.

////////como crear un helpers
1. se crea la carpeta helper con el archivo name.php dentro de app
2. se crea un provider con el comando en la consola php artisan provider FormatoHoraServiceProvider
3. dentro del metodo register del archivo creado provider se coloca el require_once app_path() . '/Helpers/FormatoHora.php'; ruta para llamar el archivo helpers que contiene el file
4. luego se debe ir ala carpeta config/app.php para realizar ajustes
en la parte de providers se coloca App\Providers\FormatoHoraServiceProvider::class,
luego en la aliases se coloca 'FormatoHora' => App\Helpers\FormatoHora::class,        
5. de esta manera se llama ala clase y luego el metodo relacionado con el metodo de index con el foreach de la vista {{' | '.\FormatoHora::LongTimeFilter($imagen->created_at)}} o donde se va a utilizar

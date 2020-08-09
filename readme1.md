documentacion pasos no comunes.

////////como crear un helpers

este archivo helpers nos permitira poder manipular el la fecha y ver desde cuando se creo la publicacion de la img.

1. se crea la carpeta helper con el archivo name.php dentro de app
2. se crea un provider con el comando en la consola php artisan provider FormatoHoraServiceProvider
3. dentro del metodo register del archivo creado provider se coloca el require_once app_path() . '/Helpers/FormatoHora.php'; ruta para llamar el archivo helpers que contiene el file
4. luego se debe ir ala carpeta config/app.php para realizar ajustes
en la parte de providers se coloca App\Providers\FormatoHoraServiceProvider::class,
luego en la aliases se coloca 'FormatoHora' => App\Helpers\FormatoHora::class,        
5. de esta manera se llama ala clase y luego el metodo relacionado con el metodo de index con el foreach de la vista {{' | '.\FormatoHora::LongTimeFilter($imagen->created_at)}} o donde se va a utilizar


//////utilizando JSON

para boton de like y dislike de una img

1. se colocan en la view donde tendremos las imgs de like y dislike (maquetamos).
2. luego se le agrega una clase donde contara con los estilos que manipulremos atraves de el DOM y evento click.
3. luego se le agrega el atributo data-id="{{$imagen->id}}" en este caso es el id de la img de la tabla images.
4. se crea en un archivo de javascript donde contara con el codigo que manipulara el DOM atravez de evento click
5. se vincula este archivo con el archivo donde estamos maquetando.
6. se crea la ruta en el archivo web para que te dirija a los controladores de like y dislike.
7. se crean los controladores megustacontroller y sus metodos like y dislike con sus codificacion o acciones que realizaran cuando ocurre el evento.
8. al final en el cntrolador de like y dislike enviara una repueta JSON para que sea revida por el archivo de JS y asi poder confirmar si se realizo la accion.
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use App\Image;

Route::get('/', function ()
{

    /*$images = Image::all();
	foreach($images as $image){
		echo $image->image_path."<br/>";
		echo $image->description."<br/>";
		echo $image->user->name.' '.$image->user->surname.'<br/>';
		
		if(count($image->comments) >= 1){
			echo '<h4>Comentarios</h4>';
			foreach($image->comments as $comment){
				echo $comment->user->name.' '.$comment->user->surname.': ';
				echo $comment->content.'<br/>';
			}
		}
		
		echo 'LIKES: '.count($image->likes);
		echo "<hr/>";
	}
	
	die();
*/
   return view('welcome');
});

Auth::routes();
// home principal
Route::get('/', 'HomeController@index')->name('home');

//USERS
//ruta para configuraciones -- link en view app.blade.php el controlador te envia a la view usuario/config.php
Route::get('/configuraciones', 'usuarioController@config')->name('config');
//datos de formu de config.blade.php los envia al controlador usuario metodo update
Route::post('/user/update', 'usuarioController@update')->name('user.update');
//rutas para obtener la img de las carpeta storage del usuario por medio del controlador y asi colocarlas en la view de home.blade.php y el formul de config.blade.php
Route::get('/user/avatar/{filename}', 'usuarioController@getImage')->name('user.avatar');
//
Route::get('/perfil/{id}', 'usuarioController@perfiluser')->name('perfiluser');


//IMAGEN
//link en view app.blade.php, el controlador te envia ala view createimg.blade.php formulario para crear una img y descripcion
Route::get('/subir/imagen', 'ImageController@createimg')->name('image.create');
//envia los datos del view createimg.blade.php formulario al controlador para guarda una img con su descripcion creada por el user 
Route::post('/image/guardar', 'ImageController@saveimg')->name('image.guardar');
//ruta para poder mostrar las imagenes del disk imagenes en la view home.blade.php
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
//ruta para mostrar la view de detalle.blade.php el link esta en la view home.blade.php
Route::get('/imagen/{id}', 'ImageController@detalles')->name('image.detalle');


// COMENTARIO
//ruta para guarda el comentario atraves de el controlador y el metodo getcomentario, el formulario esta en la view detalle.blade.php
Route::post('/comentario/guardar', 'ComentarioController@getcomentario')->name('comentario.guardar');
//esta ruta nos dirige a un controlador para eliminar el comentario
Route::get('/comentario/eliminar/{id}', 'ComentarioController@eliminar')->name('comentario.eliminar');

// LIKE
Route::get('/like/{image_id}', 'MegustaController@like')->name('megusta.guardar');
Route::get('/dislike/{image_id}', 'MegustaController@dislike')->name('megusta.borrar');
//ruta para mostrar la view l imge de like en favorito, el link esta en app.blade.php 
Route::get('/likes', 'MegustaController@index')->name('Megusta');
/*

Route::get('/gente/{search?}', 'UserController@index')->name('user.index');

// IMAGEN

Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'ImageController@update')->name('image.update');

// LIKE


*/
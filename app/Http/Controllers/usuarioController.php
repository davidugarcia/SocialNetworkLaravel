<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//se llaman estos archivos para utilizar sus metodos en el codigo
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
//modelo user
use App\User;

class usuarioController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function index($search = null){
		//datos provenientes de la ruta de buscar en la view usuario/index.blade.php
		if(!empty($search)){
			$users = User::where('nick', 'LIKE', '%'.$search.'%')
							->orWhere('name', 'LIKE', '%'.$search.'%')
							->orWhere('surname', 'LIKE', '%'.$search.'%')
							->orderBy('id', 'desc')
							->paginate(5);
		}else{
			$users = User::orderBy('id', 'desc')->paginate(5);
		}
		
		return view('usuario.index',[
			'users' => $users
		]);
	}  
	

    public function config(){
		return view('usuario.config');
	}

	public function update(Request $request){
		
		// Conseguir usuario identificado de la tabla users con el metodo auth
		$user = \Auth::user();
		$id = $user->id;

		/*
		$image_path = $request->file('image_path');
		$image_path_name = $image_path->getClientOriginalName();
		var_dump($image_path);
		var_dump($image_path_name);
		die();
		*/

		// Validación de los datos del formulario de la vista config.blade.php
		$validate = $this->validate($request, [
         'name' => 'required|string|max:255',
			'surname' => 'required|string|max:255',
			//el nick de la tabla users debe ser unico o el mismo si es el mismo usuario
			'nick' => 'required|string|max:255|unique:users,nick,'.$id,
			//el email debe ser unico o el mismo si es el mismo usuario
         'email' => 'required|string|email|max:255|unique:users,email,'.$id
		]);
		
		// Recoger datos validados
		$name = $request->input('name');
		$surname = $request->input('surname');
		$nick = $request->input('nick');
		$email = $request->input('email');
		/*
		var_dump($id);
		var_dump($name);
		var_dump($surname);
		var_dump($nick);
		var_dump($email);
		die();
		*/

		$user->name = $name;
		$user->surname = $surname;
		$user->nick = $nick;
		$user->email = $email;
	
		// Subir la imagen
		$image_path = $request->file('image_path');
		
		if($image_path){
			// Poner nombre unicos
			$image_path_name = time().$image_path->getClientOriginalName();
			// Guardar en la carpeta storage (storage/app/usuarios/y la imagen guardada)
			//solo imagenes png
			Storage::disk('users')->put($image_path_name, File::get($image_path));
			// Seteo el nombre de la imagen en el objeto
			//se inserta el nombre de la img en la entidad image en la tabla users
			$user->image = $image_path_name;
		}

		//Actualiza en la base de datos, tabla users
		$user->update();
		
		//redireccion ala ruta especificada en route web.php
		return redirect()->route('config')
						//mensaje que deseamos que muestre cuando se actualiza los datos en config.blade.php
						->with(['message'=>'Usuario actualizado correctamente']);
	}

	//obtiene la imagen para mostrarla en el navbar y en la view config.php del user
	public function getImage($filename){
		$file = Storage::disk('users')->get($filename);
		return new Response($file, 200);
	}

	
	public function perfiluser($id){
		$user = User::find($id);
		
		return view('usuario.perfil', [
			'usuario' => $user
		]);
	}

}

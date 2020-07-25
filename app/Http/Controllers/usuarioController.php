<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usuarioController extends Controller
{
    public function config(){
		return view('usuario.config');
	}

	public function update(Request $request){
		
		// Conseguir usuario identificado de la tabla users con el metodo auth
		$user = \Auth::user();
		$id = $user->id;

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
		die();*/

		$user->name = $name;
		$user->surname = $surname;
		$user->nick = $nick;
		$user->email = $email;

		// Ejecutar consulta y cambios en la base de datos
		$user->update();
		
		//redireccion ala ruta especificada en route web.php
		return redirect()->route('config')
						//mensaje que deseamos que muestre cuando se actualiza los datos en config.blade.php
						 ->with(['message'=>'Usuario actualizado correctamente']);

	}
}

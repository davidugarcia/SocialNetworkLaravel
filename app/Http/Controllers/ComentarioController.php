<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class ComentarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getcomentario(Request $request){

        // Validación
        //datos provenientes de la view detalle.blade.php
		$validate = $this->validate($request, [
			'image_id' => 'integer|required',
			'contenido' => 'string|required'
        ]);
        
        // Recoger datos
		$user = \Auth::user();
		$image_id = $request->input('image_id');
        $content = $request->input('contenido');
        
        // Asigno los valores a mi nuevo objeto a guardar
		$comment = new Comment();
		$comment->user_id = $user->id;
		$comment->image_id = $image_id;
		$comment->content = $content;
		
        // Guardar en la bd
        $comment->save();
        
        // Redirección
		return redirect()->route('image.detalle', ['id' => $image_id])
        ->with([
           'message' => 'Has publicado tu comentario correctamente!!'
        ]);
    }


}

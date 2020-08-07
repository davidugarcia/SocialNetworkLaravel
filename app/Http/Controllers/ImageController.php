<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//clase storege para guardar file en la carpeta
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
//modelos para la conexion de la database
use App\Image;
use App\Comment;
use App\Like;


class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	
	public function createimg(){
        //presenta la vista en la carpeta file create
		return view('image.createimg');
    }
    
    public function saveimg(Request $request){
		
		//Validación
		$validate = $this->validate($request, [
            //regrla de validacion de que sean solo formato o file de imagen
			'imagen'  => 'required|image',
			'descripcion' => 'required'
		]);
		
		// Recoger datos
		$image_path = $request->file('imagen');
		$description = $request->input('descripcion');
		
		// llama al modelo user de autenticacion
		$user = \Auth::user();
		// el modelo image se coloca el path
		$image = new Image();
		//inseta en los campos de la tabla images
		//si el user_id de la tabla image es igual al id de la table user
		$image->user_id = $user->id;
		$image->description = $description;
		
		// Subir fichero al storage/app/images 
		if($image_path){

         $image_path_name = time().$image_path->getClientOriginalName();
         //para guarda la imagen se configura un disco en la carpeta config/filesystem.php 
			Storage::disk('images')->put($image_path_name, File::get($image_path));

			$image->image_path = $image_path_name;

		}
		
		//guarda la img en la database tabla Images
		$image->save();
		
		return redirect()->route('home')
								->with(['message' => 'La foto ha sido subida correctamente!!']);
	}

	public function getImage($filename){
		$file = Storage::disk('images')->get($filename);
		return new Response($file, 200);
	}

	public function detalles($id){
		//extrae los registro por medio del parametro $id
		$image = Image::find($id);
		//te envia ala view image/detalle.blade.php
		//no se utiliza  en la view un foreach por solo contiene un registro por medio del id
		return view('image.detalle',[
			'imagen' => $image
		]);

	}



}

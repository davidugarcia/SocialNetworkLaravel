<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//se utiliza del modelo Image con los registros de la tabla images
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //este metodo solo dara acceso a los usuarios que estan identificados 
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //se trae todo el objeto del file Image de modelo
        //se utiliza el objeto pagination por cinco elementos por paginas
        $images = Image::orderBy('id', 'desc')->paginate(5);
        return view('home', [
			'images' => $images
		]);
    }
}
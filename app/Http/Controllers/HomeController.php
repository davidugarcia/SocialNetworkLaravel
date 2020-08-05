<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $images = Image::orderBy('id', 'desc')->get();//paginate(5);
        return view('home', [
			'images' => $images
		]);
    }
}
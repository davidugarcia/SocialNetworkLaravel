@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

			<h1>Mis imagenes favoritas</h1>
			<hr/>
			
            @foreach($likess as $like)
            <!--proviene de la controlador Megustacontroller metodo index-->
            <!--la palabra image invoca el metodo del modelo like para poder referenciarlo 
                y poder utilizar los mismo campo del objeto del view home y asi utilizar la view de image.blade.php.
               que alista la imagenes a cual le has dato like--> 
               @include('includes.image',['imagen'=>$like->image])
		    @endforeach
			
			<!-- PAGINACION -->
			<div class="clearfix"></div>
			{{$likess->links()}}
        </div>
    </div>
</div>
@endsection

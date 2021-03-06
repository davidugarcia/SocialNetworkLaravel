@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">

      <div class="col-md-8">

         @include('includes.message')

         <!--la variable $images proviene del controlador Home metodo index-->
         @foreach($imagess as $imagen)
            @include('includes.image',['img'=>$imagen])
         @endforeach

         <div class="clearfix"></div>
         {{$imagess->links()}}
      </div>

   </div>
</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">

      <div class="col-md-8">

         <!--la variable $images proviene del controlador Home metodo index-->
         @foreach($images as $imagen)
             @include('includes.image',['image'=>$imagen])
         @endforeach

         <div class="clearfix"></div>
         {{$images->links()}}
      </div>

   </div>
</div>

@endsection
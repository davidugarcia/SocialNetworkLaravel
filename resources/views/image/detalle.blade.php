@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-10">

         @include('includes.message')

         <div class="card pub_image pub_image_detail">
            <div class="card-header">

               <div class="container-avatar">
                  <img src="{{ route('user.avatar',['filename'=>$imagen->user->image]) }}" class="avatar" />
               </div>

               <!--la variable $imagen proviene del controlador Image metodo detalles-->
               <div class="data-user">
                  {{$imagen->user->name.' '.$imagen->user->surname}}
                  <span class="nickname">
                     {{' | @'.$imagen->user->nick}}
                  </span>
               </div>
            </div>

            <div class="card-body">
               <div class="image-container image-detail">
                  <img src="{{ route('image.file',['filename' => $imagen->image_path]) }}" />
               </div>

               <div class="description">
                  <span class="nickname">{{'@'.$imagen->user->nick}} </span>
                  <span class="nickname date">{{' | '.\FormatoHora::LongTimeFilter($imagen->created_at)}}</span>
                  <p>{{$imagen->description}}</p>
               </div>

               <div class="likes">
                  <img src="{{asset('img/heart-black.png')}}" data-id="" class="btn-like" />
               </div>

               <div class="clearfix"></div>
               <div class="comments">

                  <h2>Comentarios ({{count($imagen->comments)}})</h2>
                  <hr>

                  <!--form para realizar un cmentario de la img-->
                  <form method="POST" action="{{ route('comentario.guardar')}}">
                     @csrf
                     
                     <!--este input almacena el id que viene en el objeto imagen-->
                     <input type="hidden" name="image_id" value="{{$imagen->id}}" />
                     <p>
                        <textarea class="form-control {{ $errors->has('contenido') ? 'is-invalid' : '' }}"
                           name="contenido"></textarea>
                        @if($errors->has('contenido'))
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('contenido') }}</strong>
                        </span>
                        @endif
                     </p>
                     <button type="submit" class="btn btn-success">
                        Comentar
                     </button>
                  </form>

               </div>

            </div>

         </div>
      </div>

      @endsection
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">

      <div class="col-md-8">

         <!--la variable $images proviene del controlador Home metodo index-->
         @foreach($images as $imagen)


         <div class="card pub_image">

            <div class="card-header">

               @if($imagen->user->image)
               <div class="container-avatar">
                  <img src="{{ route('user.avatar',['filename'=>$imagen->user->image]) }}" class="avatar" alt="" />
               </div>
               @endif

               <div class="data-user">
                  <a href="{{ route('image.detalle',['id' => $imagen->id])  }}">
                     {{$imagen->user->name.' '.$imagen->user->surname}}
                     <span class="nickname">
                        {{' | @'.$imagen->user->nick}}
                     </span>
                  </a>
               </div>
            </div>

            <div class="card-body">
               <div class="image-container">
                  <img src="{{ route('image.file',['filename' => $imagen->image_path]) }}" />
               </div>

               <div class="description">
                  <span class="nickname">{{'@'.$imagen->user->nick}} </span>
                  <span class="nickname date">{{' | '.\FormatoHora::LongTimeFilter($imagen->created_at)}}</span>
                  <p>{{$imagen->description}}</p>
               </div>

               <div class="likes">
                  <img src="{{asset('img/heart-black.png')}}" data-id="" class="btn-dislike" />
               </div>


               <div class="comments">
                  <a href="" class="btn btn-sm btn-warning btn-comments">
                     Comentarios ({{count($imagen->comments)}})
                  </a>
               </div>
            </div>

         </div>
         @endforeach

         <div class="clearfix"></div>
         {{$images->links()}}
      </div>

   </div>
</div>

@endsection
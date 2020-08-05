@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      
      <div class="col-md-8">


         @foreach($images as $imagen)


         <div class="card pub_image">

            <div class="card-header">

               @if($imagen->user->image)
               <div class="container-avatar">
                  <img src="{{ route('user.avatar',['filename'=>$imagen->user->image]) }}" class="avatar" alt="" />
               </div>
               @endif

               <div class="data-user">
                  <a href="">
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
                  <p>{{$imagen->description}}</p>
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
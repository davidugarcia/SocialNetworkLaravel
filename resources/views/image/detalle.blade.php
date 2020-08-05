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
                  <p>{{$imagen->description}}</p>
               </div>

               <div class="likes">
                  <img src="{{asset('img/heart-black.png')}}" data-id="" class="btn-like" />
               </div>

            </div>


         </div>

      </div>
   </div>
   @endsection
<div class="card pub_image">

   <div class="card-header">

      @if($imagen->user->image)
      <div class="container-avatar">
         <!--ruta para obtener la img de perfil en el disk storage/app/user-->
         <img src="{{ route('user.avatar',['filename'=>$imagen->user->image]) }}" class="avatar" alt="" />
      </div>
      @endif

      <div class="data-user">
         <a href="{{ route('perfiluser', ['id' => $imagen->user->id])}}">
            {{$imagen->user->name.' '.$imagen->user->surname}}
            <span class="nickname">
               {{' | @'.$imagen->user->nick}}
            </span>
         </a>
      </div>
   </div>

   <div class="card-body">
      <div class="image-container">
         <!--ruta para obtener la img del disk storage/app/images-->
         <img src="{{ route('image.file',['filename' => $imagen->image_path]) }}" />
      </div>

      <div class="description">
         <span class="nickname">{{'@'.$imagen->user->nick}} </span>
         <span class="nickname date">{{' | '.\FormatoHora::LongTimeFilter($imagen->created_at)}}</span>
         <p>{{$imagen->description}}</p>
      </div>

      <div class="likes">

         <!-- Comprobar si el usuario le dio like a la imagen -->
         <?php $user_like = false; ?>
         @foreach($imagen->likes as $like)
         @if($like->user->id == Auth::user()->id)
         <?php $user_like = true; ?>
         @endif
         @endforeach

         @if($user_like)
         <img src="{{asset('img/heart-red.png')}}" data-id="{{$imagen->id}}" class="btn-dislike" />
         @else
         <img src="{{asset('img/heart-black.png')}}" data-id="{{$imagen->id}}" class="btn-like" />
         @endif

         <span class="number_likes">{{count($imagen->likes)}}</span>
      </div>


      <div class="comments">
         <a href="{{ route('image.detalle',['id' => $imagen->id])}}" class="btn btn-sm btn-warning btn-comments">
            Comentarios ({{count($imagen->comments)}})
         </a>
      </div>
   </div>

</div>
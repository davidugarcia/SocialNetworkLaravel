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

               @if(Auth::user() && Auth::user()->id == $imagen->user->id)

					<div class="actions">
						<a href="{{ route('image.editar', ['id' => $imagen->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>
						<!--<a href="{{ route('image.eliminar', ['id' => $imagen->id]) }}" class="btn btn-sm btn-danger">Borrar</a>-->

						<!-- Button to Open the Modal -->
						<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
							Eliminar
						</button>

						<!-- The Modal -->
						<div class="modal" id="myModal">
							<div class="modal-dialog">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">¿Estas seguro?</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										Si eliminar esta imagen nunca podrás recuperarla, ¿estas seguro de querer borrarla?
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
										<a href="{{ route('image.eliminar', ['id' => $imagen->id]) }}" class="btn btn-danger">Borrar definitivamente</a>
									</div>

								</div>
							</div>
						</div>
					</div>
					@endif
               
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

                  <hr>

                  @foreach($imagen->comments as $comentario)

                  <div class="comment">

                     <span class="nickname">{{'@'.$comentario->user->nick}} </span>
                     <span class="nickname date">{{' | '.\FormatoHora::LongTimeFilter($comentario->created_at)}}</span>
                     <p>{{$comentario->content}}<br />
                        <!--condicional para poder eliminar el comentario-->
                        @if(Auth::check() && ($comentario->user_id == Auth::user()->id || $comentario->image->user_id ==
                        Auth::user()->id))
                        <a href="{{ route('comentario.eliminar', ['id' => $comentario->id]) }}"
                           class="btn btn-sm btn-danger">
                           Eliminar
                        </a>
                        @endif
                     </p>
                  </div>

                  @endforeach

               </div>

            </div>

         </div>

      </div>

      @endsection
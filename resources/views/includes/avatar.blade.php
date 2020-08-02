<!--si existe una imagen en el usuario mostrarla-->

@if(Auth::user()->image)
	<div class="container-avatar">
		<!--hrfe para obtener la imagen en la carpeta storage atraves de la clase del objeto user-->
		<img src="{{ route('user.avatar',['filename'=>Auth::user()->image]) }}" class="avatar" />
	</div>
@endif

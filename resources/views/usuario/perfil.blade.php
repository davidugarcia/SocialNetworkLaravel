@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			
			<div class="profile-user">
			
				@if($usuario->image)
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=>$usuario->image]) }}" class="avatar" />
					</div>
				@endif
				
				<div class="user-info">
					<h1>{{'@'.$usuario->nick}}</h1>
					<h2>{{$usuario->name .' '. $usuario->surname}}</h2>
					<p>{{'Se unió: '.\FormatoHora::LongTimeFilter($usuario->created_at)}}</p>
				</div>
				
				<div class="clearfix"></div>
				<hr>
			</div>
			
			<div class="clearfix"></div>
			
			@foreach($usuario->images as $image)
				@include('includes.image',['imagen'=>$image])
			@endforeach

	
        </div>

    </div>
</div>
@endsection
@extends('layout.dashboard')

@section('title', 'Dashboard | Agregar Categorias')

@section('content')

	{{-- include menu bar --}}
	 @include('layout.parts.menu')
	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="#">Home</a></li>
				    <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorias</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Agregar Categoria</li>
				  </ol>
				</nav>
			</div>
		</div>
		<form method="POST" action="{{ route('categorias.store') }}">
			{!! csrf_field() !!}
		  	<div class="panel panel-default">
				<div class="panel-heading">
			    	<button type="submit" class="btn btn-default btn-outline-dark btn-sm shadow" id="btnGU1"><i class="fa fa-save position-left"></i> Guardar</button>
			    	<button type="button" class="btn btn-default btn-outline-dark btn-sm shadow" id="btnCO2" onclick="location.href='{{ route("categorias.index") }}'"><i class="fa fa-list-ul position-left"></i> Consulta</button>
				</div>
		    	<div class="panel-body">

					@if ($errors->any())
					  <div class="alert alert-danger">
					      <ul>
					          @foreach ($errors->all() as $error)
					              <li>{{ $error }}</li>
					          @endforeach
					      </ul>
					  </div><br />
					@endif
			     	<div class="row">
				      	<div class="col-md-4">
				      		<div class="form-group">
							    <label for="tNombre">Nombre</label>
							    <input type="text" class="form-control" id="tNombre" name="tNombre" placeholder="Nombre" value="{{ old('tNombre') }}">
							</div>
		      			</div>
		      		</div>
		    	</div>
		    	<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</form>
	</div>
	<!-- /.container -->
@stop

@push('scripts')
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script>
		$(document).ready(function(){
			if($( ".alert-danger" ))
				setTimeout(function(){
					$( ".alert-danger" ).hide( "slow");
				}, 6000);
		});
	</script>
@endpush
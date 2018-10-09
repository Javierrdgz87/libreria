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
				    <li class="breadcrumb-item"><a href="{{ route('libros.index') }}">Libros</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Agregar Libro</li>
				  </ol>
				</nav>
			</div>
		</div>
		<form method="POST" action="{{ route('libros.update', $aDatos->eCodLibro) }}">
			{!! method_field('PUT') !!}
			{!! csrf_field() !!}
		  	<div class="panel panel-default">
				<div class="panel-heading">
			    	<button type="submit" class="btn btn-default btn-outline-dark btn-sm shadow" id="btnGU1"><i class="fa fa-save position-left"></i> Guardar</button>
			    	<button type="button" class="btn btn-default btn-outline-dark btn-sm shadow" id="btnCO2" onclick="location.href='{{ route("libros.index") }}'"><i class="fa fa-list-ul position-left"></i> Consulta</button>
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
							    <input type="text" class="form-control" id="tNombre" name="tNombre" placeholder="Nombre" value="{{ $aDatos->tNombre }}">
							</div>
		      			</div>
				      	<div class="col-md-4">
				      		<div class="form-group">
							    <label for="tAutor">Autor</label>
							    <input type="text" class="form-control" id="tAutor" name="tAutor" placeholder="Autor" value="{{ $aDatos->tAutor }}">
							</div>
		      			</div>
				      	<div class="col-md-4">
				      		<div class="form-group">
							    <label for="eCodCategoria">Categoria</label>
							    <input type="text" class="form-control" id="eCodCategoria" name="eCodCategoria" placeholder="Categoria" value="{{ $aDatos->Categoria }}" onkeypress="obj.autoCategoria()">
							    <input type="hidden" id="CodCategoria" name="CodCategoria" value="{{ $aDatos->eCodCategoria }}">
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
	<script src="{{ asset('js/typeahead/bootstrap-typeahead.js') }}"></script>
	<script>
		$(document).ready(function(){
			if($( ".alert-danger" ))
				setTimeout(function(){
					$( ".alert-danger" ).hide( "slow");
				}, 6000);

		});
		var obj = {
		    // autocomplete 
		    autoCategoria: function(){
		    	var url = "{{ route('autoCategoria') }}";

		        $.ajax({
		            type: "GET",
		            url: url,
		            success:function(data){
		                var aDatos=[];
		                aDatos = data.datos;
		                $('#eCodCategoria').typeahead({
		                  source: aDatos,
		                  displayField: 'tNombre',
		                  valueField: 'eCodCategoria',
		                });
		            },
		        });
		    }
		}
	</script>
@endpush
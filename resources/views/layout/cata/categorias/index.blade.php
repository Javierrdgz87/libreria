@extends('layout.dashboard')

@section('title', 'Dashboard | Categorias')

@section('content')
	{{-- include menu bar --}}
	@include('layout.parts.menu')
	<!-- Page Content -->
	<div class="container">
		<div class="row ">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Categorias</li>
				</ol>
			</div>
		</div>
		<form action="return false" method="POST">
		  	<div class="panel panel-default">
				<div class="panel-heading">
					<button type="button" class="btn btn-default btn-sm shadow" id="btnNU1" onclick="location.href='{{ route("categorias.create") }}'"><i class="fa fa-pencil-square-o position-left"></i> Nuevo</button>
				</div>
		    	<div class="panel-body">
			     	<div class="row">
				      	<div class="col-md-12">
				      		<table class="table table-hover table-sm" id="tbDatos" style="width: 100%">
								<thead>
									<tr>
										<th>Estatus</th>
										<th>Acci&oacute;n</th>
										<th>Nombre</th>
									</tr>
								</thead>
								<tbody>
									{{-- {{ $aDatos }} --}}								
									@foreach($aDatos as $rDato)
									<tr>
										<td style="white-space: nowrap; text-align: center;"> <i class="{{ $rDato->tClase }}" title="{{ $rDato->Estatus}}" data-popup="tooltip" ></i> </td>
										<td style="white-space: nowrap;"> 
											<div class="form-group" style="display:inline-block;">
												<div class="dropdown">
												  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="ContextMenu{{ $rDato->eCodCategoria}}">
												    <span class="caret"></span>
												  </button>
												  <ul class="dropdown-menu" aria-labelledby="ContextMenu{{ $rDato->eCodCategoria}}">
												    <li><a class="dropdown-item" href="{{ action('web\Cata\CatCategoriaController@edit', $rDato->eCodCategoria)}}">Editar Categoria</a></li>
												    <li role="separator" class="divider"></li>
												    <li><a class="dropdown-item" href="{{ URL::route('categorias.destroy', $rDato->eCodCategoria)}}">Eliminar Categoria</a></li>
												    </li role="separator" class="divider"></li>
												    {{-- <li><a class="dropdown-item" data-target="#modal_large" onclick="obj.openModal({{ $rDato->eCodCategoria }})">Mostrar Detalles de Categoria</a></li> --}}
												  </ul>
												</div>
											</div>&nbsp;
											<span>{{ $rDato->iCodCategoria}}</span>
										</td>
										<td style="white-space: nowrap; width: 100%"> {{ $rDato->tNombre}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
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
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{ asset('js/web/cata/coboca.js') }}"></script>
@endpush
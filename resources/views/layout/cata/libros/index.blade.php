@extends('layout.dashboard')

@section('title', 'Dashboard | Libros')

@section('content')
	{{-- include menu bar --}}
	@include('layout.parts.menu')
	<!-- Page Content -->
	<div class="container">
		<div class="row ">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Libros</li>
				</ol>
			</div>
		</div>
		<form action="return false" method="POST" id="Datos">
		  	<div class="panel panel-default">
				<div class="panel-heading">
					<button type="button" class="btn btn-default btn-sm shadow" id="btnNU1" onclick="location.href='{{ route("libros.create") }}'"><i class="fa fa-pencil-square-o position-left"></i> Nuevo</button>
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
										<th>Autor</th>
										<th>Categoría</th>
										<th>F. Publicación</th>
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
												  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="ContextMenu{{ $rDato->eCodLibro}}">
												    <span class="caret"></span>
												  </button>
												  <ul class="dropdown-menu" aria-labelledby="ContextMenu{{ $rDato->eCodLibro}}">
												    <li><a class="dropdown-item" href="{{ action('web\Cata\CatLibroController@edit', $rDato->eCodLibro)}}">Editar Libro</a></li>
												    <li role="separator" class="divider"></li>
												    <li><a class="dropdown-item" href="{{ URL::route('libros.destroy', $rDato->eCodLibro)}}">Eliminar Libro</a></li>
												    </li role="separator" class="divider"></li>
												    <li><a class="dropdown-item" data-target="#modal_large" onclick="libro.openModal({{ $rDato->eCodLibro }})">Mostrar Detalles de Libro</a></li>
												  </ul>
												</div>
											</div>&nbsp;
											<span>{{ $rDato->iCodLibro}}</span>
										</td>
										<td style="white-space: nowrap;"> {{ $rDato->tNombre}}</td>
										<td style="white-space: nowrap;"> {{ $rDato->tAutor}}</td>
										<td style="white-space: nowrap;"> {{ $rDato->Categoria}}</td>
										<td style="white-space: nowrap; width: 100%"> {{ $rDato->fhFechaPublicacion}}</td>

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

<!-- Large modal -->
<div id="modal_large" class="modal fade">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Detalle</h5>
			</div>

			<div class="modal-body"></div>

		</div>
	</div>
</div>
<!-- /large modal -->
@stop

@push('scripts')
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#tbDatos").DataTable({
		        "language": {
		            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
		        },
                pagingType: "full_numbers",
        		order: [[ 2, 'desc' ]]
			});
		});

		var libro = {
			openModal: function(id){
				$('#modal_large').modal();
		        $.ajax({
		            type: 'get',
		            url: "libros/"+id,
		            success: function(data) {
		            	aDatos = data;
		                
		            	var html = "";
		            	html += "<div class=\"row\">";
		            	html += "	<div class=\"col-md-4\"><span class=\"help-block text-semibold\">C&oacute;digo</span>"+aDatos.iCodLibro+"</div>";
		                html += "   <div class=\"col-md-4\"><span class=\"help-block text-semibold\">Fecha Publicación</span>"+aDatos.fhFechaPublicacion+"</div>";
		            	html += "	<div class=\"col-md-4\"><span class=\"help-block text-semibold\">Estatus</span>"+aDatos.Estatus+"</div>";
		            	html += "</div>";

		                html += "<div class=\"row\">";
		                html += "   <div class=\"col-md-4\"><span class=\"help-block text-semibold\">Nombre</span>"+aDatos.tNombre+"</div>";
		                html += "   <div class=\"col-md-4\"><span class=\"help-block text-semibold\">Usuario</span><input type=\"text\" name=\"tUsuario\" id=\"tUsuario\" class=\"form-control\" value=\""+(aDatos.tUsuario ? aDatos.tUsuario : '')+"\"></div>";
		                html += "</div>";
		                html += "<div class=\"row\">";
		                html += "   <div class=\"col-md-4\"><span class=\"help-block text-semibold text-info\">Mostrar Galeria</span>"+(aDatos.Categoria)+"</div>";
		                html += "</div>";

		                $(".modal-body").html(html);

						var footer = "";
						footer = "<div class=\"modal-footer\">";
						footer += "<button type=\"button\" class=\"btn btn-default btn-outline-dark btn-sm shadow\" id=\"btnGU1\" onclick=\"libro.borrow("+aDatos.eCodLibro+");\"><i class=\"fa fa-save position-left\"></i> Guardar</button>";
						footer += "<button type=\"button\" class=\"btn btn-default btn-raised\" data-dismiss=\"modal\"><i class=\"fa fa-close\"></i>&nbsp;Close</button>";
						footer += "</div>";
						if($('.modal-content').children('.modal-footer').length > 0){
							$('.modal-footer').remove();
						}

						$(".modal-body").after(footer);
		            }
		        });
			},
			borrow: function(id){

				$.ajax({
			        type: "POST",
			        data: {"_token":"{{ csrf_token() }}", eCodLibro: id, tUsuario: $("#tUsuario").val()},
			        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			        url: 'libros/'+id,
			        success:function(data){

						var error = "";
					  	error += "<div class=\"alert alert-success\">";
					   	error += "  <ul>";
					    error += "		<li>La informacion se guardo correctamente</li>";
					    error += "	</ul>";
					  	error += "</div>";
					  	$(".modal-header").after(error);

			        }
			    });
			}
		}
	</script>
@endpush

@section('head')
	<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
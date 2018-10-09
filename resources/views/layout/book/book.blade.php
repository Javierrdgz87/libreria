@extends('layout.dashboard')

@section('title', 'Dashboard | Books')

@section('content')
	{{-- include menu bar --}}
	@include('layout.parts.menu')

	<!-- Page Content -->
	<div class="container">
	  <div class="card border-secondary mt-4">
		  <div class="card-header">
		    
		  </div>
	    <div class="card-body">
	      <div class="jumbotron">
	        <h1>Prestamo de libros</h1>
	        <p>En esta peque&ntilde;a aplicaci&oacute;n puede realizar la busqueda de libros y categor&iacute;as, as&iacute; como realizar la actualizaci&oacute;n de la informaci&oacute;n y "prestar" libros.</p>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- /.container -->
@stop

@push('scripts')
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{ asset('js/web/sist/coboca.js') }}"></script>
@endpush
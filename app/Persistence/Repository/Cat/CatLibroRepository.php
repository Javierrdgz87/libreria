<?php
namespace App\Persistence\Repository\Cat;

use DB;
use Validator;
use App\Persistence\Models\Cat\CatLibro;

class CatLibroRepository {
	private $CatLibro;
	// constructor
	public function __construct(CatLibro $CatLibro){
		$this->CatLibro = $CatLibro;
	}

	public function getAllRecords($aFiltros){

		// obtenemos todos los registros del catalogo Paquetes
		$select = $this->CatLibro::from('CatLibros as cl')
										->leftjoin('SisEstatus AS se', 'se.tCodEstatus', '=', 'cl.tCodEstatus')
										->leftjoin('CatCategorias AS cc', 'cc.eCodCategoria', '=', 'cl.eCodCategoria')
										->codigo((isset($aFiltros['eCodCategoria']) ? $aFiltros['eCodCategoria'] : ''), 'cl')
										->nombre((isset($aFiltros['tNombre']) ? $aFiltros['tNombre'] : ''), 'cl')
										->categoria((isset($aFiltros['eCodCategoria']) ? $aFiltros['eCodCategoria'] : ''), 'cl')
										->fecha((isset($aFiltros['fhFechaPublicacion']) ? $aFiltros['fhFechaPublicacion'] : ''), 'cl')
									    ->select('cl.eCodLibro', 'cl.tNombre', 'se.tNombre AS Estatus', 'se.tClase', 'cl.tAutor', 'cc.tNombre AS Categoria', 'cl.fhFechaPublicacion')
									    ->get();
		return $select;
	}

	public function getRecord($id){
		$select = $this->CatLibro::from('CatLibros as cl')
										->leftjoin('CatCategorias AS cc', 'cc.eCodCategoria', '=', 'cl.eCodCategoria')
										->leftjoin('SisEstatus AS se', 'se.tCodEstatus', '=', 'cl.tCodEstatus')
										->where('cl.eCodLibro', $id)
									    ->select('cl.eCodLibro', 'cl.tNombre', 'se.tNombre AS Estatus', 'se.tClase', 'cl.tAutor', 'cc.tNombre AS Categoria', 'cc.eCodCategoria', 'cl.fhFechaPublicacion', 'cl.tUsuario')
									    ->first();
	    
		return response()->json($select, 200);
		// return $select;
	}

	public function update($request, $id){
		$data = $this->CatLibro::find($id);
		$data->tNombre = $request->tNombre;
		$data->tAutor = $request->tAutor;
		$data->eCodCategoria = $request->CodCategoria;
		$data->tCodEstatus = 'DI';
		$data->save();

		return response()->json(['data' => $data], 200);
	}

	public function delete($id){
		$data = $this->CatLibro::find($id);
		$data->tCodEstatus = 'EL';
		$data->save();

		return response()->json(['data' => $data], 200);	
	}

	public function borrow($request, $id){
		$data = $this->CatLibro::find($id);
		$data->tCodEstatus = 'ND';
		$data->tUsuario = $request->tUsuario;
		$data->save();

        return response()->json(['success'=>'Data is successfully added']);
	}

	public function store($request){
		$date = new \DateTime();
		$data = $this->CatLibro;
		$data->tNombre = $request->tNombre;
		$data->tAutor = $request->tAutor;
		$data->eCodCategoria = $request->CodCategoria;
		$data->fhFechaPublicacion = $date->format('m-d-y H:i:s');
		$data->tCodEstatus = 'DI';
		$data->save();

		return response()->json(['data' => $data], 200);
	}
}
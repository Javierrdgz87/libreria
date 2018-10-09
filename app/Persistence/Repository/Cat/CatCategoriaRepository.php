<?php
namespace App\Persistence\Repository\Cat;

use DB;
use Validator;
use App\Persistence\Models\Cat\CatCategoria;
use App\Persistence\Models\Cat\CatLibro;

class CatCategoriaRepository {
	private $CatCategoria;
	// constructor
	public function __construct(CatCategoria $CatCategoria){
		$this->CatCategoria = $CatCategoria;
	}

	public function getAllRecords(){
		// obtenemos todos los registros del catalogo Paquetes
		$select = $this->CatCategoria::from('CatCategorias as cc')
										->leftjoin('SisEstatus AS se', 'se.tCodEstatus', '=', 'cc.tCodEstatus')
										->where('cc.tCodEstatus', 'AC')
									    ->select('cc.eCodCategoria', 'cc.tNombre', 'se.tNombre AS Estatus', 'se.tClase', 'cc.tDescripcion')
									    ->get();
		return $select;
	}

	public function getRecord($id){
		$select = $this->CatCategoria::with('libros')
										->from('CatCategorias as cc')
										->leftjoin('SisEstatus AS se', 'se.tCodEstatus', '=', 'cc.tCodEstatus')
										->where('cc.eCodCategoria', $id)
									    ->select('cc.eCodCategoria', 'cc.tNombre', 'se.tNombre AS Estatus', 'se.tClase', 'cc.tDescripcion')
									    ->first();
	    // dd($select);
		return response()->json($select, 200);
		// return $select;
	}

	public function update($request, $id){

		$data = $this->CatCategoria::find($id);
		$data->tNombre = $request->tNombre;
		$data->tDescripcion = $request->tDescripcion;
		$data->save();

		return response()->json(['data' => $data], 200);
	}

	public function delete($id){
		$data = $this->CatCategoria::find($id);
		$data->tCodEstatus = 'EL';
		$data->save();

		return response()->json(['data' => $data], 200);	
	}

	public function store($request){

		$data = $this->CatCategoria;
		$data->tNombre = $request->tNombre;
		$data->tDescripcion = $request->tDescripcion;
		$data->tCodEstatus = 'AC';
		$data->save();

		return response()->json(['data' => $data], 200);
	}
}
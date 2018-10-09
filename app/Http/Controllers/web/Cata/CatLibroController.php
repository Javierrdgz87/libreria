<?php

namespace App\Http\Controllers\web\Cata;

use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Persistence\Repository\Cat\CatLibroRepository;

class CatLibroController extends Controller
{
    private $CatLibroRepository;

    public function __construct(CatLibroRepository $CatLibroRepository){
        $this->CatLibroRepository = $CatLibroRepository;
    }
    /**
     */
    public function index(Request $request)
    {
        // obtenemos los registros del datatable
        // dd($request);
        $jsonDatos = $this->getDataTable($request);
        $aDatos = $jsonDatos->getData();
        $aDatos = $aDatos->aDatos;

        return view('layout.cata.libros.index', compact('aDatos'));
    }

    /*
     * Carga el datatable que contiene todos los registros del bitacora
     */
    public function getDataTable($request){
        
        // obtenemos los datos del repositorio y los enviamos para poblar el datatable
        $select = $this->CatLibroRepository->getAllRecords($request);
        // dd($select);
        $data = DataTables::of($select)->filter(function($select){})->make(true);
        $aDatos = json_decode($data->content(), true);
        
        return response()->json(['Registros' => $aDatos['recordsTotal'], 'Filtrados' =>$aDatos['recordsFiltered'], 'aDatos' => $aDatos['data']], 200);
    }

    /**
     */
    public function create()
    {
        return view('layout.cata.libros.create');
    }

    /**
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tNombre' => 'required|max:255'
        ],[
            'tNombre.required' => 'El campo Nombre es obligatorio'
        ]);
        
        $data = $this->CatLibroRepository->store($request);

        return redirect('libros');
    }

    /**
     */
    public function show($id)
    {
        $aDatos = $this->CatLibroRepository->getRecord($id);
        return $aDatos;
    }

    /**
     */
    public function saveBorrow(Request $request, $id)
    {
        $aDatos = $this->CatLibroRepository->borrow($request, $id);
        
        return $aDatos;
    }

    /**
     */
    public function edit($id)
    {
        $aDatos = $this->CatLibroRepository->getRecord($id);
        $aDatos = $aDatos->getData();
        return view('layout.cata.libros.edit', compact('aDatos'));
    }

    /**
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tNombre' => 'required|max:255'
        ],[
            'tNombre.required' => 'El campo Nombre es obligatorio'
        ]);

        $data = $this->CatLibroRepository->update($request, $id);
        
        return redirect('libros');
    }

    /**
     */
    public function destroy($id)
    {
        $data = $this->CatLibroRepository->delete($id);
        
        return redirect('libros');
    }
}

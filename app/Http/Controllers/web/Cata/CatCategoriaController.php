<?php

namespace App\Http\Controllers\web\Cata;

use Datatables;
use Illuminate\Http\Request;
use App\Persistence\Models\Cat\CatCategoria;
use App\Http\Controllers\Controller;
use App\Persistence\Repository\Cat\CatCategoriaRepository;

class CatCategoriaController extends Controller
{
    private $CatCategoriaRepository;

    public function __construct(CatCategoriaRepository $CatCategoriaRepository){
        $this->CatCategoriaRepository = $CatCategoriaRepository;
    }
    /**
     */
    public function index()
    {
        // obtenemos los registros del datatable
        $jsonDatos = $this->getDataTable();
        $aDatos = $jsonDatos->getData();
        $aDatos = $aDatos->aDatos;

        return view('layout.cata.categorias.index', compact('aDatos'));
    }


    /*
     * Carga el datatable que contiene todos los registros del bitacora
     */
    public function getDataTable(){
        // obtenemos los datos del repositorio y los enviamos para poblar el datatable
        $select = $this->CatCategoriaRepository->getAllRecords();
        // dd($select);
        $data = DataTables::of($select)->filter(function($select){})->make(true);
        $aDatos = json_decode($data->content(), true);
        
        return response()->json(['Registros' => $aDatos['recordsTotal'], 'Filtrados' =>$aDatos['recordsFiltered'], 'aDatos' => $aDatos['data']], 200);
    }

    /**
     */
    public function create()
    {
        return view('layout.cata.categorias.create');
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
        
        $data = $this->CatCategoriaRepository->store($request);

        return redirect('categorias');
    }

    /**
     */
    public function show($id)
    {
        //
    }

    /**
     */
    public function edit($id)
    {
        $aDatos = $this->CatCategoriaRepository->getRecord($id);
        $aDatos = $aDatos->getData();
        
        return view('layout.cata.categorias.edit', compact('aDatos'));
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

        $data = $this->CatCategoriaRepository->update($request, $id);
        
        return redirect('categorias');
    }

    /**
     */
    public function destroy($id)
    {
        $data = $this->CatCategoriaRepository->delete($id);
        
        return redirect('categorias');
    }

    public function autoCategoria(Request $request){

        $select = CatCategoria::where('tNombre', 'LIKE', '%'.$request->eCodCategoria.'%')
                            ->where('tCodEstatus', 'AC')
                            ->take(10)
                            ->select(['eCodCategoria', 'tNombre'])
                            ->get();
        // dd($select);
        if(count($select) > 0){
            return response()->json(['datos' => $select], 200);
        }else{
            $select = ['tNombre'=>'No Result Found','eCodCategoria'=>''];
            return response()->json(['datos' => $select], 200);
        }
    }
}

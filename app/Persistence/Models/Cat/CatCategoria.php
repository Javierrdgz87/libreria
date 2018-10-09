<?php

namespace App\Persistence\Models\Cat;

use Illuminate\Database\Eloquent\Model;
use App\Persistence\Models\Cat\CatLibro;

class CatCategoria extends Model
{
    protected $table = "CatCategorias";
    protected $primaryKey = "eCodCategoria";
    protected $appends = ["iCodCategoria"];
    protected $fillable = ['tNombre', 'tCodEstatus'];

    public $timestamps = false;

    // accesors
    public function getICodCategoriaAttribute(){
      return sprintf("%07d", $this->attributes['eCodCategoria']);
    }
    // has many relationships
    public function libros(){
        return $this->hasMany(CatLibro::class, 'eCodCategoria', 'eCodCategoria');
    }

}

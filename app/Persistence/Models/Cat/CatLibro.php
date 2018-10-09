<?php

namespace App\Persistence\Models\Cat;

use Illuminate\Database\Eloquent\Model;
use App\Persistence\Models\Cat\CatCategoria;

class CatLibro extends Model
{
    protected $table = "CatLibros";
    protected $primaryKey = "eCodLibro";
    protected $appends = ["iCodLibro"];
    protected $fillable = ['tNombre', 'tAutor', 'eCodCategoria', 'tUsuario', 'tCodEstatus'];
	protected $casts = [
        'fhFechaPublicacion' => 'datetime:m/d/Y H:i'
    ];

    public $timestamps = false;


    // has One relationships
    public function categoria(){
        return $this->belongsTo(CatCategoria::class, 'eCodCategoria', 'eCodCategoria');
    }

    // accesors
    public function getICodLibroAttribute(){
      return sprintf("%07d", $this->attributes['eCodLibro']);
    }

    // filter
    public function scopeCodigo($query, $eCodCategoria, $alias){
        ($eCodCategoria != "" ? $query->where('{$alias}.eCodCategoria', $eCodCategoria) : '');
    }
    public function scopeNombre($query, $tNombre, $alias){
        ($tNombre != "" ? $query->where('{$alias}.tNombre', $tNombre) : '');
    }
    public function scopeCategoria($query, $eCodCategoria, $alias){
        ($eCodCategoria != "" ? $query->where('{$alias}.eCodCategoria', $eCodCategoria) : '');
    }
    public function scopeFecha($query, $fhFechaPublicacion, $alias){
        ($fhFechaPublicacion != "" ? $query->where('{$alias}.fhFechaPublicacion', $fhFechaPublicacion) : '');
    }
    public function scopeOrdenamiento($query, $field, $direction){
        if($field != "" || $direction){
            $query->orderBy($field, $direction);
        }
    }

    public function scopeLimit($query, $eRecords){
        $query->take($eRecords ? $eRecords : 10);
    }
}

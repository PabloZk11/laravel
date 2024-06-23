<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\usuario;

class roles extends Model
{

    public function usuario()
    {
        return $this->hasMany(usuario::class, 'id_rol');
    }

    protected $primaryKey = 'id_rol';
    protected $table = 'roles';

    protected $fillable = [
        "nombre_rol",
        "descripcion_rol"
    ];
    
    public $timestamps = false;
}

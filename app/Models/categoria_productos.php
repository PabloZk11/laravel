<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\producto;


class categoria_productos extends Model
{

    public function producto()
    {
        return $this->hasMany(producto::class, 'id_categoria');
    }

    public $timestamps = false;

    use HasFactory;
    protected $table = 'categoria_productos';
    protected $primaryKey = 'id_categoria';  
    protected $fillable = [
        'nombre_categoria',
        'descripcion'
    ];
}

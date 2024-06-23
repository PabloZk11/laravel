<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\producto;

class registro_salida extends Model
{

    public function producto()
    {
        return $this->BelongsTo(producto::class, 'id_producto');
    }    

    use HasFactory;
    protected $table = 'registro_salida';
    protected $primaryKey = 'id_salida';


    protected $fillable = [
        "unidades",
        "id_producto_salida",
        "id_factura_salida",
        "id_producto"
    ];

    public $timestamps = false;
}

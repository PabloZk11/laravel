<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\registro_salida;
use App\Models\proveedor;
use App\Models\categoria_productos;
use App\Models\pedido;
use App\Models\entrada_mercancia;
use App\Models\devolucion;


class producto extends Model
{

    public function proveedor()
    {
        return $this->BelongsTo(proveedor::class, 'id_proveedor');
    }  

    public function categoria()
    {
        return $this->BelongsTo(categoria_productos::class, 'id_categoria');
    }  

    public function registro_salida()
    {
        return $this->hasMany(registro_salida::class, 'id_producto');
    }   

    public function pedido()
    {
        return $this->hasMany(pedido::class, 'id_producto');
    } 

    public function entrada_mercancia()
    {
        return $this->hasMany(entrada_mercancia::class, 'id_producto');
    } 

    public function devolucion()
    {
        return $this->hasMany(devolucion::class, 'id_producto');
    } 

    use HasFactory;

    protected $primaryKey = 'id_producto';
    protected $table = 'productos';

    protected $fillable = [
        "nom_producto",
        "precio_unitario",
        "unidades_disponibles",
        "marca",
        "id_proveedor",
        "id_categoria"
    ];


    public $timestamps = false;

}

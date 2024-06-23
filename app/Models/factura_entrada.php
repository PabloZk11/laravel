<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factura_entrada extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'factura_entradas';
    protected $primaryKey = 'id_factura_entrada'; 
    protected $fillable = [
        'unidades',
        'precio_unitario',
        'precio_total',
        'fecha',
        'id_proveedor',
        'producto_id_producto'
    ];

}

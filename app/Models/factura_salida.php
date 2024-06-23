<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factura_salida extends Model
{
    use HasFactory;

    protected $table = 'factura_salida';
    protected $primaryKey = 'Id_factura_salida';

    protected $fillable = [
        'Cantidad',
        'Precio_unitario',
        'Precio_total',
        'Fecha',
        'id_producto',
        'id_vendedor'  
    ];
    public $timestamps = false;
}

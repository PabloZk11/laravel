<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\producto;
use App\Models\proveedor;

class entrada_mercancia extends Model
{

    public function producto()
    {
        return $this->BelongsTo(producto::class, 'id_producto');
    }

    public function proveedor()
    {
        return $this->BelongsTo(proveedor::class, 'id_proveedor');
    }

    use HasFactory;
    public $timestamps = false;
    protected $table = 'entrada_mercancias';
    protected $primaryKey = 'id_entrada'; 
    protected $fillable = [
        'cantidad_unidades',
        'id_producto',
        'id_pedido',
        'id_proveedor'
    ];

}

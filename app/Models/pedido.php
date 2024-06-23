<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\producto;
use App\Models\usuario;
use App\Models\proveedor;
use App\Models\entrada_mercancia;

class pedido extends Model
{

    public function producto()
    {
        return $this->BelongsTo(producto::class, 'id_producto');
    }

    public function usuario()
    {
        return $this->BelongsTo(usuario::class, 'id_usuario');
    }

    public function proveedor()
    {
        return $this->BelongsTo(proveedor::class, 'id_producto');
    }

    public function entrada_mercancia()
    {
        return $this->BelongsTo(entrada_mercancia::class, 'id_pedido');
    }


    use HasFactory;
    public $timestamps = false;
    protected $table = 'pedido';
    protected $primaryKey = 'id_pedido'; 
    protected $fillable = [
        'unidades',
        'id_producto',
        'id_usuario',
        'id_proveedor'
    ];

}

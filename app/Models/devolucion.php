<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\producto;
use App\Models\pedido;

class devolucion extends Model
{

  public function producto()
  {
      return $this->BelongsTo(producto::class, 'id_producto');
  }


    use HasFactory;

    
    protected $table = 'devolucion';
    protected $primaryKey = 'id_devolucion';

    protected $fillable = [
      'id_producto',
      'unidades',
      'id_entrada'  
    ];

    public $timestamps = false;
    
}

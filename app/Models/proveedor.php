<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\producto;
use App\Models\entrada_mercancia;

class proveedor extends Model
{

    public function producto()
    {
        return $this->hasMany(producto::class, 'id_proveedor');
    }  

    public function entrada_mercancia()
    {
        return $this->hasMany(entrada_mercancia::class, 'id_proveedor');
    }  

    use HasFactory;
    public $timestamps = false;
    protected $table = 'proveedors';
    protected $primaryKey = 'id_proveedor'; 

    protected $fillable = [
        
        'productos',
        'doc_proveedor'
    ];

}

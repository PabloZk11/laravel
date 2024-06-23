<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\roles;
use App\Models\pedido;
use App\Models\documento_ident;

class usuario extends Model
{

    public function roles()
    {
        return $this->BelongsTo(roles::class, 'id_rol');
    }  

    public function pedido()
    {
        return $this->hasMany(pedido::class, 'id_usuario');
    }

    public function documento_ident()
    {
        return $this->BelongsTo(documento_ident::class, 'id_documento');
    }  

    protected $primaryKey = 'id_usuario';
    protected $table = 'usuario';

    protected $fillable = [
        "nombre",
        "email",
        "contraseña",
        "id_rol",
        "id_documento"
    ];
    
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\usuario;

class documento_ident extends Model
{

    public function usuario()
    {
        return $this->hasMany(usuario::class, 'id_documento');
    }

    protected $primaryKey = 'id_documento';
    protected $table = 'documento_identificacion';

    protected $fillable = [
        "tipo_documento",
    ];
    
    public $timestamps = false;
}
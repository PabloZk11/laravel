<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pqrs extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pqrs';
    protected $table = 'pqrs';

    protected $fillable = [
        "pqrs_descripcion",
        "id_usuario_pqrs",
        "id_rol_pqrs"
    ];


    public $timestamps = false;
}

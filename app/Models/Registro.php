<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'nombre_estudiante',
        'fecha_nacimiento',
        'requerimiento',
        'como_nos_conocio',
        'nombre_apoderado',
        'telefono_apoderado',
        'comprobante',
        'reservado',
        'modalidad_id',
    ];
    public function modalidad()
    {
        return $this->belongsTo(\App\Models\Modalidad::class);
    }

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'reservado' => 'boolean',
    ];
}

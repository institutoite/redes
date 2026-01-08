<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
        'estado' => 'boolean',
    ];
    // Relación con Product (Pertenencia)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relación con Horario (Uno a Muchos)
    public function horarios()
    {
        // Horarios ahora pertenecen al Product; devolvemos los horarios del mismo producto
        return $this->hasMany(Horario::class, 'product_id', 'product_id');
    }

    // Relación con Día (Uno a Muchos)


    public function dias()
    {
        // Relación muchos-a-muchos entre Modalidad y Dia usando la nueva tabla pivote
        return $this->belongsToMany(Dia::class, 'product_modalidad_dia', 'modalidad_id', 'dia_id');
    }


    // Relación con Ventaja (Uno a Muchos)
    public function ventajas()
    {
        return $this->hasMany(Ventaja::class);
    }
}

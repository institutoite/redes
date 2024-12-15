<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    use HasFactory;
    protected $guarded=[];
    // Relación con Product (Pertenencia)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relación con Horario (Uno a Muchos)
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    // Relación con Día (Uno a Muchos)
    public function dias()
    {
        return $this->hasMany(Dias::class);
    }

    // Relación con Ventaja (Uno a Muchos)
    public function ventajas()
    {
        return $this->hasMany(Ventaja::class);
    }
}

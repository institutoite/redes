<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function category(){
        return $this->belongsTo(Category::class,'categories_id');
    }
    public function modalidades()
    {
        return $this->hasMany(Modalidad::class);
    }
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
    public function contenidos()
    {
        return $this->hasMany(Contenido::class);
    }
    public function materiales()
    {
        return $this->hasMany(Material::class);
    }
    // Nota: Los días se relacionan con modalidades vía muchos-a-muchos.
}

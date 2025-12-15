<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model

   
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'nombre', 'imagen', 'descripcion', 'price', 'clicks', 'categories_id',
    ];

      /**
         * Relación uno a muchos: Product tiene muchos Horarios
         */
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

     public function beneficios()
    {
        return $this->hasMany(Beneficio::class);
    }

    /**
     * Relación uno a muchos: Product tiene muchos Materiales
     */
    public function materiales()
    {
        return $this->hasMany(Material::class)->orderBy('orden');
    }

 

    /**
     * Relación uno a muchos: Product tiene muchos Contenidos
     */
    public function contenidos()
    {
        return $this->hasMany(Contenido::class)->orderBy('orden');
    }

    public function category(){
        return $this->belongsTo(Category::class,'categories_id');
    }

    public function modalidades()
    {
        return $this->hasMany(Modalidad::class);
    }


    

}

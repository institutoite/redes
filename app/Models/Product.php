<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
      
       
      
    /**
     * Relación uno a muchos: Product tiene muchas Modalidades
     */
   
{
    use HasFactory;
    protected $guarded = [];
    // Para asignación masiva de 'orden' si se requiere
    protected $fillable = [
        'nombre', 'imagen', 'descripcion', 'price', 'clicks', 'categories_id', 'orden',
    ];

      /**
         * Relación uno a muchos: Product tiene muchos Horarios
         */
    public function horarios()
    {
        return $this->hasMany(Horario::class);
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
    
    // Scope para ordenar productos por 'orden'
    public function scopeOrdered($query)
    {
        return $query->orderBy('orden');
    }

    /**
     * Normaliza los valores de orden para que sean secuenciales únicos.
     */
    public static function normalizarOrden()
    {
        $productos = self::orderBy('orden')->get();
        $orden = 1;
        foreach ($productos as $producto) {
            if ($producto->orden !== $orden) {
                $producto->orden = $orden;
                $producto->save();
            }
            $orden++;
        }
    }
}

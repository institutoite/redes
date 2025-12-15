<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDia extends Model
{
    use HasFactory;
    protected $table = 'product_dia';
    protected $fillable = ['product_id', 'modalidad_id', 'dia_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function modalidad()
    {
        return $this->belongsTo(\App\Models\Modalidad::class);
    }
    public function dia()
    {
        return $this->belongsTo(Dia::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;
    protected $table = 'dias';
    protected $fillable = ['dias', 'abreviatura'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_dia', 'dia_id', 'product_id');
    }
}

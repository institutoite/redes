<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

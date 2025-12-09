<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dias extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function modalidades()
    {
        return $this->belongsToMany(Modalidad::class, 'dia_modalidad', 'dias_id', 'modalidad_id');
    }
}

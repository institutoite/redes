<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }
}

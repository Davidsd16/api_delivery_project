<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Relación: Un producto pertenece a un establecimiento
    public function establecimiento()
    {
        return $this->belongsTo(Establishment::class);
    }
}


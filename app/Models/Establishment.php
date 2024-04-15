<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    // Relación: Un establecimiento tiene muchos productos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}


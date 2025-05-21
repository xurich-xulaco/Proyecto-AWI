<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class, 'recetas')
            ->withPivot('cantidad', 'unidad')
            ->withTimestamps();
    }
}

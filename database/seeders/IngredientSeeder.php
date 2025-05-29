<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingrediente;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        $toppings = [
            'Queso Parmesano',
            'Pepperoni',
            'Jamón',
            'Champiñones',
            'Pimientos',
            'Aceitunas',
            'Cebolla',
            'Tocineta',
            'Anchoas',
        ];

        foreach ($toppings as $name) {
            Ingrediente::updateOrCreate(
                ['nombre'  => $name],
                ['precio_unitario' => 0.50]
            );
        }
    }
}

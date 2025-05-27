<?php

namespace App\Exports;

use App\Models\Ingrediente;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventoryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ingrediente::all();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Descripción', 'Stock', 'Precio Unitario'];
    }

    public function map($row): array
    {
        return [
            $row->ID_ingrediente,
            $row->nombre,
            $row->descripcion,
            $row->stock,
            '$' . number_format($row->precio_unitario, 2)
        ];
    }
}

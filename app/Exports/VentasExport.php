<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;
    
    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Order::when($this->startDate && $this->endDate, function($query) {
                return $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
            })
            ->with('user', 'items.product')
            ->get();
    }
    
    public function headings(): array
    {
        return [
            '# Orden',
            'Cliente',
            'Fecha',
            'Productos',
            'Estado',
            'Subtotal',
            'Impuestos',
            'Total',
        ];
    }
    
    public function map($order): array
    {
        return [
            $order->order_number,
            $order->user->name . ' ' . $order->user->lastname,
            $order->created_at->format('d/m/Y H:i'),
            $order->items->map(function($item) {
                return $item->quantity . 'x ' . $item->product->name;
            })->implode(', '),
            $order->status,
            '$' . number_format($order->subtotal, 2),
            '$' . number_format($order->tax, 2),
            '$' . number_format($order->total, 2),
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
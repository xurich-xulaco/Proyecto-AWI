<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Ingredient;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PdfService
{
    /**
     * Generate an invoice PDF for an order
     */
    public function generateInvoice(Order $order)
    {
        $pdf = PDF::loadView('pdfs.invoice', [
            'order' => $order->load('items.product', 'user'),
            'date' => Carbon::now()
        ]);
        
        return $pdf->download('factura-' . $order->order_number . '.pdf');
    }
    
    /**
     * Generate an inventory status PDF
     */
    public function generateInventoryReport($startDate = null, $endDate = null)
    {
        $startDate = $startDate ?? Carbon::now()->subMonth();
        $endDate = $endDate ?? Carbon::now();
        
        $ingredients = Ingredient::all();
        
        $pdf = PDF::loadView('pdfs.inventory', [
            'ingredients' => $ingredients,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'date' => Carbon::now()
        ]);
        
        return $pdf->download('reporte-inventario-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }
    
    /**
     * Generate a sales report PDF
     */
    public function generateSalesReport($startDate = null, $endDate = null)
    {
        $startDate = $startDate ?? Carbon::now()->subMonth();
        $endDate = $endDate ?? Carbon::now();
        
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->with('items.product', 'user')
            ->get();
        
        $pdf = PDF::loadView('pdfs.sales', [
            'orders' => $orders,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalSales' => $orders->sum('total'),
            'date' => Carbon::now()
        ]);
        
        return $pdf->download('reporte-ventas-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }
}
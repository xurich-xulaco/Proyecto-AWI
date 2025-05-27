<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ReportService;

class GenerateReports extends Command
{
    protected $signature = 'reports:generate';
    protected $description = 'Genera cortes diarios y mensuales de inventario (PDF) y ganancias (Excel).';

    public function handle(ReportService $r)
    {
        $r->dailyInventoryPdf();
        $r->monthlyInventoryPdf();
        $r->dailySalesExcel();
        $r->monthlySalesExcel();
        $this->info('Reportes automáticos generados');
    }
}

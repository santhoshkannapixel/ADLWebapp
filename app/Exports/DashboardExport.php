<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\fromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;

class DashboardExport implements fromArray, WithHeadings, WithStyles, WithEvents
{
    use Exportable, RegistersEventListeners;
    public $data = [];
    function __construct($data)
    {
        $this->data = $data;
    }
    public function array(): array
    {
        return collect($this->data)->map(function($x) { 
            return [
                "name"       =>  $x->name,
                "page"       =>  $x->page,
                "type"       =>  $x->type,
                "mobile"     =>  $x->mobile,
                "email"      =>  $x->email,
                "status"     =>  $x->status,
                "remark"     =>  $x->remark,
                "created_at" =>  $x->created_at
            ];
        })->toArray(); 
    }
    public function headings(): array
    {
        return [
            "Name",
            "Page",
            "Type",
            "Mobile",
            "Email",
            "Status",
            "Remark",
            "Created at",
        ];
    }
    public function styles(Worksheet $sheet)
    {  
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('H')->setAutoSize(true);
                $event->sheet->getColumnDimension('I')->setAutoSize(true);
            }
        ];
    }
  
}

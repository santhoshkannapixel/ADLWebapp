<?php

namespace App\Exports;

use App\Models\Research;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResearchExport implements FromCollection,WithHeadings
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        return Research::select('name','email','mobile','city','message','created_at')->when(!empty($this->request->start_date) && !empty($this->request->end_date), function ($query) {
            $start_month     = Carbon::parse($this->request->start_date)->startOfDay();
            $end_month       = Carbon::parse($this->request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start_month, $end_month]);
        })->get();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'City',
            'Message',
            'Created Date'
        ];
    }
}

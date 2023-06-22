<?php

namespace App\Exports;

use App\Models\HeadOffice;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HeadOfficeExport implements FromCollection,WithHeadings
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        return  HeadOffice::select('name','email','mobile','company_name','designation','message','address','created_at')->when(!empty($this->request->start_date) && !empty($this->request->end_date), function ($query) {
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
            'Company Name',
            'Designation',
            'Message',
            'Address',
            'Created Date'
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\ClinicalLabManagement;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClinicalLabManagementExport implements FromCollection,WithHeadings
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        return ClinicalLabManagement::select('doctors_name','specialization','associated_hospitals_clinics','email','mobile','message','created_at')
        ->when(!empty($this->request->start_date) && !empty($this->request->end_date), function ($query) {
            $start_month     = Carbon::parse($this->request->start_date)->startOfDay();
            $end_month       = Carbon::parse($this->request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start_month, $end_month]);
        })->get();
    }
    public function headings(): array
    {
        return [
            'Doctors Name',
            'Specialization',
            'Associated hospital address',
            'Email',
            'Mobile',
            'Message',
            'Created Date'
        ];
    }
}

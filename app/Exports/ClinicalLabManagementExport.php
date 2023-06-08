<?php

namespace App\Exports;

use App\Models\ClinicalLabManagement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClinicalLabManagementExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ClinicalLabManagement::select('doctors_name','specialization','associated_hospitals_clinics','email','mobile','message','created_at')->get();
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

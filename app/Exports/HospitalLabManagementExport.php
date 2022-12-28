<?php

namespace App\Exports;

use App\Models\HospitalLabManagement;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class HospitalLabManagementExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HospitalLabManagement::select('hospital_name','hospital_address','name','email','mobile','message','designation','created_at')->get();
    }
    public function headings(): array
    {
        return [
            'Hospital Name',
            'Hospital Address',
            'Name',
            'Email',
            'Mobile',
            'Message',
            'Designation',
            'Created Date'
        ];
    }
}

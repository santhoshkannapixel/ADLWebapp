<?php

namespace App\Exports;

use App\Models\PatientsConsumers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatientsConsumersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PatientsConsumers::select('name','email','mobile','date','gender','test_for_home_collection','preferred_date_1','preferred_date_2','preferred_time','address','pincode','created_at')->get();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'Date',
            'Gender',
            'Test for home collection',
            'preferred_date_1',
            'preferred_date_2',
            'preferred_time',
            'Address',
            'Pincode',
            'Created Date'
        ];
    }
}

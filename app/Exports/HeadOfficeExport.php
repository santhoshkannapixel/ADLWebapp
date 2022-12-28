<?php

namespace App\Exports;

use App\Models\HeadOffice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HeadOfficeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HeadOffice::select('name','email','mobile','company_name','designation','message','address','created_at')->get();
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

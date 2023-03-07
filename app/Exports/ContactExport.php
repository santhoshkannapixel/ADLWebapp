<?php

namespace App\Exports;

use App\Models\ContactUs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return ContactUs::select('name','mobile','email','location','message','status','remark','created_at')->get();
        
    }
    public function headings(): array
    {
        return [
            'Name',
            'Mobile',
            'Email',
            'Location',
            'Message',
            'Status',
            'Remark',
            'Created Date'
        ];
    }
}

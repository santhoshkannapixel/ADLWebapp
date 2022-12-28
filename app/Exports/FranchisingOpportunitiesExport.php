<?php

namespace App\Exports;

use App\Models\FranchisingOpportunities;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FranchisingOpportunitiesExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FranchisingOpportunities::select('name','email','mobile','city','message','created_at')->get();
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

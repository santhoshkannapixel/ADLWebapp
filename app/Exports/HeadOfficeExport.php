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
    protected $from_date ;
    protected $to_date ;
    public function __construct($from,$to)
    {
       $this->from_date = $from;
       $this->to_date   = $to;
    }
    public function collection()
    {
        $from   = $this->from_date;
        $to     = $this->to_date;
        return HeadOffice::select('name','email','mobile','company_name','designation','message','address','created_at')
        ->when($from != '', function ($query) use ($from,$to) {
            $query->whereDate('created_at', '>=', $from);
            $query->whereDate('created_at', '<=', $to);
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

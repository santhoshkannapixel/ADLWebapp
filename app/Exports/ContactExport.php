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
        return ContactUs::select('name','mobile','email','location','message','status','remark','created_at')
        ->when($from != '', function ($query) use ($from) {
            $query->whereDate('created_at', '>=', $from);
        })
        ->when($to != '', function ($query) use ($to) {
            $query->whereDate('created_at', '<=', $to);
        })
        ->get();
        
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

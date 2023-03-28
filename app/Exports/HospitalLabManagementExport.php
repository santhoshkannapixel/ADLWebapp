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
        return HospitalLabManagement::select('hospital_name','hospital_address','name','email','mobile','message','designation','created_at')
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

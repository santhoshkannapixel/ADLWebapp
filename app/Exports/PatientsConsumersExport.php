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
        return PatientsConsumers::select('name','email','mobile','dob','gender','test_for_home_collection','preferred_date_1','preferred_date_2','preferred_time','address','pincode','created_at')
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

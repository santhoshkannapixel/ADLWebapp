<?php

namespace App\Exports;

use App\Models\BookAppointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookAppointmentExport  implements  FromCollection , WithHeadings
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
         return BookAppointment::leftJoin('cities','cities.AreaId','book_appointments.location_id')
        ->leftJoin('tests','tests.id','book_appointments.test_id')
        ->select('name','mobile','cities.AreaName as location','tests.TestName as test','test_type','book_appointments.created_at')
        ->when($from != '', function ($query) use ($from) {
            $query->whereDate('book_appointments.created_at', '>=', $from);
        })
        ->when($to != '', function ($query) use ($to) {
            $query->whereDate('book_appointments.created_at', '<=', $to);
        })
        ->get();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Mobile',
            'Location',
            'Test',
            'Test Type',
            'Created Date'
        ];
    }
}

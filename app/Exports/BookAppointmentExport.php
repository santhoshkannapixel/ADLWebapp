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
    public function collection()
    {
         return BookAppointment::leftJoin('cities','cities.AreaId','book_appointments.location_id')
        ->leftJoin('tests','tests.id','book_appointments.test_id')
        ->select('name','mobile','cities.AreaName as location','tests.TestName as test','test_type','book_appointments.created_at')->get();
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

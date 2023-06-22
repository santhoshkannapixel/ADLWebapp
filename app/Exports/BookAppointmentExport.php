<?php

namespace App\Exports;

use App\Models\BookAppointment;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookAppointmentExport  implements  FromCollection , WithHeadings
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
         return BookAppointment::leftJoin('cities','cities.AreaId','book_appointments.location_id')
        ->leftJoin('tests','tests.id','book_appointments.test_id')
        ->select('name','mobile','cities.AreaName as location','tests.TestName as test','test_type','book_appointments.created_at')
        ->when(!empty($this->request->start_date) && !empty($this->request->end_date), function ($query) {
            $start_month     = Carbon::parse($this->request->start_date)->startOfDay();
            $end_month       = Carbon::parse($this->request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start_month, $end_month]);
        })->get();
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

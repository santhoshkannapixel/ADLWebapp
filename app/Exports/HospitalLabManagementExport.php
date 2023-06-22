<?php

namespace App\Exports;

use App\Models\HospitalLabManagement;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class HospitalLabManagementExport implements FromCollection,WithHeadings
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        return HospitalLabManagement::select('hospital_name','hospital_address','name','email','mobile','message','designation','created_at') 
        ->when(!empty($this->request->start_date) && !empty($this->request->end_date), function ($query) {
            $start_month     = Carbon::parse($this->request->start_date)->startOfDay();
            $end_month       = Carbon::parse($this->request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start_month, $end_month]);
        })->get();
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

<?php

namespace App\Exports;

use App\Models\ContactUs;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactExport implements FromCollection, WithHeadings
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        return ContactUs::select('name', 'mobile', 'email', 'location', 'message', 'status', 'remark', 'created_at')
            ->when(!empty($this->request->start_date) && !empty($this->request->end_date), function ($query) {
                $start_month     = Carbon::parse($this->request->start_date)->startOfDay();
                $end_month       = Carbon::parse($this->request->end_date)->endOfDay();
                $query->whereBetween('created_at', [$start_month, $end_month]);
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

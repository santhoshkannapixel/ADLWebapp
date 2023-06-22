<?php

namespace App\Exports;

use App\Models\NewsLetter;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        return User::where('role_id', 0)->select('name', 'email', 'mobile', 'created_at')
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
            'Email',
            'Mobile',
            'Date'
        ];
    }
}

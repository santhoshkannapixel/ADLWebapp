<?php

namespace App\Exports;

use App\Models\Career;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CareerExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    { 
        return Career::select('name', 'mobile', 'email', 'title', 'location', 'message', 'careers.status', 'remark', 'careers.created_at')
            ->leftJoin('job_posts', 'job_posts.id', '=', 'careers.job_id')
            ->when(!empty($this->request->start_date) && !empty($this->request->end_date), function ($query) {
                $start_month     = Carbon::parse($this->request->start_date)->startOfDay();
                $end_month       = Carbon::parse($this->request->end_date)->endOfDay();
                $query->whereBetween('created_at', [$start_month, $end_month]);
            })
           ->latest() ->get();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Mobile',
            'Email',
            'Job Title',
            'Location',
            'Message',
            'Status',
            'Remark',
            'Created Date'
        ];
    }
}

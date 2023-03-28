<?php

namespace App\Exports;

use App\Models\Career;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CareerExport implements FromCollection,WithHeadings
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
        return Career::select('name','mobile','email','title','location','message','careers.status','careers.remark','careers.created_at')
        ->leftJoin('job_posts','job_posts.id','=','careers.job_id')
        ->when($from != '', function ($query) use ($from,$to) {
            $query->whereDate('careers.created_at', '>=', $from);
            $query->whereDate('careers.created_at', '<=', $to);
        })
        ->get();
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

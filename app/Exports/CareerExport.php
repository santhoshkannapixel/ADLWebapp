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
   
    public function collection()
    {
        // return Career::select('name','mobile','location','test_name','comments','created_at')->get();
        return Career::select('name','mobile','email','title','location','message','careers.status','careers.remark','careers.created_at')
        ->leftJoin('job_posts','job_posts.id','=','careers.job_id')
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

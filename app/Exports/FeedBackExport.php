<?php

namespace App\Exports;

use App\Models\FeedBack;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class FeedBackExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $type =  request()->route()->type ?? 'feedback';
        return FeedBack::where('page_url', 'LIKE', "%/$type")->select('name','email','mobile','location','message','created_at')->get();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'Location',
            'Message',
            'Created Date'
        ];
    }
}

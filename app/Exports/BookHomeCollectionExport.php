<?php

namespace App\Exports;
use App\Models\BookHomeCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookHomeCollectionExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BookHomeCollection::select('name','mobile','location','test_name','comments','created_at')->get();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Mobile',
            'Location',
            'Test Name',
            'Comments',
            'Created Date'
        ];
    }
}

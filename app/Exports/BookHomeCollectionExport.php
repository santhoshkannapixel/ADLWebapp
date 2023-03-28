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
        return BookHomeCollection::select('name','mobile','location','test_name','comments','created_at')
        ->when($from != '', function ($query) use ($from) {
            $query->whereDate('created_at', '>=', $from);
        })
        ->when($to != '', function ($query) use ($to) {
            $query->whereDate('created_at', '<=', $to);
        })
        ->get();
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

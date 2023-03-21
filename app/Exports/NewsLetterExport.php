<?php

namespace App\Exports;

use App\Models\NewsLetter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NewsLetterExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return NewsLetter::select('email','created_at')->get();
    }
    public function headings(): array
    {
        return [
            'Email',
            'Date'
        ];
    }
}

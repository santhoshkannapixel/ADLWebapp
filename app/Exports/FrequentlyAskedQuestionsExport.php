<?php

namespace App\Exports;

use App\Models\FrequentlyAskedQuestions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class FrequentlyAskedQuestionsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FrequentlyAskedQuestions::select('name','email','mobile','location','message','created_at')->get();
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

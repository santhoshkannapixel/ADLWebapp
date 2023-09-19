<?php

namespace App\Exports;

use App\Models\FeedBack;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class FeedBackExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $type =  request()->route()->type ?? 'feedback';
     $feedbacks=FeedBack::where('page_url', 'LIKE', "%/$type")->select('name','email','mobile','location','message','remark','created_at','qa_comments')->get();
     $form_data=[];
     foreach($feedbacks as $feedback){
        $data=[];
              if(isset($feedback['qa_comments'])){
             
                foreach(json_decode($feedback['qa_comments']) as $comment){ 
                  if(request()->route()->type=='feedback-b2b'){
                    $data[]=$comment->question.' | '.(($comment->answer==1)?'yes':'no').' | '.(isset($comment->comments)? $comment->comments :'');
                  }else{
                    $data[]=$comment->question.' : '.$comment->answer;
                  }
                    
                }
              }
              $form_data[]=[
                       'name'=>$feedback['name'],
                       'email'=>$feedback['email'],
                       'mobile'=>$feedback['mobile'],
                       'location'=>$feedback['location'],
                       'message'=>$feedback['message'],
                       'remark'=>$feedback['remark'],
                       'created_at'=>$feedback['created_at'],
                       'comments'=> $data
              ];
     }
     return collect($form_data);
    }
    public function map($row): array
    {
        return [
     $row['name'], $row['email'], $row['mobile'],$row['location'],$row['message'],$row['remark'], $row['created_at'],implode(",\n", $row['comments'])
        ];
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'Location',
            'Message',
            'Remark',
            'Created Date',
            'Comments'
        ];
    }
    public function columns(): array
    {
        return [
           
           
        ];
    }
}

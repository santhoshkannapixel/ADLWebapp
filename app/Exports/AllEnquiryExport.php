<?php

namespace App\Exports;

use App\Models\BookAppointment;
use App\Models\BookHomeCollection;
use App\Models\Career;
use App\Models\ClinicalLabManagement;
use App\Models\ContactUs;
use App\Models\FeedBack;
use App\Models\FranchisingOpportunities;
use App\Models\FrequentlyAskedQuestions;
use App\Models\HeadOffice;
use App\Models\HospitalLabManagement;
use App\Models\PatientsConsumers;
use App\Models\Research;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllEnquiryExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   
    public function collection()
    {
        $data_contact = ContactUs::selectRaw('name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null,"CONTACT US","CONTACT US") as Type');
        $data_career = Career::selectRaw('name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null,"CAREER","CAREER") as Type');
        $data_head_office = HeadOffice::selectRaw('name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null,"HEAD OFFICE","HEAD OFFICE") as Type');
        $data_booking_appointment = BookAppointment::selectRaw('name as Name,IF(deleted_at = null,"","") as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null,"BOOK APPOINTMENT","BOOK APPOINTMENT") as Type');
        $data_research = Research::selectRaw('name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null,"Research","Research") as Type');
        $data_franchising = FranchisingOpportunities::selectRaw('name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null,"FRANCHISING OPPORTUNITIES","FRANCHISING OPPORTUNITIES") as Type');
        $data_clinical_lab = ClinicalLabManagement::selectRaw('doctors_name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null,"CLINICAL LAB MANAGEMENT","CLINICAL LAB MANAGEMENT") as Type');
        $data_hospital_lab = HospitalLabManagement::selectRaw('name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null,"HOSPTAL LAB MANAGEMENT","HOSPTAL LAB MANAGEMENT") as Type');
        $data_faq = FrequentlyAskedQuestions::selectRaw('name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null, "FREQUENTLY ASKED QUESTIONS", "FREQUENTLY ASKED QUESTIONS") as Type');
        $data_feed_back = FeedBack::selectRaw('name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null, "FEEDBACK LIST", "FEEDBACK LIST") as Type');
        $databookhome = BookHomeCollection::selectRaw('name as Name,IF(deleted_at = null, "", "") as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark,IF(deleted_at = null, "BOOK HOME COLLECTION LIST", "BOOK HOME COLLECTION LIST") as Type');
        $data_patients_consumers = PatientsConsumers::selectRaw('name as Name,email as Email,mobile as Mobile,created_at as Date,status as Status,remark as Remark, IF(deleted_at = null, "PATIENTS CONSUMERS LIST", "PATIENTS CONSUMERS LIST") as Type')
        ->union($data_booking_appointment)
        ->union($databookhome)
        ->union($data_feed_back)
        ->union($data_faq)
        ->union($data_hospital_lab)
        ->union($data_clinical_lab)
        ->union($data_franchising)
        ->union($data_research)
        ->union($data_head_office)
        ->union($data_contact)
        ->union($data_career)
        ->get();
       
        return $data_patients_consumers;
        
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'Date',
            'Status',
            'Remark',
            'Type',
           
        ];
    }
     
}

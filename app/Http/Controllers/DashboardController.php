<?php

namespace App\Http\Controllers;

use App\Exports\BookAppointmentExport;
use App\Exports\BookHomeCollectionExport;
use App\Exports\ClinicalLabManagementExport;
use App\Exports\FeedBackExport;
use App\Exports\FranchisingOpportunitiesExport;
use App\Exports\FrequentlyAskedQuestionsExport;
use App\Exports\HeadOfficeExport;
use App\Exports\HospitalLabManagementExport;
use App\Exports\PatientsConsumersExport;
use App\Exports\ResearchExport;
use App\Models\BookAppointment;
use App\Models\BookHomeCollection;
use App\Models\Career;
use App\Models\ClinicalLabManagement;
use App\Models\ContactUs;
use App\Models\Enquiries;
use App\Models\CustomerDetails;
use App\Models\FeedBack;
use App\Models\FranchisingOpportunities;
use App\Models\FrequentlyAskedQuestions;
use App\Models\HeadOffice;
use App\Models\HospitalLabManagement;
use App\Models\Orders;
use App\Models\Packages;
use App\Models\PatientsConsumers;
use App\Models\Research;
use App\Models\Tests;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    { 
        $search = $request->search_data;
        $from   = $request->from_date;
        $to     = $request->to_date;
        if($request->ajax()) {
            if(!empty($request->from_date))
            {
                if(!empty($search))
                {
                    switch ($search) {
                        
                        case 'BOOK_HOME_COLLECTION_LIST':
                            $data = BookHomeCollection::select('name as Name','mobile as Mobile','created_at')
                                    ->whereDate('created_at', '>=', $from)
                                    ->whereDate('created_at', '<=', $to)
                                    ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['Email'] = '';
                                $val['type'] = 'BOOK HOME COLLECTION LIST';
                            }
                            break;
                        case 'PATIENTS_CONSUMERS_LIST':
                            $data = PatientsConsumers::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'PATIENTS CONSUMERS LIST';
                            }
                            break;

                        case 'FEEDBACK_LIST':
                            $data = FeedBack::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'FEEDBACK LIST';
                            }
                            break;
                        case 'FREQUENTLY_ASKED_QUESTIONS_LIST':
                            $data = FrequentlyAskedQuestions::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'FREQUENTLY ASKED QUESTIONS LIST';
                            }
                            break;

                        case 'HOSPITAL_LAB_MANAGEMENT':
                            $data = HospitalLabManagement::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'HOSPITAL LAB MANAGEMENT LIST';
                            }
                            break;

                        case 'CLINICAL_LAB_MANAGEMENT':
                            $data = ClinicalLabManagement::select('email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['Name'] = '';
                                $val['type'] = 'CLINICAL LAB MANAGEMENT LIST';
                            }
                            break;
                        case 'FRANCHISING_OPPORTUNITIES':
                            $data = FranchisingOpportunities::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'FRANCHISING OPPORTUNITIES LIST';
                            }
                            break;

                        case 'RESEARCH':
                            $data = Research::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'RESEARCH LIST';
                            }
                            break;
                        case 'BOOK_AN_APPOINTMENT':
                            $data = BookAppointment::select('name as Name','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['Email'] = '';
                                $val['type'] = 'BOOK AN APPOINTMENT LIST';
                            }
                            break;
                        case 'HEAD_OFFICE':
                            $data = HeadOffice::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                             foreach($data as $key=>$val)
                            {
                                $val['type'] = 'HEAD OFFICE LIST';
                            }
                            break;
                        // case 'CUSTOMERS':
                        //     $data = User::select('name as Name','email as Email','mobile as Mobile','created_at')
                        //     ->whereDate('created_at', '>=', $from)
                        //     ->whereDate('created_at', '<=', $to)
                        //     ->get();
                        //     foreach($data as $key=>$val)
                        //     {
                        //         $val['type'] = 'CUSTOMERS LIST';
                        //     }
                        //     break;
                        case 'CAREER_ENQUIRY':
                            $data = Career::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'CAREER ENQUIRY LIST';
                            }
                            break;

                        case 'CONTACT_LIST':
                            $data = ContactUs::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'CONTACT LIST';
                            }
                            break;
                            
                            
                    }
                }
                else{
                    $data = PatientsConsumers::select('name as Name','email as Email','mobile as Mobile','created_at')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
            }
            else   {
                $data = PatientsConsumers::select('name as Name','email as Email','mobile as Mobile','created_at')
                ->get();
                foreach($data as $key=>$val)
                {
                    $val['type'] = 'Patients Consumers List';
                }

            }

            return datatables()->of($data)->addIndexColumn()->make(true);
        }
        return view('admin.index');
    }
    public function dashboardData(Request $request)
    {
        
        $data['test'] = Tests::count();
        $data['package'] = Packages::count();
        $data['order'] = Orders::count();
        $data['customer'] = User::where('role_id',0)->count();
        $data['received_payment'] = Orders::where('payment_status',1)->count();
        $data['pending_order'] = Orders::where('order_status',[0,null])->count();
        $data['failed_payment'] = Orders::where('payment_status',0)->count();
        return response()->json(['data'=>$data]);
    }
    public function exportData(Request $request)
    {
        $export_data = $request->export_enquiry;
        if(!empty($export_data))
        {
            switch($export_data)
            {
                case 'BOOK_HOME_COLLECTION_LIST':
                    return Excel::download(new BookHomeCollectionExport, 'book_home_collection.xlsx');
                    break;
                case 'PATIENTS_CONSUMERS_LIST':
                    return Excel::download(new PatientsConsumersExport, 'patients_consumers.xlsx');
                    break;
                case 'FEEDBACK_LIST':
                    return Excel::download(new FeedBackExport, 'feedback.xlsx');
                    break;
                case 'FREQUENTLY_ASKED_QUESTIONS_LIST':
                    return Excel::download(new FrequentlyAskedQuestionsExport, 'faq.xlsx');
                    break;
                case 'HOSPITAL_LAB_MANAGEMENT':
                    return Excel::download(new HospitalLabManagementExport, 'hospital_lab_management.xlsx');
                    break;
                case 'CLINICAL_LAB_MANAGEMENT':
                    return Excel::download(new ClinicalLabManagementExport, 'clinical_lab_management.xlsx');
                    break;
                case 'FRANCHISING_OPPORTUNITIES':
                    return Excel::download(new FranchisingOpportunitiesExport, 'franchising_opportunities.xlsx');
                    break;
                case 'RESEARCH':
                    return Excel::download(new ResearchExport, 'research.xlsx');
                    break;
                case 'BOOK_AN_APPOINTMENT':
                    return Excel::download(new BookAppointmentExport, 'book_appointment.xlsx');
                    break;
                case 'HEAD_OFFICE':
                    return Excel::download(new HeadOfficeExport, 'head_office.xlsx');
                    break;
            }
        }
    }
}

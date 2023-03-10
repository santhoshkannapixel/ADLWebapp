<?php

namespace App\Http\Controllers;

use App\Exports\BookAppointmentExport;
use App\Exports\BookHomeCollectionExport;
use App\Exports\CareerExport;
use App\Exports\ClinicalLabManagementExport;
use App\Exports\ContactExport;
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
use Laracasts\Flash\Flash;
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
use Carbon\Carbon;
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
                            $data = BookHomeCollection::select('id','name as Name','mobile as Mobile','status','remark','created_at','status','remark')
                                    ->whereDate('created_at', '>=', $from)
                                    ->whereDate('created_at', '<=', $to)
                                    ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['Email'] = '';
                                $val['type'] = 'BOOK HOME COLLECTION LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="BOOK_HOME_COLLECTION_LIST" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="BOOK_HOME_COLLECTION_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;
                        case 'PATIENTS_CONSUMERS_LIST':
                            $data = PatientsConsumers::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'PATIENTS CONSUMERS LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="PATIENTS_CONSUMERS_LIST" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="PATIENTS_CONSUMERS_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;

                        case 'FEEDBACK_LIST':
                            $data = FeedBack::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'FEEDBACK LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="FEEDBACK_LIST" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="FEEDBACK_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;
                        case 'FREQUENTLY_ASKED_QUESTIONS_LIST':
                            $data = FrequentlyAskedQuestions::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'FREQUENTLY ASKED QUESTIONS LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="FREQUENTLY_ASKED_QUESTIONS_LIST" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="FREQUENTLY_ASKED_QUESTIONS_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;

                        case 'HOSPITAL_LAB_MANAGEMENT':
                            $data = HospitalLabManagement::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'HOSPITAL LAB MANAGEMENT LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="HOSPITAL_LAB_MANAGEMENT" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="HOSPITAL_LAB_MANAGEMENT" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;

                        case 'CLINICAL_LAB_MANAGEMENT':
                            $data = ClinicalLabManagement::select('id','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['Name'] = '';
                                $val['type'] = 'CLINICAL LAB MANAGEMENT LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="CLINICAL_LAB_MANAGEMENT" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="CLINICAL_LAB_MANAGEMENT" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;
                        case 'FRANCHISING_OPPORTUNITIES':
                            $data = FranchisingOpportunities::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'FRANCHISING OPPORTUNITIES LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="FRANCHISING_OPPORTUNITIES" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="FRANCHISING_OPPORTUNITIES" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;

                        case 'RESEARCH':
                            $data = Research::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'RESEARCH LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="RESEARCH" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="RESEARCH" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;
                        case 'BOOK_AN_APPOINTMENT':
                            $data = BookAppointment::select('id','name as Name','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['Email'] = '';
                                $val['type'] = 'BOOK AN APPOINTMENT LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="BOOK_AN_APPOINTMENT" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="BOOK_AN_APPOINTMENT" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;
                        case 'HEAD_OFFICE':
                            $data = HeadOffice::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                             foreach($data as $key=>$val)
                            {
                                $val['type'] = 'HEAD OFFICE LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="HEAD_OFFICE" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="HEAD_OFFICE" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;
                       
                        case 'CAREER_ENQUIRY':
                            $data = Career::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'CAREER ENQUIRY LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="CAREER_ENQUIRY" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="CAREER_ENQUIRY" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;

                        case 'CONTACT_LIST':
                            $data = ContactUs::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['type'] = 'CONTACT LIST';
                            }
                            $datatables =  Datatables::of($data)
                            ->editColumn('status', function($row){
                                $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="CONTACT_LIST" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                            })
                            ->editColumn('remark', function($row){
                                if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="CONTACT_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                            })
                            ->rawColumns(['status','remark']);
                            break;
                            
                            
                    }
                }
                else{
                       // Patients Consumers
                    $data_patients_consumers = PatientsConsumers::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                    ->whereDate('created_at', '>=', $request->from_date)
                    ->whereDate('created_at', '<=', $request->to_date)
                    ->get();
                    foreach($data_patients_consumers as $key=>$val)
                    {
                        $val['type'] = 'PATIENTS CONSUMERS LIST';
                    }
                    foreach($data_patients_consumers as $key=>$val){
                            $data[] = $val;
                        }
                    // Book Home
                    $databookhome = BookHomeCollection::select('id','name as Name','mobile as Mobile','created_at','status','remark')
                    ->whereDate('created_at', '>=', $request->from_date)
                    ->whereDate('created_at', '<=', $request->to_date)
                    ->get();
                    foreach($databookhome as $key=>$val)
                    {
                        $val['Email'] = '';
                        $val['type'] = 'BOOK HOME COLLECTION LIST';
                    }
                    foreach($databookhome as $key=>$val){
                        $data[] = $val;
                    }
                    // Feed Back
                    $data_feed_back = FeedBack::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                    ->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)
                    ->get();
                    foreach($data_feed_back as $key=>$val)
                    {
                        $val['type'] = 'FEEDBACK LIST';
                    }
                    foreach($data_feed_back as $key=>$val){
                        $data[] = $val;
                    } 
                     // FAQ
                     $data_faq = FrequentlyAskedQuestions::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                     ->whereDate('created_at', '>=', $from)
                     ->whereDate('created_at', '<=', $to)
                     ->get();
                     foreach($data_faq as $key=>$val)
                     {
                         $val['type'] = 'FREQUENTLY ASKED QUESTIONS LIST';
                     }
                     foreach($data_faq as $key=>$val){
                        $data[] = $val;
                    } 
                    //Hospital lab
                    $data_hospital_lab = HospitalLabManagement::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                    ->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)
                    ->get();
                    foreach($data_hospital_lab as $key=>$val)
                    {
                        $val['type'] = 'HOSPITAL LAB MANAGEMENT LIST';
                    }
                    foreach($data_hospital_lab as $key=>$val){
                        $data[] = $val;
                    }
                    //clinical lab
                    $data_clinical_lab = ClinicalLabManagement::select('id','email as Email','mobile as Mobile','created_at','status','remark')
                    ->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)
                    ->get();
                    foreach($data_clinical_lab as $key=>$val)
                    {
                        $val['Name'] = '';
                        $val['type'] = 'CLINICAL LAB MANAGEMENT LIST';
                    }
                    foreach($data_clinical_lab as $key=>$val){
                        $data[] = $val;
                    }
                    // franchisting
                    $data_franchising = FranchisingOpportunities::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                    ->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)
                    ->get();
                    foreach($data_franchising as $key=>$val)
                    {
                        $val['type'] = 'FRANCHISING OPPORTUNITIES LIST';
                    }
                    foreach($data_franchising as $key=>$val){
                        $data[] = $val;
                    }
                    // Research
                    $data_research = Research::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                    ->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)
                    ->get();
                    foreach($data_research as $key=>$val)
                    {
                        $val['type'] = 'RESEARCH LIST';
                    }
                    foreach($data_research as $key=>$val){
                        $data[] = $val;
                    }
                    // BookAppointment
                    $data_booking_appointment = BookAppointment::select('id','name as Name','mobile as Mobile','created_at','status','remark')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                    foreach($data_booking_appointment as $key=>$val)
                    {
                        $val['Email'] = '';
                        $val['type'] = 'BOOK AN APPOINTMENT LIST';
                    }
                    foreach($data_booking_appointment as $key=>$val){
                        $data[] = $val;
                    }
                    //HeadOffice
                    $data_head_office = HeadOffice::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                        ->whereDate('created_at', '>=', $from)
                        ->whereDate('created_at', '<=', $to)
                        ->get();
                    foreach($data_head_office as $key=>$val)
                    {
                        $val['type'] = 'HEAD OFFICE LIST';
                    }
                    foreach($data_head_office as $key=>$val){
                        $data[] = $val;
                    }
                    //career
                    $data_career = Career::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                    ->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)
                    ->get();
                    foreach($data_career as $key=>$val)
                    {
                        $val['type'] = 'CAREER ENQUIRY LIST';
                    }
                    foreach($data_career as $key=>$val){
                        $data[] = $val;
                    }
                    //ContactUs
                    $data_contact = ContactUs::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                    ->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)
                    ->get();
                    foreach($data_contact as $key=>$val)
                    {
                        $val['type'] = 'CONTACT LIST';
                    }
                    foreach($data_contact as $key=>$val){
                        $data[] = $val;
                    }

                    $datatables =  Datatables::of($data)
                    ->editColumn('status', function($row){
                        if($row->type == "PATIENTS CONSUMERS LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="PATIENTS_CONSUMERS_LIST" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;

                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="PATIENTS_CONSUMERS_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }

                        if($row->type == "BOOK HOME COLLECTION LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="BOOK_HOME_COLLECTION_LIST" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;

                             if(!empty($row->remark)){
                                    $remark = $row->remark;
                                }else{
                                    $remark = '';
                                }
                                $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="BOOK_HOME_COLLECTION_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                                return $remark;
                        }
                        if($row->type == "FEEDBACK LIST")
                        {
                        $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="FEEDBACK_LIST" id="status"><option value="">-- Select --</option>';
                        foreach (config('dashboard.status') as $option)
                        {
                            if(!empty($row->status) && $row->status == $option){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }
                            $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                        }
                        $status .= '</select>';
                        return $status;
                        }
                        if($row->type == "FREQUENTLY ASKED QUESTIONS LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="FREQUENTLY_ASKED_QUESTIONS_LIST" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;
                        }
                        if($row->type == "HOSPITAL LAB MANAGEMENT LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="HOSPITAL_LAB_MANAGEMENT" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;
                        }
                        if($row->type == "CLINICAL LAB MANAGEMENT LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="CLINICAL_LAB_MANAGEMENT" id="status"><option value="">-- Select --</option>';
                                foreach (config('dashboard.status') as $option)
                                {
                                    if(!empty($row->status) && $row->status == $option){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                                }
                                $status .= '</select>';
                                return $status;
                        }
                        if($row->type == "FRANCHISING OPPORTUNITIES LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="FRANCHISING_OPPORTUNITIES" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;
                        }
                        if($row->type == "RESEARCH LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="RESEARCH" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;
                        }
                        if($row->type == "BOOK AN APPOINTMENT LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="BOOK_AN_APPOINTMENT" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;
                        }
                        if($row->type == "HEAD OFFICE LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="HEAD_OFFICE" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;
                        }
                        if($row->type == "CAREER ENQUIRY LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="CAREER_ENQUIRY" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;
                        }
                        if($row->type == "CONTACT LIST")
                        {
                            $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="CONTACT_LIST" id="status"><option value="">-- Select --</option>';
                            foreach (config('dashboard.status') as $option)
                            {
                                if(!empty($row->status) && $row->status == $option){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                            }
                            $status .= '</select>';
                            return $status;
                        }
                        
                    })
                    ->editColumn('remark', function($row){
                        if($row->type == "PATIENTS CONSUMERS LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="PATIENTS_CONSUMERS_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "BOOK HOME COLLECTION LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="BOOK_HOME_COLLECTION_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "FEEDBACK LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="FEEDBACK_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "FREQUENTLY ASKED QUESTIONS LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="FREQUENTLY_ASKED_QUESTIONS_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "HOSPITAL LAB MANAGEMENT LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="HOSPITAL_LAB_MANAGEMENT" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "CLINICAL LAB MANAGEMENT LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="CLINICAL_LAB_MANAGEMENT" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "FRANCHISING OPPORTUNITIES LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="FRANCHISING_OPPORTUNITIES" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "RESEARCH LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="RESEARCH" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "BOOK AN APPOINTMENT LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="BOOK_AN_APPOINTMENT" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "HEAD OFFICE LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="HEAD_OFFICE" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "CAREER ENQUIRY LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="CAREER_ENQUIRY" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                        if($row->type == "CONTACT LIST")
                        {
                            if(!empty($row->remark)){
                                $remark = $row->remark;
                            }else{
                                $remark = '';
                            }
                            $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="CONTACT_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                            return $remark;
                        }
                    })
                    ->editColumn('created_at',function($row){
                   
                        $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $row['created_at'])->format('d-m-Y');
                         return $created_at;
                     
                 })->rawColumns(['status','remark']);
                 
                }
            }
            else   {
                $data = PatientsConsumers::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')->get();
                foreach($data as $key=>$val)
                {
                    $val['type'] = 'Patients Consumers List';
                }
                $datatables =  Datatables::of($data)
                ->editColumn('status', function($row){
                    $status = '<select class="form-control status" name="status" data-id="'.$row->id.'" data-type="PATIENTS_CONSUMERS_LIST" id="status"><option value="">-- Select --</option>';
                    foreach (config('dashboard.status') as $option)
                    {
                        if(!empty($row->status) && $row->status == $option){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                        $status .=  '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
                    }
                    $status .= '</select>';
                    return $status;
                })
                ->editColumn('remark', function($row){
                    if(!empty($row->remark)){
                        $remark = $row->remark;
                    }else{
                        $remark = '';
                    }
                    $remark = '<textarea class="form-control" data-id="'.$row->id.'" data-type="PATIENTS_CONSUMERS_LIST" id="remark" name="remark">'.$remark.'</textarea>';
                    return $remark;
                })
                ->editColumn('created_at',function($row){
                   
                       $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $row['created_at'])->format('d-m-Y');
                        return $created_at;
                    
                })
                ->rawColumns(['status','remark','created_at']);

            }
           
            return $datatables->addIndexColumn()->make(true);

            // return datatables()->of($datatables)->addIndexColumn()->make(true);
        }
        return view('admin.index');
    }
    public function dashboardData(Request $request)
    {
        
        $data['test'] = Tests::where('IsPackage','No')->count();
        $data['package'] = Tests::where('IsPackage','Yes')->count();
        $data['order'] = Orders::count();
        $data['customer'] = User::where('role_id',0)->count();
        $data['received_payment'] = Orders::where('payment_status',1)->count();
        $data['pending_order'] = Orders::whereNull('order_status')->count();
        $data['failed_payment'] = Orders::where('order_status',2)->count();
        $data['cancel_order'] = Orders::where('order_status',3)->count();
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
                case 'CONTACT_LIST':
                    return Excel::download(new ContactExport, 'contact_us.xlsx');
                    break;
                case 'CAREER_ENQUIRY':
                    return Excel::download(new CareerExport, 'career_enquiry.xlsx');
                    break;
            }
        }
    }
    public function status(Request $request)
    {
        $type   = $request->type;
        $id     = $request->id;
        $value  = $request->value;
        if($id!='' && $value != '')
        {
            
                switch ($type) {
                    
                    case 'PATIENTS_CONSUMERS_LIST':
                        $data = PatientsConsumers::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }

                        break;
                    case 'BOOK_HOME_COLLECTION_LIST':
                        $data = BookHomeCollection::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;
                    case 'FEEDBACK_LIST':
                        $data = FeedBack::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;
                    case 'FREQUENTLY_ASKED_QUESTIONS_LIST':
                        $data = FrequentlyAskedQuestions::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;
                        
                    case 'HOSPITAL_LAB_MANAGEMENT':
                        $data = HospitalLabManagement::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;

                    case 'CLINICAL_LAB_MANAGEMENT':
                        $data = ClinicalLabManagement::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;
                    case 'FRANCHISING_OPPORTUNITIES':
                        $data = FranchisingOpportunities::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;

                    case 'RESEARCH':
                        $data = Research::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;
                    case 'BOOK_AN_APPOINTMENT':
                        $data = BookAppointment::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;
                    case 'HEAD_OFFICE':
                        $data = HeadOffice::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;
                    
                    case 'CAREER_ENQUIRY':
                        $data = Career::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;

                    case 'CONTACT_LIST':
                        $data = ContactUs::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->status = $value ?? '';
                            $data->update();
                        }
                        break;
                }
        }
    }
    public function remark(Request $request)
    {
        $type   = $request->type;
        $id     = $request->id;
        $value  = $request->value;
        if($id!='')
        {
                switch ($type) {
                    
                    case 'PATIENTS_CONSUMERS_LIST':
                        $data = PatientsConsumers::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;
                    case 'BOOK_HOME_COLLECTION_LIST':
                        $data = BookHomeCollection::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;

                    case 'FEEDBACK_LIST':
                        $data = FeedBack::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;
                        
                    case 'FREQUENTLY_ASKED_QUESTIONS_LIST':
                        $data = FrequentlyAskedQuestions::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;
                        
                    case 'HOSPITAL_LAB_MANAGEMENT':
                        $data = HospitalLabManagement::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;

                    case 'CLINICAL_LAB_MANAGEMENT':
                        $data = ClinicalLabManagement::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;
                    case 'FRANCHISING_OPPORTUNITIES':
                        $data = FranchisingOpportunities::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;

                    case 'RESEARCH':
                        $data = Research::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;
                    case 'BOOK_AN_APPOINTMENT':
                        $data = BookAppointment::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;
                    case 'HEAD_OFFICE':
                        $data = HeadOffice::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;
                    
                    case 'CAREER_ENQUIRY':
                        $data = Career::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;

                    case 'CONTACT_LIST':
                        $data = ContactUs::where('id',$id)->first();
                        if(!empty($data))
                        {
                            $data->remark = $value ?? '';
                            $data->update();
                        }
                        break;
                }

        }
    }
}

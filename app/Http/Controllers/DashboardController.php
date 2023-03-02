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
                    $data = PatientsConsumers::select('id','name as Name','email as Email','mobile as Mobile','created_at','status','remark')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
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
                ->rawColumns(['status','remark']);

            }
           
            return $datatables->addIndexColumn()->make(true);

            // return datatables()->of($datatables)->addIndexColumn()->make(true);
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

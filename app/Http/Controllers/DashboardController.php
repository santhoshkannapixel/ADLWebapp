<?php

namespace App\Http\Controllers;

use App\Models\BookAppointment;
use App\Models\BookHomeCollection;
use App\Models\ClinicalLabManagement;
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
                            }
                            break;
                        case 'PATIENTS_CONSUMERS_LIST':
                            $data = PatientsConsumers::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            break;

                        case 'FEEDBACK_LIST':
                            $data = FeedBack::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            break;
                        case 'FREQUENTLY_ASKED_QUESTIONS_LIST':
                            $data = FrequentlyAskedQuestions::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            break;

                        case 'HOSPITAL_LAB_MANAGEMENT':
                            $data = HospitalLabManagement::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            break;

                        case 'CLINICAL_LAB_MANAGEMENT':
                            $data = ClinicalLabManagement::select('email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['Name'] = '';
                            }
                            break;
                        case 'FRANCHISING_OPPORTUNITIES':
                            $data = FranchisingOpportunities::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            break;

                        case 'RESEARCH':
                            $data = Research::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            break;
                        case 'BOOK_AN_APPOINTMENT':
                            $data = BookAppointment::select('name as Name','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            foreach($data as $key=>$val)
                            {
                                $val['Email'] = '';
                            }
                            break;
                        case 'HEAD_OFFICE':
                            $data = HeadOffice::select('name as Name','email as Email','mobile as Mobile','created_at')
                            ->whereDate('created_at', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                            break;
                    }
                }
                else{
                    $data = Enquiries::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
            }
            else   {
                $data = Enquiries::all();
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
        return response()->json(['data'=>$data]);
    }
}

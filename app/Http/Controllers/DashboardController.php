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
use App\Exports\AllEnquiryExport;
use App\Models\Orders;
use App\Models\Tests;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $enquiries = getAllEnquiries([
                "type"      => $request->search_data ?? null,
                "from_date" => $request->from_date ?? null,
                "to_date"   => $request->to_date ?? null
            ]);

            return Datatables::of($enquiries)->addIndexColumn()
                ->editColumn('action', function ($row) {
                    $status = '';
                    foreach (config('dashboard.status') as $option) {
                        $selected = '';
                        if (!empty($row->status) && $row->status == $option) {
                            $selected = 'selected';
                        }
                        $status .=  '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                    } 
                    return '<div class="d-flex align-items-center">
                                <b style="width:100px">Status</b>
                                <span> :&nbsp;</span>
                                <select class="border w-100" name="status" data-id="' . $row->id . '" data-type="' . $row->type . '" id="status"><option value="">-- Select --</option>'.$status.'</select>
                            </div>
                            <div class="d-flex align-items-center">
                                <b style="width:100px">Remarks</b>
                                <span> :&nbsp;</span>
                                <textarea class="mt-1 border w-100" data-id="' . $row->id . '" data-type="' . $row->type . '"  id="remark" name="remark">' . $row->remark . '</textarea>
                            </div>';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('M-d-Y h:s:A');
                })
                ->editColumn('type', function ($row) {
                    return ucfirst(str_replace('_', ' ', $row->type));
                })
                ->editColumn('page', function ($row) {
                    if ($row->page_url) {
                        return ' <a target="_blank" href="' . $row->page_url . '" title="' . $row->page_url . '" class="ms-1"><i class="fa fa-link"></i> '.strtoupper($row->page).'</a>';
                    } else {
                        return strtoupper($row->page);
                    }
                })
                ->rawColumns(['action', 'page'])
                ->make(true);
        }
        return view('admin.index');
    }
    public function dashboardData()
    {
        return response()->json(['data' => [
            'test'             => Tests::where('IsPackage', 'No')->count(),
            'package'          => Tests::where('IsPackage', 'Yes')->count(),
            'order'            => Orders::count(),
            'customer'         => User::where('role_id', 0)->count(),
            'received_payment' => Orders::where('payment_status', 1)->count(),
            'pending_order'    => Orders::whereNull('order_status')->count(),
            'failed_payment'   => Orders::where('payment_status', 0)->count(),
            'cancel_order'     => Orders::where('order_status', 3)->count()
        ]]);
    }
    public function exportData(Request $request)
    {
        $export_data = $request->export_enquiry;
        $from = $request->export_enquiry_from_date ?? '';
        $to = $request->export_enquiry_to_date ?? '';
        if (!empty($export_data)) {
            switch ($export_data) {
                case 'BOOK_HOME_COLLECTION_LIST':
                    return Excel::download(new BookHomeCollectionExport($from, $to), 'book_home_collection.xlsx');
                    break;
                case 'PATIENTS_CONSUMERS_LIST':
                    return Excel::download(new PatientsConsumersExport($from, $to), 'patients_consumers.xlsx');
                    break;
                case 'FEEDBACK_LIST':
                    return Excel::download(new FeedBackExport($from, $to), 'feedback.xlsx');
                    break;
                case 'FREQUENTLY_ASKED_QUESTIONS_LIST':
                    return Excel::download(new FrequentlyAskedQuestionsExport($from, $to), 'faq.xlsx');
                    break;
                case 'HOSPITAL_LAB_MANAGEMENT':
                    return Excel::download(new HospitalLabManagementExport($from, $to), 'hospital_lab_management.xlsx');
                    break;
                case 'CLINICAL_LAB_MANAGEMENT':
                    return Excel::download(new ClinicalLabManagementExport($from, $to), 'clinical_lab_management.xlsx');
                    break;
                case 'FRANCHISING_OPPORTUNITIES':
                    return Excel::download(new FranchisingOpportunitiesExport($from, $to), 'franchising_opportunities.xlsx');
                    break;
                case 'RESEARCH':
                    return Excel::download(new ResearchExport($from, $to), 'research.xlsx');
                    break;
                case 'BOOK_AN_APPOINTMENT':
                    return Excel::download(new BookAppointmentExport($from, $to), 'book_appointment.xlsx');
                    break;
                case 'HEAD_OFFICE':
                    return Excel::download(new HeadOfficeExport($from, $to), 'head_office.xlsx');
                    break;
                case 'CONTACT_LIST':
                    return Excel::download(new ContactExport($from, $to), 'contact_us.xlsx');
                    break;
                case 'CAREER_ENQUIRY':
                    return Excel::download(new CareerExport($from, $to), 'career_enquiry.xlsx');
                case 'All':
                    return Excel::download(new AllEnquiryExport($request->export_enquiry_from_date, $request->export_enquiry_to_date), 'all_enquiry.xlsx');
                    break;
            }
        }
    }
    public function status(Request $request)
    {
        DB::table($request->type)->where('id', $request->id)->update([
            'status' => $request->value
        ]);
        return response(["status" => true]);
    }
    public function remark(Request $request)
    {
        DB::table($request->type)->where('id', $request->id)->update([
            'remark' => $request->value
        ]);
        return response(["status" => true]);
    }
}

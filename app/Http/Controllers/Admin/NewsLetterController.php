<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Yajra\DataTables\Facades\DataTables;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class NewsLetterController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = NewsLetter::select([
                'id',
                'email',
            ]);

            return DataTables::eloquent($data)
                ->addIndexColumn()
                          
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    $show =  button('show', route('news-letter.show', $data->id));
                    $delete = button('delete', route('news-letter.delete', $data->id));
                    return $show . $delete;
                })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.master.news-letter.index');
    }
   
    public function delete($id = null)
    {
        $careers  = NewsLetter::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Home Collection']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   BookAppointment::findOrFail($id);
        $data   =   NewsLetter::find($id);
        return view('admin.master.news-letter.show', compact('data'));
    }
}

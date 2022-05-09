<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = Banners::select([
                'id',
                'Title',
                'Content',
                'Url',
                'DesktopImage',
                'MobileImage',
                'OrderBy',
                'Status'
            ]);

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('Mobile_Image', function ($data) {
                    return '
                        <img src="'.asset_url($data->MobileImage).'" height="40"/>
                    ';
                }) 
                ->addColumn('Desktop_Image', function ($data) {
                    return '
                        <img src="'.asset_url($data->DesktopImage).'" height="40"/>
                    ';
                })                
                ->addColumn('action', function ($data) {
                    return '
                        <div class="btn-group">
                            <a href="'.route('banner.edit', $data->id).'" class="btn btn-sm text-primary" title="Edit"> <i class="bi bi-pencil-square"></i> </a>
                            <form method="post" action="'.route('banner.delete', $data->id).'"> 
                                    '.csrf_field().'
                                <button id="confirmDelete" type="submit" class="btn btn-sm text-danger" title="Delete"><i class="bi bi-trash"></i> </button>
                            </form>
                        </div>
                    ';
                })
            ->rawColumns(['action','Mobile_Image','Desktop_Image'])
            ->make(true);
        }

        return view('admin.master.banner.index');
    }

    public function create()
    {
        return view('admin.master.banner.create');
    }

    public function edit($id)
    {
        $banner = Banners::find($id);
        return view('admin.master.banner.edit', compact('banner'));
    }

    public function store(Request $request, $id = null)
    { 
        $banner =  Banners::updateOrCreate(["id"=> $id],$request->except(['_token','MobileImage','DesktopImage']));

        if($banner) {
            if($request->has('MobileImage')) {
                if(Storage::exists($banner->MobileImage)){
                    Storage::delete($banner->MobileImage);
                } 
                $MobileImage               =  $request->file('MobileImage')->store('public/files/mobile_images');
                $banner  ->  MobileImage   =  $MobileImage;
                $banner  ->  save();
            }
            if($request->has('DesktopImage')) {
                if(Storage::exists($banner->DesktopImage)){
                    Storage::delete($banner->DesktopImage);
                }
                $DesktopImage               =   $request->file('DesktopImage')->store('public/files/desktop_images');
                $banner  ->  DesktopImage   =   $DesktopImage;
                $banner  ->  save();
            }
        }
        
        Flash::success( __('action.saved', ['type' => 'Banner']));
        return redirect()->route('banner.index');
    }

    public function delete($id = null)
    {
        $banner  = Banners::find($id);
        if(Storage::exists($banner->MobileImage)){
            Storage::delete($banner->MobileImage);
        }
        if(Storage::exists($banner->DesktopImage)){
            Storage::delete($banner->DesktopImage);
        }
        $banner->delete();
        Flash::success( __('action.deleted', ['type' => 'Banner']));
        return redirect()->back();
    }
}
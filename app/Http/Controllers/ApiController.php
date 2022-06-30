<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\SubTests;
use App\Models\Tests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function banners()
    {
        $data = Banners::latest()->get();
        return response()->json([
            "status"    =>  true,
            "data"      =>  $data
        ]);
    }
    public function topBookedTest()
    {
        $data   = Tests::oldest()->limit(10)->get();
        return response()->json([
            "status"    =>  true,
            "data"      =>  $data
        ]);
    }
    public function testDetails($id)
    {
        $data    = Tests::find($id);
        $subData = SubTests::where("TestId", $data->id)->get();
        return response()->json([
            "status"    =>  true,
            "data"      =>  [
                "test"      => $data,
                "sub_test"  => $subData,
            ]
        ]);
    }
    public function bannerContactForm(Request $request)
    {
        Storage::put('contact', $request->file('reportFile'));
        return response()->json([
            "status"    =>  true,
            "message"   =>  "Form Submit Success !"
        ]);
    }
    public function testLists(Request $request)
    {
        $data   =   Tests::with('SubTestList')
                            ->where('TestName', 'like', '%'.$request->search.'%')
                            ->skip(0)
                            ->take($request->tack)
                            ->orderBy('TestPrice', ($request->sort == 'low' ? "DESC" : null) === null ? "DESC" : 'ASC'  )
                            ->get();
        return response()->json([
            "status"    =>  true,
            "data"      =>  $data
        ]);
    }
}
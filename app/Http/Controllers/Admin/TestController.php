<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packages;
use App\Models\TestPrice;
use App\Models\Tests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class TestController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tests::select('*');
            $data->when(isset($request->isPackage), function ($q) use ($request) {
                $q->where('isPackage', $request->isPackage);
            });
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('is_home', function ($data) {
                    if ($data->is_home) {
                        $is_home  = '<input type="checkbox" class="checkbox"  onclick="isHomeStatusChange(' . $data->id . ')" checked  name="is_home" >';
                    } else {
                        $is_home  = '<input type="checkbox" class="checkbox"  onclick="isHomeStatusChange(' . $data->id . ')"    name="is_home" >';
                    }


                    return $is_home;
                })
                ->addColumn('Applicable_Gender', function ($data) {
                    if ($data->ApplicableGender == 'M') return '<span class="t-center"><i class="text-primary fa fa-mars me-2"></i>Male</span>';
                    if ($data->ApplicableGender == 'F') return '<span class="t-center"><i class="text-info fa fa-venus me-2"></i>Female</span>';
                    if ($data->ApplicableGender == 'B') return '<span class="t-center"><i class="text-success fa fa-mars me-2"></i><i class="fa fa-venus me-2"></i>Both</span>';
                    if ($data->ApplicableGender == '') return '<span class="t-center">-</span>';
                })
                ->addColumn('Drive_Through', function ($data) {
                    $flag    =  $data->DriveThrough == 'N' ? 'danger' : 'success';
                    $type    =  $data->DriveThrough == 'N' ? 'ban' : 'check-circle';
                    $status  =  '<span class="fa-20 t-center fa fa-' . $type . ' text-' . $flag . '"></span>';
                    return $status;
                })
                ->addColumn('Home_Collection', function ($data) {
                    $flag    =  $data->HomeCollection == 'N' ? 'danger' : 'success';
                    $type    =  $data->HomeCollection == 'N' ? 'ban' : 'check-circle';
                    $status  =  '<span class="fa-20 t-center fa fa-' . $type . ' text-' . $flag . '"></span>';
                    return $status;
                })
                ->addColumn('Test_Schedule', function ($data) {
                    $TestSchedule  =  '<small>' . str_replace(',', ' ', $data->TestSchedule) . '</small>';
                    return $TestSchedule;
                })
                ->addColumn('action', function ($data) use ($request) {
                    $show = '';
                    $edit = '';
                    if ($request->isPackage == 'No') {
                        if (permission_check('TEST_SHOW'))
                            $show = button('show', route('test.show', $data->id));

                        if (permission_check('TEST_EDIT'))
                            $edit = button('edit', route('test.edit', $data->id));

                        return $show . $edit;
                    } else {
                        if (permission_check('TEST_SHOW'))
                            $show =  button('show', route('test.show', $data->id));

                        if (permission_check('TEST_EDIT'))
                            $edit =  button('edit', route('test.edit', $data->id));

                        return $show . $edit;
                    }
                })
                ->rawColumns(['action', 'is_home', 'Test_Schedule', 'Drive_Through', 'Home_Collection', 'Applicable_Gender'])
                ->make(true);
        }

        $last_sync  =   Carbon::parse(Tests::latest()->first()->created_at ?? "")->format('d/m/Y');

        return view('admin.master.tests.index', compact('last_sync'));
    }

    public function syncRequest()
    {
        foreach (getApiMaster('GetTestMaster') as $api) {
            $response = Http::get($api['http']);
            $response_data = json_decode($response->body())[0]->Data;

            if (!is_null($response_data)) {
                foreach ($response_data as $data) {
                    $test = Tests::updateOrCreate(["TestId" => $data->TestId], [
                        "TestId"                           => $data->TestId ?? null,
                        "DosCode"                          => $data->DosCode ?? null,
                        "TestName"                         => $data->TestName ?? null,
                        "TestSlug"                         => Str::slug($data->TestName),
                        "AliasName1"                       => $data->AliasName1 ?? null,
                        "AliasName2"                       => $data->AliasName2 ?? null,
                        "ApplicableGender"                 => $data->ApplicableGender ?? null,
                        "IsPackage"                        => $data->IsPackage ?? null,
                        "Createdon"                        => $data->Createdon ?? null,
                        "Modifiedon"                       => $data->Modifiedon ?? null,
                        "Classifications"                  => $data->Classifications ?? null,
                        "TransportCriteria"                => $data->TransportCriteria ?? null,
                        "SpecialInstructionsForPatient"    => $data->SpecialInstructionsForPatient ?? null,
                        "SpecialInstructionsForCorporates" => $data->SpecialInstructionsForCorporates ?? null,
                        "SpecialInstructionsForDoctors"    => $data->SpecialInstructionsForDoctors ?? null,
                        "BasicInstruction"                 => $data->BasicInstruction ?? null,
                        "DriveThrough"                     => $data->DriveThrough ?? null,
                        "HomeCollection"                   => $data->HomeCollection ?? null,
                        "OrganName"                        => str_replace('+', ' ', str_replace('%0D%0A', '', urlencode($data->OrganName))),
                        "HealthCondition"                  => str_replace('+', ' ', str_replace('%0D%0A', '', urlencode($data->HealthCondition))),
                        "CteateDate"                       => $data->CteateDate ?? null,
                        "ModifiedDate"                     => $data->ModifiedDate ?? null,
                        "TestSchedule"                     => $data->TestSchedule ?? null,
                    ]);
                    if (isset($data->SubTestList)) {
                        $cTest =   Tests::with('SubTests')->find($test->id);
                        if (isset($cTest->SubTests)) {
                            $cTest->SubTests()->delete();
                        }
                        foreach ($data->SubTestList as  $subTest) {
                            $test->SubTests()->create([
                                "SubTestId"      => $subTest->SubTestId,
                                "SubTestDOSCode" => $subTest->SubTestDOSCode,
                                "SubTestName"    => $subTest->SubTestName
                            ]);
                        }
                    }
                    $test->TestPrice()->updateOrcreate([
                        "TestPrice"    => $data->TestPrice,
                        "TestLocation" => $api['location']
                    ]);
                    // try {
                    // if ($data->IsPackage == "No") {

                    // } 
                    // else {
                    //     $Packages = Packages::updateOrCreate([
                    //         "TestId" => $data->TestId ?? null,
                    //         "DosCode" => $data->DosCode ?? null,
                    //         "TestName" => $data->TestName ?? null,
                    //         "TestSlug" => Str::slug($data->TestName),
                    //         "AliasName1" => $data->AliasName1 ?? null,
                    //         "AliasName2" => $data->AliasName2 ?? null,
                    //         "ApplicableGender" => $data->ApplicableGender ?? null,
                    //         "IsPackage" => $data->IsPackage ?? null,
                    //         "Createdon" => $data->Createdon ?? null,
                    //         "Modifiedon" => $data->Modifiedon ?? null,
                    //         "Classifications" => $data->Classifications ?? null,
                    //         "TransportCriteria" => $data->TransportCriteria ?? null,
                    //         "SpecialInstructionsForPatient" => $data->SpecialInstructionsForPatient ?? null,
                    //         "SpecialInstructionsForCorporates" => $data->SpecialInstructionsForCorporates ?? null,
                    //         "SpecialInstructionsForDoctors" => $data->SpecialInstructionsForDoctors ?? null,
                    //         "BasicInstruction" => $data->BasicInstruction ?? null,
                    //         "DriveThrough" => $data->DriveThrough ?? null,
                    //         "HomeCollection" => $data->HomeCollection ?? null,
                    //         "OrganName" => $data->OrganName ?? null,
                    //         "HealthCondition" => $data->HealthCondition ?? null,
                    //         "CteateDate" => $data->CteateDate ?? null,
                    //         "ModifiedDate" => $data->ModifiedDate ?? null,
                    //         "TestSchedule" => $data->TestSchedule ?? null,
                    //         "TestPrice" => $data->TestPrice ?? null,
                    //     ]);
                    //     $Packages->PackagesPrice()->create([
                    //         "TestPrice" => $Packages->TestPrice,
                    //         "TestLocation" => $api['location']
                    //     ]);
                    //     if (isset($data->SubTestList)) {
                    //         foreach ($data->SubTestList as  $subTest) {
                    //             $Packages->SubTestList()->create([
                    //                 "SubTestId"         =>  $subTest->SubTestId,
                    //                 "SubTestDOSCode"    =>  $subTest->SubTestDOSCode,
                    //                 "SubTestName"       =>  $subTest->SubTestName,
                    //             ]);
                    //         }
                    //     }
                    // }
                    // } catch (\Throwable $th) {
                    //     //throw $th;
                    // }
                    Flash::success(__('masters.sync_success'));
                }
            }
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $data   =   Tests::findOrFail($id);
        $testPrice  = TestPrice::where('TestId', $data->id)->first();
        $data['testPrice'] = $testPrice['TestPrice'];
        return view('admin.master.tests.show', compact('data'));
    }

    public function edit($id)
    {
        $data   =   Tests::findOrFail($id);
        return view('admin.master.tests.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data   =   Tests::findOrFail($id);
        if ($request->is_home == 'on') {
            $data->is_home = 1;
        } else {
            $data->is_home = 0;
        }
        $data->sorting_order = $request->sorting_order ?? '';
        if ($request->image) {
            if (Storage::exists($request->image)) {
                Storage::delete($request->image);
            }
            $Image = Storage::put('TestImage', $request->image);
            $data->image = $Image;
        }
        $data->save();
        Flash::success(__('action.saved', ['type' => 'Package Updated']));

        return redirect()->route('test.index');
    }
    public function status(Request $request)
    {
        $data   =   Tests::findOrFail($request->id);
        if ($data->is_home == '1') {
            $data->is_home = '0';
        } else {
            $data->is_home = 1;
        }
        $result = $data->update();
        return response()->json(['status' => $result]);
    }
}

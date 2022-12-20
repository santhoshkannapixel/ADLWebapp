<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Roles;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = Sentinel::getRoleRepository()->select([
                'id',
                'slug',
                'name',
                'created_at',
                'updated_at',
            ])->whereNotIn('slug',['admin','superadmin']);
                return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $action = button('edit',route('role.edit', $data->id)).button('delete',route('role.delete', $data->id));
                    return $action;
                })

            ->make(true);
        }
        return view('admin.settings.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = config('permission');
        return view('admin.settings.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DD($request->all());
        Flash::success(__('auth.role_creation_successful'));
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role           = Sentinel::findRoleById($id);
        $permissions    = $role->permissions ?? config('permission');
        return view('admin.settings.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataDb = Sentinel::findRoleById($id);

        if (empty($dataDb)) {
            Flash::error( __('global.denied'));
            return redirect()->back();
        }


        $permissions = [

            // Withdrawal
            'user.view.dashboard'    =>  $request -> user_view_dashboard   == 'true' ? true : false,
            'user.add.dashboard'     =>  $request -> user_add_dashboard    == 'true' ? true : false,
            'user.edit.dashboard'    =>  $request -> user_edit_dashboard   == 'true' ? true : false,
            'user.delete.dashboard'  =>  $request -> user_delete_dashboard == 'true' ? true : false,

            // Search or Add
            'user.view.settings'    =>  $request -> user_view_settings   == 'true' ? true : false,
            'user.add.settings'     =>  $request -> user_add_settings   == 'true' ? true : false,
            'user.edit.settings'    =>  $request -> user_edit_settings   == 'true' ? true : false,
            'user.delete.settings'  =>  $request -> user_delete_settings   == 'true' ? true : false,

        ];

        Sentinel::findRoleById($id)->update(['permissions'  =>  null]);

        Sentinel::findRoleById($id)->update([
            'name'         =>  $request->name,
            'slug'         =>  Str::slug($request->name),
            'permissions'  =>  $permissions,
        ]);

        Flash::success( __('auth.role_update_successful'));

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userDb = Sentinel::getUser();
        $dataDb = Sentinel::findRoleById($id);

        if (empty($dataDb)) {
            Flash::error(__('global.not_found'));

            return redirect()->route('role.index');
        }

        $dataDb->users()->detach($userDb);
        $dataDb->delete();

        Flash::success(__('auth.role_delete_successful'));

        return redirect()->route('role.index');
    }
}

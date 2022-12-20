<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Roles;
use App\Models\User;
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
        unset($request['_token']);
        $permissions = $request->all();
        unset($permissions['name']);

        Roles::create([
            "name"        => $request->name,
            "slug"        => Str::slug($request->name),
            "user_id"     => auth_user()->id,
            "permissions" => json_encode($permissions)
        ]);

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
        $permissions    = $role->permissions;
        // dd($permissions);
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
        unset($request['_token']);
        unset($request['_method']);
        $permissions = $request->all();
        unset($permissions['name']);
        Roles::findOrFail($id)->update([
            'name'         =>  $request->name,
            'slug'         =>  Str::slug($request->name),
            "permissions" => json_encode($permissions)
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

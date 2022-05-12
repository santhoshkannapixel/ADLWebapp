<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Masters\Departments;
use App\Models\RoleUsers;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users  = Sentinel::getUserRepository()->with('roles')->get();
        $roles  = Sentinel::getRoleRepository()->get();

        if ($request->ajax()) {
            $data = Sentinel::getUserRepository()->with('roles', 'activations')
                                                ->whereHas('roles',function($q){
                                                    $q->whereNotIn('slug',['admin']);
                                                });
            return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('role', function ($data) {
                return $data->roles()->first()->name;
            })
            ->addColumn('status', function($data){
                $status = 'Active';
                return $status;
            })
            ->addColumn('action', function($data){
                $action = button('edit',route('user.edit', $data->id)).button('delete',route('user.delete', $data->id)); 
                return $action;
            })
            ->rawColumns(array(
                'status',
                'action',
            ))
            ->make(true);
        }
 
        return view('admin.settings.users.index', compact('users','roles'));
    }

    public function create(Request $request)
    {
        $roleDb         = Sentinel::getRoleRepository()->whereNotIn('slug',['admin','superadmin'])->pluck('name','id');
        $userRole       = null;
        return view('admin.settings.users.create', compact('roleDb','userRole'));
    }

    public function store(Request $request)
    {  
        $request->validate([
            'email'     => 'required|unique:users|max:255',
            'role_id'   => 'required',
            'name'      => 'required',
            'password'  => 'required',
        ]);
 
        try {
 
            //  Create a User Record
            $user   =  User::create([
                'name'      =>  $request->name,
                'email'     =>  $request->email,
                'password'  =>  Hash::make($request->password),
            ]);

            // find a Users
            $user_activation = Sentinel::findById($user->id);

            //  Create Activation Record for User 
            $activation      = Activation::create($user_activation);

            // To Complete a Activation 
            Activation::complete($user_activation, $activation->code);
 
            //Attach the user to the role
            $role = Sentinel::findRoleById($request->role_id);
            $role->users()->attach($user);

            Flash::success( __('auth.account_creation_successful'));

        } catch (\Throwable $th) {

            Log::error('User registration email sent failure.');
        }
        return redirect()->route('user.index');
    } 

    public function destroy(Request $request , $id)
    {
        $data = Sentinel::findById($id);

        if (empty($data)) {
           Flash::error( __('global.not_found'));

            return redirect()->route('user.index');
        }
        

        $data->delete();

        Flash::success( __('auth.delete_account'));

        return redirect()->route('user.index');
    }

    public function edit(Request $request , $id)
    {
        $user = Sentinel::findUserById($id);

        if (empty($user)) {
            Flash::error( __('global.not_found'));
            return redirect()->route('user.index');
        }

        $roleDb = Sentinel::getRoleRepository()->whereNotIn('slug',['admin'])->pluck('name','id');

        $userRole = $user->roles[0]->id ?? null;

        return view('admin.settings.users.edit', compact('user','roleDb','userRole'));
    }

    public function update(Request $request , $id)
    {
   
        try {
            $user = User::find($id);

            if($request->new_password != null) {
                $password  =  Hash::make($request->new_password);
            }

            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  =>  $password ??  $user->password,
            ]);

            RoleUsers::where("user_id",$id)->update([
                "role_id"  => $request->role_id,
            ]);
        
            Flash::success( __('auth.update_successful'));
            return redirect()->route('user.index');

        } catch (\Throwable $th) {
            Flash::error( __('auth.failed'));
            return redirect()->route('user.index');
        }
    }
} 
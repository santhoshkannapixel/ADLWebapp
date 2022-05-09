<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if(Sentinel::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }
    
    public function login(Request $request)
    {
       
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];
        

        try {
            if($user = Sentinel::authenticate($credentials , $request->get('remember', false))) {
                Flash::success( __('auth.login_successful'));
                // if(Sentinel::inRole('manager')) {
                //     return redirect(route('manager.dashboard'));
                // } else if(Sentinel::inRole('employee')) {
                //     return redirect(route('employee.dashboard'));
                // }
                return redirect(route('admin.dashboard'));
            } else {
                Flash::error( __('auth.login_unsuccessful'));
                return redirect(route('login'));
            }
        } catch (ThrottlingException $ex) {

            Flash::error(__('auth.login_timeout'));
            return redirect()->route('login');
            
        } catch (NotActivatedException $ex) {
            Flash::error(__('auth.login_unsuccessful_not_active')); 
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {

        Sentinel::logout(null, true);
        Flash::success(__('auth.logout_successful'));
        return redirect(route('login'));
    } 
}
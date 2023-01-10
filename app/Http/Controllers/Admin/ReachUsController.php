<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReachUsController extends Controller
{
    public function index()
    {
        return redirect()->route('healthcheckup-for-employee.index');
    }
}

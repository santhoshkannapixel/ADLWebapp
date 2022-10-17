<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index()
    {
        return redirect()->route('hospital-lab-management.index');
    }
}

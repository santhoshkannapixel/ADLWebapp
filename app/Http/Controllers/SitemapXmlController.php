<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Tests;

class SitemapXmlController extends Controller
{
    public function index()
    {
        $test_packages = Tests::all();
        $carrers = Career::all();
        $website = [
            'reports',
            'reports/account',
            'my-cart',
            'for-patient',
            'login',
            'login-with-otp',
            'verify-otp',
            'forgot-password',
            'register',
            'about-us',
            'people-behind',
            'history',
            'commitment',
            'accreditation',
            'patients-consumers',
            'packages',
            'health-packages',
            'preparing-for-health-checkup',
            'drive-through-blood-collection',
            'feedback',
            'faq',
            'book-an-appointment',
            'department',
            'hospital-or-lab-management',
            'clinical-lab-management',
            'franchising-opportunities',
            'research',
            'physiotherapy',
            'manual-therapy',
            'exercise-therapy',
            'electrotherapy',
            'reach-us',
            'head-office',
            'healthcheckup-for-employees',
            'anand-at-home',
            'careers',
            'anandlab-franchise',
            'covidtesting-employees',
            'covidtesting-employees',
            'find-lab',
            'cancellation-policy',
            'privacy-policy',
            'terms-conditions',
        ];
        return response()->view('site-map', compact('test_packages', 'website','carrers'))->header('Content-Type', 'text/xml');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'hospitalCount' => Hospital::count(),
            'patientCount'  => Patient::count()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobApplication;
use App\Payment;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){

        $data = [
            'usersCount' => User::count(),
            'totalPayments' => Payment::success()->sum('amount'),
            'activeJobs' => Job::active()->count(),
            'totalJobs' => Job::count(),
            'employerCount' => User::employer()->count(),
            'agentCount' => User::agent()->count(),
            'totalApplicants' => JobApplication::count(),

        ];


        return view('admin.dashboard', $data);
    }
}

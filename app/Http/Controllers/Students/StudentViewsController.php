<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentViewsController extends Controller
{
    public function student_dashboard()
    {
        return redirect('/student/dashboard');
    }
    public function dashboard_view()
    {
        return view('student.index');
    }
    public function edit_profile_view ()
    {
        return view('student.edit-profile');
    }
    public function security_view ()
    {
        return view('student.security');
    }
    public function social_profile_view ()
    {
        return view('student.social-profile');
    }
    public function logout ()
    {
    
    }
}

<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorViewsController extends Controller
{
    public function instructor_dashboard()
    {
        return redirect('/instructor/dashboard');
    }
    public function dashboard_view()
    {
        return view('instructor.index');
    }
    public function add_course_view()
    {
        return view('instructor.add-course');
    }
    public function my_courses_view ()
    {
        return view('instructor.my-courses');
    }
    public function reviews_view ()
    {
        return view('instructor.reviews');
    }
    public function students_view ()
    {
        return view('instructor.my-students');
    }
    public function edit_profile_view ()
    {
        return view('instructor.edit-profile');
    }
    public function security_view ()
    {
        return view('instructor.security');
    }
    public function social_profile_view ()
    {
        return view('instructor.social-profile');
    }
}

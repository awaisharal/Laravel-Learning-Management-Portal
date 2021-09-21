<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Curriculum;
use App\Models\Lecture;

class AdminViewsController extends Controller
{
    public function index_view()
    {
        return view('admin.index');
    }
    public function all_instructors_view()
    {
        $instructors = Instructor::orderBy('id', 'desc')->get();
        $ins = Instructor::orderBy('id', 'desc')->get();
        return view('admin.all-instructors', ['instructor' => $instructors, 'ins' => $ins]);
    }
    public function add_instructors_view()
    {
        return view('admin.add-instructors');
    }
    public function all_students_view()
    {
        $students = Student::orderBy('id', 'desc')->get();
        return view('admin.all-students', ['student' => $students]);
    }
    public function add_students_view()
    {
        return view('admin.add-students');
    }
    public function all_courses_view()
    {
        $pending_courses = Course::where('status', '=', "Pending")->orderBy('id', 'desc')->get();
        $approved_courses = Course::where('status', '=', "Approved")->orderBy('id', 'desc')->get();
        $banned_courses = Course::where('status', '=', "Banned")->orderBy('id', 'desc')->get();
        $not_approved_courses = Course::where('status', '=', "Not Approved")->orderBy('id', 'desc')->get();
        return view('admin.all-courses', [
            'pending_course'        =>      $pending_courses,
            'approved_course'       =>      $approved_courses,
            'banned_course'        =>      $banned_courses,
            'not_approved_course'   =>      $not_approved_courses
        ]);
    }
    public function add_courses_view()
    {
        return view('admin.add-courses');
    }
    public function setting_view(Request $request)
    {
        return view('admin.setting');
    }
}

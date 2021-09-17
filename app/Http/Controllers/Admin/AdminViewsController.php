<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\Student;

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
        return view('admin.all-students');
    }
    public function add_students_view()
    {
        return view('admin.add-students');
    }
    public function all_courses_view()
    {
        return view('admin.all-courses');
    }
    public function add_courses_view()
    {
        return view('admin.add-courses');
    }
}

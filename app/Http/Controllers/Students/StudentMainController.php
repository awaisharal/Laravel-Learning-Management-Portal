<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Curriculum;
use App\Models\Lecture;

class StudentMainController extends Controller
{
    public function my_courses_view()
    {
        $categories = CourseCategory::orderBy('id', 'desc')->get();
        return view('student.my-courses', ['categories' => $categories]);
    }
}

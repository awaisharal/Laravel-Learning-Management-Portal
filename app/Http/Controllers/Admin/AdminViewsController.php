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
        if(!empty($instructors))
        {
            foreach($instructors as $instr)
            {
                $ins_id         =   $instr->id;
                $course_count   =   Course::where([
                    ['user_id', '=', $ins_id],
                    ['status', '!=', 'Draft']
                ])->get()->count();
                $instr['course_count'] = $course_count;
                
            }
        }
        $ins = Instructor::orderBy('id', 'desc')->get();
        if(!empty($ins))
        {
            foreach($ins as $instr)
            {
                $ins_id         =   $instr->id;
                $course_count   =   Course::where('user_id', $ins_id)->get()->count();
                $instr['course_count'] = $course_count;
                
            }
        }
        $live_courses       = Course::where('status', '=', "Approved")->get()->count();
        $pending_courses    = Course::where('status', '=', "Pending")->get()->count();
        
        $active_students    = Student::where('status', '=', 1)->get()->count();
        $ban_students       = Student::where('status', '=', 0)->get()->count();
        
        $active_instructors = Instructor::where('status', '=', 1)->get()->count();
        $ban_instructors    = Instructor::where('status', '=', 0)->get()->count();
        
        return view('admin.all-instructors', [
            'instructor'        => $instructors, 
            'ins'               => $ins,
            'live_courses'      => $live_courses,
            'pending_courses'   => $pending_courses,
            'active_students'   => $active_students,
            'ban_students'      => $ban_students,
            'active_instructors'=> $active_instructors,
            'ban_instructors'   => $ban_instructors
        ]);
    }
    public function add_instructors_view()
    {
        return view('admin.add-instructors');
    }
    public function all_students_view()
    {
        $students = Student::orderBy('id', 'desc')->get();

        $live_courses       = Course::where('status', '=', "Approved")->get()->count();
        $pending_courses    = Course::where('status', '=', "Pending")->get()->count();
        
        $active_students    = Student::where('status', '=', 1)->get()->count();
        $ban_students       = Student::where('status', '=', 0)->get()->count();
        
        $active_instructors = Instructor::where('status', '=', 1)->get()->count();
        $ban_instructors    = Instructor::where('status', '=', 0)->get()->count();
        
        return view('admin.all-students', [
            'student'           => $students,
            'live_courses'      => $live_courses,
            'pending_courses'   => $pending_courses,
            'active_students'   => $active_students,
            'ban_students'      => $ban_students,
            'active_instructors'=> $active_instructors,
            'ban_instructors'   => $ban_instructors
        ]);
    }
    public function add_students_view()
    {
        return view('admin.add-students');
    }
    public function all_courses_view()
    {
        $pending_courses = Course::where('status', '=', "Pending")->orderBy('id', 'desc')->get();
        if(!empty($pending_courses))
        {
            foreach($pending_courses as $pc)
            {
                $ins_id = $pc->user_id;
                $ins = Instructor::find($ins_id);
                $name = $ins->name;
                $img = $ins->img;

                $pc['instructor_name'] = $name;
                $pc['instructor_img'] = $img;
            }
        }
        $approved_courses = Course::where('status', '=', "Approved")->orderBy('id', 'desc')->get();
        if(!empty($approved_courses))
        {
            foreach($approved_courses as $pc)
            {
                $ins_id = $pc->user_id;
                $ins = Instructor::find($ins_id);
                $name = $ins->name;

                $pc['instructor_name'] = $name;
            }
        }
        $banned_courses = Course::where('status', '=', "Banned")->orderBy('id', 'desc')->get();
        if(!empty($banned_courses))
        {
            foreach($banned_courses as $pc)
            {
                $ins_id = $pc->user_id;
                $ins = Instructor::find($ins_id);
                $name = $ins->name;

                $pc['instructor_name'] = $name;
            }
        }
        $not_approved_courses = Course::where('status', '=', "Not Approved")->orderBy('id', 'desc')->get();
        if(!empty($not_approved_courses))
        {
            foreach($not_approved_courses as $pc)
            {
                $ins_id = $pc->user_id;
                $ins = Instructor::find($ins_id);
                $name = $ins->name;

                $pc['instructor_name'] = $name;
            }
        }
        return view('admin.all-courses', [
            'pending_course'        =>      $pending_courses,
            'approved_course'       =>      $approved_courses,
            'banned_course'        =>      $banned_courses,
            'not_approved_course'   =>      $not_approved_courses
        ]);
    }
    public function courses_categories_view()
    {
        $categories = CourseCategory::orderBy('id', 'desc')->paginate(5);
        foreach($categories as $cat)
        {
            $id = $cat->id;
            $count = Course::where('category', $id)->count();
            $cat->course_count = $count;
        }
        return view('admin.course-categories', ['categories' => $categories]);
    }
    public function setting_view(Request $request)
    {
        return view('admin.setting');
    }
}

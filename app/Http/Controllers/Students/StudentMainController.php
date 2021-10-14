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
use App\Models\Enrolment;
use App\Models\Bookmark;

class StudentMainController extends Controller
{
    public function my_courses_view()
    {

        $session = session()->get('sessionData')[0];
        $session_id = $session->id;

        $categories = CourseCategory::orderBy('id', 'desc')->get();

        $enroled = Enrolment::where('student_id', $session_id)->where('status','Active')->get();
        $ecount = count($enroled);
        $enroled_courses = [];
        if($ecount > 0)
        {
            foreach($enroled as $obj)
            {
                $course_id = $obj->course_id;
                $course = Course::find($course_id);

                $ins_id = $course->user_id;

                // find course instructor
                $instructor = Instructor::find($ins_id);

                $instructor_id = $instructor->id;
                $instructor_name = $instructor->name;
                $instructor_img = $instructor->img;

                $arr = [
                    'id' => $course->id,
                    'title' => $course->title,
                    'level' => $course->level,
                    'category' => $course->category,
                    'description' => $course->description,
                    'filename' => $course->filename,
                    'duration' => $course->duration,
                    'instructor_id' => $instructor_id,
                    'instructor_name' => $instructor_name,
                    'instructor_img' => $instructor_img
                ];

                array_push($enroled_courses, $arr);
            }
        }

        // Check for Bookmarked courses
        // ========================================

        $bookmarked = Bookmark::where('user_id', $session_id)->get();
        $bcount = count($bookmarked);
        $bookmarked_courses = [];
        if($bcount > 0)
        {
            foreach($bookmarked as $obj)
            {
                $course_id = $obj->course_id;
                $course = Course::find($course_id);

                $ins_id = $course->user_id;

                // find course instructor
                $instructor = Instructor::find($ins_id);

                $instructor_id = $instructor->id;
                $instructor_name = $instructor->name;
                $instructor_img = $instructor->img;

                $arr = [
                    'id' => $course->id,
                    'title' => $course->title,
                    'level' => $course->level,
                    'category' => $course->category,
                    'description' => $course->description,
                    'filename' => $course->filename,
                    'duration' => $course->duration,
                    'instructor_id' => $instructor_id,
                    'instructor_name' => $instructor_name,
                    'instructor_img' => $instructor_img
                ];

                array_push($bookmarked_courses, $arr);
            }
        }
        return view('student.my-courses', ['categories' => $categories,'enroled_courses'=>$enroled_courses,'bookmarked_courses'=>$bookmarked_courses]);
    }
}

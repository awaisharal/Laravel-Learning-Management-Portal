<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Curriculum;
use App\Models\Lecture;
use App\Models\Enrolment;
use DB;


class mainController extends Controller
{
    public function index_view()
    {
        return view('index');
    }
    public function courses()
    {
        $filters = session()->get('filters');
    
        $category_filter = "";
        $filter_str = "level = 'Advance' || level = 'Intermediate' || level = 'Beginner'";
        $data = [];
        if($filters != "" || $filters != null || !empty($filters))
        {
            if($filters['levels'] != null)
            {
                $levels = $filters['levels'];
                $cnt = count($levels);
                $all = array_search("All", $levels);
                $filter_str = "";
                $i = 1;
                if($levels[0] == 'All')
                {
                 $filter_str = "level = 'Advance' || level = 'Intermediate' || level = 'Beginner'";   
                }
                else{
                    if($all != false )
                    {
                        $filter_str = "level = 'Advance' || level = 'Intermediate' || level = 'Beginner'";
                    }
                    else
                    {
                        foreach($levels as $lvl)
                        {
                            if($i == $cnt)
                            {
                                $filter_str .= "level = '$lvl'";    
                            }else{
                                $filter_str .= "level = '$lvl' || ";    
                            }
                            $i++;
                        }    
                    }
                }
            }
            else{
                $filter_str = "level = 'Advance' || level = 'Intermediate' || level = 'Beginner'";
            }
            if($filters['categories'] != null)
            {
                $category_filter = "";
                $cats = $filters['categories'];
                $cat_cnt = count($cats);
                $ii = 0;
                if($cat_cnt == 1)
                {
                    $category_filter .= "&& category=$cats[0]";
                }else{
                    foreach($cats as $cat)
                    {
                        if($ii == 0)
                        {
                            $category_filter .= "&& (category=$cat";    
                        }
                        else
                        {
                            $category_filter .= " || category=$cat)";
                        }
                        $ii++;
                    }
                }
            }else{
                $category_filter = "";
            }
        }

        $maxPage = 20;
        $query = "SELECT * FROM courses WHERE status='Approved' $category_filter && ($filter_str)";
        $courses = DB::select(DB::raw($query));
        
        foreach($courses as $obj)
        {
            $ins_id = $obj->user_id;
            $instructor = Instructor::find($ins_id);

            $instructor_id = $instructor->id;
            $instructor_name = $instructor->name;
            $instructor_img = $instructor->img;

            $obj->instructor_id = $instructor_id;
            $obj->instructor_name = $instructor_name;
            $obj->instructor_img = $instructor_img;
        }
        
        $courses = new Paginator($courses, $maxPage);

        $categories = CourseCategory::where('status', 'Live')->get();

        return view('courses.courses',['categories'=>$categories, 'courses'=>$courses]);
    }
    public function filter_courses(Request $request)
    {
        $categories = $request->category;
        $levels = $request->levels;
        
        $filters = [];

        $filters['categories'] = $categories;
        $filters['levels'] = $levels;

        $request->session()->put('filters', $filters);

        return redirect('/courses');
    }
    public function course_details_page($id)
    {
        if(session()->get('sessionData') != null || session()->get('sessionData') != "")
        {
            $session = session()->get('sessionData')[0];
            $user_id = $session->id;
        }
        
        $course = Course::find($id);
        $sections = Curriculum::where('course_id', $course->id)->get();
        foreach($sections as $obj)
        {
            $id = $obj->id;

            $lectures = Lecture::where('curriculum_id', $id)->get();
            $obj['lectures'] = $lectures;
        }

        $ins_id = $course->user_id;

        $instructor = Instructor::find($ins_id);
        $c = Course::where('user_id', $ins_id)->get();

        $instructor['course_count'] = count($c);

        if(session()->get('sessionData') != null || session()->get('sessionData') != "")
        {
            $enrolCheck = Enrolment::where([
                ['student_id','=',$user_id],
                ['course_id','=',$id],
                ['instructor_id','=',$ins_id],
            ])->get();

            $enrolCount = count($enrolCheck);
        }else{
            $enrolCount = 0;
        }
        return view('courses.course-details', compact('course','sections','instructor','enrolCount'));
    }
    public function enrol_course(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'instructor_id' => 'required',
            'course_id' => 'required'
        ]);
        $student_id = $request->student_id;
        $instructor_id = $request->instructor_id;
        $course_id = $request->course_id;
        
        $check = Enrolment::where([
            ['student_id','=',$student_id],
            ['instructor_id','=',$instructor_id],
            ['course_id','=',$course_id]
        ])->get();

        $count = count($check);
        if($count == 0)
        {
            Enrolment::create([
                'student_id' => $student_id,
                'instructor_id' => $instructor_id,
                'course_id' => $course_id
            ]);

            return redirect('/student/my-courses')->withErrors('course_enroled');
        }else{
            return back();
        }
    }
}

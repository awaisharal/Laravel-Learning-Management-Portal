<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Http\Controllers\EmailsController;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Curriculum;
use App\Models\Lecture;
use App\Models\Enrolment;
use App\Models\Bookmark;
use App\Models\Certificate;
use DB;


class mainController extends Controller
{
    public function index_view()
    {
        return view('index');
    }
    public function courses()
    {
        if(session()->has('sessionData')){
            $session = session()->get('sessionData')[0];
            $session_id = $session->id;    
        }    

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
            $id = $obj->id;

            // find course instructor
            $instructor = Instructor::find($ins_id);

            $instructor_id = $instructor->id;
            $instructor_name = $instructor->name;
            $instructor_img = $instructor->img;

            $obj->instructor_id = $instructor_id;
            $obj->instructor_name = $instructor_name;
            $obj->instructor_img = $instructor_img;

            // Check bookmarks
            if(session()->has('sessionData'))
            {
                $check = Bookmark::where([
                    ['user_id','=',$session_id],
                    ['course_id','=',$id]
                ])->count();
                $obj->bookmark = $check;
            }
            
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
    public function course_details_page($course_id)
    {
        if(session()->get('sessionData') != null || session()->get('sessionData') != "")
        {
            $session = session()->get('sessionData')[0];
            $user_id = $session->id;
        }
        
        $course = Course::find($course_id);
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
                ['course_id','=',$course_id]
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

            // Check if student already exist for this instructor
            $student_check = Assign::where([
                ['student_id','=',$student_id],
                ['instructor_id','=',$instructor_id]
            ])->get();
            $student_check = count($student_check);
            if($student_check == 0)
            {
                Assign::create([
                    'student_id' => $student_id,
                    'instructor_id' => $instructor_id
                ]);
            }
            
            $course = Course::find($course_id);
            $title = $course->title;
            $ins_id = $course->user_id;
            
            $student = Student::find($student_id);
            $student_name = $student->name;
            $student_email = $student->email;
            
            $ins = Instructor::find($ins_id);
            $ins_name = $ins->name;
            $ins_email = $ins->email;

            // Sending emails
            EmailsController::course_enrol_student($title, $student_name, $student_email);
            EmailsController::course_enrol_instructor($title, $ins_name, $ins_email);
            return redirect('/student/my-courses')->withErrors('course_enroled');
        }else{
            return back();
        }
    }
    public function bookmark_course(Request $request)
    {
        $user_id = $request->user_id;
        $course_id = $request->course_id;
    
        $check = Bookmark::where([
            ['user_id','=',$user_id],
            ['course_id','=',$course_id]
        ])->get();

        $count = count($check);

        if($count == 0)
        {
            Bookmark::create([
                'user_id' => $user_id,
                'course_id' => $course_id,
            ]);

            return back();
        }else{
            Bookmark::where([
                ['user_id','=',$user_id],
                ['course_id','=',$course_id]
            ])->delete();

            return back();
        }
    }
    public function watch_course($course_id)
    {
        if(session()->has('sessionData'))
        {
            $user = session()->get('sessionData')[0];
            $user_id = $user->id;

            $enrolCheck = Enrolment::where([
                ['student_id','=',$user_id],
                ['course_id','=',$course_id]
            ])->get();

            $enrolCount = count($enrolCheck);

            if($enrolCount == 1)
            {
                // =======================
                // Get Course Details     |
                // =======================

                $course = Course::find($course_id);
                $curriculums = Curriculum::where('course_id', $course_id)->get();

                foreach($curriculums as $obj)
                {
                    $curriculum_id = $obj->id;
                    $curriculum_name = $obj->name;
                    $lectures = Lecture::where('curriculum_id', $curriculum_id)->get();
                    $obj->lectures = $lectures;
                }  
                if(isset($_GET['s']))
                {
                    if($_GET['s'] != "")
                    {
                        $lec_getID = $_GET['s'];
                        $lecture = Lecture::find($lec_getID);
                    }
                    else{
                        $first_c = Curriculum::where('course_id', $course_id)->orderBy('id','asc')->first();
                        $lecture = Lecture::where('curriculum_id', $first_c->id)->first();
                    }
                    if($_GET['s'] == "complete")
                    {
                        $lec_getID = $_GET['s'];
                        $lecture = "complete";
                    }
                }
                else{
                    $first_c = Curriculum::where('course_id', $course_id)->orderBy('id','asc')->first();
                    if($first_c != null)
                    {
                        $lecture = Lecture::where('curriculum_id', $first_c->id)->first();
                    }
                    else{
                        $lecture = [];
                    }
                }

                // Fetching last lecture
                // ======================

                $last_cur = Curriculum::where('course_id', $course_id)->orderBy('id','desc')->first();
                if($last_cur != null)
                {
                    $last_lecture = Lecture::where('curriculum_id', $last_cur->id)->orderBy('id','desc')->first();
                    $last_lecture_id = $last_lecture->id;
                }else{
                    $last_lecture_id = null;
                }
                
                return view('courses.watch',['course'=>$course,'curriculums'=>$curriculums,'lecture'=>$lecture,'last_lecture_id'=>$last_lecture_id]);
            }else{
                return redirect('/courses/'.$course_id.'/details');
            }

        }else{
            return redirect('/login');
        }
    }
    public function thankyou()
    {
        return view('courses.thankyou');
    }
    public function finish_course(Request $request)
    {
        $user = session()->get('sessionData')[0];
        $user_id = $user->id;
        $course_id = $request->course_id;
        
        Enrolment::where([
            ['student_id','=',$user_id],
            ['course_id','=',$course_id]
        ])->update(['status'=>'Finished']);

        $student_name = $user->name;
        $student_email = $user->email;
        
        $course = Course::find($course_id);
        $ins_id = $course->user_id;
        $title = $course->title;
        $ins = Instructor::find($ins_id);
        $ins_name = $ins->name;
        $ins_email = $ins->email;

        $cert_check = Certificate::where([
            ['student_id','=',$user_id],
            ['instructor_id','=',$ins_id],
            ['course_id','=',$course_id]
        ])->count();

        if($cert_check == 0)
        {
            Certificate::create([
                'student_id' => $user_id,
                'instructor_id' => $ins_id,
                'course_id' => $course_id
            ]);
        }

        EmailsController::course_completion($title, $student_name, $student_email, $ins_name, $ins_email);

        return redirect('/course/completed');
    }
}

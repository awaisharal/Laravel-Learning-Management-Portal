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
        // session()->forget('filters');
        // return $filters;
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
        // return $query;
        $courses = DB::select(DB::raw($query));
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
        // $course_id = $id;
        // $course = Course::where('id', $course_id)->get();
        // return view('courses.course-details', [
        //     'course'   =>  $course,
        // ]);    
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

        return view('courses.course-details', compact('course','sections','instructor'));
    }
}

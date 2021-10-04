<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;

class mainController extends Controller
{
    public function index_view()
    {
        return view('index');
    }
    public function courses()
    {
        $categories = CourseCategory::where('status', 'Live')->get();
        $courses = Course::where([
            'status' => 'Approved'
        ])->get();

        return view('courses.courses',['categories'=>$categories]);
    }
    public function filter_courses(Request $request)
    {
        $categories = $request->category;
        $data = array();
        if(!empty($categories))
        {
            foreach($categories as $cat)
            {
                $courses = Course::where('status','Approved')->where('category',$cat)->get();
                foreach($courses as $c)
                {
                    array_push($data, $c);
                }
            }
        }   

        return $data;

    }
}

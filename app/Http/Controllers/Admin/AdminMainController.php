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
use DB;
class AdminMainController extends Controller
{
    public function approve_course(Request $request)
    {
        $id = $request->id;
        $new_status = "Approved";
        $query = DB::table('courses')->where('id', $id)->update(['status' => $new_status]);
        if ($query) {
            return back()->withErrors('course_approved');
        }else{
            return back()->withErrors('unknownError');
        }
    }
    public function reject_course(Request $request)
    {
        $id = $request->id;
        $new_status = "Not Approved";
        $query = DB::table('courses')->where('id', $id)->update(['status' => $new_status]);
        if ($query) {
            return back()->withErrors('course_rejected');
        }else{
            return back()->withErrors('unknownError');
        }
    }
    public function ban_course(Request $request)
    {
        $id = $request->id;
        $new_status = "Banned";
        $query = DB::table('courses')->where('id', $id)->update(['status' => $new_status]);
        if ($query) {
            return back()->withErrors('course_banned');
        }else{
            return back()->withErrors('unknownError');
        }
    }
    public function unban_course(Request $request)
    {
        $id = $request->id;
        $new_status = "Pending";
        $query = DB::table('courses')->where('id', $id)->update(['status' => $new_status]);
        if ($query) {
            return back()->withErrors('course_unbanned');
        }else{
            return back()->withErrors('unknownError');
        }
    }
    public function ban_student(Request $request)
    {
        $id = $request->id;
        $new_status = 0;
        $query = DB::table('students')->where('id', $id)->update(['status' => $new_status]);
        if ($query) {
            return back()->withErrors('student_banned');
        }else{
            return back()->withErrors('unknownError');
        }
    }
    public function unban_student(Request $request)
    {
        $id = $request->id;
        $new_status = 1;
        $query = DB::table('students')->where('id', $id)->update(['status' => $new_status]);
        if ($query) {
            return back()->withErrors('student_unbanned');
        }else{
            return back()->withErrors('unknownError');
        }
    }
    public function delete_student(Request $request)
    {
        return $request;
    }
    public function edit_instructors_view($id){
        $instructor_id = $id;
        $courses = Course::where('user_id', $instructor_id)->get(); 

        foreach($courses as $course)
        {
            $category_id = $course->category;
            $cat = CourseCategory::find($category_id);
            $category = $cat->name;

            $course->category = $category;
        }
        return view('admin.view-instructor-courses',compact('courses'));
    }
    public function curriculum_view($id){
        $course = Course::find($id);
        $sections = Curriculum::where('course_id', $course->id)->get();
        foreach($sections as $obj)
        {
            $id = $obj->id;

            $lectures = Lecture::where('curriculum_id', $id)->get();
            $obj['lectures'] = $lectures;
        }
        return view('admin.view-curriculum', compact('course','sections'));
    }
    public function course_curriculum_detail_view($id){
        $lectures = Lecture::where('id', $id)->get();
        return view('admin.curriculum-details', ['lecture' => $lectures]);
    }
    public function ban_instructor(Request $request)
    {
        $instructor_id = $request->id;
        $new_status = 0;
        $query = Instructor::where('id', $instructor_id)->update(['status' => $new_status]);
        if ($query) {
            return back()->withErrors('instructor_banned');
        }else{
            return back()->withErrors('unknownError');
        }
    }
    public function unban_instructor(Request $request)
    {
        $instructor_id  = $request->id;
        $new_status     = 1;
        $query = Instructor::where('id', $instructor_id)->update(['status' => $new_status]);
        if ($query) {
            return back()->withErrors('instructor_unbanned');
        }else{
            return back()->withErrors('unknownError');
        }
    }
    public function add_category(Request $request)
    {
        $request->validate([
            'category_name'   => 'required|max:255',
        ]);

        $name = $request->category_name;
        $array = [
            'name'           =>      $name,
        ];
        $category = CourseCategory::create($array);
        if($category)
        {
            return back()->withErrors('cat_added');
        }else{
            return back()->withErrors('unknownError');
        }
        return $request;
    }
    public function edit_category(Request $request)
    {
        $request->validate([
            'name'   => 'required|max:255',
        ]);

        $id = $request->id;
        $name = $request->name;
        $array = [
            'name'           =>      $name,
        ];
        $category = CourseCategory::where('id', $id)->update($array);
        if($category)
        {
            return back()->withErrors('cat_updated');
        }else{
            return back()->withErrors('unknownError');
        }
        return $request;
    }
    public function delete_category(Request $request)
    {
        // return $request;
        $id = $request->id;
        $category = CourseCategory::where('id', $id)->delete();
        if($category)
        {
            return back()->withErrors('cat_deleted');
        }else{
            return back()->withErrors('unknownError');
        }
        return $request;
    }
}

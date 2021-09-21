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
}

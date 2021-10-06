<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Curriculum;
use App\Models\Lecture;

class InstructorViewsController extends Controller
{
    public function instructor_dashboard()
    {
        return redirect('/instructor/dashboard');
    }
    public function dashboard_view()
    {
        return view('instructor.index');
    }
    public function add_course_view()
    {
        $categories = CourseCategory::orderBy('id','desc')->get();
        return view('instructor.add-course',compact('categories'));
    }
    public function my_courses_view ()
    {
        $user = session()->get('sessionData')[0];
        $user_id = $user->id;

        $courses = Course::where('user_id', $user_id)->get(); 

        foreach($courses as $course)
        {
            $category_id = $course->category;
            $cat = CourseCategory::find($category_id);
            $category = $cat->name;

            $course->category = $category;
        }

        return view('instructor.my-courses',compact('courses'));
    }
    public function reviews_view ()
    {
        return view('instructor.reviews');
    }
    public function students_view ()
    {
        return view('instructor.my-students');
    }
    public function edit_profile_view ()
    {
        return view('instructor.edit-profile');
    }
    public function edit_profile(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255'
        ]);

        $name       =   $request->name;
        $phone      =   $request->phone;
        $birthday   =   $request->birthday;

        $user       = session()->get('sessionData')[0];
        $user_id    = $user->id;

        Instructor::where('id',$user_id)->update([
            'name'      =>  $name,
            'phone'     =>  $phone,
            'birthday'  =>  $birthday
        ]);

        return back()->withErrors('success');
    }
    public function edit_address(Request $request)
    {
        $street_address  =   $request->street_address;
        $suburb          =   $request->suburb;
        $postcode        =   $request->postcode;
        $state           =   $request->state;
        $country         =   $request->country;

        $user    = session()->get('sessionData')[0];
        $user_id = $user->id;

        Instructor::where('id',$user_id)->update([
            'street_address'   =>   $street_address,
            'suburb'           =>   $suburb,
            'postcode'         =>   $postcode,
            'state'            =>   $state,
            'country'          =>   $country
        ]);

        return back()->withErrors('addresssuccess');
    } 
    public function security_view ()
    {
        return view('instructor.security');
    }
    public function update_password(Request $request)
    {
        $request->validate([
            'old' => 'required',
            'new1' => 'required',
            'new2' => 'required'
        ]);

        $user = session()->get('sessionData')[0];
        $dbPass = $user->password;
        $user_id = $user->id;

        $old = $request->old;
        $new1 = $request->new1;
        $new2 = $request->new2;

        if($new1 == $new2)
        {
            if (password_verify($old, $dbPass)) {
                $password = bcrypt($new1);
                Instructor::where('id', $user_id)->update(['password'=>$password]);
                return back()->withErrors('success');
            }else
            {
                return back()->withErrors('invalid');
            }
        }else{
            return back()->withErrors('mismatch');
        }
    }
    public function social_profile_view ()
    {
        $user = session()->get('sessionData')[0];
        return view('instructor.social-profile', ['user' => $user]);
    }
    public function edit_social_links(Request $request)
    {
        $twitter_link    =   $request->twitter_link;
        $fb_link         =   $request->fb_link;
        $github_link     =   $request->github_link;
        $linkedin_link   =   $request->linkedin_link;
        $youtube_link    =   $request->youtube_link;
        // return $request;
        $user    = session()->get('sessionData')[0];
        $user_id = $user->id;

        Instructor::where('id',$user_id)->update([
            'twitter_link'  => $twitter_link,
            'fb_link'       => $fb_link,
            'github_link'   => $github_link,
            'linkedin_link' => $linkedin_link,
            'youtube_link'  => $youtube_link
        ]);

        return back()->withErrors('success');
    } 
    public function add_course(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:255',
            'level' => 'required|max:255',
            'description' => 'required',
            'thumbnail' => 'required|mimes:jpeg,jpg,png|max:10000',
            'url' => 'required',
            'tags' => 'required|max:255',
            'hrs' => 'required|max:10',
            'min' => 'required|max:10',
        ]);

        $user = session()->get('sessionData')[0];
        $user_id = $user->id;

        $title = $request->title;
        $category = $request->category;
        $level = $request->level;
        $description = $request->description;
        $thumbnail = $request->thumbnail;
        $url = $request->url;
        $tags = $request->tags;
        $hrs = $request->hrs;
        $min = $request->min;

        if($hrs > 0)
        {
            $duration = $hrs.'h '.$min.'m';
        }else{
            $duration = $min.'m';
        }
        if($min == 0)
        {
            $duration = $hrs.'h';
        }

        $ext = $thumbnail->getClientOriginalExtension();    
        $filename = uniqid(rand(999, 999999)).time().'.'.$ext;

        $filepath = "uploads/thumbnails/";

        if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $filepath.$filename))
        {
            Course::create([
                'title' => $title,
                'level' => $level,
                'category' => $category,
                'description' => $description,
                'filename' => $filename,
                'url' => $url,
                'tags' => $tags,
                'duration' => $duration,
                'user_id' => $user_id
            ]);

            return redirect("/instructor/my-courses");
        }else{
            return back()->withErrors('serverError');
        }
    }
    public function editCourseView($id)
    {
        $course_id = $id;
        $course = Course::where('id', $course_id)->orderBy('id','desc')->get();
        $categories = CourseCategory::orderBy('id','desc')->get();
        $course_count = $course->count();
        if ($course_count == 0){
            return redirect('/instructor/my-courses');
        }else{

            // Exploding duration

            $duration = $course[0]->duration;

            $ex = explode("h",$duration);
            $hours = $ex[0];
            $min_ex = $ex[1];
            $ex2 = explode("m",$min_ex);
            $mins = $ex2[0];

            $course[0]->hours = $hours;
            $course[0]->mins = $mins;


            return view('instructor.edit-course', ['course' => $course,'categories'=>$categories]);
        }
    }
    public function editCourse(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:255',
            'level' => 'required|max:255',
            'url' => 'required|max:255',
            'description' => 'required',
            'tags' => 'required',
            'hrs' => 'required',
            'min' => 'required'
        ]);

        $title = $request->title;
        $category = $request->category;
        $level = $request->level;
        $description = $request->description;
        $tags = $request->tags;
        $url = $request->url;
        $hrs = $request->hrs;
        $min = $request->min;
        $id = $request->id;

        if($hrs > 0)
        {
            $duration = $hrs.'h '.$min.'m';
        }else{
            $duration = $min.'m';
        }
        if($min == 0)
        {
            $duration = $hrs.'h';
        }

        Course::where('id', $id)->update([
            'title' => $title,
            'level' => $level,
            'category' => $category,
            'description' => $description,
            'url' => $url,
            'duration' => $duration,
            'tags' => $tags
        ]);

        return redirect("/instructor/my-courses")->withErrors('courseUpdated');        
    }
    public function course_curriculum_view($id)
    {
        $course = Course::find($id);
        $sections = Curriculum::where('course_id', $course->id)->get();
        foreach($sections as $obj)
        {
            $id = $obj->id;

            $lectures = Lecture::where('curriculum_id', $id)->get();
            $obj['lectures'] = $lectures;
        }
        return view('instructor.curriculum', compact('course','sections'));
    }   
    public function add_section(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $user = session()->get('sessionData')[0];
        $user_id = $user->id;
        $course_id = $request->course_id;
        $name = $request->name;
        
        Curriculum::create([
            'name' => $name, 
            'user_id' => $user_id,
            'course_id' => $course_id
        ]);

        return back()->withErrors('sectionAdded');
    }
    public function add_lecture(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'mimes:mp4,mov,ogg,qt',
        ]);

        $user = session()->get('sessionData')[0];
        $user_id = $user->id;
        $title = $request->title;   
        $description = $request->description;   
        $course_id = $request->course_id;   
        $curriculum_id = $request->curriculum_id;   

       if($request->file != null || $request->file != "")
        {
            $file = $request->file;   
            $ext = $file->getClientOriginalExtension();    
            $filename = uniqid(rand(999, 999999)).time().'.'.$ext;

            $filepath = "uploads/lectures/";

            move_uploaded_file($_FILES['file']['tmp_name'], $filepath.$filename);
        }else{
            $filename = null;
        }
        Lecture::create([
            'title' => $title,
            'description' => $description,
            'video' => $filename,
            'curriculum_id' => $curriculum_id,
            'course_id' => $course_id,
            'user_id' => $user_id
        ]);

        return back()->withErrors('lectureAdded');
    }
    public function editLectureView($id)
    {
        $lecture_id = $id;
        $lecture = Lecture::where('id', $lecture_id)->orderBy('id','desc')->get();
        $lecture_count = $lecture->count();
        if ($lecture_count == 0){
            return redirect('/instructor/my-courses');
        }else{
            return view('instructor.edit-curriculum', ['lecture' => $lecture]);
        }
    }
    public function editLecture(Request $request)
    {
        $validate = $request->validate([
            'title'         => 'required|max:255',
            'description'   => 'required|max:1500'
        ]);
        $id           =   $request->id;
        $title        =   $request->title;
        $description  =   $request->description;

        $obj = Lecture::find($id);
        // return $obj;
        if(!empty($obj)){
            Lecture::where('id', $id)->update(['title' => $title, 'description' => $description]);
            return back()->withErrors('LectureUpdated');
        }else{
            return back()->with('error','Unknown error. Please try again later.');
        }
        // return $request;
    }
    public function delete_lecture(Request $request)
    {
        $id = $request->id;
        $data = Lecture::find($id);
        $data->delete();
        return back()->withErrors('Lecture deleted successfully');
    }
    public function edit_section(Request $request)
    {   
        $validate = $request->validate([
            'name' => 'required|max:255'
        ]);
        $id = $request->id;
        $name = $request->name;

        $obj = Curriculum::find($id);
        if(!empty($obj)){
            Curriculum::where('id', $id)->update(['name'=>$name]);
            return back()->withErrors('sectionUpdated');
        }else{
            return back()->with('error','Unknown error. Please try again later.');
        }
    }
    public function delete_section(Request $request)
    {
        $id = $request->id;
        
        // deleting all lectures of this section
        $lec = Lecture::where('curriculum_id', $id)->delete();
        
        // Deleting section itself
        
        $obj = Curriculum::find($id);
        $obj->delete();

        return back()->withErrors('sectionDeleted');
    }
    public function update_profile_pic(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png|max:10000'
        ]);
        
        $file = $request->file;
        $user = session()->get('sessionData')[0];
        $user_id = $user->id;

        $ext = $file->getClientOriginalExtension();    
        $filename = uniqid(rand(999, 999999)).time().'.'.$ext;

        $filepath = "uploads/profiles/";

        if(move_uploaded_file($_FILES['file']['tmp_name'], $filepath.$filename))
        {        
            Instructor::where('id', $user_id)->update([
                'img' => $filename
            ]);

            return back()->withErrors('success');
        }else{
            return back()->withErrors('DPError');
        }
    }
    public function delete_profile_pic(Request $request)
    {
        $user = session()->get('sessionData')[0];
        $user_id = $user->id;

        Instructor::where('id', $user_id)->update([
            'img' => ""
        ]);

        return back()->withErrors("success");
    }
    public function submit_for_approval(Request $request)
    {
        $id = $request->id;
        $status = "Pending";
        Course::where('id', $id)->update(['status'=>$status]);

        return back()->withErrors('CourseSubmitSuccess');
    }
}

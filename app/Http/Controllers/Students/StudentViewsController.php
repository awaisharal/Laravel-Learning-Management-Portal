<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentViewsController extends Controller
{
    public function student_dashboard()
    {
        return redirect('/student/dashboard');
    }
    public function dashboard_view()
    {
        return view('student.index');
    }
    public function edit_profile_view ()
    {
        return view('student.edit-profile');
    }
    public function edit_profile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'birthday' => 'max:255',
            'address_line1' => 'max:255',
            'address_line2' => 'max:255',
            'city' => 'max:255',
            'state' => 'max:255',
            'country' => 'max:255'
        ]);
        $id = $request->id;
        $name = $request->name;
        $phone = $request->phone;
        $birthday = $request->birthday;
        $address_line1 = $request->address_line1;
        $address_line2 = $request->address_line2;
        $city = $request->city;
        $state = $request->state;
        $country = $request->country;

        Student::where('id', $id)->update([
            'name' => $name,
            'phone' => $phone,
            'birthday' => $birthday,
            'address_line1' => $address_line1,
            'address_line2' => $address_line2,
            'city' => $city,
            'state' => $state,
            'country' => $country
        ]);

        return back()->withErrors('PersonalSuccess');
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

        $filepath = "uploads/profiles/students/";

        if(move_uploaded_file($_FILES['file']['tmp_name'], $filepath.$filename))
        {        
            Student::where('id', $user_id)->update([
                'img' => $filename
            ]);

            return back()->withErrors('DPSuccess');
        }else{
            return back()->withErrors('error');
        }
    }
    public function security_view ()
    {
        return view('student.security');
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
                Student::where('id', $user_id)->update(['password'=>$password]);
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
        return view('student.social-profile');
    }
}

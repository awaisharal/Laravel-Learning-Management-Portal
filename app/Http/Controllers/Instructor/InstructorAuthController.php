<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\EmailsController;
use App\Models\Instructor;

class InstructorAuthController extends Controller
{
    public function add_instructor(Request $request)
    {
        $request->validate([
            'first_name'        => 'required|max:14',
            'last_name'         => 'required|max:14',
            'email'             => 'required|unique:instructors|email|max:255',
            'phone'             => 'required|max:16',
            'password'          => 'required|max:14',
            'confirm_password'  => 'required|same:password|max:14'
        ]);
        $first_name            =        $request->first_name;
        $last_name             =        $request->last_name;
        $phone                 =        $request->phone;
        $email                 =        $request->email;
        $password              =        $request->password;
        $confirm_password      =        $request->confirm_password;
        $status                =        1;
        $students              =        0;
        $courses               =        0;
        
        $checkEmail = Instructor::where('email', $email)->get();
        if($checkEmail->isEmpty()){
            $password = bcrypt($request->password);
            $name = $first_name." ".$last_name;
            
            $array = [
                'name'           =>      $name,
                'email'          =>      $email,
                'phone'          =>      $phone,
                'password'       =>      $password,
                'students'       =>      $students,
                'courses'        =>      $courses,
                'status'         =>      $status,
            ];
            $user = Instructor::create($array);
            
            if($user)
            {
                // Sending welcome email
                // =====================
                EmailsController::instructor_welcome($name, $email, $confirm_password);    
                return back()->withErrors('user_created');
            }else{
                return back()->withErrors('unknownError');
            }
        }else{
            return back()->withErrors('emailError');
        }
    }
    public function login_view ()
    {
        return view('instructor.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255'
        ]);
        $email = $request->email;
        $password = $request->password;

        $user = Instructor::where('email', $email)->get();
        if(!$user->isEmpty())
        {   
            $dbPass = $user[0]->password;
            $dbStatus = $user[0]->status;
            if(password_verify($password, $dbPass))
            {
                if ($dbStatus == 0) {
                    return back()->withErrors('banned');
                }else{
                    $request->session()->put('InstructorEmail',$email);
                    $request->session()->put('sessionData',$user);
                    return redirect('/instructor/');
                }
            }
            else
            {
                return back()->withErrors('pass_not_match');
            }
        }else{
            return back()->withErrors('email_not_match');

        }
    }
    public function logoutInstructor()
    {
        session()->forget('InstructorEmail');
        return redirect('/instructor/login');
    }
}

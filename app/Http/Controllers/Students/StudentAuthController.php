<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\EmailsController;
use App\Models\Student;

class StudentAuthController extends Controller
{
    public function add_students(Request $request)
    {
        $request->validate([
            'first_name'        => 'required|regex:/^[a-zA-Z]+$/u||max:14',
            'last_name'         => 'required|regex:/^[a-zA-Z]+$/u||max:14',
            'email'             => 'required|unique:students|email|max:255',
            'phone'             => 'required|numeric',
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
        
        $checkEmail = Student::where('email', $email)->get();
        if($checkEmail->isEmpty()){
            $password = bcrypt($request->password);
            $name = $first_name." ".$last_name;
            
            $array = [
                'name'           =>      $name,
                'email'          =>      $email,
                'phone'          =>      $phone,
                'password'       =>      $password,
                'status'         =>      $status,
            ];
            $user = Student::create($array);
            if($user)
            {
                // Sending welcome email
                // =====================
                EmailsController::student_welcome($name, $email, $confirm_password);
                return back()->withErrors('user_created');
            }else{
                return back()->withErrors('unknownError');
            }
        }else{
            return back()->withErrors('emailError');
        }
        // return $request;
    }
    public function login_view ()
    {
        return view('student.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255'
        ]);
        $email = $request->email;
        $password = $request->password;

        $user = Student::where('email', $email)->get();
        if(!$user->isEmpty())
        {   
            $dbPass = $user[0]->password;
            $dbStatus = $user[0]->status;
            if(password_verify($password, $dbPass))
            {
                if ($dbStatus == 0) {
                    return back()->withErrors('banned');
                }else{
                    $request->session()->put('StudentEmail',$email);
                    $request->session()->put('sessionData',$user);

                    if(isset($request->enrol_page))
                    {
                        return back();
                    }
                    return redirect('/student');
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
    public function forget_password(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255'
        ]);

        $email = $request->email;

        $student = Student::where(['email'=> $email])->get();
        if(!$student->isEmpty())
        {
            $id = $student[0]->id;
            $name = $student[0]->name;
            
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$_';
            $len = 48;
            $l = strlen($chars) - 1;
            $hash = '';
            for ($i = 0; $i < $len; ++$i) {
                $hash .= $chars[rand(0, $l)];
            }
            $hash = $id.$hash;

            EmailsController::forget_password_student($name, $email, $hash);

            return back()->withErrors('resetSuccess');
        }else{
            return back()->withErrors('emailMatchError');
        }
        
    }
    public function reset_password_page($hash)
    {
        $id = $hash[0];
        $student = Student::find($id);
        if(empty($student))
        {
            return redirect('/login');
        }

        return view('student.change-password',['id'=>$id]);
    }
    public function reset_password(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'pass1' => 'required|max:255',
            'pass2' => 'required|max:255'
        ]);

        $id = $request->id;
        $pass1 = $request->pass1;
        $pass2 = $request->pass2;

        $student = Student::find($id);
        if(empty($student))
        {
            return redirect('/login');
        }

        if($pass1 != $pass2)
        {
            return back()->withErrors('pass_not_match');
        }

        $hash = bcrypt($pass1);

        Student::where('id', $id)->update(['password'=> $hash]);

        return redirect('/login')->withErrors('password_changed');
    }
    public function logoutStudent()
    {
        session()->forget('StudentEmail');
        session()->forget('sessionData');
        return redirect('/login');
    }
}

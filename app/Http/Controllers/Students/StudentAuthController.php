<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentAuthController extends Controller
{
    public function add_students(Request $request)
    {
        $request->validate([
            'first_name'        => 'required|max:14',
            'last_name'         => 'required|max:14',
            'email'             => 'required|unique:students|email|max:255',
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
                // $request->session()->put('email', $email);
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
    public function logoutStudent()
    {
        session()->forget('StudentEmail');
        session()->forget('sessionData');
        return redirect('/login');
    }
}

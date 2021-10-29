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
            'first_name'        => 'required|regex:/^[a-zA-Z]+$/u||max:14',
            'last_name'         => 'required|regex:/^[a-zA-Z]+$/u||max:14',
            'email'             => 'required|unique:instructors|email|max:255',
            'phone'             => 'required|numeric',
            'title'             => 'max:30',
            'password'          => 'required|min:6|max:14',
            'confirm_password'  => 'required|same:password|max:14'
        ]);
        $first_name            =        $request->first_name;
        $last_name             =        $request->last_name;
        $phone                 =        $request->phone;
        $email                 =        $request->email;
        $title                 =        $request->title;
        $date                  =        $request->date;
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
                'title'          =>      $title,
                'join_date'      =>      $date,
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
    public function forget_password(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255'
        ]);

        $email = $request->email;

        $ins = Instructor::where(['email'=> $email])->get();
        if(!$ins->isEmpty())
        {
            $id = $ins[0]->id;
            $name = $ins[0]->name;
            
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$_';
            $len = 48;
            $l = strlen($chars) - 1;
            $hash = '';
            for ($i = 0; $i < $len; ++$i) {
                $hash .= $chars[rand(0, $l)];
            }
            $hash = $id.$hash;

            EmailsController::forget_password_instructor($name, $email, $hash);

            return back()->withErrors('resetSuccess');
        }else{
            return back()->withErrors('emailMatchError');
        }
        
    }
    public function reset_password_page($hash)
    {
        $id = $hash[0];
        $data = Instructor::find($id);
        if(empty($data))
        {
            return redirect('/instructor/login');
        }

        return view('instructor.change-password',['id'=>$id]);
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

        $ins = Instructor::find($id);
        if(empty($ins))
        {
            return redirect('/instructor/login');
        }

        if($pass1 != $pass2)
        {
            return back()->withErrors('pass_not_match');
        }

        $hash = bcrypt($pass1);

        Instructor::where('id', $id)->update(['password'=> $hash]);

        return redirect('/instructor/login')->withErrors('password_changed');
    }
    public function logoutInstructor()
    {
        session()->forget('InstructorEmail');
        return redirect('/instructor/login');
    }
}

<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Question;

class QuizController extends Controller
{
    public function add_quiz(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ]);

        $user = session()->get('sessionData')[0];
        $user_id = $user->id;
        $title = $request->title;   
        $course_id = $request->course_id;   
        $curriculum_id = $request->curriculum_id;   
        $type = "Quiz";

        Lecture::create([
            'title' => $title,
            'curriculum_id' => $curriculum_id,
            'course_id' => $course_id,
            'type' => $type,
            'user_id' => $user_id
        ]);

        return back()->withErrors('quizAdded');
    }
    public function edit_quiz(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255'
        ]);

        $id = $request->id;
        $title = $request->title;
    
        Lecture::where('id', $id)->update(['title'=>$title]);

        return back()->withErrors('quizUpdated');
    }
    public function quiz_details_view($course_id, $quiz_id, $section_id)
    {
        $course = Course::find($course_id);
        if(empty($course))
        {
            return redirect('/instructor');
        }
        $ins_id = $course->user_id;
        if(!session()->has('InstructorEmail'))
        {
            return redirect('/instructor');
        }
        $session = session()->get('sessionData')[0];
        $session_id = $session->id;
        if($session_id != $ins_id)
        {
            return redirect('/instructor');
        }

        $quiz = Lecture::find($quiz_id);
        $questions = Question::where('section_id', $section_id)->get();
        return view('instructor.quiz-details',['course_id'=>$course_id,'quiz'=>$quiz,'section_id'=>$section_id,'questions'=>$questions]);
    }
    public function add_question(Request $request)
    {
        $request->validate([
            'question' => 'required|max:255',
            'opt1' => 'required|max:255',
            'opt2' => 'required|max:255',
            'opt3' => 'required|max:255',
            'opt4' => 'required|max:255',
            'correct' => 'required'
        ]);

        $question = $request->question;
        $opt1 = $request->opt1;
        $opt2 = $request->opt2;
        $opt3 = $request->opt3;
        $opt4 = $request->opt4;
        $correct = $request->correct;
        $course_id = $request->course_id;
        $section_id = $request->section_id;

        if($correct == 1)
        {
            $correct = $opt1;
        }elseif ($correct == 2) {
            $correct = $opt2;
        }elseif ($correct == 3) {
            $correct = $opt3;
        }elseif ($correct == 4) {
            $correct = $opt4;
        }

        Question::create([
            'question' => $question,
            'option1' => $opt1,
            'option2' => $opt2,
            'option3' => $opt3,
            'option4' => $opt4,
            'correct' => $correct,
            'course_id' => $course_id,
            'section_id' => $section_id
        ]);

        return back()->withErrors('questionAdded');
    }
}

<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Attempt;
use App\Models\Result;

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
        $quiz_id = $request->quiz_id;

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
            'section_id' => $section_id,
            'quiz_id' => $quiz_id
        ]);

        return back()->withErrors('questionAdded');
    }
    public function delete_question(Request $request)
    {
        $id = $request->id;

        $res = Question::find($id);
        $res->delete();
        return back()->withErrors('questionDeleted');
    }
    public function quiz_attempt_view($course_id, $quiz_id)
    {
        $quiz = Lecture::find($quiz_id);

        if(empty($quiz))
        {
            return redirect('/student');
        }

        $session = session()->get('sessionData')[0];
        $student_id = $session->id;
        $section_id = $quiz->curriculum_id;
        $questions = Question::where('section_id', $section_id)->get();
        $question = null;
        $question_no = 0;
        $total = count($questions);
        $i = 1;
        foreach($questions as $obj)
        {
            $id = $obj->id;
            $res = Answer::where([
                ['student_id','=',$student_id],
                ['question_id','=',$id]
            ])->count();
            if($res == 0)
            {
                $question = $obj;
            }

        }

        $check2 = Answer::where([
                ['student_id','=',$student_id],
                ['quiz_id','=',$quiz_id]
            ])->count();
        $question_no = $check2+1; 
        return view('courses.attempt-quiz',['question'=>$question,'course_id'=>$course_id,'quiz_id'=>$quiz_id,'question_no'=>$question_no,'total'=>$total]);
    }
    public function submit_answer(Request $request)
    {
        $request->validate([
            'answer' => 'required'
        ]);
        $answer = $request->answer;
        $question_id = $request->question_id;
        $quiz_id = $request->quiz_id;
        $course_id = $request->course_id;
        $session = session()->get('sessionData')[0];
        $student_id = $session->id;
        $is_correct = "wrong";


        $check = Answer::where([
            ['student_id','=', $student_id],
            ['quiz_id','=', $quiz_id],
            ['question_id','=', $question_id]
        ])->count();

        if($check == 0)
        {

            // Check if answer is correct or wrong
            $question = Question::find($question_id);
            if($question->correct == $answer)
            {
                $is_correct = "correct";
            }
            Answer::create([
                'question_id' => $question_id,
                'quiz_id' => $quiz_id,
                'course_id' => $course_id,
                'student_id' => $student_id,
                'status' => $is_correct
            ]);
        }

        $check2 = Attempt::where([
            ['student_id','=', $student_id],
            ['quiz_id','=', $quiz_id],
            ['course_id','=', $course_id]
        ])->count();
        if($check2 == 0)
        {
            Attempt::create([
                'student_id' => $student_id,
                'course_id' => $course_id,
                'quiz_id' => $quiz_id
            ]);
        }

        if(isset($request->finish))
        {
            Attempt::where([
                ['student_id','=', $student_id],
                ['quiz_id','=', $quiz_id],
                ['course_id','=', $course_id]
            ])->update(['status'=>'Complete']);

            // Calculating results
            $total_questions = Question::where('quiz_id',$quiz_id)->count();
            $correct_answers = Answer::where([
                ['student_id','=',$student_id],
                ['quiz_id','=',$quiz_id],
                ['status','=','correct']
            ])->count();
            
            $percentage = ($correct_answers/$total_questions)*100;

            if($percentage >= 60)
            {
                $result_status = 'Pass';
            }else{
                $result_status = 'Fail';
            }

            Result::create([
                'student_id' => $student_id,
                'quiz_id' => $quiz_id,
                'course_id' => $course_id,
                'total_questions' => $total_questions,
                'correct' => $correct_answers,
                'percentage' => $percentage,
                'status' => $result_status
            ]);

            $route = '/courses/'.$course_id.'/watch?s='.$quiz_id+1;
            return redirect($route)->withErrors('quizCompleted');
        }

        return redirect()->back();

    }
}

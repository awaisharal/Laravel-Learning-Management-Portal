@extends('courses.partials.layout')

@section('meta')

<title>Quiz | {{config('app.name')}}</title>

@endsection

@section('main_content')
    

  <div class="mt-5 course-container" style="position:static!important;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <form action="{{route('answer.submit')}}" method="POST">
          @csrf
          <div class="card quizWrapper col-md-8 offset-md-2">
            <div class="text-center">
              <h2 style="font-size:35px;" class="mt-5 mb-5">Quiz</h2>
            </div>
            <div class="questionSection" style="padding:20px;">
              <h4>Q{{$question_no}})</h4>
              <p style="margin-left:15px;">{{$question->question}}</p>
            </div>
            <div class="optionSection" style="padding:20px;">
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">
                    <input type="radio" name="answer" id="radio1" value="{{$question->option1}}" />
                    <label class="option" for="radio1">{{$question->option1}}</label>
                  </div>
                  <div class="col-md-6">
                    <input type="radio" name="answer" id="radio2" value="{{$question->option2}}" />
                    <label class="option" for="radio2">{{$question->option2}}</label>
                  </div>
                </div>
                <div class="row mt-5">
                  <div class="col-md-6">
                    <input type="radio" name="answer" id="radio3" value="{{$question->option3}}" />
                    <label class="option" for="radio3">{{$question->option3}}</label>
                  </div>
                  <div class="col-md-6">
                    <input type="radio" name="answer" id="radio4" value="{{$question->option4}}" />
                    <label class="option" for="radio4">{{$question->option4}}</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <input type="hidden" name="question_id" value="{{$question->id}}">
              <input type="hidden" name="quiz_id" value="{{$quiz_id}}">
              <input type="hidden" name="course_id" value="{{$course_id}}">
              @if($question_no == $total)
              <input type="hidden" name="finish" value="1" />
              @endif
              <div class="row">
                <div class="col-md-6">
                  <p style="font-size:18px;">
                    {{$question_no}}/{{$total}}
                  </p>
                </div>
                <div class="col-md-6">
                  @if($question_no == $total)
                  <button class="btn btn-success btn-sm" style="float:right;">Finish <i class="fe fe-chevron-right"></i></button>
                  @else
                  <button class="btn btn-info btn-sm" style="float:right;">Next <i class="fe fe-chevron-right"></i></button>
                  @endif
                </div>
              </div>
            </div>
          </div>    
          </form>
        </div>
      </div>
    </div>
  </div>



  <script>

  </script>

@endsection


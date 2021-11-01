@extends('instructor.partials.layout')

@section('meta')

<title>Instructor Dashboard | {{config('app.name')}}</title>

@endsection

@section('css')
<style>
	.add-course-btn{
		display: none!important;
	}
</style>
@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
  <!-- Page Content -->
  <div class="pb-12">
    <div class="container">
      <div id="courseForm" class="bs-stepper">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="card mb-3 " style="padding:0px 15px 0px 15px;">
              @if(count($errors->all()) > 0)
                @if($errors->first() == 'serverError')
                  <div class="alert alert-warning mt-5">
                    Something went wrong. Please try again later!
                  </div>
                @endif
                @if($errors->first() == 'questionAdded')
                  <div class="alert alert-success">
                    New question successfully added
                  </div>
                @endif
              @endif
              <div class="card-header border-bottom px-4 py-3">
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="mb-0">Manage Quiz ({{$quiz->title}})</h4>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <button class="btn btn-primary btn-sm" onclick="addQuestionModal()">
                      Add Question
                    </button>
                  </div>
                </div>
              </div>
              <table class="table table-hover table-striped table-bordered">
                <thead>
                  <tr>
                    <th></th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($questions))
                  @php $i=1; @endphp
                  @foreach($questions as $obj)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$obj->question}}</td>
                    <td>{{$obj->correct}}</td>
                    <td style="text-align:right">
                      <button class="btn btn-primary btn-xs" onclick="hintModal('{{$obj->option1}}','{{$obj->option2}}','{{$obj->option3}}','{{$obj->option4}}','{{$obj->correct}}')">
                        <i class="fe fe-info"></i>
                      </button>
                      <button class="btn btn-danger btn-xs">
                        <i class="fe fe-trash"></i>
                      </button>
                    </td>
                  </tr>
                  @php $i++; @endphp
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Add Question Modal --}}
<div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="addSectionModalLabel1">
          Add Question
        </h4>
        <button type="button" class="close-btn no-bg" data-dismiss="modal" aria-label="Close" onclick="dismissModal()">
            <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('quiz.addQuestion')}}" method="post">
        @csrf
          <div class="form-group">
            <label for="question">Question</label>
            <input class="form-control mb-3" type="text" name="question" placeholder="Enter question here.." required value="{{old('question')}}" />
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Option 1</label>
                <input type="text" class="form-control mb-3" name="opt1" placeholder="Enter option here" value="{{old('opt1')}}" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="ans2">Option 2</label>
                <input type="text" class="form-control mb-3" name="opt2" placeholder="Enter option here" value="{{old('opt2')}}"/>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Option 3</label>
                <input type="text" class="form-control mb-3" name="opt3" placeholder="Enter option here" value="{{old('opt3')}}" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="ans2">Option 4</label>
                <input type="text" class="form-control mb-3" name="opt4" placeholder="Enter option here" value="{{old('opt4')}}" />
              </div>
            </div>
          </div>
          <div class="mb-3">
            <p>
              <label>Correct Answer</label>
            </p>
            <div class="row">
              <div class="col-md-6">
                <input type="radio" id="c1" name="correct" value="1" />
                <label for="c1"> Option 1</label>
              </div>
              <div class="col-md-6">
                <input type="radio" id="c2" name="correct" value="2" />
                <label for="c2"> Option 2</label>
              </div>
            </div><br>
            <div class="row">
              <div class="col-md-6">
                <input type="radio" id="c3" name="correct" value="3" />
                <label for="c3"> Option 3</label>
              </div>
              <div class="col-md-6">
                <input type="radio" id="c4" name="correct" value="4" />
                <label for="c4"> Option 4</label>
              </div>
            </div>
          </div>
          <input type="hidden" id="course_id" name="course_id" value="{{$course_id}}" />
          <input type="hidden" id="section_id" name="section_id" value="{{$section_id}}" />
          <button class="btn btn-primary" type="submit">
              Add Question
          </button>
          <button type="button" class="btn btn-outline-white" data-dismiss="modal" aria-label="Close" onclick="dismissModal()">
              Close
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Hint Modal --}}
<div class="modal fade" id="hintModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="addSectionModalLabel1">
          Preview
        </h4>
        <button type="button" class="close-btn no-bg" data-dismiss="modal" aria-label="Close" onclick="dismissModal()">
            <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <h4>Options</h4>
            <div class="row mb-3 mt-3">
              <div class="col-md-6">
                <div class="alert alert-info">
                  <i class="fe fe-arrow-right"></i> &nbsp;
                  <span id="opt1">Option 1</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="alert alert-info">
                  <i class="fe fe-arrow-right"></i> &nbsp;
                  <span id="opt2">Option 2</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="alert alert-info">
                  <i class="fe fe-arrow-right"></i> &nbsp;
                  <span id="opt3">Option 3</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="alert alert-info">
                  <i class="fe fe-arrow-right"></i> &nbsp;
                  <span id="opt4">Option 4</span>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <h4 class="">Correct Answer</h4>
            <div class="clearfix"></div>
            <div class="alert alert-info mt-3" style="width: 100%;" id="correct">
              <i class="fe fe-check"></i> &nbsp;
              Correct Answer
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $("#sidenav ul li#myCourses").addClass("active");
  function addQuestionModal(){
    $("#addQuestionModal").modal('show');
  }
  function hintModal(opt1,opt2,opt3,opt4,correct)
  {
    $("#opt1").text(opt1);
    $("#opt2").text(opt2);
    $("#opt3").text(opt3);
    $("#opt4").text(opt4);
    $("#correct").text(correct);
    $("#hintModal").modal('show');
  }
</script>
@endsection
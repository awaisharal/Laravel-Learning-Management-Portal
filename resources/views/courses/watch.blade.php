@extends('courses.partials.layout')

@section('meta')

<title>Watch Course | {{config('app.name')}}</title>

@endsection

@section('main_content')
    

  <div class="mt-5 course-container" style="position:static!important;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
           <!-- Tab content -->
           <div class="tab-content content" id="course-tabContent">
            
	            <div class="tab-pane fade show active" id="course-intro" role="tabpanel" aria-labelledby="course-intro-tab">
	              <div class="row">
                 <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                      <div>
                        <h3 class=" mb-0  text-truncate-line-2">
                          @if($lecture != "complete")
                            @if(isset($lecture->title))
                              {{$lecture->title}}
                            @endif
                          @else
                            Complete this Course
                          @endif
                        </h3>
                      </div>
                    </div>
                 </div>
                </div>
                
	              <!-- Video -->
                @if(isset($lecture->video))
  	              @if($lecture->video != null)
    	              <div class="embed-responsive  position-relative w-100 d-block overflow-hidde p-0" style="height: 600px;">
      		            <iframe class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100" src="uploads/lectures/{{$lecture->video}}"></iframe>
      		          </div>
                  @endif
  		          @endif
		          <div class="container-fluid watchPageDecs">
		          	<p>
                  @if(isset($lecture->description))
		          		<?php  echo $lecture->description; ?>
                  @else
                    <h4>
                      The standard Lorem Ipsum passage, used since the 1500s
                    </h4>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>

                    <div class="text-center">
                      <button class="btn btn-info btn-sm btn-finish-course" onclick="finishCourse()">
                         Finish Course 
                         <i class="fe fe-arrow-right"></i>
                      </button>
                    </div>
                  @endif
		          	</p>
		          </div>
	            </div>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Card -->
  <div class="card course-sidebar " id="courseAccordion">
      <!-- List group -->
      <ul class="list-group list-group-flush course-list">
        <li class="list-group-item">
          <h4 class="mb-0">Table of Content</h4>
        </li>
        <!-- List group item -->
        @php $i = 1; @endphp
        @if(!empty($curriculums))
        @foreach($curriculums as $obj)
        <li class="list-group-item">
          <!-- Toggle -->
          <a class="d-flex align-items-center text-inherit text-decoration-none h4 mb-0" data-bs-toggle="collapse"
            href="#course-{{$i}}" role="button" aria-expanded="false" aria-controls="course-{{$i}}">
            <div class="me-auto">
              {{$obj->name}}
            </div>
            <!-- Chevron -->
            <span class="chevron-arrow  ms-4">
              <i class="fe fe-chevron-down fs-4"></i>
            </span>
          </a>
          <!-- Row -->
          <!-- Collapse -->
          <div class="collapse @if($i == 1) show @endif" id="course-{{$i}}" data-bs-parent="#courseAccordion">
            <div class="py-4 nav" id="course-tabOne" role="tablist" aria-orientation="vertical"
              style="display: inherit;">
              @foreach($obj->lectures as $lec)
              <a class="mb-2 d-flex justify-content-between align-items-center text-decoration-none"
                id="course-intro-tab" href="/courses/{{$course->id}}/watch?s={{$lec->id}}" >
                <div class="text-truncate">
                  <span class="icon-shape bg-light text-primary icon-sm  rounded-circle me-2">
                  	@if($lec->video == null)
                  	<i class="fe fe-book  fs-6"></i>
                  	@else
                  	<i class="fe fe-play  fs-6"></i>
                  	@endif
                  </span>
                  <span>{{$lec->title}}</span>
                </div>
              </a>
              @endforeach
        
            </div>
          </div>
        </li>
        @php $i++; @endphp
        @endforeach
        <li class="list-group-item">
          <!-- Toggle -->
          <a class="d-flex align-items-center text-inherit text-decoration-none h4 mb-0"
            href="/courses/{{$course->id}}/watch?s=complete" role="button" aria-expanded="false">
            <div class="me-auto">
              Finish Course
            </div>
          </a>
          <!-- Row -->
          <!-- Collapse -->
          <div class="collapse @if($i == 1) show @endif" id="course-{{$i}}" data-bs-parent="#courseAccordion">
            <div class="py-4 nav" id="course-tabOne" role="tablist" aria-orientation="vertical"
              style="display: inherit;">
              @foreach($obj->lectures as $lec)
              <a class="mb-2 d-flex justify-content-between align-items-center text-decoration-none"
                id="course-intro-tab" href="/courses/{{$course->id}}/watch?s={{$lec->id}}" >
                <div class="text-truncate">
                  <span class="icon-shape bg-light text-primary icon-sm  rounded-circle me-2">
                    @if($lec->video == null)
                    <i class="fe fe-book  fs-6"></i>
                    @else
                    <i class="fe fe-play  fs-6"></i>
                    @endif
                  </span>
                  <span>{{$lec->title}}</span>
                </div>
              </a>
              @endforeach
        
            </div>
          </div>
        </li>
        @endif
      </ul>
  </div>
  

<!-- Finish Course Modal -->
<div class="modal fade" id="finishCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Finish this Course?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to mark this course as completed?
      </div>
      <form action="{{route('course.finish')}}" method="post">
        @csrf
        <div class="modal-footer">
          <input type="hidden" name="course_id" value="{{$course->id}}">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-sm">Mark Finish</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <script>
    function finishCourse()
    {
      $("#finishCourseModal").modal('show');
    }
  </script>

@endsection


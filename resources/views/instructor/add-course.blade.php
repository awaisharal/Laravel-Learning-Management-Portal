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
            <!-- Stepper Button -->
            <div class="bs-stepper-header shadow-sm" role="tablist">
              <div class="step" data-target="#test-l-1">
                <button type="button" class="step-trigger" role="tab" id="courseFormtrigger1" aria-controls="test-l-1">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">Basic Information</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#test-l-2">
                <button type="button" class="step-trigger" role="tab" id="courseFormtrigger2" aria-controls="test-l-2">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Courses Media</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#test-l-4">
                <button type="button" class="step-trigger" role="tab" id="courseFormtrigger4" aria-controls="test-l-4">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label">Settings</span>
                </button>
              </div>
            </div>

            @if(count($errors->all()) > 0)
              <div class="alert alert-warning mt-5">
                Please fill all the required fields to continue.
              </div>
              @if($errors->first('serverError'))
                <div class="alert alert-warning mt-5">
                  Something went wrong. Please try again later!
                </div>
              @endif
            @endif
            <!-- Stepper content -->
            <div class="bs-stepper-content mt-5">
              <form method="post" action="{{route('course.create')}}" enctype="multipart/form-data">
                @csrf
                <!-- Content one -->
                <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                  <!-- Card -->
                  <div class="card mb-3 ">
                    <div class="card-header border-bottom px-4 py-3">
                      <h4 class="mb-0">Basic Information</h4>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="courseTitle" class="form-label">Course Title</label>
                        <input id="courseTitle" name="title" class="form-control" type="text" placeholder="Course Title" value="{{old('title')}}" />
                        <small>Write a 60 character course title.</small>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Courses category</label>
                        <select class="selectpicker" name="category" data-width="100%">
                          @if(old('category'))
                            <option value="{{old('category')}}">Select category</option>
                          @else
                            <option selected disabled>Select category</option>
                          @endif
                          @if(!empty($categories))
                            @foreach($categories as $cat)
                              <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                          @endif
                        </select>
                        <small>Help people find your courses by choosing
                          categories that represent your course.</small>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Courses level</label>
                        <select class="selectpicker" name="level" data-width="100%">
                          @if(old('level'))
                            <option value="{{old('level')}}">{{old('level')}}</option>
                          @endif
                          <option value="">Select level</option>
                          <option value="Intermediate">Intermediate</option>
                          <option value="Beignners">Beignners</option>
                          <option value="Advance">Advance</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Course Description</label>
                        <textarea id="" name="description" class="form-control">
                          {{old('description')}}
                        </textarea>
                        <small>A brief summary of your courses.</small>
                      </div>
                    </div>
                  </div>
                  <!-- Button -->
                  <button type="button" class="btn btn-primary" onclick="courseForm.next()">
                    Next
                  </button>
                </div>
                <!-- Content two -->
                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                  <!-- Card -->
                  <div class="card mb-3  border-0">
                    <div class="card-header border-bottom px-4 py-3">
                      <h4 class="mb-0">Courses Media</h4>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                      <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                        <label class="form-label">Course cover image
                          <a href="javascript:void(0)" class="custom-file-container__image-clear"
                            title="Clear Image"></a></label>
                        <label class="custom-file-container__custom-file">
                          <input type="file" class="custom-file-container__custom-file__custom-file-input"
                            accept="image/*" name="thumbnail" />
                          <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                          <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        @if(count($errors->all()) > 0)
                        @if($errors->first('thumbnail'))
                          <div style="color: red;font-size: 13px;margin-top: 10px;">
                            <ul>
                              <li>Thumbnail is required</li>
                              <li>File must be an image</li>
                              <li>File must be less then 10MB</li>
                            </ul>
                          </div>
                        @endif
                        @endif
                        <small class="mt-3 d-block">Upload your course image here. It must meet
                          our
                          course image quality standards to be accepted.
                          Important guidelines: 750x440 pixels; .jpg, .jpeg,.
                          gif, or .png. no text on the image.</small>
                        <div class="custom-file-container__image-preview"></div>
                      </div>
                      <div>
                        <input type="url" name="url" class="form-control" placeholder="Video URL" value="{{old('url')}}" />
                      </div>
                      <small class="mt-3 d-block">Enter a valid video URL. Students who watch a
                        well-made promo video are 5X more likely to enroll in
                        your course.
                      </small>
                    </div>
                  </div>
                  <!-- Button -->
                  <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" onclick="courseForm.previous()">
                      Previous
                    </button>
                    <button type="button" class="btn btn-primary" onclick="courseForm.next()">
                      Next
                    </button>
                  </div>
                </div>
                <!-- Content four -->
                <div id="test-l-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger4">
                  <!-- Card -->
                  <div class="card mb-3  border-0">
                    <div class="card-header border-bottom px-4 py-3">
                      <h4 class="mb-0">Requirements</h4>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                      <input name='tags' value='jquery, bootstrap' autofocus>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between mb-22">
                    <!-- Button -->
                    <button type="button" class="btn btn-secondary mt-5" onclick="courseForm.previous()">
                      Previous
                    </button>
                    <button type="submit" class="btn btn-danger mt-5">
                      Create Course
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $("#sidenav ul li#myCourses").addClass("active");
</script>
@endsection
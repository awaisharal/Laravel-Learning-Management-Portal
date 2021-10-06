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
            <div class="card mb-3 ">
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
              <div class="card-header border-bottom px-4 py-3">
                <h4 class="mb-0">Basic Information</h4>
              </div>
              <form action="{{route('course.update')}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="mb-3">
                    <label for="courseTitle" class="form-label">Course Title</label>
                    <input id="courseTitle" name="title" class="form-control" type="text" placeholder="Course Title" value="{{ $course[0]->title }}" />
                    <small>Write a 60 character course title.</small>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Courses category</label>
                    <select class="selectpicker" name="category" data-width="100%">
                      <option selected value="{{$course[0]->category}}">Select category</option>
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
                      <option selected value="{{$course[0]->level}}">{{$course[0]->level}}</option>
                      <option value="Intermediate">Intermediate</option>
                      <option value="Beginner">Beginner</option>
                      <option value="Advance">Advance</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Course Description</label>
                    <textarea id="" name="description" class="form-control">{{ $course[0]->description }}</textarea>
                    <small>A brief summary of your courses.</small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Video URL</label>
                    <input name='url' value="{{$course[0]->url}}" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Tags</label>
                    <input name='tags' value='jquery, bootstrap' autofocus>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Duration</label>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-group mb-3">
                          <select name="hrs" class="form-control" required>
                            <option selected>{{$course[0]->hours}}</option>
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                          </select>
                          <span class="input-group-text">Hours</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-group mb-3">
                          <select name="min" class="form-control" required>
                            @if($course[0]->mins == "")
                              <option selected>0</option>
                            @else
                              <option selected>{{$course[0]->mins}}</option>
                            @endif
                            <option>0</option>
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>25</option>
                            <option>30</option>
                            <option>35</option>
                            <option>40</option>
                            <option>45</option>
                            <option>50</option>
                            <option>55</option>
                          </select>
                          <span class="input-group-text">minutes</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3 text-right">
                    <input type="hidden" name="id" value="{{$course[0]->id}}" />
                    <button type="submit" class="btn btn-primary">Update</button>
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
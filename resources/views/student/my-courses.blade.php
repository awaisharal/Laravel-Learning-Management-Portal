@extends('student.partials.layout')

@section('meta')

<title>Student Dashboard | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
	<div class="row">
		<div class="col-md-12">
			<!-- Side Navbar -->
			<ul class="nav nav-lb-tab mb-6" id="tab" role="tablist">
				<li class="nav-item ms-0" role="presentation">
					<a class="nav-link active " id="bookmarked-tab" data-bs-toggle="pill" href="#enroled" role="tab"
						aria-controls="bookmarked" aria-selected="true">Enroled </a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="finished-tab" data-bs-toggle="pill" href="#finished" role="tab"
						aria-controls="finished" aria-selected="false">Completed</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="currentlyLearning-tab" data-bs-toggle="pill" href="#currentlyLearning" role="tab"
						aria-controls="currentlyLearning" aria-selected="false">Bookmarked</a>
				</li>
			</ul>

			@if(count($errors) > 0)
				@if($errors->first() == 'course_enroled')
					<div class="alert alert-success">
						New course successfully enroled
					</div>
				@endif
			@endif
			<!-- Tab content -->
			<div class="tab-content" id="tabContent">
				{{-- Active Courses --}}
				<div class="tab-pane fade show active" id="enroled" role="tabpanel" aria-labelledby="enroled-tab">
					<div class="row">
						@if(!empty($enroled_courses))
						@foreach($enroled_courses as $obj)
						<div class="col-lg-4 col-md-6 col-12">
							<!-- Card -->
							<div class="card mb-4 card-hover">
								<a href="#" class="card-img-top">
									<img src="uploads/thumbnails/{{$obj['filename']}}" alt=""
									class="card-img-top rounded-top-md">
								</a>
								<!-- Card body -->
								<div class="card-body">
									<h3 class="h4 mb-2 text-truncate-line-2 ">
										<a href="/courses/{{$obj["id"]}}/watch" class="text-inherit" target="_blank">
											{{$obj['title']}}
										</a>
									</h3>
									<!-- List inline -->
									<ul class="mb-3  list-inline">
										<li class="list-inline-item"><i class="far fa-clock me-1"></i>
											{{$obj['duration']}}
										</li>
										
										@if($obj["level"] == "Beginner")
					                    <li class="list-inline-item"><svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16"
					                        fill="none" xmlns="http://www.w3.org/2000/svg">
					                        <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE">
					                        </rect>
					                        <rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9">
					                        </rect>
					                        <rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9">
					                        </rect>
					                      </svg>{{$obj["level"]}} 
					                  	</li>
					                  	@elseif($obj["level"] == "Intermediate")
					                  	<li class="list-inline-item">
					                  		<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
												<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
												<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9"></rect>
											</svg>
					                  		{{$obj["level"]}} 
					                  	</li>
					                  	@elseif($obj["level"] == "Advance")
					                  	<li class="list-inline-item">
					                  		<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
												<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
												<rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
											</svg>
					                  		{{$obj["level"]}} 
					                  	</li>
					                  	@endif

									</ul>
									{{-- <div class="lh-1">
										<span>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning"></i>
										</span>
										<span class="text-warning">4.5</span>
										<span class="fs-6 text-muted">(9,300)</span>
									</div> --}}
								</div>
								<!-- Card footer -->
								<div class="card-footer">
									<div class="row align-items-center g-0">
										<div class="col-auto">
											@if($obj["instructor_img"] == null || $obj["instructor_img"] == "")
											<img src="assets/images/avatar/avatar-3.jpg" class="rounded-circle avatar-xs" alt="">
											@else
											<img src="uploads/profiles/{{$obj["instructor_img"]}}" class="rounded-circle avatar-xs" alt="">
											@endif
										</div>
										<div class="col ms-2">
											<span>{{$obj["instructor_name"]}}</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="row text-center">
							<p>No Enroled Courses to show.</p>
						</div>
						@endif
					</div>
				</div>
				{{-- Bookmarked Courses --}}
				<div class="tab-pane fade show active" id="finished" role="tabpanel" aria-labelledby="bookmarked-tab">
					<div class="row">
						@if(!empty($completed_courses))
						@foreach($completed_courses as $obj)
						<div class="col-lg-4 col-md-6 col-12">
							<!-- Card -->
							<div class="card mb-4 card-hover">
								<a href="#" class="card-img-top">
									<img src="uploads/thumbnails/{{$obj['filename']}}" alt=""
									class="card-img-top rounded-top-md">
								</a>
								<!-- Card body -->
								<div class="card-body">
									<h3 class="h4 mb-2 text-truncate-line-2 ">
										<a href="/courses/{{$obj["id"]}}/watch" class="text-inherit" target="_blank">
											{{$obj['title']}}
										</a>
									</h3>
									<!-- List inline -->
									<ul class="mb-3  list-inline">
										<li class="list-inline-item"><i class="far fa-clock me-1"></i>
											{{$obj['duration']}}
										</li>
										
										@if($obj["level"] == "Beginner")
					                    <li class="list-inline-item"><svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16"
					                        fill="none" xmlns="http://www.w3.org/2000/svg">
					                        <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE">
					                        </rect>
					                        <rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9">
					                        </rect>
					                        <rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9">
					                        </rect>
					                      </svg>{{$obj["level"]}} 
					                  	</li>
					                  	@elseif($obj["level"] == "Intermediate")
					                  	<li class="list-inline-item">
					                  		<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
												<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
												<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9"></rect>
											</svg>
					                  		{{$obj["level"]}} 
					                  	</li>
					                  	@elseif($obj["level"] == "Advance")
					                  	<li class="list-inline-item">
					                  		<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
												<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
												<rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
											</svg>
					                  		{{$obj["level"]}} 
					                  	</li>
					                  	@endif

									</ul>
									{{-- <div class="lh-1">
										<span>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning"></i>
										</span>
										<span class="text-warning">4.5</span>
										<span class="fs-6 text-muted">(9,300)</span>
									</div> --}}
								</div>
								<!-- Card footer -->
								<div class="card-footer">
									<div class="row align-items-center g-0">
										<div class="col-auto">
											@if($obj["instructor_img"] == null || $obj["instructor_img"] == "")
											<img src="assets/images/avatar/avatar-3.jpg" class="rounded-circle avatar-xs" alt="">
											@else
											<img src="uploads/profiles/{{$obj["instructor_img"]}}" class="rounded-circle avatar-xs" alt="">
											@endif
										</div>
										<div class="col ms-2">
											<span>{{$obj["instructor_name"]}}</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="row text-center">
							<p>No Completed Courses to show.</p>
						</div>
						@endif
					</div>
				</div>
				{{-- Bookmarked Courses --}}
				<div class="tab-pane fade" id="currentlyLearning" role="tabpanel" aria-labelledby="currentlyLearning-tab">
					<div class="row">
						@if(!empty($bookmarked_courses))
						@foreach($bookmarked_courses as $obj)
						<div class="col-lg-4 col-md-6 col-12">
							<!-- Card -->
							<div class="card mb-4 card-hover">
								<a href="#" class="card-img-top">
									<img src="uploads/thumbnails/{{$obj['filename']}}" alt=""
									class="card-img-top rounded-top-md">
								</a>
								<!-- Card body -->
								<div class="card-body">
									<h3 class="h4 mb-2 text-truncate-line-2 "><a href="#" class="text-inherit">{{$obj['title']}}</a>
									</h3>
									<!-- List inline -->
									<ul class="mb-3  list-inline">
										<li class="list-inline-item"><i class="far fa-clock me-1"></i>
											{{$obj['duration']}}
										</li>
										
										@if($obj["level"] == "Beginner")
					                    <li class="list-inline-item"><svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16"
					                        fill="none" xmlns="http://www.w3.org/2000/svg">
					                        <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE">
					                        </rect>
					                        <rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9">
					                        </rect>
					                        <rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9">
					                        </rect>
					                      </svg>{{$obj["level"]}} 
					                  	</li>
					                  	@elseif($obj["level"] == "Intermediate")
					                  	<li class="list-inline-item">
					                  		<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
												<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
												<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9"></rect>
											</svg>
					                  		{{$obj["level"]}} 
					                  	</li>
					                  	@elseif($obj["level"] == "Advance")
					                  	<li class="list-inline-item">
					                  		<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
												<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
												<rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
											</svg>
					                  		{{$obj["level"]}} 
					                  	</li>
					                  	@endif

									</ul>
									{{-- <div class="lh-1">
										<span>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning me-n1"></i>
										<i class="mdi mdi-star text-warning"></i>
										</span>
										<span class="text-warning">4.5</span>
										<span class="fs-6 text-muted">(9,300)</span>
									</div> --}}
								</div>
								<!-- Card footer -->
								<div class="card-footer">
									<div class="row align-items-center g-0">
										<div class="col-auto">
											@if($obj["instructor_img"] == null || $obj["instructor_img"] == "")
											<img src="assets/images/avatar/avatar-3.jpg" class="rounded-circle avatar-xs" alt="">
											@else
											<img src="uploads/profiles/{{$obj["instructor_img"]}}" class="rounded-circle avatar-xs" alt="">
											@endif
										</div>
										<div class="col ms-2">
											<span>{{$obj["instructor_name"]}}</span>
										</div>

					                	<div class="col-auto">
					                      <form action="{{route('course.bookmark')}}" method="post">
					                      @csrf
					                      	  <input type="hidden" name="user_id" value="{{$user->id}}" />
					                      	  <input type="hidden" name="course_id" value="{{$obj["id"]}}" />
						                      <button class="text-muted bookmark no-bg">
								                <i class="fa fa-bookmark" style="color:#E13E31;"></i>
								              </button>
							              </form>
					                    </div>

									</div>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="row text-center">
							<p>No Bookmarked Courses to show.</p>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
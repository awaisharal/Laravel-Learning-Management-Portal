@extends('courses.partials.layout')

@section('meta')

<title>Browse Courses | {{config('app.name')}}</title>

@endsection

@section('main_content')

<div class="bg-primary py-4 py-lg-6">
	<div class="container">
	  <div class="row align-items-center">
	    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
	      <div>
	        <h1 class="mb-0 text-white display-4">Filter Page</h1>
	      </div>
	    </div>
	  </div>
	</div>
</div>

{{-- Body --}}

<div class="py-6">
	<div class="container">
	  <div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
	      <div class="row d-lg-flex justify-content-between align-items-center">
	        <div class="col-md-6 col-lg-8 col-xl-9 ">
	          <h4 class="mb-3 mb-lg-0">Displaying 9 out of 68 courses</h4>
	        </div>
	        <div class="d-inline-flex col-md-6 col-lg-4 col-xl-3 ">
	          <!-- List  -->
	          <select class="selectpicker" data-width="100%">
	            <option value="">Sort by</option>
	            <option value="Newest">Newest</option>
	            <option value="Free">Free</option>
	            <option value="Most Popular">Most Popular</option>
	            <option value="Highest Rated">Highest Rated</option>
	          </select>
	        </div>
	      </div>
	    </div>
	    <!-- Sidebar Filters -->
	    @include('courses.partials.sidebar')
	    <!-- Tab content -->
	    <div class="col-xl-9 col-lg-9 col-md-8 col-12">
	      <div class="tab-content">
	        <!-- Tab pane -->
	        <div class="tab-pane fade show active pb-4 " id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">
	          <div class="row">
	            @if(!empty($courses))
	            @foreach($courses as $obj)
	            <div class="col-lg-4 col-md-6 col-12">
	              <!-- Card -->
	              <div class="card  mb-4 card-hover">
	                <a href="courses/{{$obj->id}}/details" class="card-img-top"><img src="uploads/thumbnails/{{$obj->filename}}" alt=""
	                    class="card-img-top rounded-top-md"></a>
	                <!-- Card body -->
	                <div class="card-body">
	                  <h4 class="mb-2 text-truncate-line-2 ">
	                  	<a href="courses/{{$obj->id}}/details" class="text-inherit">
	                  		{{$obj->title}}
	                  	</a>
	                  </h4>
	                   <!-- List inline -->
	                  <ul class="mb-3 list-inline">
	                    <li class="list-inline-item"><i class="far fa-clock me-1"></i>3h 56m
	                    </li>
	                    <li class="list-inline-item"><svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16"
	                        fill="none" xmlns="http://www.w3.org/2000/svg">
	                        <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE">
	                        </rect>
	                        <rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9">
	                        </rect>
	                        <rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9">
	                        </rect>
	                      </svg>Beginner </li>
	                  </ul>
	                  <div class="lh-1">
	                    <span>
	                      <i class="mdi mdi-star text-warning me-n1"></i>
	                      <i class="mdi mdi-star text-warning me-n1"></i>
	                      <i class="mdi mdi-star text-warning me-n1"></i>
	                      <i class="mdi mdi-star text-warning me-n1"></i>
	                      <i class="mdi mdi-star text-warning"></i>
	                    </span>
	                    <span class="text-warning">4.5</span>
	                    <span class="fs-6 text-muted">(7,700)</span>
	                  </div>
	                </div>
	                <!-- Card footer -->
	                <div class="card-footer">
	                   <!-- Row -->
	                  <div class="row align-items-center g-0">
	                    <div class="col-auto">
	                      <img src="../assets/images/avatar/avatar-1.jpg" class="rounded-circle avatar-xs" alt="">
	                    </div>
	                    <div class="col ms-2">
	                      <span>Morris Mccoy</span>
	                    </div>
	                    <div class="col-auto">
	                     <a href="#" class="text-muted bookmark">
	                <i class="fe fe-bookmark  "></i>
	              </a>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	            @endforeach
	            @endif
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
  
@endsection
@extends('instructor.partials.layout')

@section('meta')

<title>Instructor Dashboard | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
	<div class="card mb-4">
		<!-- Card header -->
		<div class="card-header">
			<h3 class="mb-0">Courses</h3>
			<span>Manage your courses and its update like live, draft and
				insight.</span>
		</div>
		<!-- Card body -->
		<div class="card-body">
			<!-- Form -->
			<form class="row">
				<div class="col-lg-9 col-md-7 col-12 mb-lg-0 mb-2">
					<input type="search" class="form-control" placeholder="Search Your Courses" />
				</div>
				<div class="col-lg-3 col-md-5 col-12">
					<select class="selectpicker" data-width="100%">
						<option value="">Date Created</option>
						<option value="Newest">Newest</option>
						<option value="High Rated">High Rated</option>
						<option value="Law Rated">Law Rated</option>
						<option value="High Earned">High Earned</option>
					</select>
				</div>
			</form>
		</div>
		<!-- Table -->
		<div style="padding-left:20px;padding-right:20px;">
		@if(count($errors) > 0)
			@if($errors->first() == 'courseUpdated')
				<div class="alert alert-success">
					Course details updated successfully
				</div>
			@endif
		@endif
		</div>
		<div class="table-responsive border-0 overflow-y-hidden">
			<table class="table mb-0 text-nowrap">
				<thead class="table-light">
					<tr>
						<th scope="col" class="border-0">Courses</th>
						<th scope="col" class="border-0">Students</th>
						<th scope="col" class="border-0">Rating</th>
						<th scope="col" class="border-0">Status</th>
						<th scope="col" class="border-0"></th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($courses))
					@foreach($courses as $obj)
						<tr>
							<td class="border-top-0">
								<div class="d-lg-flex">
									<div>
										<a href="#">
											<img src="../uploads/thumbnails/{{$obj->filename}}" alt="" class="rounded img-4by3-lg" /></a>
									</div>
									<div class="ms-lg-3 mt-2 mt-lg-0">
										<h4 class="mb-1 h5">
											<a href="#" class="text-inherit">
												{{$obj->title}}
											</a>
										</h4>
										<ul class="list-inline fs-6 mb-0">
											<li class="list-inline-item">
												<i class="far fa-clock me-1"></i>1h 30m
											</li>
											<li class="list-inline-item">
												@if($obj->level == 'Beginner')
													<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none"
														xmlns="http://www.w3.org/2000/svg">
														<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
														<rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9"></rect>
														<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9"></rect>
													</svg>Beginner
												@elseif($obj->level == 'Intermediate')
													<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none"xmlns="http://www.w3.org/2000/svg">
														<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
														<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
														<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9"></rect>
													</svg>
													Intermediate
												@else
													<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none"xmlns="http://www.w3.org/2000/svg">
														<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
														<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
														<rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
													</svg>
													Advance
												@endif
											</li>
										</ul>
									</div>
								</div>
							</td>
							<td class="border-top-0">0</td>
							<td class="border-top-0">
								<span class="text-warning">4.5<i class="mdi mdi-star"></i></span>(3,250)
							</td>
							<td class="border-top-0">
								@if($obj->status == "Approved")
									<span class="badge bg-success">Live</span>
								@elseif($obj->status == 'Not Approved')
									<span class="badge bg-warning">Rejected</span>
								@elseif($obj->status == 'Draft')
									<span class="badge bg-info">Draft</span>
								@elseif($obj->status == 'Deleted')
									<span class="badge bg-danger">Deleted</span>
								@endif
							</td>
							<td class="text-muted border-top-0">
								<span class="dropdown dropstart">
									<a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown"
										data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
										<i class="fe fe-more-vertical"></i>
									</a>
									<span class="dropdown-menu" aria-labelledby="courseDropdown">
										<span class="dropdown-header">Setting </span>
										<a class="dropdown-item" href="/instructor/course/{{$obj->id}}/edit"><i class="fe fe-edit dropdown-item-icon"></i>Edit Course</a>
										<a class="dropdown-item" href="/instructor/course/{{$obj->id}}/curriculum"><i class="fe fe-edit dropdown-item-icon"></i>Edit Curriculum</a>
										<a class="dropdown-item" href="#"><i class="fe fe-trash dropdown-item-icon"></i>Remove</a>
									</span>
								</span>
							</td>
						</tr>
					@endforeach
					@endif

					{{-- Dont remove this dummy <tr> --}}
					<tr>
						<td>
							<div class="d-lg-flex">
								<div>
									<a href="#">
										<img src="../assets/images/course/course-node.jpg" alt="" class="rounded img-4by3-lg" /></a>
								</div>
								<div class="ms-lg-3 mt-2 mt-lg-0">
									<h4 class="mb-1 h5">
										<a href="#" class="text-inherit">
											Learn Node.js - Tutorials Courses
										</a>
									</h4>
									<ul class="list-inline fs-6 mb-0">
										<li class="list-inline-item">
											<i class="far fa-clock me-1"></i>3h 40m
										</li>
										<li class="list-inline-item">
											<svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
												<rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
												<rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9"></rect>
											</svg>
											Intermediate
										</li>
									</ul>
									<div class="progress mt-3" style="height: 3px">
										<div class="progress-bar bg-success" role="progressbar" style="width: 25%"
											aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</td>
						<td>0</td>
						<td>
							<span class="text-warning">4.5<i class="mdi mdi-star"></i></span>(5,300)
						</td>
						<td><span class="badge bg-info">Darft</span></td>
						<td class="text-muted">
							<span class="dropdown dropstart">
								<a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown1"
									data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
									<i class="fe fe-more-vertical"></i>
								</a>
								<span class="dropdown-menu" aria-labelledby="courseDropdown1">
									<span class="dropdown-header">Setting </span>
									<a class="dropdown-item" href="#"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>
									<a class="dropdown-item" href="#"><i class="fe fe-trash dropdown-item-icon"></i>Remove</a>
								</span>
							</span>
						</td>
					</tr>
					{{-- Ok? --}}
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
	$("#sidenav ul li#myCourses").addClass("active");
</script>
@endsection
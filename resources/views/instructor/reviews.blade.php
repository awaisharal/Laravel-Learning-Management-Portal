@extends('instructor.partials.layout')

@section('meta')

<title>Instructor Reviews | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
	<div class="card mb-4">
		<!-- Card header -->
		<div class="card-header d-lg-flex align-items-center justify-content-between">
			<div class="mb-3 mb-lg-0">
				<h3 class="mb-0">Reviews</h3>
				<span>You have full control to manage your own account
					setting.</span>
			</div>
			<div>
				<a href="#" class="btn btn-outline-primary btn-sm">Export To CSV...</a>
			</div>
		</div>
		<!-- Card body -->
		<div class="card-body">
			<!-- Form -->
			<form class="row mb-4">
				<div class="col-xl-7 col-lg-6 col-md-4 col-12 mb-2 mb-lg-0">
					<select class="selectpicker" data-width="100%">
						<option value="">ALL</option>
						<option value="How to easily create a website">
							How to easily create a website
						</option>
						<option value="Grunt: The JavaScript Task...">
							Grunt: The JavaScript Task...
						</option>
						<option value="Vue js: The JavaScript Task...">
							Vue js: The JavaScript Task...
						</option>
					</select>
				</div>
				<div class="col-xl-2 col-lg-2 col-md-4 col-12 mb-2 mb-lg-0">
					<!-- Custom select -->
					<select class="selectpicker" data-width="100%">
						<option value="">Rating</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-4 col-12 mb-2 mb-lg-0">
					<!-- Custom select -->
					<select class="selectpicker" data-width="100%">
						<option value="">Sort</option>
						<option value="Newest">Newest</option>
						<option value="Oldest">Oldest</option>
					</select>
				</div>
			</form>
			<!-- List group -->
			<ul class="list-group list-group-flush border-top">
				<!-- List group item -->
				<li class="list-group-item px-0 py-4">
					<div class="d-flex">
						<img src="../assets/images/avatar/avatar-9.jpg" alt="" class="rounded-circle avatar-lg" />
						<div class="ms-3 mt-2">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h4 class="mb-0">Eleanor Pena</h4>
									<span class="text-muted fs-6">2 hour ago</span>
								</div>
								<div>
									<a href="#" data-bs-toggle="tooltip" data-placement="top" title="Report Abuse"><i
											class="fe fe-flag"></i></a>
								</div>
							</div>
							<div class="mt-2">
								<span class="me-1">
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star mb-2 text-warning fs-6"></i>
								</span>
								<span class="me-1">for</span>
								<span class="h5">How to easily create a website with WordPress</span>
								<p class="mt-2">
									The course is very interesting and insightful. I
									think it should have more downloadable resources for
									'points to remember' or 'key learnings' kind of
									document for later reference after finishing each
									section.
								</p>
								<a href="#" class="btn btn-outline-white btn-sm">Respond</a>
							</div>
						</div>
					</div>
				</li>
				<!-- List group item -->
				<li class="list-group-item px-0 py-4">
					<div class="d-flex">
						<img src="../assets/images/avatar/avatar-4.jpg" alt="" class="rounded-circle avatar-lg" />
						<div class="ms-3 mt-2">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h4 class="mb-0">Jenny Wilson</h4>
									<span class="text-muted fs-6">2 hour ago</span>
								</div>
								<div>
									<a href="#" data-bs-toggle="tooltip" data-placement="top" title="Report Abuse"><i
											class="fe fe-flag"></i></a>
								</div>
							</div>
							<div class="mt-2">
								<span class="me-1">
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star mb-2-half-alt text-warning fs-6"></i>
								</span>
								<span class="me-1">for</span>
								<span class="h5">Getting started - Grunt: The JavaScript
									Task...</span>
								<p class="mt-2">
									Quisque semper aliquet lacinia. Ut molestie felis
									nec consectetur hendrerit. Aliquam eu viverra velit.
									In non leo ornare, ornare lorem elementum, efficitur
									urna. Curabitur fringilla nulla ac odio dignissim
									viverra.
								</p>
								<a href="#" class="btn btn-outline-white btn-sm">Respond</a>
							</div>
						</div>
					</div>
				</li>
				<!-- List group item -->
				<li class="list-group-item px-0 py-4">
					<div class="d-flex">
						<img src="../assets/images/avatar/avatar-7.jpg" alt="" class="rounded-circle avatar-lg" />
						<div class="ms-3 mt-2">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h4 class="mb-0">Brooklyn Simmons</h4>
									<span class="text-muted fs-6">2 hour ago</span>
								</div>
								<div>
									<a href="#" data-bs-toggle="tooltip" data-placement="top" title="Report Abuse"><i
											class="fe fe-flag"></i></a>
								</div>
							</div>
							<div class="mt-2">
								<span class="me-1">
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star mb-2-half-alt text-warning fs-6"></i>
								</span>
								<span class="me-1">for</span>
								<span class="h5">Getting started - Vue js: The JavaScript
									Task...</span>
								<p class="mt-2">
									Nulla eu cursus lacus. Vestibulum imperdiet accumsan
									tempor. Vivamus lacinia posuere augue ac mollis.
									Integer ornare purus ac hendrerit vehicula. In
									condimentum efficitur quam, sed porta turpis
									lobortis sit amet.
								</p>
								<a href="#" class="btn btn-outline-white btn-sm">Respond</a>
							</div>
						</div>
					</div>
				</li>
				<!-- List group item -->
				<li class="list-group-item px-0 py-4">
					<div class="d-flex">
						<img src="../assets/images/avatar/avatar-1.jpg" alt="" class="rounded-circle avatar-lg" />
						<div class="ms-3 mt-2">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h4 class="mb-0">John Deo</h4>
									<span class="text-muted fs-6">1 hour ago</span>
								</div>
								<div>
									<a href="#" data-bs-toggle="tooltip" data-placement="top" title="Report Abuse"><i
											class="fe fe-flag"></i></a>
								</div>
							</div>
							<div class="mt-2">
								<span class="me-1">
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star mb-2 text-light fs-6"></i>
								</span>
								<span class="me-1">for</span>
								<span class="h5">Getting started - Gulp: The JavaScript
									Task...</span>
								<p class="mt-2">
									Suspendisse mauris lectus, posuere et quam eu,
									auctor interdum turpis. Maecenas gravida libero
									vitae risus sodales dictu llentesque tristique mi ut
									lectus luctus, eu hendrerit felis accumsan. Nam eget
									felis porttitor, volutpat nisi id, aliquam purus.
								</p>
								<a href="#" class="btn btn-outline-white btn-sm">Respond</a>
							</div>
						</div>
					</div>
				</li>
				<!-- List group item -->
				<li class="list-group-item px-0 pt-4 pb-0">
					<div class="d-flex">
						<img src="../assets/images/avatar/avatar-8.jpg" alt="" class="rounded-circle avatar-lg" />
						<div class="ms-3 mt-2">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h4 class="mb-0">Simons Xolaa</h4>
									<span class="text-muted fs-6">3 hour ago</span>
								</div>
								<div>
									<a href="#" data-bs-toggle="tooltip" data-placement="top" title="Report Abuse"><i
											class="fe fe-flag"></i></a>
								</div>
							</div>
							<div class="mt-2">
								<span class="me-1">
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star me-n1 mb-2 text-warning fs-6"></i>
									<i class="mdi mdi-star mb-2 text-warning fs-6"></i>
								</span>
								<span class="me-1">for</span>
								<span class="h5">Getting started - HTML: The Foundations
									Task...</span>
								<p class="mt-2">
									Lorem ipsum dolor sit amet, consectetur adipiscing
									elit. Sed euismod nulla orci, sed varius metus
									tincidunt consequat. Maecenas in purus non nisi
									luctus pulvinar vitae eu lacus. Nam magna ipsum,
									fermentum in commodo ut, tristique ut mauris.
								</p>
								<a href="#" class="btn btn-outline-white btn-sm">Respond</a>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
@endsection
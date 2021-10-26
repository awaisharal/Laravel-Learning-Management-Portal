@extends('instructor.partials.layout')

@section('meta')

<title>Instructor Reviews | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
	<div class="card mb-4">
		<!-- Card body -->
		<div class="p-4 d-flex justify-content-between align-items-center">
			<div>
				<h3 class="mb-0">Students ({{count($students)}})</h3>
				<span>Meet people taking your course.</span>
			</div>
			
		</div>
	</div>
	<!-- Tab content -->
	<div class="tab-pane show" id="tabPaneList" role="tabpanel" aria-labelledby="tabPaneList">
		<div class="card">
			<div class="card-header border-bottom-0">
				<div class="row">
					<div class="col pe-0">
						<form>
							<input type="search" class="form-control" placeholder="Search by Name" />
						</form>
					</div>
					
				</div>
			</div>
			<!-- Table -->
			<div class="table-responsive">
				<table class="table">
					<thead class="table-light">
						<tr>
							<th scope="col" class="border-0">Name</th>
							<th scope="col" class="border-0">Email</th>
							<th scope="col" class="border-0">Phone</th>
							<th scope="col" class="border-0">Enroled</th>
						</tr>
					</thead>
					<tbody>
						@if(!empty($students))
						@foreach($students as $obj)
						<tr>
							<td class="align-middle border-top-0">
								<div class="d-flex align-items-center">
									@if($obj['img'] != "" || $obj['img'] != null)
									<img src="uploads/profiles/{{$obj['img']}}" style="width:30px;"/>
									@else
									<img src="assets/images/avatar/avatar-3.jpg" style="width:30px;" />
									@endif
									<h5 class="mb-0" style="margin-left:10px;">{{$obj['name']}}</h5>
								</div>
							</td>
							<td class="align-middle border-top-0">{{$obj['email']}}</td>
							<td class="align-middle border-top-0">{{$obj['phone']}}</td>
							<td class="align-middle border-top-0">
								<?php echo date('d M, Y', strtotime($obj["date"])); ?>
							</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td colspan="5" class="text-center">
								You don't have any students yet.
							</td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
			<div class="pt-2 pb-4">
				<!-- Pagination -->
				<nav>
					{{-- <ul class="pagination justify-content-center mb-0">
						<li class="page-item disabled">
							<a class="page-link mx-1 rounded" href="#" tabindex="-1" aria-disabled="true"><i
									class="mdi mdi-chevron-left"></i></a>
						</li>
						<li class="page-item active">
							<a class="page-link mx-1 rounded" href="#">1</a>
						</li>
						<li class="page-item">
							<a class="page-link mx-1 rounded" href="#">2</a>
						</li>
						<li class="page-item">
							<a class="page-link mx-1 rounded" href="#">3</a>
						</li>
						<li class="page-item">
							<a class="page-link mx-1 rounded" href="#"><i class="mdi mdi-chevron-right"></i></a>
						</li>
					</ul> --}}
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection
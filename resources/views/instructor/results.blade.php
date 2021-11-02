@extends('instructor.partials.layout')

@section('meta')

<title>Certification Requests | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
	<div class="card mb-4">
		<!-- Card body -->
		<div class="p-4 d-flex justify-content-between align-items-center">
			<div>
				<h3 class="mb-0">Results</h3>
				<span>View results for the quizes attempted by students</span>
			</div>
			
		</div>
	</div>
	<!-- Tab content -->
	<div class="tab-pane show" id="tabPaneList" role="tabpanel" aria-labelledby="tabPaneList">
		<div class="card">
			<div class="card-header border-bottom-0">
				<h4>Attempted: {{$attempted}}/{{$total_quizes}}</h4>
			</div>
			@if(count($errors) > 0)
				@if($errors->first() == 'CourseRejected')
					<div class="alert alert-success">
						Certification rejected for the selected student.
					</div>
				@elseif($errors->first() == 'CourseAccepted')
					<div class="alert alert-success">
						Certification approved for the selected student.
					</div>
				@endif
			@endif
			<!-- Table -->
			<div class="table-responsive">
				<table class="table">
					<thead class="table-light">
						<tr>
							<th scope="col" class="border-0">Quiz</th>
							<th scope="col" class="border-0">Total Questions</th>
							<th scope="col" class="border-0">Correct Answers</th>
							<th scope="col" class="border-0">Percentage</th>
							<th scope="col" class="border-0">Status</th>
							<th scope="col" class="border-0"></th>
						</tr>
					</thead>
					<tbody>
						@if(!empty($results))
							@foreach($results as $res)
								<tr>
									<td>{{$res['title']}}</td>
									<td>{{$res['total_questions']}}</td>
									<td>{{$res['correct']}}</td>
									<td>{{$res['percentage']}}%</td>
									<td>
										@if($res['status'] == 'Pass')
											<span class="custom-badge-success">Pass</span>
										@else
											<span class="custom-badge-warning">Fail</span>
										@endif
									</td>
									<td></td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="pt-2 pb-4">
				<!-- Pagination -->
				<nav>
					
				</nav>
			</div>
		</div>
	</div>
</div>

{{-- Approval Modal --}}
<div class="modal fade" id="arrovalModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="padding-bottom: 0!important;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSectionModalLabel1">
          Approve Certification
        </h4>
        <button type="button" class="btn-close" onclick="dismissModal()" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
      </div>
      <form action="{{route('certificate.approve')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
      		<div class="form-group">
      			<label>Choose Certificate File</label>
      			<input type="file" class="form-control" name="file" id="file" required>
      			<small class="mt-3 d-block">Upload the certificate here. It must meet our certificate image quality standards. Important guidelines: 750x440 pixels; .jpg, .jpeg, or .png.</small>
      			<div class="">
      				<img src="" id="preview" class="img-fluid">
      			</div>
      		</div>
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="id" id="id" />
      	<button type="button" class="btn btn-light" onclick="dismissModal()">Cancel</button>
      	<button type="submit" class="btn btn-primary">Approve & Send</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

@endsection
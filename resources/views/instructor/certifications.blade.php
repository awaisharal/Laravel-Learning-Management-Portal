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
				<h3 class="mb-0">Manage Certificates</h3>
				<span>Certificate manager for completed courses.</span>
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
							<th scope="col" class="border-0">Name</th>
							<th scope="col" class="border-0">Email</th>
							{{-- <th scope="col" class="border-0">Phone</th> --}}
							<th scope="col" class="border-0">Course</th>
							<th scope="col" class="border-0">Complete</th>
							<th scope="col" class="border-0"></th>
						</tr>
					</thead>
					<tbody>
						@if(!empty($data))
						@foreach($data as $obj)
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
							{{-- <td class="align-middle border-top-0">{{$obj['phone']}}</td> --}}
							<td class="align-middle border-top-0">{{$obj['course_title']}}</td>
							<td class="align-middle border-top-0">
								<?php echo date('d M, Y', strtotime($obj["date"])); ?>
							</td>
							<td class="align-middle border-top-0">
								<div class="row" style="text-align:center;">
									<div>
										<form action="{{route('certificate.reject')}}" method="post">
											@csrf
											<input type="hidden" name="id" value="{{$obj['id']}}">
											<button class="btn btn-warning btn-xs" style="width:100%;">Reject</button>
										</form>
									</div>
									<div style="margin-top: 6px;">
										<button class="btn btn-success btn-xs" style="width:100%;" onclick="cert_approval_modal('{{$obj['id']}}')">Approve</button>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td colspan="5" class="text-center">
								No pending requests found.
							</td>
						</tr>
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
<script>
	$(document).ready(function(){
		$("#file").on('change', function(){
			let input = this;
			if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#preview').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }

		})
	});
	function cert_approval_modal(id)
	{
		$("#arrovalModal #id").val(id);
		$("#arrovalModal").modal('show');
	}
	
</script>
@endsection
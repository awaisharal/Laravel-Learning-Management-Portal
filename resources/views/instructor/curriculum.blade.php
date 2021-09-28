@extends('instructor.partials.layout')

@section('meta')

<title>Course Curriculum | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')

<script src="/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
		selector: '#description',
		height : "350"
	});
</script>

<div class="col-lg-9 col-md-8 col-12">
	<div class="card mb-4">
		<!-- Card body -->
		<div class="p-4 d-flex justify-content-between align-items-center">
			<div>
				<h3 class="mb-0">Curriculum</h3>
				<span>Update your course curriculum</span>
			</div>
		</div>
	</div>
	@if(count($errors->all()) > 0)
		@if($errors->first() == 'sectionAdded')
			<div class="alert alert-success mt-5">
				New section added to the course 
			</div>
		@elseif($errors->first() == 'lectureAdded')
			<div class="alert alert-success mt-5">
				New lecture added to the course
			</div>
		@elseif($errors->first() == 'sectionUpdated')
			<div class="alert alert-success mt-5">
				Section updated successfully.
			</div>
		@elseif($errors->first() == 'sectionDeleted')
			<div class="alert alert-success mt-5">
				Section deleted successfully.
			</div>
		@else
			<div class="alert alert-warning mt-5">
				{{$errors->first()}}
			</div>
		@endif
	@endif
	<!-- Tab content -->
	<div class="tab-content">
		<div class="tab-pane fade show active pb-4" id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">
			<div class="card mb-3 ">
                <div class="card-header border-bottom px-4 py-3">
                  <div class="row">
                  	<div class="col-md-6">
                  		<h4 class="mb-0">{{$course->title}}</h4>
                  	</div>
                  	<div class="col-md-6">
                  		<button class="btn btn-info btn-sm" onclick="showModal('addSectionModal', '{{$course->id}}')" style="float:right;">Add section +</button>
                  	</div>
                  </div>
                </div>
                <div class="card-body">

                	@if(!empty($sections))
                	@php 
                		$i = 1;
                	@endphp
                	@foreach($sections as $obj)
                	<div class="bg-light rounded p-2 mb-4">
                        <!-- List group -->
                        <div class="list-group list-group-flush border-top-0" id="courseList">
                          <div id="courseOne">
                          	<h4>
                          		{{$obj->name}}
															<button class="no-bg" onclick="openSectionEditModal('{{$obj->id}}','{{$obj->name}}')">
																<i class="fe fe-edit" style="font-size:14px;"></i>
															</button>
															<button class="no-bg" onclick="openSectionDeleteModal('{{$obj->id}}','{{$obj->name}}')">
																<i class="fe fe-trash-2" style="font-size:14px;"></i>
															</button>
                          	</h4>
                          	@if(!$obj->lectures->isEmpty())
                            	@foreach($obj->lectures as $lec)
	                            <div class="list-group-item rounded px-3 mb-1" id="introduction">
	                              <div class="d-flex align-items-center justify-content-between">
	                                <h5 class="mb-0">
	                                  <a href="#" class="text-inherit" data-toggle="collapse">
	                                    <i class="fe fe-menu mr-1 text-muted align-middle"></i>
	                                    <span class="align-middle">{{$lec->title}}</span>
	                                  </a>
	                                </h5>
	                                <div style="display:flex;">
	                                	<a href="/instructor/course/{{ $lec->id }}/edit/curriculum" class="mr-1 text-inherit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
	                                		<i class="fe fe-edit font-size-xs"></i>
	                                	</a>
	                                	<button class="mr-1 text-inherit no-bg" onclick="openLectureDeleteModal('{{$lec->id}}','{{$lec->title}}')">
	                                		<i class="fe fe-trash-2 font-size-xs"></i>
	                                	</button>
	                                  <button type="button" class="text-inherit no-bg"  data-toggle="collapse" id="collapseBtn1" onclick="collapsefun({{$i}})">
	                                    <span class="chevron-arrow"><i class="fe fe-chevron-down"></i></span>
	                                  </button>
	                                </div>
	                              </div>
	                              <div id="collapselist{{$i}}" class="collapse inner" aria-labelledby="introduction" data-parent="#courseList">
	                                <div class="card-body">
	                                  <a href="#!" class="btn btn-secondary btn-sm">Add
	                                    Article +</a>
	                                  <a href="#!" class="btn btn-secondary btn-sm">Add
	                                    Description +</a>
	                                </div>
	                              </div>
	                            </div>
	                            <?php $i++; ?>
                            	@endforeach
                            @else
                            	<div class="alert alert-info mt-5 mb-3">
                            		No lectures available in this section
                            	</div>
                            @endif
                          </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mt-3" onclick="openLectureModal('addLectureModal','{{$course->id}}','{{$obj->id}}')">Add Lecture +</button>
                    </div>
                    	@php
                    		$i++;
                    	@endphp
                    @endforeach
                    @endif
                </div>
            </div>
		</div>
	</div>
</div>

<!-- addSectionModal -->
<div class="modal fade" id="addSectionModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="addSectionModalLabel1">
          Add New Section
        </h4>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('course.addSection')}}" method="post">
        @csrf
	        <input class="form-control mb-3" type="text" name="name" placeholder="Enter section name here.." required />
	        <input type="hidden" id="course_id" name="course_id" value="" />
	        <button class="btn btn-primary" type="submit">
	            Add Section
	        </button>
	        <button type="button" class="btn btn-outline-white" data-dismiss="modal" aria-label="Close">
            	Close
          	</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- addLectureModal -->

<div class="modal fade" id="addLectureModal" tabindex="-1" role="dialog" aria-labelledby="addLectureModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width:700px!important;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="addLectureModalLabel1">
          Add New Lecture
        </h4>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('course.addLecture')}}" method="post" enctype="multipart/form-data">
        @csrf
	        <div class="form-group mb-3">
	        	<label for="title">Title</label>
	        	<input class="form-control" type="text" id="title" name="title" placeholder="Lecture title here.." required />
	        </div>
	        <div class="form-group mb-3">
	        	<label for="description">Description</label>
	        	<textarea name="description" id="description" class="form-control tinymce-editor"></textarea>
	        </div>
	        <div class="form-group mb-3">
	        	<label for="file">Video</label>
	        	<input class="form-control mb-3" type="file" id="file" name="file" />
	        </div>
	        <input type="hidden" id="course_id" name="course_id" value="" />
	        <input type="hidden" id="curriculum_id" name="curriculum_id" value="" />
	        <input class="btn btn-primary mt-5" type="submit" value="Add Lecture">
	                 
        </form>
      </div>
    </div>
  </div>
</div>

<!-- EditSectionModal -->
<div class="modal fade" id="EditSectionModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="addSectionModalLabel1">
          Update Section
        </h4>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('course.editSection')}}" method="post">
        @csrf
	        <input class="form-control mb-3" type="text" name="name" id="name" placeholder="Enter section name here.." required />
	        <input type="hidden" id="id" name="id" value="" />
	        <button class="btn btn-primary" type="submit">
	            Update Section
	        </button>
	        <button type="button" class="btn btn-outline-white" data-dismiss="modal" aria-label="Close">
            	Close
          	</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- DeleteSectionModal --}}
<div class="modal fade" id="DeleteSectionModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="padding-bottom: 0!important;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSectionModalLabel1">
          Delete Section
        </h4>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('course.deleteSection')}}" method="post">
        @csrf
        	<p>Are you sure, you want to delete <b id="name" class="text-danger"></b> section?</p>
	        <input type="hidden" id="id" name="id" value="" />
	        <div class="modal-footer" style="padding: 10px 0 0 0!important;border:none!important;">
	        	<button class="btn btn-danger" type="submit">
	            Delete
	        	</button>
	        </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- DeleteLectureModal --}}
<div class="modal fade" id="DeleteLectureModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="padding-bottom: 0!important;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSectionModalLabel1">
          Delete Lecture
        </h4>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="{{route('lecture.delete')}}" method="post">
        @csrf
        	<p>Are you sure, you want to delete <b id="name" class="text-danger"></b> lecture?</p>
	        <input type="hidden" id="id" name="id" value="" />
	        <div class="modal-footer" style="padding: 10px 0 0 0!important;border:none!important;">
	        	<button class="btn btn-danger" type="submit">
	            Delete
	        	</button>
	        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>	
	function collapsefun(id)
	{
		let trigger = "#collapselist"+id;
		$(".collapse.inner").hide();
		$(trigger).toggle();
	}
	function showModal(id, course_id)
	{
		let trigger = "#"+id;
		$(trigger+ " #course_id").val(course_id);
		$(trigger).modal('show');
	}
	function openLectureModal(id, course_id, curriculum_id)
	{
		let trigger = "#"+id;
		$(trigger+ " #course_id").val(course_id);
		$(trigger+ " #curriculum_id").val(curriculum_id);
		$(trigger).modal('show');	
	}
	function openSectionEditModal(id, name)
	{
		let trigger = "#EditSectionModal";
		$(trigger+ " #id").val(id);
		$(trigger+ " #name").val(name);
		$(trigger).modal('show');	
	}
	function openSectionDeleteModal(id, name)
	{
		let trigger = "#DeleteSectionModal";
		$(trigger+ " #id").val(id);
		$(trigger+ " #name").html(name);
		$(trigger).modal('show');	
	}
	function openLectureDeleteModal(id, name)
	{
		let trigger = "#DeleteLectureModal";
		$(trigger+ " #id").val(id);
		$(trigger+ " #name").html(name);
		$(trigger).modal('show');	
	}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
	$("#sidenav ul li#myCourses").addClass("active");
</script>
@endsection
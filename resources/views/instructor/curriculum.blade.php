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
                          	<h4>{{$obj->name}}</h4>
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
	                                <div style="display:flex;"><a href="" class="mr-1 text-inherit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fe fe-edit font-size-xs"></i></a>
	                                  <form action="{{route('lecture.delete')}}" method="post">
	                                  	@csrf
	                                  	<input type="hidden" name="id" value="{{$lec->id}}">
	                                  	<button class="mr-1 text-inherit no-bg" data-toggle="tooltip" data-placement="top" title="Delete this lecture" data-original-title="Delete"><i class="fe fe-trash-2 font-size-xs"></i></button>
	                                  </form>
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
		<!-- Tab pane -->
		<div class="tab-pane fade" id="tabPaneList" role="tabpanel" aria-labelledby="tabPaneList">
			<div class="card">
				<div class="card-header border-bottom-0">
					<div class="row">
						<div class="col pe-0">
							<form>
								<input type="search" class="form-control" placeholder="Search by Name" />
							</form>
						</div>
						<div class="col-auto">
							<a href="#" class="btn btn-secondary">Export CSV</a>
						</div>
					</div>
				</div>
				<!-- Table -->
				<div class="table-responsive">
					<table class="table">
						<thead class="table-light">
							<tr>
								<th scope="col" class="border-0">Name</th>
								<th scope="col" class="border-0">Enrolled</th>
								<th scope="col" class="border-0">Progress</th>
								<th scope="col" class="border-0">Q/A</th>
								<th scope="col" class="border-0">Locations</th>
								<th scope="col" class="border-0">Message</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="align-middle border-top-0">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-3.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Guy Hawkins</h5>
									</div>
								</td>
								<td class="align-middle border-top-0">3/12/2020</td>
								<td class="align-middle border-top-0">0%</td>
								<td class="align-middle border-top-0">0</td>
								<td class="align-middle border-top-0">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Greece</span>
								</td>
								<td class="pe-0 align-middle border-top-0">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-2.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Dianna Smiley</h5>
									</div>
								</td>
								<td class="align-middle">3/11/2020</td>
								<td class="align-middle">12%</td>
								<td class="align-middle">2</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>India</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-5.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Guy Hawkins</h5>
									</div>
								</td>
								<td class="align-middle">3/11/2020</td>
								<td class="align-middle">34%</td>
								<td class="align-middle">4</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Brazil</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-10.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Jacob Jones</h5>
									</div>
								</td>
								<td class="align-middle">3/12/2020</td>
								<td class="align-middle">44%</td>
								<td class="align-middle">5</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Chile</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-8.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Kristin Watson</h5>
									</div>
								</td>
								<td class="align-middle">18/12/2020</td>
								<td class="align-middle">45%</td>
								<td class="align-middle">9</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Estonia</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-6.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Rivao Luke</h5>
									</div>
								</td>
								<td class="align-middle">8/12/2020</td>
								<td class="align-middle">100%</td>
								<td class="align-middle">5</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Greece</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-7.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Nia Sikhone</h5>
									</div>
								</td>
								<td class="align-middle">8/12/2020</td>
								<td class="align-middle">67%</td>
								<td class="align-middle">3</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Egypt</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr class="border-bottom">
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-9.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Xiaon Merry</h5>
									</div>
								</td>
								<td class="align-middle">7/12/2020</td>
								<td class="align-middle">65%</td>
								<td class="align-middle">4</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Denmark</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="pt-2 pb-4">
					<!-- Pagination -->
					<nav>
						<ul class="pagination justify-content-center mb-0">
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
						</ul>
					</nav>
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
	        	<input class="form-control mb-3" type="file" id="file" name="file" required />
	        </div>
	        <input type="hidden" id="course_id" name="course_id" value="" />
	        <input type="hidden" id="curriculum_id" name="curriculum_id" value="" />
	        <input class="btn btn-primary mt-5" type="submit" value="Add Lecture">
	                 
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
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
	$("#sidenav ul li#myCourses").addClass("active");
</script>
@endsection
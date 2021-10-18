@extends('admin.partials.layout')

@section('meta')

<title>All Courses | {{config('app.name')}}</title>

@endsection

@section('css')


@endsection

@section('main_content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Courses</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/admin">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="/admin/all-courses">Courses</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                All
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card rounded-3">
                <!-- Card header -->
                <div class="card-header border-bottom-0 p-0 bg-white">
                    <div>
                        <!-- Nav -->
                        <ul class="nav nav-lb-tab" id="tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pending-tab" data-bs-toggle="pill" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending ({{ $pending_course->count() }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="approved-tab" data-bs-toggle="pill" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved ({{ $approved_course->count() }})
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="not-approved-tab" data-bs-toggle="pill" href="#not-approved" role="tab" aria-controls="not-approved" aria-selected="false">Not Approved ({{ $not_approved_course->count() }})
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="banned-tab" data-bs-toggle="pill" href="#banned" role="tab" aria-controls="banned" aria-selected="false">Banned ({{ $banned_course->count() }})
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-4 row">
                    <!-- Form -->
                    <form class="d-flex align-items-center col-12 col-md-12 col-lg-12">
                        <span class="position-absolute ps-3 search-icon">
                        <i class="fe fe-search"></i>
                        </span>
                        <input type="search" class="form-control ps-6" placeholder="Search Course" id="search" />
                    </form>
                </div>
                <div>
                    <div class="tab-content" id="tabContent">
                        @if($errors->any())
                            @if($errors->first() == 'course_approved')
                                <div class="alert alert-success" role="alert">
                                    Course approved successfully.
                                </div>
                            @elseif($errors->first() == 'course_rejected')
                                <div class="alert alert-warning" role="alert">
                                    Course rejected successfully.
                                </div>
                            @elseif($errors->first() == 'course_banned')
                                <div class="alert alert-warning" role="alert">
                                    Course banned successfully.
                                </div>
                            @elseif($errors->first() == 'course_unbanned')
                                <div class="alert alert-success" role="alert">
                                    Course Unbanned successfully.
                                </div>
                            @elseif($errors->first() == 'unknownError')
                                <div class="alert alert-danger" role="alert">
                                    Try Again Please.
                                </div>
                            @endif
                        @endif
                        <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">                          
                            <div class="table-responsive border-0 overflow-y-hidden">
                                <table class="table mb-0 text-nowrap" id="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase">
                                                Courses
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                Instructor
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                STATUS
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pending_course->count() == 0)
                                            <tr>
                                                <td class="border-top-0 text-center" colspan="4">
                                                    No pending courses found.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($pending_course as $pending)
                                                <tr>
                                                    <td class="border-top-0">
                                                        <a href="#" class="text-inherit">
                                                            <div class="d-lg-flex align-items-center">
                                                                <div>
                                                                    <img src="/uploads/thumbnails/{{ $pending->filename }}" alt="" class="img-4by3-lg rounded" />
                                                                </div>
                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                    <h4 class="mb-1 text-primary-hover">
                                                                        {{ $pending->title }}
                                                                    </h4>
                                                                    <span class="text-inherit">Added on {{ $pending->created_at }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <div class="d-flex align-items-center">
                                                            @if ($pending->instructor_img == "")
                                                            @else
                                                                <img src="/uploads/profiles/{{$pending->instructor_img}}" alt="" class="rounded-circle avatar-xs me-2" />
                                                            @endif
                                                            <h5 class="mb-0">
                                                                {{$pending->instructor_name}}
                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <span class="badge-dot bg-warning me-1 d-inline-block align-middle"></span>{{ $pending->status }}
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <a href="#" class="btn btn-outline-white btn-sm"  data-bs-toggle="modal" data-bs-target="#reject-course-modal" 
                                                        onclick="rejectCourse('<?php echo $pending->id; ?>', '<?php echo $pending->title; ?>')"
                                                        >
                                                            Reject
                                                        </a>
                                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approve-course-modal" onclick="approveCourse('<?php echo $pending->id; ?>', '<?php echo $pending->title; ?>')">
                                                            Approve
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                            <div class="table-responsive border-0 overflow-y-hidden">
                                <table class="table mb-0 text-nowrap" id="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase">
                                                Courses
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                Instructor
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                STATUS
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($approved_course->count() == 0)
                                            <tr>
                                                <td class="border-top-0 text-center" colspan="4">
                                                    No approved courses found.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($approved_course as $approve_course)
                                                <tr>
                                                    <td class="border-top-0">
                                                        <a href="#" class="text-inherit">
                                                            <div class="d-lg-flex align-items-center">
                                                                <div>
                                                                    <img src="/uploads/thumbnails/{{ $approve_course->filename }}" alt="" class="img-4by3-lg rounded" />
                                                                </div>
                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                    <h4 class="mb-1 text-primary-hover">
                                                                        {{ $approve_course->title }}
                                                                    </h4>
                                                                    <span class="text-inherit">Added on {{ $approve_course->created_at }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <div class="d-flex align-items-center">
                                                            <img src="../../assets/images/avatar/avatar-10.jpg" alt="" class="rounded-circle avatar-xs me-2" />
                                                            <h5 class="mb-0">{{$approve_course->instructor_name}}</h5>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>{{ $approve_course->status }}
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <span class="dropdown dropstart">
                                                        <a class="text-decoration-none text-muted" href="#" role="button" id="courseDropdown9"
                                                            data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                                        <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="courseDropdown9">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#reject-course-modal" onclick="rejectCourse('<?php echo $approve_course->id; ?>', '<?php echo $approve_course->title; ?>')">
                                                                <i class="fe fe-x-circle dropdown-item-icon"></i>
                                                                Reject
                                                            </a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ban-course-modal" onclick="banCourse('<?php echo $approve_course->id; ?>', '<?php echo $approve_course->title; ?>')">
                                                                Ban
                                                            </a>
                                                        </span>
                                                        </span>
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="not-approved" role="tabpanel" aria-labelledby="not-approved-tab">
                            <div class="table-responsive border-0 overflow-y-hidden">
                                <table class="table mb-0 text-nowrap" id="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase">
                                                Courses
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                Instructor
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                STATUS
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($not_approved_course->count() == 0)
                                            <tr>
                                                <td class="border-top-0 text-center" colspan="5">
                                                    No not approved courses found.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($not_approved_course as $not_approve_course)
                                                <tr>
                                                    <td class="border-top-0">
                                                        <a href="#" class="text-inherit">
                                                            <div class="d-lg-flex align-items-center">
                                                                <div>
                                                                    <img src="/uploads/thumbnails/{{ $not_approve_course->filename }}" alt="" class="img-4by3-lg rounded" />
                                                                </div>
                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                    <h4 class="mb-1 text-primary-hover">
                                                                        {{ $not_approve_course->title }}
                                                                    </h4>
                                                                    <span class="text-inherit">Added on {{ $not_approve_course->created_at }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <div class="d-flex align-items-center">
                                                            <img src="../../assets/images/avatar/avatar-7.jpg" alt="" class="rounded-circle avatar-xs me-2" />
                                                            <h5 class="mb-0">{{$not_approve_course->instructor_name}}</h5>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>{{ $not_approve_course->status}}
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <span class="dropdown dropstart">
                                                        <a class="text-decoration-none text-muted" href="#" role="button" id="courseDropdown13"
                                                            data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="courseDropdown13">
                                                            
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#approve-course-modal" onclick="approveCourse('<?php echo $not_approve_course->id; ?>', '<?php echo $not_approve_course->title; ?>')">
                                                                Approve
                                                            </a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ban-course-modal" onclick="banCourse('<?php echo $not_approve_course->id; ?>', '<?php echo $not_approve_course->title; ?>')">
                                                                Ban
                                                            </a>
                                                        </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="banned" role="tabpanel" aria-labelledby="banned-tab">
                            <div class="table-responsive border-0 overflow-y-hidden">
                                <table class="table mb-0 text-nowrap" id="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase">
                                                Courses
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                Instructor
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                STATUS
                                            </th>
                                            <th scope="col" class="border-0 text-uppercase">
                                                ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($banned_course->count() == 0)
                                            <tr>
                                                <td class="border-top-0 text-center" colspan="4">
                                                    No banned courses found.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($banned_course as $ban_course)
                                                <tr>
                                                    <td class="border-top-0">
                                                        <a href="#" class="text-inherit">
                                                            <div class="d-lg-flex align-items-center">
                                                                <div>
                                                                    <img src="/uploads/thumbnails/{{ $ban_course->filename }}" alt="" class="img-4by3-lg rounded" />
                                                                </div>
                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                    <h4 class="mb-1 text-primary-hover">
                                                                        {{ $ban_course->title }}
                                                                    </h4>
                                                                    <span class="text-inherit">Added on {{ $ban_course->created_on }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <div class="d-flex align-items-center">
                                                            <img src="../../assets/images/avatar/avatar-7.jpg" alt="" class="rounded-circle avatar-xs me-2" />
                                                            <h5 class="mb-0">{{$ban_course->instructor_name}}</h5>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Banned
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#unban-course-modal" onclick="unbanCourse('<?php echo $ban_course->id; ?>', '<?php echo $ban_course->title; ?>')">Unban</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Footer -->
                <div class="card-footer border-top-0">
                    <nav aria-label="Page navigation example">
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
<!-- Approve Course Modal -->
<div class="modal fade" id="approve-course-modal" tabindex="-1" role="dialog" aria-labelledby="addLectureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addLectureModalLabel">
                    Approve Lecture
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to approve <b id="name"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.approve_course') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <button class="btn btn-outline-success btn-sm" type="submit">
                        Appprove
                    </button>
                </form>
                <button class="btn btn-outline-white btn-sm" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Reject Course Modal -->
<div class="modal fade" id="reject-course-modal" tabindex="-1" role="dialog" aria-labelledby="addLectureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addLectureModalLabel">
                    Reject Lecture
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reject <b id="name"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.reject_course') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <button class="btn btn-outline-danger btn-sm" type="submit">
                        Reject
                    </button>
                </form>
                <button class="btn btn-outline-white btn-sm" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Ban Course Modal -->
<div class="modal fade" id="ban-course-modal" tabindex="-1" role="dialog" aria-labelledby="addLectureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addLectureModalLabel">
                    Ban Lecture
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to ban <b id="name"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.ban_course') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <button class="btn btn-outline-danger btn-sm" type="submit">
                        Ban
                    </button>
                </form>
                <button class="btn btn-outline-white btn-sm" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Unban Course Modal -->
<div class="modal fade" id="unban-course-modal" tabindex="-1" role="dialog" aria-labelledby="addLectureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addLectureModalLabel">
                    Unban Lecture
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to unban <b id="name"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.unban_course') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <button class="btn btn-outline-success btn-sm" type="submit">
                        Unban
                    </button>
                </form>
                <button class="btn btn-outline-white btn-sm" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('extra_js')
<script>
    function approveCourse(id, name ){
      $("#approve-course-modal #name").html(name);
      $("#approve-course-modal #id").val(id);
    }
    function rejectCourse(id, name){
      $("#reject-course-modal #name").html(name);
      $("#reject-course-modal #id").val(id);
    }
    function banCourse(id, name){
      $("#ban-course-modal #name").html(name);
      $("#ban-course-modal #id").val(id);
    }
    function unbanCourse(id, name){
      $("#unban-course-modal #name").html(name);
      $("#unban-course-modal #id").val(id);
    }
    var $rows = $('#table tr');
    $('#search').keyup(function() {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        
        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
  </script> 
@endsection
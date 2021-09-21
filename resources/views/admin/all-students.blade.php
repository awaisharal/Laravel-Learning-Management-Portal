@extends('admin.partials.layout')

@section('meta')

<title>All Students | {{config('app.name')}}</title>

@endsection

@section('css')


@endsection

@section('main_content')
<div class="container-fluid p-4">
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">
                        Students
                        <span class="fs-5 text-muted">(12,105)</span>
                    </h1>
                    <!-- Breadcrumb  -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../dashboard/admin-dashboard.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Students
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Sales</span>
                        </div>
                        <div>
                            <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        $10,800
                    </h2>
                    <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+20.9$</span>
                    <span class="ms-1 fw-medium">Number of sales</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Courses</span>
                        </div>
                        <div>
                            <span class=" fe fe-book-open fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        2,456
                    </h2>
                    <span class="text-danger fw-semi-bold">120+</span>
                    <span class="ms-1 fw-medium">Number of pending</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Students</span>
                        </div>
                        <div>
                            <span class=" fe fe-users fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        1,22,456
                    </h2>
                    <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+1200</span>
                    <span class="ms-1 fw-medium">Students</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Instructor</span>
                        </div>
                        <div>
                            <span class=" fe fe-user-check fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        22,786
                    </h2>
                    <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+200</span>
                    <span class="ms-1 fw-medium">Instructor</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <input type="search" class="form-control" placeholder="Search Student" />
                </div>
                @if($errors->any())
                        @if($errors->first() == 'course_approved')
                            <div class="mx-4 my-2 alert alert-danger" role="alert">
                                Student deleted successfully.
                            </div>
                        @elseif($errors->first() == 'student_banned')
                            <div class="mx-4 my-2 alert alert-warning" role="alert">
                                Student banned successfully.
                            </div>
                        @elseif($errors->first() == 'student_unbanned')
                            <div class="mx-4 my-2 alert alert-success" role="alert">
                                Student Unbanned successfully.
                            </div>
                        @elseif($errors->first() == 'unknownError')
                            <div class="mx-4 my-2 alert alert-danger" role="alert">
                                Try Again Please.
                            </div>
                        @endif
                    @endif                
                <div class="table-responsive">
                    
                    <table class="table mb-0 text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0">Name</th>
                                <th scope="col" class="border-0">
                                    Courses
                                </th>
                                <th scope="col" class="border-0">
                                    Joined
                                </th>
                                <th scope="col" class="border-0">
                                    Status
                                </th>
                                <th scope="col" class="border-0">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($student->count() == 0)
                                <tr>
                                    <td class="border-top-0 text-center" colspan="5">
                                        
                                    </td>
                                    
                                </tr>
                            @else
                                @foreach ($student as $stu)
                                    <tr>
                                        <td class="align-middle border-top-0">
                                            <div class="d-flex align-items-center">
                                                <img src="../../assets/images/avatar/avatar-12.jpg" alt="" class="rounded-circle avatar-md me-2" />
                                                <h5 class="mb-0">{{ $stu->name }}</h5>
                                            </div>
                                        </td>
                                        <td class="align-middle border-top-0">
                                            0 Courses
                                        </td>
                                        <td class="align-middle border-top-0">
                                            {{ $stu->created_at }}
                                        </td>
                                        <td class="align-middle border-top-0">
                                            @if ($stu->status == 0)
                                                <span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Banned
                                            @elseif ($stu->status == 1)
                                                <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active
                                            @endif
                                            
                                        </td>
                                        <td class="text-muted px-4 py-3 align-middle border-top-0">
                                            <span class="dropdown dropstart">
                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown"
                                                data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i></a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown">
                                                @if ($stu->status == 1)
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ban-student-modal" onclick="banStudent('<?php echo $stu->id; ?>', '<?php echo $stu->name; ?>')">
                                                        Ban
                                                    </a>
                                                @elseif($stu->status == 0)
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#unban-student-modal" onclick="unbanStudent('<?php echo $stu->id; ?>', '<?php echo $stu->name; ?>')">
                                                        Unban
                                                    </a>
                                                @endif
                                                
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-student-modal" onclick="deleteStudent('<?php echo $stu->id; ?>', '<?php echo $stu->name; ?>')">
                                                    Delete
                                                </a>
                                            </span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="pb-4 pt-4">
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
</div>
<!-- Delete Student Modal -->
<div class="modal fade" id="reject-student-modal" tabindex="-1" role="dialog" aria-labelledby="addLectureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addLectureModalLabel">
                    Delete Student
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <b id="name"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.delete_student') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <button class="btn btn-outline-danger btn-sm" type="submit">
                        Delete
                    </button>
                </form>
                <button class="btn btn-outline-white btn-sm" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Ban Student Modal -->
<div class="modal fade" id="ban-student-modal" tabindex="-1" role="dialog" aria-labelledby="addLectureModalLabel" aria-hidden="true">
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
                <form action="{{ route('admin.ban_student') }}" method="POST">
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

<!-- Unban Student Modal -->
<div class="modal fade" id="unban-student-modal" tabindex="-1" role="dialog" aria-labelledby="addLectureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addLectureModalLabel">
                    Unban Student
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to unban <b id="name"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.unban_student') }}" method="POST">
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
    function deleteStudent(id, name ){
      $("#delete-student-modal #name").html(name);
      $("#delete-student-modal #id").val(id);
    }
    function banStudent(id, name){
      $("#ban-student-modal #name").html(name);
      $("#ban-student-modal #id").val(id);
    }
    function unbanStudent(id, name){
      $("#unban-student-modal #name").html(name);
      $("#unban-student-modal #id").val(id);
    }
  </script> 
@endsection
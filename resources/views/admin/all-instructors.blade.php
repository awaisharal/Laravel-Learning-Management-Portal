@extends('admin.partials.layout')

@section('meta')

<title>All Instructors | {{config('app.name')}}</title>

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
                        Instructor
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
                                Instructor
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="nav btn-group" role="tablist">
                    <button class="btn btn-outline-white  active" data-bs-toggle="tab" data-bs-target="#tabPaneGrid" role="tab" aria-controls="tabPaneGrid" aria-selected="true">
                    <span class="fe fe-grid"></span>
                    </button>
                    <button class="btn btn-outline-white " data-bs-toggle="tab" data-bs-target="#tabPaneList" role="tab" aria-controls="tabPaneList" aria-selected="false">
                    <span class="fe fe-list"></span>
                    </button>
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
            <!-- Tab -->
            <div class="tab-content">
                <!-- Tab pane -->
                <div class="tab-pane fade show active" id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">
                    <div class="mb-4">
                        <input type="search" class="form-control" placeholder="Search Instructor" />
                    </div>
                    <div class="row">
                        @foreach ($instructor as $instructor)
                            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                                <!-- Card -->
                                <div class="card mb-4">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="text-center">
                                            @if ($instructor->img == "")
                                                <img src="/assets/images/instructors/icon.png" class="rounded-circle avatar-xl mb-3" alt="" />
                                            @else
                                                <img src="/assets/images/instructors/avatar-11.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
                                            @endif
                                            <h4 class="mb-0">{{ $instructor->name }}</h4>
                                            <p class="mb-0">{{ $instructor->title }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom py-2 mt-4">
                                            <span>Students</span>
                                            <span class="text-dark">{{ $instructor->students }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom py-2">
                                            <span>Instructor Rating</span>
                                            <span class="text-warning">
                                            4.5 <i class="mdi mdi-star"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between pt-2">
                                            <span>Courses</span>
                                            <span class="text-dark"> {{ $instructor->courses }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="pt-4">
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
                <!-- tab pane -->
                <div class="tab-pane fade" id="tabPaneList" role="tabpanel" aria-labelledby="tabPaneList">
                    <!-- card -->
                    <div class="card">
                        <!-- card header -->
                        <div class="card-header">
                            <input type="search" class="form-control" placeholder="Search Instructor" />
                        </div>
                        <!-- table -->
                        <div class="table-responsive">
                            <table class="table mb-0 text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="border-0">
                                            Name
                                        </th>
                                        <th scope="col" class="border-0">
                                            Title
                                        </th>
                                        <th scope="col" class="border-0">
                                            Students
                                        </th>
                                        <th scope="col" class="border-0">
                                            Courses
                                        </th>
                                        <th scope="col" class="border-0">
                                            Joined
                                        </th>
                                        <th scope="col" class="border-0">
                                            Rating
                                        </th>
                                        <th scope="col" class="border-0">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ins as $instructor)
                                        <tr>
                                            <td class="align-middle border-top-0">
                                                <div class="d-flex align-items-center">
                                                    @if ($instructor->img == "")
                                                        <img src="/assets/images/instructors/icon.png" alt="" class="rounded-circle avatar-md me-2" />
                                                    @else
                                                       <img src="/assets/images/avatar/avatar-12.jpg" alt="" class="rounded-circle avatar-md me-2" /> 
                                                    @endif
                                                    <h5 class="mb-0">{{ $instructor->name }}</h5>
                                                </div>
                                            </td>
                                            <td class="align-middle border-top-0">
                                                
                                                @if ($instructor->title == "")
                                                    No title added yet
                                                @else
                                                    {{ $instructor->title }}
                                                @endif
                                            </td>
                                            <td class="align-middle border-top-0">
                                                {{ $instructor->students }}
                                            </td>
                                            <td class="align-middle border-top-0">
                                                {{ $instructor->courses }}
                                            </td>
                                            <td class="align-middle border-top-0">
                                                7 July, 2020
                                            </td>
                                            <td class="align-middle text-warning border-top-0">
                                                4.5 <span class="mdi mdi-star"></span>
                                            </td>
                                            <td class="text-muted px-4 py-3 align-middle border-top-0">
                                                <span class="dropdown dropstart">
                                                <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown"
                                                    data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i></a>
                                                <span class="dropdown-menu" aria-labelledby="courseDropdown"><span
                                                    class="dropdown-header">Settings</span>
                                                <a class="dropdown-item" href="#"><i
                                                    class="fe fe-edit dropdown-item-icon"></i>Edit</a>
                                                <a class="dropdown-item" href="#"><i
                                                    class="fe fe-trash dropdown-item-icon"></i>Remove</a>
                                                </span>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
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
    </div>
</div>
@endsection

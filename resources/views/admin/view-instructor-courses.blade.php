@extends('admin.partials.layout')

@section('meta')

<title>Instructor Courses | {{config('app.name')}}</title>

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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card Header -->
                <div class="card-header border-bottom-0">
                    <form class="d-flex align-items-center">
                        <span class="position-absolute ps-3 search-icon">
                            <i class="fe fe-search"></i>
                        </span>
                        <input type="search" class="form-control ps-6" placeholder="Search Courses" />
                    </form>
                </div>
                <!-- Table  -->
                <div class="table-responsive border-0 overflow-y-hidden">
                    <table class="table mb-0 text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0">COURSES</th>
                                <th scope="col" class="border-0">Enrolled</th>
                                <th scope="col" class="border-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($courses != null)
                                @foreach($courses as $obj)
                                    <tr>
                                        <td class="border-top-0">
                                            <a href="/admin/course/{{ $obj->id }}/curriculum" class="text-inherit">
                                                <div class="d-lg-flex align-items-center">
                                                    <div>
                                                        <img src="/uploads/thumbnails/{{$obj->filename}}" alt="" class="img-4by3-lg rounded" />
                                                    </div>
                                                    <div class="ms-lg-3 mt-2 mt-lg-0">
                                                        <h4 class="mb-1 text-primary-hover">
                                                            {{$obj->title}}
                                                        </h4>
                                                        <span class="text-inherit">Added on 7 July, 2021</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle border-top-0">12,234</td>
                                        <td class="align-middle border-top-0">
                                            <span class="dropdown dropstart">
                                                <a class="text-decoration-none text-muted" href="#" role="button" id="courseDropdown1" data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                                    <i class="fe fe-more-vertical"></i>
                                                </a>
                                                <span class="dropdown-menu" aria-labelledby="courseDropdown1">
                                                    <span class="dropdown-header">Settings</span>
                                                    <a class="dropdown-item" href="#"><i class="fe fe-layers dropdown-item-icon"></i>Change Category</a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fe fe-trash dropdown-item-icon"></i>Delete Course
                                                    </a>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif($courses == null)
                                <tr>
                                    <td class="text-center" colspan="3">
                                        No courses added by instructor yet.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Card Footer -->
                <div class="card-footer border-top-0">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item disabled">
                                <a class="page-link mx-1 rounded" href="#" tabindex="-1" aria-disabled="true"><i class="mdi mdi-chevron-left"></i></a>
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
@endsection

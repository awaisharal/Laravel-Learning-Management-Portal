@extends('admin.partials.layout')

@section('meta')

<title>Course Details | {{config('app.name')}}</title>

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
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <input type="search" class="form-control" placeholder="Search Instructor" />
                </div>
                <div class="table-responsive">
                    @if(!empty($sections))
                        @php 
                            $i = 1;
                        @endphp
                        @foreach($sections as $obj)
                            <table class="table mb-0 text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="border-0">
                                            {{$obj->name}}
                                        </th>
                                        <th scope="col" class="border-0">
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$obj->lectures->isEmpty())
                                        @foreach($obj->lectures as $lec)
                                            <tr>
                                                <td>
                                                   <a href="/admin/course/curriculum/{{ $lec->id }}/details">{{$lec->title}}</a> 
                                                </td>
                                                <td style="text-align:right;">
                                                    <i class="fe fe-eye" style="font-size:14px;"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">
                                                <div class="alert alert-info">
                                                    No lectures available in this section
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        @endforeach
                    @endif
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
@endsection

@extends('admin.partials.layout')

@section('meta')

<title>Course Categories | {{config('app.name')}}</title>

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
                        Course Categories
                        <span class="fs-5 text-muted">({{count($categories)}})</span>
                    </h1>
                    <!-- Breadcrumb  -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/admin">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a>Course Categories</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="nav btn-group" role="tablist">
                    <a class="btn btn-outline-white active" href="#" data-bs-toggle="modal" data-bs-target="#add-category-modal">
                        Add Category
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <input type="search" id="search" class="form-control" placeholder="Search Category" />
                </div>
                @if($errors->any())
                    @if($errors->first() == 'cat_added')
                        <div class="mx-4 my-2 alert alert-success" role="alert">
                            Category created successfully.
                        </div>
                    @elseif($errors->first() == 'cat_updated')
                        <div class="mx-4 my-2 alert alert-success" role="alert">
                            Category updated successfully.
                        </div>
                    @elseif($errors->first() == 'cat_deleted')
                        <div class="mx-4 my-2 alert alert-success" role="alert">
                            Category deleted successfully.
                        </div>
                    @elseif($errors->first() == 'unknownError')
                        <div class="mx-4 my-2 alert alert-warning" role="alert">
                            Try Again Please.
                        </div>
                    @endif
                @endif                
                <div class="table-responsive">
                    <table class="table mb-0 text-nowrap" id="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0">
                                    Category Title
                                </th>
                                <th scope="col" class="border-0">
                                    Total Courses
                                </th>
                                <th scope="col" class="border-0">
                                    Status
                                </th>
                                <th scope="col" class="border-0">
                                    Date Added
                                </th>
                                <th scope="col" class="border-0" style="text-align: right;">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->count() == 0)
                                <tr>
                                    <td class="border-top-0 text-center" colspan="5">
                                        No categories added yet.
                                    </td>
                                </tr>
                            @else
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td class="align-middle border-top-0">
                                            {{ $cat->name }}
                                        </td>
                                        <td class="align-middle border-top-0">
                                            {{ $cat->course_count }}
                                        </td>
                                        <td class="align-middle border-top-0">
                                            @if ( $cat->status == "Trashed")
                                                <span class="text-danger">Deleted</span>
                                            @elseif ( $cat->status == "Live")
                                                <span class="text-success">Active</span>
                                            
                                            @endif
                                        </td>
                                        <td class="align-middle border-top-0">
                                            <?php echo date('d M, Y', strtotime($cat->created_at)); ?>
                                        </td>
                                        <td class="text-muted px-4 py-3 align-middle border-top-0" style="text-align: right; padding-right: 20px;">
                                            <span class="dropdown dropstart">
                                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown"
                                                data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i></a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit-category-modal" onclick="editCategory('<?php echo $cat->id; ?>', '<?php echo $cat->name; ?>')">
                                                    Edit
                                                </a>
                                                @if($cat->course_count == 0)
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-category-modal" onclick="deleteCategory('<?php echo $cat->id; ?>', '<?php echo $cat->name; ?>')">
                                                    Delete
                                                </a>
                                                @endif
                                            </span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="pb-4 pt-4 pagination">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addLectureModalLabel">
                    Add Course Category
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.add_category') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label class="form-label" for="cat_name">Category Name</label>
                            <input type="text" id="cat_name" class="form-control" placeholder="Category name" required name="category_name" />
                            @error('category_name')
                                <span>
                                    <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="" style="display:flex; float: right;">
                        <button class="btn btn-outline-primary" type="submit" style="margin-right:20px;">
                            Add Category
                        </button>
                        <button class="btn btn-outline-white" data-bs-dismiss="modal" aria-label="Close">
                            Close
                        </button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editCategoryModalLabel">
                    Edit Course Category
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.edit_category') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="" id="id" >
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label class="form-label" for="name">Category Name</label>
                            <input type="text" id="name" value="" name="name" class="form-control" placeholder="Category name" required />
                            @error('name')
                                <span>
                                    <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="" style="display:flex; float: right;">
                        <button class="btn btn-outline-primary" type="submit">
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Student Modal -->
<div class="modal fade" id="delete-category-modal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteCategoryModalLabel">
                    Delete Category
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <b id="name" class="text-danger"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.delete_category') }}" method="POST">
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

@endsection
@section('extra_js')
<script>
    function editCategory(id, name) {
        $("#edit-category-modal #id").val(id);
        $("#edit-category-modal #name").val(name);
    }
    function deleteCategory(id, name ){
      $("#delete-category-modal #name").html(name);
      $("#delete-category-modal #id").val(id);
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
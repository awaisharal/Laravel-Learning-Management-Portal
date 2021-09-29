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
                        {{ $lecture[0]->title }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4>Description</h4>
                        <p>
                            {!! $lecture[0]->description !!}
                        </p>
                        @if ($lecture[0]->video != "")
                            <h4>
                                Video
                            </h4>
                            <div class="embed-responsive  position-relative w-100 d-block overflow-hidden p-0" style="height: 300px;">
                                <iframe class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100" src="/uploads/lectures/{{$lecture[0]->video}}"></iframe>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
